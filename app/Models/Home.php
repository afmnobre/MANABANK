<?php

class Home
{
    private $db;

    public function __construct()
    {
        // O Autoload carregará a classe Database automaticamente da pasta core/
        $this->db = Database::getInstance();
    }

    public function clientesInativos($idLoja)
    {
        $sql = "SELECT
                    C.id_cliente,
                    C.nome,
                    C.telefone,
                    MAX(P.data_pedido) AS ultima_compra,
                    COUNT(P.id_pedido) AS total_pedidos,
                    COALESCE(SUM(P.valor_variado), 0) AS total_gasto
                FROM clientes C
                INNER JOIN clientes_lojas CL
                    ON C.id_cliente = CL.id_cliente
                    AND CL.id_loja = :id_loja
                    AND CL.status = 'ativo'
                LEFT JOIN pedidos P
                    ON P.id_cliente = C.id_cliente
                    AND P.id_loja = CL.id_loja
                GROUP BY C.id_cliente, C.nome, C.telefone
                HAVING (MAX(P.data_pedido) IS NULL
                    OR MAX(P.data_pedido) < DATE_SUB(CURDATE(), INTERVAL 2 MONTH))
                ORDER BY ultima_compra ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id_loja' => $idLoja]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

	public function contratoInfo($idLoja)
	{
		$sql = "SELECT
					L.numero_contrato AS numero,
					(SELECT DATEDIFF(C.data_fim, CURDATE())
					 FROM contratos C
					 WHERE C.id_loja = L.id_loja AND C.status = 'ativo'
					 ORDER BY C.id_contrato DESC LIMIT 1) AS dias_restantes
				FROM lojas L
				WHERE L.id_loja = :id_loja";

		$stmt = $this->db->prepare($sql);
		$stmt->execute(['id_loja' => $idLoja]);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function resumoDia($idLoja)
	{
		// Pedidos e total vendido (valor_variado + itens)
		$sqlPedidos = "SELECT
						   COUNT(DISTINCT p.id_pedido) AS pedidos,
						   COALESCE(SUM(p.valor_variado),0)
						   + COALESCE(SUM(pi.quantidade * pi.valor_unitario),0) AS total_vendido
					   FROM pedidos p
					   LEFT JOIN pedidos_itens pi ON p.id_pedido = pi.id_pedido
					   WHERE p.id_loja = :id_loja
						 AND DATE(p.criado_em) = CURDATE()";
		$stmt = $this->db->prepare($sqlPedidos);
		$stmt->execute(['id_loja' => $idLoja]);
		$resumo = $stmt->fetch(PDO::FETCH_ASSOC);

		// Produto mais vendido
		$sqlProduto = "SELECT pr.nome AS produto_top
					   FROM pedidos_itens pi
					   INNER JOIN pedidos p ON pi.id_pedido = p.id_pedido
					   INNER JOIN produtos pr ON pi.id_produto = pr.id_produto
					   WHERE p.id_loja = :id_loja AND DATE(p.criado_em) = CURDATE()
					   GROUP BY pi.id_produto
					   ORDER BY SUM(pi.quantidade) DESC
					   LIMIT 1";
		$stmt = $this->db->prepare($sqlProduto);
		$stmt->execute(['id_loja' => $idLoja]);
		$produto = $stmt->fetch(PDO::FETCH_ASSOC);

		$resumo['produto_top'] = $produto['produto_top'] ?? '---';
		return $resumo;
	}

    public function alertas($idLoja)
    {
        // Estoque baixo
        $sqlEstoque = "SELECT COUNT(*) AS estoque_baixo
                       FROM produtos
                       WHERE id_loja = :id_loja
                         AND controlar_estoque = 1
                         AND estoque_atual <= estoque_alerta";
        $stmt = $this->db->prepare($sqlEstoque);
        $stmt->execute(['id_loja' => $idLoja]);
        $estoque = $stmt->fetch(PDO::FETCH_ASSOC);

        // Pagamentos pendentes
        $sqlPendencias = "SELECT COUNT(*) AS pendencias
                          FROM pedidos
                          WHERE id_loja = :id_loja
                            AND pedido_pago = 0";
        $stmt = $this->db->prepare($sqlPendencias);
        $stmt->execute(['id_loja' => $idLoja]);
        $pendencias = $stmt->fetch(PDO::FETCH_ASSOC);

        // Contratos próximos do vencimento
        $sqlContratos = "SELECT COUNT(*) AS contratos_vencendo
                         FROM contratos
                         WHERE id_loja = :id_loja
                           AND status = 'ativo'
                           AND data_fim <= DATE_ADD(CURDATE(), INTERVAL 30 DAY)";
        $stmt = $this->db->prepare($sqlContratos);
        $stmt->execute(['id_loja' => $idLoja]);
        $contratos = $stmt->fetch(PDO::FETCH_ASSOC);

        return [
            'estoque_baixo' => $estoque['estoque_baixo'] ?? 0,
            'pendencias' => $pendencias['pendencias'] ?? 0,
            'contratos_vencendo' => $contratos['contratos_vencendo'] ?? 0
        ];
    }

	public function detalhesContratoLoja($idLoja)
	{
		// Selecionamos explicitamente l.cnpj
		$sql = "SELECT
					l.id_loja,
					l.nome_loja,
					l.cnpj,
					l.logo,
					l.cor_tema,
					l.favicon,
					c.id_contrato,
					c.numero_contrato,
					c.data_inicio,
					c.data_fim,
					c.tipo,
					c.status
				FROM lojas l
				LEFT JOIN contratos c ON l.id_loja = c.id_loja AND c.status = 'ativo'
				WHERE l.id_loja = :id_loja
				LIMIT 1";

		$stmt = $this->db->prepare($sql);
		$stmt->execute(['id_loja' => $idLoja]);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function buscarPlanos()
	{
		// O Model já tem acesso ao banco de dados (geralmente via $this->db)
		$sql = "SELECT * FROM planos";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

	public function renovarContrato($referencia) {
		// Identifica se é Anual ou Mensal pelo sufixo da referência
		$dias = (strpos($referencia, 'ANU') !== false) ? 365 : 30;

		// Extrai o ID da loja (ex: de "5202603ANU", pega o 5)
		$id_loja = explode('202', $referencia)[0];

		// SQL que soma dias se estiver ativo ou renova a partir de hoje se estiver vencido
		$sql = "UPDATE contratos SET
				data_fim = DATE_ADD(IF(data_fim > NOW(), data_fim, NOW()), INTERVAL :dias DAY),
				status = 'ativo'
				WHERE id_loja = :id_loja AND status = 'ativo'";

		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(':dias', $dias, PDO::PARAM_INT);
		$stmt->bindValue(':id_loja', $id_loja, PDO::PARAM_INT);
		return $stmt->execute();
	}




}


