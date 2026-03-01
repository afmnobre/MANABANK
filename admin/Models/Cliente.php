<?php
use Core\Database;

class Cliente
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    // Listar todos clientes com lojas e cardgames
    public function listarComLojasECardgames()
    {
        $stmt = $this->db->prepare("
            SELECT c.id_cliente, c.nome, c.telefone, c.email,
                   GROUP_CONCAT(DISTINCT l.nome_loja ORDER BY l.nome_loja SEPARATOR ', ') AS lojas,
                   GROUP_CONCAT(DISTINCT cg.nome ORDER BY cg.nome SEPARATOR ', ') AS cardgames
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

    // Retorna todos pedidos do cliente agrupados por loja
    public function pedidosPorCliente($id_cliente)
    {
        $stmt = $this->db->prepare("
            SELECT p.id_pedido, p.data_pedido, p.valor_variado, p.observacao_variado,
                   l.id_loja, l.nome_loja
            FROM pedidos p
            INNER JOIN lojas l ON l.id_loja = p.id_loja
            WHERE p.id_cliente = :id_cliente
            ORDER BY l.nome_loja, p.data_pedido DESC
        ");
        $stmt->execute(['id_cliente' => $id_cliente]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

