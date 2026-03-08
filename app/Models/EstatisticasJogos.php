<?php

class EstatisticasJogos
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

	public function getDadosCompletos($id_loja, $mes, $ano)
	{
		$dados = [];

		// Filtros para a tabela de Torneios (usa data_criacao)
		$condicaoTorneio = ($mes > 0) ? "AND MONTH(t.data_criacao) = ? AND YEAR(t.data_criacao) = ?" : "AND YEAR(t.data_criacao) = ?";
		$paramsTorneio = ($mes > 0) ? [$id_loja, $mes, $ano] : [$id_loja, $ano];

		// Filtros para a tabela de Pedidos (usa criado_em)
		$condicaoPedido = ($mes > 0) ? "AND MONTH(criado_em) = ? AND YEAR(criado_em) = ?" : "AND YEAR(criado_em) = ?";
		$paramsPedido = ($mes > 0) ? [$id_loja, $mes, $ano] : [$id_loja, $ano];

		// 1. Clientes mais assíduos (Frequência) - Corrigido os nomes das colunas de data
		$sqlFreq = "SELECT c.nome, COUNT(*) as total_presencas
					FROM (
						SELECT id_cliente FROM pedidos
						WHERE id_loja = ? $condicaoPedido

						UNION ALL

						SELECT tp.id_cliente FROM torneio_participantes tp
						JOIN torneios t ON tp.id_torneio = t.id_torneio
						WHERE t.id_loja = ? $condicaoTorneio
					) as presencas
					JOIN clientes c ON presencas.id_cliente = c.id_cliente
					GROUP BY c.id_cliente
					ORDER BY total_presencas DESC LIMIT 10";

		$stmt = $this->db->prepare($sqlFreq);
		// Mesclamos os parâmetros de Pedidos e Torneios para o UNION
		$stmt->execute(array_merge($paramsPedido, $paramsTorneio));
		$dados['frequencia'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

		// 2. Maiores Vencedores (Pódio)
		$sqlWins = "SELECT c.nome, COUNT(trf.id_torneio) as vitorias
					FROM torneio_resultados_finais trf
					JOIN torneios t ON trf.id_torneio = t.id_torneio
					JOIN clientes c ON trf.id_cliente = c.id_cliente
					WHERE t.id_loja = ? AND trf.posicao = 1 $condicaoTorneio
					GROUP BY c.id_cliente
					ORDER BY vitorias DESC LIMIT 10";
		$stmt = $this->db->prepare($sqlWins);
		$stmt->execute($paramsTorneio);
		$dados['vencedores'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

		// 3. Popularidade por Cardgame
		$sqlPop = "SELECT cg.nome, COUNT(t.id_torneio) as total_torneios
				   FROM torneios t
				   JOIN cardgames cg ON t.id_cardgame = cg.id_cardgame
				   WHERE t.id_loja = ? $condicaoTorneio
				   GROUP BY t.id_cardgame
				   ORDER BY total_torneios DESC";
		$stmt = $this->db->prepare($sqlPop);
		$stmt->execute($paramsTorneio);
		$dados['popularidade_cardgames'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $dados;
	}

    public function getEvolucaoMensal($id_loja, $ano) {
        $sql = "SELECT MONTH(t.data_criacao) as mes, COUNT(tp.id_cliente) as total
                FROM torneio_participantes tp
                JOIN torneios t ON tp.id_torneio = t.id_torneio
                WHERE t.id_loja = ? AND YEAR(t.data_criacao) = ?
                GROUP BY MONTH(t.data_criacao)
                ORDER BY mes ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_loja, $ano]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $formatado = array_fill(1, 12, 0);
        foreach ($res as $row) { $formatado[(int)$row['mes']] = (int)$row['total']; }
        return array_values($formatado);
    }

	public function getCardgameMaisJogadoPorMes($id_loja, $ano) {
		$sql = "SELECT mes, id_cardgame, nome_cardgame, imagem_fundo_card, total_torneios
				FROM (
					SELECT
						MONTH(t.data_criacao) as mes,
						cg.id_cardgame,
						cg.nome as nome_cardgame,
						IFNULL(cg.imagem_fundo_card, '') as imagem_fundo_card,
						COUNT(t.id_torneio) as total_torneios,
						ROW_NUMBER() OVER (PARTITION BY MONTH(t.data_criacao) ORDER BY COUNT(t.id_torneio) DESC) as ranking
					FROM torneios t
					JOIN cardgames cg ON t.id_cardgame = cg.id_cardgame
					WHERE t.id_loja = ? AND YEAR(t.data_criacao) = ? AND t.status = 'finalizado'
					GROUP BY MONTH(t.data_criacao), cg.id_cardgame
				) as ranking_mensal
				WHERE ranking = 1
				ORDER BY mes ASC";

		$stmt = $this->db->prepare($sql);
		$stmt->execute([$id_loja, $ano]);
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$nomes = array_fill(0, 12, '');
		$valores = array_fill(0, 12, 0);
		$imagens = array_fill(0, 12, '');
		$ids = array_fill(0, 12, 0);

		foreach ($res as $row) {
			$idx = (int)$row['mes'] - 1;
			$nomes[$idx] = $row['nome_cardgame'];
			$valores[$idx] = (int)$row['total_torneios'];
			$imagens[$idx] = $row['imagem_fundo_card'];
			$ids[$idx] = $row['id_cardgame'];
		}

		return ['nomes' => $nomes, 'valores' => $valores, 'imagens' => $imagens, 'ids' => $ids];
	}

}
