<?php

class Torneio
{
    protected $db;

    public function __construct()
    {
        // Conexão padrão do seu sistema
        $this->db = Database::getInstance();
    }

    // Busca dados básicos de um torneio
	public function buscar($id_torneio, $id_loja)
	{
		$sql = "SELECT t.*, c.nome AS cardgame
				FROM torneios t
				LEFT JOIN cardgames c ON t.id_cardgame = c.id_cardgame
				WHERE t.id_torneio = ? AND t.id_loja = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->execute([$id_torneio, $id_loja]);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

    //listar todos os torneios criados na loja.
    public function listarTodos($id_loja)
    {
        $sql = "SELECT t.*, c.nome as cardgame
            FROM torneios t
            LEFT JOIN cardgames c ON t.id_cardgame = c.id_cardgame
            WHERE t.id_loja = ?
            ORDER BY t.id_torneio DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_loja]);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Criar o 'tipo_legivel' que a view está procurando
        foreach ($resultados as &$r) {
            $r['tipo_legivel'] = $this->formatarTipoTorneio($r['tipo_torneio']);
        }

        return $resultados;
    }

    // lista para o campo dos combobox e tabelas
    private function formatarTipoTorneio($tipo) {
        $tipos = [
            'suico_bo1' => 'Suíço (MD1)',
            'suico_bo3' => 'Suíço (MD3)',
            'elim_dupla_bo3' => 'Eliminação Dupla (MD3)',
            'elim_simples_bo1' => 'Eliminação Simples (MD1)'
        ];
        return $tipos[$tipo] ?? $tipo;
    }

	public function listarClientesParaTorneio($id_loja, $id_cardgame, $id_torneio = null)
	{
		$sql = "SELECT c.id_cliente, c.nome, c.documento,
					   CASE WHEN tp.id_cliente IS NOT NULL THEN 1 ELSE 0 END AS inscrito
				FROM clientes c
				INNER JOIN clientes_lojas cl ON c.id_cliente = cl.id_cliente
				INNER JOIN clientes_cardgames cc ON c.id_cliente = cc.id_cliente
				LEFT JOIN torneio_participantes tp
					   ON tp.id_cliente = c.id_cliente AND tp.id_torneio = ?
				WHERE cl.id_loja = ?
				  AND cc.id_cardgame = ?
				  AND cl.status = 'ativo'
				ORDER BY c.nome ASC";

		$stmt = $this->db->prepare($sql);
		$stmt->execute([$id_torneio, $id_loja, $id_cardgame]);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function salvar($dados)
	{
		if (!empty($dados['id_torneio'])) {
			$sql = "UPDATE torneios SET
						id_cardgame = ?,
						nome_torneio = ?,
						tipo_torneio = ?,
						tempo_rodada = ?
					WHERE id_torneio = ? AND id_loja = ?";

			$stmt = $this->db->prepare($sql);
			$stmt->execute([
				$dados['id_cardgame'],
				$dados['nome_torneio'],
				$dados['tipo_torneio'],
				$dados['tempo_rodada'],
				$dados['id_torneio'],
				$dados['id_loja']
			]);

			return $dados['id_torneio'];
		} else {
			$sql = "INSERT INTO torneios
					(id_loja, id_cardgame, nome_torneio, tipo_torneio, tempo_rodada, status, data_criacao)
					VALUES (?, ?, ?, ?, ?, 'em_andamento', NOW())"; // Alterado de 'aberto' para 'em_andamento'

			$stmt = $this->db->prepare($sql);
			$stmt->execute([
				$dados['id_loja'],
				$dados['id_cardgame'],
				$dados['nome_torneio'],
				$dados['tipo_torneio'],
				$dados['tempo_rodada']
			]);
			return $this->db->lastInsertId();
		}
    }

	public function vincularParticipantes($idTorneio, $selecionados)
	{
		// Remove vínculos antigos
		$sql = "DELETE FROM torneio_participantes WHERE id_torneio = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->execute([$idTorneio]);

		// Insere os novos vínculos
		$sql = "INSERT INTO torneio_participantes (id_torneio, id_cliente) VALUES (?, ?)";
		$stmt = $this->db->prepare($sql);

		foreach ($selecionados as $idCliente) {
			$stmt->execute([$idTorneio, $idCliente]);
		}
	}


	public function excluirTorneioCompleto($id_torneio, $id_loja) {
		try {
			// Iniciamos uma transação para garantir que ou apaga tudo ou não apaga nada
			$this->db->beginTransaction();

			// 1. Deletar partidas (dependem das rodadas)
			$sqlPartidas = "DELETE FROM torneio_partidas WHERE id_rodada IN (SELECT id_rodada FROM torneio_rodadas WHERE id_torneio = ?)";
			$this->db->prepare($sqlPartidas)->execute([$id_torneio]);

			// 2. Deletar rodadas
			$sqlRodadas = "DELETE FROM torneio_rodadas WHERE id_torneio = ?";
			$this->db->prepare($sqlRodadas)->execute([$id_torneio]);

			// 3. Deletar participantes (vínculo entre cliente e torneio)
			$sqlParticipantes = "DELETE FROM torneio_participantes WHERE id_torneio = ?";
			$this->db->prepare($sqlParticipantes)->execute([$id_torneio]);

			// 4. Por fim, deletar o torneio
			$sqlTorneio = "DELETE FROM torneios WHERE id_torneio = ? AND id_loja = ?";
			$this->db->prepare($sqlTorneio)->execute([$id_torneio, $id_loja]);

			$this->db->commit();
			return true;
		} catch (Exception $e) {
			// Se algo der errado, desfaz as exclusões
			$this->db->rollBack();
			return false;
		}
    }

	public function inscreverParticipante($id_torneio, $id_cliente) {
		$sql = "INSERT IGNORE INTO torneio_participantes (id_torneio, id_cliente) VALUES (?, ?)";
		$stmt = $this->db->prepare($sql);
		$stmt->execute([$id_torneio, $id_cliente]);
	}

	public function buscarPublico($id_torneio)
	{
		$sql = "SELECT
					t.id_torneio,
					t.nome_torneio,
					t.id_loja,
					t.id_cardgame,
					t.data_criacao,
					c.nome AS cardgame
				FROM torneios t
				LEFT JOIN cardgames c ON t.id_cardgame = c.id_cardgame
				WHERE t.id_torneio = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->execute([$id_torneio]);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function getRankingPorJogo($id_loja, $ano, $mes = null)
	{
		// Ajustado: cg.nome, c.nome e t.data_criacao conforme sua estrutura
		$sql = "SELECT
					cg.nome as cardgame,
					c.nome as cliente_nome,
					SUM(trf.pontos_totais) as total_pontos
				FROM torneio_resultados_finais trf
				JOIN clientes c ON trf.id_cliente = c.id_cliente
				JOIN torneios t ON trf.id_torneio = t.id_torneio
				JOIN cardgames cg ON t.id_cardgame = cg.id_cardgame
				WHERE t.id_loja = ? AND YEAR(t.data_criacao) = ?";

		$params = [$id_loja, $ano];

		if ($mes) {
			$sql .= " AND MONTH(t.data_criacao) = ?";
			$params[] = $mes;
		}

		$sql .= " GROUP BY cg.id_cardgame, c.id_cliente
				  ORDER BY cg.nome ASC, total_pontos DESC";

		$stmt = $this->db->prepare($sql);
		$stmt->execute($params);
		$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$rankingOrganizado = [];

		foreach ($resultados as $row) {
			$jogo = $row['cardgame'];

			if (!isset($rankingOrganizado[$jogo])) {
				$rankingOrganizado[$jogo] = [];
			}

			if (count($rankingOrganizado[$jogo]) < 3) {
				$rankingOrganizado[$jogo][] = [
					'nome' => $row['cliente_nome'],
					'total_pontos' => $row['total_pontos']
				];
			}
		}

		return $rankingOrganizado;
	}

	public function buscarRankingAcumulado($cardgame, $periodo = 'mensal')
	{
		$filtroData = ($periodo === 'mensal')
			? "AND MONTH(t.data_torneio) = MONTH(CURRENT_DATE()) AND YEAR(t.data_torneio) = YEAR(CURRENT_DATE())"
			: "AND YEAR(t.data_torneio) = YEAR(CURRENT_DATE())";

		$sql = "SELECT
					c.nome,
					SUM(trf.pontos_totais) as total_pontos
				FROM torneio_resultados_finais trf
				JOIN clientes c ON trf.id_cliente = c.id_cliente
				JOIN torneios t ON trf.id_torneio = t.id_torneio
				WHERE t.cardgame = ? $filtroData
				GROUP BY c.id_cliente
				ORDER BY total_pontos DESC
				LIMIT 3";

		$stmt = $this->db->prepare($sql);
		$stmt->execute([$cardgame]);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}


}
