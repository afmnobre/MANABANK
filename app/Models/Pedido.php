<?php

class Pedido
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

	/**
	 * MÉTODO UNIFICADO (Substitui listarPorLojaDataTodos, listarPendentes, etc.)
	 */
	public function listarPorLojaData($idLoja, $data, $apenasPagos = null)
	{
		$sql = "SELECT * FROM pedidos WHERE id_loja = :id_loja AND data_pedido = :data";

		// Se passar true ou false, ele filtra. Se não passar nada, traz todos.
		if ($apenasPagos !== null) {
			$sql .= " AND pedido_pago = " . ($apenasPagos ? 1 : 0);
		}

		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(':id_loja', $idLoja, PDO::PARAM_INT);
		$stmt->bindValue(':data', $data);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
	}

	/**
	 * Busca todos os pedidos de uma loja em uma data específica.
	 * Este método é exigido pelo PedidoController:index() na linha 28.
	 */
	public function listarPorLojaDataTodos($idLoja, $data)
	{
		$sql = "SELECT * FROM pedidos
				WHERE id_loja = :id_loja
				AND data_pedido = :data";

		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(':id_loja', $idLoja, PDO::PARAM_INT);
		$stmt->bindValue(':data', $data);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
	}

    public function listarDatasPendentes($id_loja)
    {
        $sql = "SELECT DISTINCT DATE(p.data_pedido) as data
                FROM pedidos p
                LEFT JOIN pedidos_itens pi ON pi.id_pedido = p.id_pedido
                WHERE p.id_loja = :id_loja
                  AND p.pedido_pago = 0
                  AND (pi.quantidade > 0 OR p.valor_variado > 0)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id_loja' => $id_loja]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * REUTILIZÁVEL: O método salvar agora decide se insere ou atualiza
     */
    public function salvar($dados)
    {
        $stmtCheck = $this->db->prepare("
            SELECT id_pedido FROM pedidos
            WHERE id_cliente = :id_cliente
              AND id_loja = :id_loja
              AND data_pedido = :data_pedido
            LIMIT 1
        ");
        $stmtCheck->execute([
            'id_cliente' => $dados['id_cliente'],
            'id_loja'    => $dados['id_loja'],
            'data_pedido'=> $dados['data_pedido']
        ]);
        $id_pedido = $stmtCheck->fetchColumn();

        if ($id_pedido) {
            $this->atualizar($id_pedido, $dados);
        } else {
            $stmt = $this->db->prepare("
                INSERT INTO pedidos (id_cliente, id_loja, valor_variado, observacao_variado, pedido_pago, data_pedido)
                VALUES (:id_cliente, :id_loja, :valor_variado, :observacao_variado, :pedido_pago, :data_pedido)
            ");
            $stmt->execute([
                'id_cliente'        => $dados['id_cliente'],
                'id_loja'           => $dados['id_loja'],
                'valor_variado'     => $dados['valor_variado'],
                'observacao_variado'=> $dados['observacao_variado'] ?? null,
                'pedido_pago'       => $dados['pedido_pago'],
                'data_pedido'       => $dados['data_pedido']
            ]);
            $id_pedido = $this->db->lastInsertId();
        }

        if (isset($dados['itens'])) {
            $this->atualizarItens($id_pedido, $dados['itens']);
        }

        return $id_pedido;
    }

    public function atualizar($id_pedido, $dados)
    {
        $stmt = $this->db->prepare("
            UPDATE pedidos SET
                valor_variado = :valor_variado,
                observacao_variado = :observacao_variado,
                pedido_pago = :pedido_pago
            WHERE id_pedido = :id_pedido
        ");

        $stmt->execute([
            'valor_variado'      => (float)($dados['valor_variado'] ?? 0),
            'observacao_variado' => $dados['observacao_variado'] ?? null,
            'pedido_pago'        => (int)($dados['pedido_pago'] ?? 0),
            'id_pedido'          => (int)$id_pedido
        ]);
    }

    public function atualizarItens($id_pedido, $itens)
    {
        $produtoModel = new Produto();

        // 1. Devolve estoque dos itens antigos antes de limpar
        $stmtOld = $this->db->prepare("SELECT id_produto, quantidade FROM pedidos_itens WHERE id_pedido = :id_pedido");
        $stmtOld->execute(['id_pedido' => $id_pedido]);
        $itensAntigos = $stmtOld->fetchAll(PDO::FETCH_ASSOC);

        foreach ($itensAntigos as $item) {
            if ($item['quantidade'] > 0) {
                $produtoModel->atualizarEstoque($item['id_produto'], $item['quantidade']);
            }
        }

        // 2. Limpa itens atuais
        $this->db->prepare("DELETE FROM pedidos_itens WHERE id_pedido = :id_pedido")->execute(['id_pedido' => $id_pedido]);

        // 3. Insere novos e retira estoque
        foreach ($itens as $id_produto => $quantidade) {
            if ($quantidade > 0) {
                // Busca preço atual
                $stmtProd = $this->db->prepare("SELECT valor_venda FROM produtos WHERE id_produto = :id_produto");
                $stmtProd->execute(['id_produto' => $id_produto]);
                $valor_unitario = $stmtProd->fetchColumn();

                $stmtItem = $this->db->prepare("
                    INSERT INTO pedidos_itens (id_pedido, id_produto, quantidade, valor_unitario)
                    VALUES (:id_pedido, :id_produto, :quantidade, :valor_unitario)
                ");
                $stmtItem->execute([
                    'id_pedido'      => $id_pedido,
                    'id_produto'     => $id_produto,
                    'quantidade'     => $quantidade,
                    'valor_unitario' => $valor_unitario
                ]);

                $produtoModel->atualizarEstoque($id_produto, -$quantidade);
            }
        }
    }

    public function excluir($id_pedido)
    {
        // Reaproveita a lógica de zerar itens para devolver estoque
        $this->atualizarItens($id_pedido, []);

        $this->db->prepare("DELETE FROM pedido_pagamento WHERE id_pedido = :id")->execute(['id' => $id_pedido]);
        $this->db->prepare("DELETE FROM pedidos WHERE id_pedido = :id")->execute(['id' => $id_pedido]);
    }

    /**
     * UNIFICADO: Busca dados do pedido e cliente
     */
    public function buscarPorId($id_pedido)
    {
        $sql = "SELECT p.*, c.nome as cliente_nome
                FROM pedidos p
                JOIN clientes c ON c.id_cliente = p.id_cliente
                WHERE p.id_pedido = :id_pedido";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id_pedido' => $id_pedido]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

	/**
	 * Busca os itens de um pedido.
	 * Também exigido pelo novo fluxo do Controller.
	 */
	public function listarItensPorPedido($idPedido)
	{
		$sql = "SELECT pi.*, p.nome, p.emoji
				FROM pedidos_itens pi
				JOIN produtos p ON pi.id_produto = p.id_produto
				WHERE pi.id_pedido = :id_pedido";

		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(':id_pedido', $idPedido, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
	}

	public function salvarTiposPagamento($idPedido, $pagamentos)
	{
		$this->db->prepare("DELETE FROM pedido_pagamento WHERE id_pedido = ?")->execute([$idPedido]);

		$sql = "INSERT INTO pedido_pagamento (id_pedido, id_pagamento, valor) VALUES (?, ?, ?)";
		$stmt = $this->db->prepare($sql);

		foreach ($pagamentos as $idPagamento => $valor) {
			// Se já for um float/numeric vindo do input type="number", não precisa de replace
			if (is_numeric($valor)) {
				$valorNum = (float)$valor;
			} else {
				// Se vier formatado (R$ 1.200,00), limpamos
				$valorLimpo = preg_replace('/[^\d,]/', '', $valor);
				$valorNum = (float)str_replace(',', '.', $valorLimpo);
			}

			if ($valorNum > 0) {
				$stmt->execute([$idPedido, $idPagamento, $valorNum]);
			}
		}
	}

	public function listarCardgamesPorCliente($idCliente)
	{
		// Corrigido para clientes_cardgames conforme seu CREATE TABLE
		$sql = "SELECT id_cardgame FROM clientes_cardgames WHERE id_cliente = :id_cliente";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(':id_cliente', $idCliente, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_COLUMN) ?: [];
	}

    public function listarCardgames() {
        return $this->db->query("SELECT * FROM cardgames ORDER BY nome ASC")->fetchAll(PDO::FETCH_ASSOC);
    }

	public function listarTiposPagamento()
	{
		// Sincronizado com a sua tabela tipos_pagamento
		$sql = "SELECT id_pagamento, nome, imagem FROM tipos_pagamento ORDER BY nome ASC";
		$stmt = $this->db->query($sql);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
