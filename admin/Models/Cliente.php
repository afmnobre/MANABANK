<?php

class Cliente
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    // Listar todos clientes com lojas e cardgames
	// No seu Model de Clientes
	public function listarComLojasECardgames()
	{
		$stmt = $this->db->prepare("
			SELECT c.id_cliente, c.nome, c.telefone, c.email,
				   GROUP_CONCAT(DISTINCT
						CONCAT(l.id_loja, ';#', l.nome_loja, ';#', IFNULL(l.logo, ''))
						SEPARATOR '||') AS lojas_info,

				   -- Mudamos o separador interno para ;# para não conflitar com os : dos nomes
				   GROUP_CONCAT(DISTINCT
						CONCAT(cg.id_cardgame, ';#', cg.nome, ';#', IFNULL(cg.imagem_fundo_card, ''))
						SEPARATOR '||') AS cardgames_info
			FROM clientes c
			LEFT JOIN clientes_lojas cl ON cl.id_cliente = c.id_cliente
			LEFT JOIN lojas l ON l.id_loja = cl.id_loja
			LEFT JOIN clientes_cardgames ccg ON ccg.id_cliente = c.id_cliente
			LEFT JOIN cardgames cg ON cg.id_cardgame = ccg.id_cardgame
			GROUP BY c.id_cliente
			ORDER BY c.nome
		");
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function pedidosPorCliente($id_cliente)
	{
		$stmt = $this->db->prepare("
			SELECT p.id_pedido,
				   p.data_pedido,
				   p.valor_variado,
				   p.observacao_variado,
				   p.pedido_pago,
				   l.id_loja,
				   l.nome_loja,
				   l.logo,
				   -- Cálculo do Total: Valor Variado + Somatório dos Itens (Qtd * Valor Unitário)
				   (p.valor_variado + IFNULL((SELECT SUM(quantidade * valor_unitario)
											  FROM pedidos_itens
											  WHERE id_pedido = p.id_pedido), 0)) AS valor_total_real
			FROM pedidos p
			INNER JOIN lojas l ON l.id_loja = p.id_loja
			WHERE p.id_cliente = :id_cliente
			ORDER BY p.data_pedido DESC, l.nome_loja
		");
		$stmt->execute(['id_cliente' => $id_cliente]);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}

