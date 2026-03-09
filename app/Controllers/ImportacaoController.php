<?php

class ImportacaoController extends Controller
{
    public function index()
    {
        AuthMiddleware::verificarLogin();

        $importacaoModel = new Importacao();
        $lotes = $importacaoModel->listarLotes($_SESSION['LOJA']['id_loja']);

        $this->view('importacao/index', [
            'lotes' => $lotes
        ]);
    }

	public function processar()
	{
		AuthMiddleware::verificarLogin();

		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['arquivo_csv'])) {
			$idLoja = $_SESSION['LOJA']['id_loja'];
			$arquivo = $_FILES['arquivo_csv'];
			$tipo_arquivo = $_POST['tipo_arquivo'];
			$referencia = $_POST['referencia_periodo'];

			if ($arquivo['error'] === UPLOAD_ERR_OK) {
				$importacaoModel = new Importacao();

				// 1. Criar o registro do Lote no banco
				$id_lote = $importacaoModel->criarLote(
					$idLoja,
					$arquivo['name'],
					$tipo_arquivo,
					$referencia
				);

				$handle = fopen($arquivo['tmp_name'], "r");
				$primeiraLinha = true;
				$totalItens = 0;
				$valorAcumulado = 0;

				// 2. Processar cada linha do CSV
				while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
					if ($primeiraLinha) { $primeiraLinha = false; continue; }

					// --- A) Captura de valores numéricos ---
					$qtd = (int)($row[8] ?? 0);
					$valorTotalLinha = Importacao::limparMoeda($row[9] ?? '0,00');
					$valorMedio = Importacao::limparMoeda($row[10] ?? '0,00');

					// --- B) Nome do Produto ---
					$nomePT    = trim($row[4] ?? '');
					$nomeEN    = trim($row[5] ?? '');
					$nomeCab   = trim($row[6] ?? '');

					$nomeFinal = !empty($nomePT) ? $nomePT : (!empty($nomeEN) ? $nomeEN : (!empty($nomeCab) ? $nomeCab : 'Produto sem Nome'));

					// --- C) Classificação e Identificação do Jogo ---
					$tipoProdutoOriginalCSV = trim($row[0] ?? ''); // Mantém "Magic: The Gathering", "Pokemon", etc.
					$categoriaRaw = $row[7] ?? '';

					// Identificação lógica para colunas auxiliares
					$partesCat = explode(' > ', $categoriaRaw);
					$jogoBase  = trim($partesCat[0] ?? 'Outros');
					$subCat    = trim($partesCat[1] ?? 'Geral');

					$catLower = mb_strtolower($categoriaRaw);
					$tipoLower = mb_strtolower($tipoProdutoOriginalCSV);

					// Refinamento do jogoBase para garantir consistência
					if (strpos($tipoLower, 'magic') !== false || strpos($catLower, 'produtos selados de magic') !== false) {
						$jogoBase = 'Magic: The Gathering';
					} elseif (strpos($tipoLower, 'pokemon') !== false || strpos($catLower, 'pokemon >') !== false) {
						$jogoBase = 'Pokemon';
					} elseif (strpos($tipoLower, 'yugioh') !== false || strpos($catLower, 'yu-gi-oh >') !== false) {
						$jogoBase = 'Yu-Gi-Oh!';
					}

					// --- D) Montagem do Array de Dados ---
					// Importante: tipo_p RECEBE o valor original para não quebrar os gráficos de pizza
					$dadosVenda = [
						'id_loja'    => $idLoja,
						'id_lote'    => $id_lote,
						'tipo_p'     => $tipoProdutoOriginalCSV, // Valor original: Magic, Pokemon ou Produto
						'status'     => $row[1] ?? '',
						'envio'      => $row[2] ?? '',
						'pagto'      => $row[3] ?? '',
						'nome_pt'    => mb_substr($nomeFinal, 0, 255),
						'nome_en'    => mb_substr($nomeEN, 0, 255),
						'cat_comp'   => mb_substr($categoriaRaw, 0, 255),
						'qtd'        => $qtd,
						'total'      => $valorTotalLinha,
						'medio'      => $valorMedio,
						'jogo'       => mb_substr($jogoBase, 0, 150),
						'subcat'     => mb_substr($subCat, 0, 150)
					];

					if ($importacaoModel->inserirVenda($dadosVenda)) {
						$totalItens += $qtd;
						$valorAcumulado += $valorTotalLinha;
					}
				}

				$importacaoModel->finalizarLote($id_lote, $totalItens, $valorAcumulado);
				fclose($handle);
				$_SESSION['flash'] = "Sucesso: Lote #{$id_lote} importado com {$totalItens} itens!";
			} else {
				$_SESSION['flash'] = "Erro no upload do arquivo.";
			}
		}

		header("Location: " . rtrim($this->baseUrl, '/') . "/importacao");
		exit;
	}

    public function detalhes($id_lote)
    {
        AuthMiddleware::verificarLogin();
        $idLoja = $_SESSION['LOJA']['id_loja'];
        $db = Database::getInstance();

        // 1. Dados do Lote
        $sqlLote = "SELECT * FROM lotes_importacao WHERE id_lote = :id AND id_loja = :id_loja";
        $stmt = $db->prepare($sqlLote);
        $stmt->execute(['id' => $id_lote, 'id_loja' => $idLoja]);
        $lote = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$lote) {
            header("Location: " . rtrim($this->baseUrl, '/') . "/importacao");
            exit;
        }

        // 2. Faturamento bruto por Tipo (Para os boxes superiores de Single vs Selado)
        $sqlTipo = "SELECT tipo_produto, SUM(preco_total) as total
                    FROM vendas_ligamagic
                    WHERE id_lote = :id AND id_loja = :id_loja
                    GROUP BY tipo_produto";
        $stmt = $db->prepare($sqlTipo);
        $stmt->execute(['id' => $id_lote, 'id_loja' => $idLoja]);
        $dadosTipo = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // 3. Faturamento por Pagamento (Gráfico 2)
        $sqlPagto = "SELECT forma_pagamento, SUM(preco_total) as total
                     FROM vendas_ligamagic
                     WHERE id_lote = :id AND id_loja = :id_loja
                     GROUP BY forma_pagamento ORDER BY total DESC";
        $stmt = $db->prepare($sqlPagto);
        $stmt->execute(['id' => $id_lote, 'id_loja' => $idLoja]);
        $dadosPagto = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // 4. Quantidade por Envio (Gráfico 3)
        $sqlEnvio = "SELECT forma_envio, COUNT(*) as qtd_pedidos
                     FROM vendas_ligamagic
                     WHERE id_lote = :id AND id_loja = :id_loja
                     GROUP BY forma_envio ORDER BY qtd_pedidos DESC";
        $stmt = $db->prepare($sqlEnvio);
        $stmt->execute(['id' => $id_lote, 'id_loja' => $idLoja]);
        $dadosEnvio = $stmt->fetchAll(PDO::FETCH_ASSOC);

		// 5. Inventário de Selados (Tabela) - Ajustado para identificar pela subcategoria
		$sqlSelados = "SELECT
			nome_produto_pt as nome_produto,
			jogo_base as jogo,
			SUM(quantidade) as quantidade,
			SUM(preco_total) as total
			FROM vendas_ligamagic
			WHERE id_lote = :id
			  AND id_loja = :id_loja
			  /* Agora filtramos pelo que define um selado na subcategoria ou categoria completa */
			  AND (subcategoria LIKE '%Boosters%'
				   OR subcategoria LIKE '%Selados%'
				   OR categoria_completa LIKE '%Selados%'
				   OR tipo_produto = 'Produto')
			GROUP BY nome_produto_pt, jogo_base
			ORDER BY total DESC";

		$stmt = $db->prepare($sqlSelados);
		$stmt->execute(['id' => $id_lote, 'id_loja' => $idLoja]);
		$listaSelados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // 6. Top Itens do Lote (Tabela)
        $sqlTop = "SELECT nome_produto_pt as nome_produto, jogo_base as jogo, SUM(quantidade) as quantidade, SUM(preco_total) as total
                   FROM vendas_ligamagic
                   WHERE id_lote = :id AND id_loja = :id_loja
                   GROUP BY nome_produto_pt, jogo_base
                   ORDER BY total DESC LIMIT 15";
        $stmt = $db->prepare($sqlTop);
        $stmt->execute(['id' => $id_lote, 'id_loja' => $idLoja]);
        $topProdutos = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$sqlGrafico = "SELECT
		CASE
			WHEN tipo_produto LIKE '%Pokemon%'
				 OR subcategoria LIKE '%Pokemon%'
				 OR categoria_completa LIKE '%Pokemon%'
				 OR tipo_produto LIKE '%Pok_mon%' THEN 'Pokémon'

			WHEN tipo_produto LIKE '%Magic%'
				 OR subcategoria LIKE '%Magic%'
				 OR categoria_completa LIKE '%Magic%' THEN 'Magic: The Gathering'

			WHEN tipo_produto LIKE '%Yu-Gi-Oh%'
				 OR subcategoria LIKE '%Yu-Gi-Oh%'
				 OR categoria_completa LIKE '%Yu-Gi-Oh%'
				 OR tipo_produto LIKE '%Yugioh%' THEN 'Yu-Gi-Oh!'

			ELSE 'Outros'
		END as cardgame,
		SUM(preco_total) as total
		FROM vendas_ligamagic
		WHERE id_lote = :id AND id_loja = :id_loja
		GROUP BY cardgame";

        $stmtGrafico = $db->prepare($sqlGrafico);
        $stmtGrafico->execute(['id' => $id_lote, 'id_loja' => $idLoja]);
        $dadosGraficoCardgame = $stmtGrafico->fetchAll(PDO::FETCH_ASSOC);

        // 8. Query para Agrupamento por Categoria Completa (Tabela e Barras)
        $sqlCategorias = "SELECT
            categoria_completa,
            SUM(quantidade) as total_qtd,
            SUM(preco_total) as total_valor
            FROM vendas_ligamagic
            WHERE id_lote = :id AND id_loja = :id_loja
            GROUP BY categoria_completa
            ORDER BY categoria_completa ASC";

        $stmtCat = $db->prepare($sqlCategorias);
        $stmtCat->execute(['id' => $id_lote, 'id_loja' => $idLoja]);
        $dadosCategorias = $stmtCat->fetchAll(PDO::FETCH_ASSOC);

        // 9. Renderização da View com TODOS os dados reunidos
        $this->view('importacao/detalhes', [
            'lote'                 => $lote,
            'dadosTipo'            => $dadosTipo,
            'dadosPagto'           => $dadosPagto,
            'dadosEnvio'           => $dadosEnvio,
            'listaSelados'         => $listaSelados,
            'topProdutos'          => $topProdutos,
            'dadosGraficoCardgame' => $dadosGraficoCardgame,
            'dadosCategorias'      => $dadosCategorias
        ]);


    }

    public function excluir($id_lote)
    {
        AuthMiddleware::verificarLogin();
        $db = Database::getInstance();
        $sql = "DELETE FROM lotes_importacao WHERE id_lote = :id AND id_loja = :id_loja";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            'id' => $id_lote,
            'id_loja' => $_SESSION['LOJA']['id_loja']
        ]);

        $_SESSION['flash'] = "Lote removido com sucesso.";
        header("Location: " . rtrim($this->baseUrl, '/') . "/importacao");
        exit;
    }

	public function dashboard()
	{
		AuthMiddleware::verificarLogin();

		// Conexão correta seguindo seu padrão
		$db = Database::getInstance();
		$idLoja = $_SESSION['LOJA']['id_loja'];

		// 1. Faturamento por Jogo
		$sqlJogos = "SELECT
				jogo_base,
				SUM(quantidade) as qtd,
				SUM(preco_total) as total
			FROM vendas_ligamagic
			WHERE id_loja = :id_loja
			GROUP BY jogo_base
			ORDER BY total DESC";

		$stmtJogos = $db->prepare($sqlJogos);
		$stmtJogos->execute(['id_loja' => $idLoja]);
		$dadosPorJogo = $stmtJogos->fetchAll(PDO::FETCH_ASSOC);

		// 2. Top 10 Produtos (Maior Receita)
		$sqlTop = "SELECT
				nome_produto_pt,
				jogo_base,
				SUM(quantidade) as qtd,
				SUM(preco_total) as total
			FROM vendas_ligamagic
			WHERE id_loja = :id_loja
			GROUP BY nome_produto_pt, jogo_base
			ORDER BY total DESC
			LIMIT 10";

		$stmtTop = $db->prepare($sqlTop);
		$stmtTop->execute(['id_loja' => $idLoja]);
		$topProdutos = $stmtTop->fetchAll(PDO::FETCH_ASSOC);

		// 3. Renderiza a View passando as variáveis
		$this->view('importacao/dashboard', [
			'dadosPorJogo' => $dadosPorJogo,
			'topProdutos'  => $topProdutos
		]);
	}
}
