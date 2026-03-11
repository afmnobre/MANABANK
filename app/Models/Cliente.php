<?php

class Cliente
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function listarPorLoja($id_loja)
    {
        $sql = "SELECT * FROM clientes_lojas cl
                INNER JOIN clientes c ON c.id_cliente = cl.id_cliente
                WHERE cl.id_loja = :id_loja
                ORDER BY c.nome ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id_loja' => $id_loja]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function criarOuVincular($dadosCliente, $id_loja, $cardgames)
    {
        $stmt = $this->db->prepare("SELECT * FROM clientes WHERE telefone = :telefone");
        $stmt->execute(['telefone' => $dadosCliente['telefone']]);
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

        $novo = false;

        if ($cliente) {
            $id_cliente = $cliente['id_cliente'];

            $stmt2 = $this->db->prepare("
                INSERT IGNORE INTO clientes_lojas (id_cliente, id_loja, status)
                VALUES (:id_cliente, :id_loja, 'ativo')
            ");
            $stmt2->execute([
                'id_cliente' => $id_cliente,
                'id_loja'    => $id_loja
            ]);
        } else {
            $stmt = $this->db->prepare("
                INSERT INTO clientes (nome, email, telefone)
                VALUES (:nome, :email, :telefone)
            ");
            $stmt->execute($dadosCliente);
            $id_cliente = $this->db->lastInsertId();

            $stmt2 = $this->db->prepare("
                INSERT INTO clientes_lojas (id_cliente, id_loja, status)
                VALUES (:id_cliente, :id_loja, 'ativo')
            ");
            $stmt2->execute([
                'id_cliente' => $id_cliente,
                'id_loja'    => $id_loja
            ]);

            $novo = true;
        }

        foreach ($cardgames as $id_cardgame) {
            $stmt3 = $this->db->prepare("
                INSERT IGNORE INTO clientes_cardgames (id_cliente, id_cardgame)
                VALUES (:id_cliente, :id_cardgame)
            ");
            $stmt3->execute([
                'id_cliente'  => $id_cliente,
                'id_cardgame' => $id_cardgame
            ]);
        }

        return ['id_cliente' => $id_cliente, 'novo' => $novo];
    }

    public function buscar($id, $id_loja)
    {
        $sql = "
            SELECT c.*
            FROM clientes c
            INNER JOIN clientes_lojas cl ON c.id_cliente = cl.id_cliente
            WHERE c.id_cliente = :id
              AND cl.id_loja = :id_loja
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id'      => $id,
            'id_loja' => $id_loja
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $dadosCliente, $cardgames)
    {
        $stmt = $this->db->prepare("
            UPDATE clientes
            SET nome = :nome, email = :email, telefone = :telefone
            WHERE id_cliente = :id
        ");
        $stmt->execute([
            'nome'     => $dadosCliente['nome'],
            'email'    => $dadosCliente['email'],
            'telefone' => $dadosCliente['telefone'],
            'id'       => $id
        ]);

        $stmtDel = $this->db->prepare("DELETE FROM clientes_cardgames WHERE id_cliente = :id_cliente");
        $stmtDel->execute(['id_cliente' => $id]);

        foreach ($cardgames as $id_cardgame) {
            $stmtIns = $this->db->prepare("
                INSERT INTO clientes_cardgames (id_cliente, id_cardgame)
                VALUES (:id_cliente, :id_cardgame)
            ");
            $stmtIns->execute([
                'id_cliente'  => $id,
                'id_cardgame' => $id_cardgame
            ]);
        }

        return true;
    }

	public function excluir($id, $id_loja)
	{
		$stmt = $this->db->prepare("
			DELETE FROM clientes_lojas
			WHERE id_cliente = :id AND id_loja = :id_loja
		");

		return $stmt->execute([
			'id'      => $id,
			'id_loja' => $id_loja
		]);
	}

    public function listarCardgames($id_cliente)
    {
        $sql = "
            SELECT cg.*
            FROM cardgames cg
            INNER JOIN clientes_cardgames ccg ON cg.id_cardgame = ccg.id_cardgame
            WHERE ccg.id_cliente = :id_cliente
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id_cliente' => $id_cliente]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorTelefone($telefone)
    {
        $sql = "SELECT * FROM clientes WHERE telefone = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$telefone]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listarPorLojaECardgame($id_loja, $id_cardgame)
    {
        $sql = "SELECT c.*
                FROM clientes c
                INNER JOIN clientes_lojas cl ON c.id_cliente = cl.id_cliente
                INNER JOIN clientes_cardgames ccg ON c.id_cliente = ccg.id_cliente
                WHERE cl.id_loja = :id_loja
                    AND ccg.id_cardgame = :id_cardgame
                    AND cl.status = 'ativo'
                ORDER BY c.nome ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id_loja'    => $id_loja,
            'id_cardgame'=> $id_cardgame
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

	public function buscarPorCelular($telefone)
	{
		$sql = "SELECT * FROM clientes WHERE telefone = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->execute([$telefone]);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function vinculadoLoja($id_cliente, $id_loja)
	{
		$sql = "SELECT 1 FROM clientes_lojas WHERE id_cliente = ? AND id_loja = ? AND status = 'ativo'";
		$stmt = $this->db->prepare($sql);
		$stmt->execute([$id_cliente, $id_loja]);
		return (bool)$stmt->fetch();
	}

	public function vinculadoCardgame($id_cliente, $id_cardgame)
	{
		$sql = "SELECT 1 FROM clientes_cardgames WHERE id_cliente = ? AND id_cardgame = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->execute([$id_cliente, $id_cardgame]);
		return (bool)$stmt->fetch();
	}

	public function buscarPorTelefoneELoja($telefone, $id_loja)
	{
		$sql = "SELECT c.* FROM clientes c
				INNER JOIN clientes_lojas cl ON c.id_cliente = cl.id_cliente
				WHERE c.telefone = :telefone AND cl.id_loja = :id_loja";
		$stmt = $this->db->prepare($sql);
		$stmt->execute(['telefone' => $telefone, 'id_loja' => $id_loja]);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function listarHistoricoPedidos($id_cliente, $id_loja)
	{
		$sql = "SELECT p.*,
				(SELECT SUM(quantidade * valor_unitario) FROM pedidos_itens WHERE id_pedido = p.id_pedido) as total_itens
				FROM pedidos p
				WHERE p.id_cliente = :id_cliente AND p.id_loja = :id_loja
				ORDER BY p.data_pedido DESC LIMIT 10";
		$stmt = $this->db->prepare($sql);
		$stmt->execute(['id_cliente' => $id_cliente, 'id_loja' => $id_loja]);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function obterRankingPlayer($id_cliente, $id_lo_ja)
	{
		// Ranking baseado nos resultados finais de torneios finalizados
		$sql = "SELECT
					cg.id_cardgame,
					cg.nome AS cardgame,
					cg.imagem_card_game,
					COUNT(t.id_torneio) AS participacoes,
					SUM(trf.pontos_totais) AS pontos_acumulados
				FROM torneio_resultados_finais trf
				INNER JOIN torneios t ON trf.id_torneio = t.id_torneio
				INNER JOIN cardgames cg ON t.id_cardgame = cg.id_cardgame
				WHERE trf.id_cliente = :id_cliente
				  AND t.id_loja = :id_loja
				  AND t.status = 'finalizado'
				GROUP BY cg.id_cardgame, cg.nome, cg.imagem_card_game";

		$stmt = $this->db->prepare($sql);
		$stmt->execute([
			'id_cliente' => $id_cliente,
			'id_loja'    => $id_lo_ja
		]);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}


}

