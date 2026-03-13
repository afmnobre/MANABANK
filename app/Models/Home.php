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
        $sqlEstoque = "SELECT COUNT(*) AS estoque_baixo
                       FROM produtos
                       WHERE id_loja = :id_loja
                         AND controlar_estoque = 1
                         AND estoque_atual <= estoque_alerta";
        $stmt = $this->db->prepare($sqlEstoque);
        $stmt->execute(['id_loja' => $idLoja]);
        $estoque = $stmt->fetch(PDO::FETCH_ASSOC);

        $sqlPendencias = "SELECT COUNT(*) AS pendencias
                          FROM pedidos
                          WHERE id_loja = :id_loja
                            AND pedido_pago = 0";
        $stmt = $this->db->prepare($sqlPendencias);
        $stmt->execute(['id_loja' => $idLoja]);
        $pendencias = $stmt->fetch(PDO::FETCH_ASSOC);

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
        $sql = "SELECT * FROM planos";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function renovarContrato($referencia) {
        error_log("Iniciando renovação para REF: " . $referencia);

        $partes = explode('_', $referencia);
        $id_loja = (int)$partes[0];
        $sufixo = end($partes);

        $slug = ($sufixo === 'ANU') ? 'anual' : 'mensal';

        $stmtPlano = $this->db->prepare("SELECT slug, intervalo_dias FROM planos WHERE slug = :slug");
        $stmtPlano->execute([':slug' => $slug]);
        $plano = $stmtPlano->fetch(PDO::FETCH_ASSOC);

        if (!$plano) {
            error_log("ERRO: Plano com slug $slug nao encontrado.");
            return false;
        }

        $tipoContrato = $plano['slug'];
        $dias = (int)$plano['intervalo_dias'];
        $novoNumeroContrato = $id_loja . date('Ym') . (($tipoContrato == 'anual') ? 'ANU' : 'MEN');

        try {
            $this->db->beginTransaction();

            // 1. Verifica duplicidade (A coluna 'ultima_referencia' deve existir no banco)
            $stmtCheck = $this->db->prepare("SELECT ultima_referencia FROM contratos WHERE id_loja = :id_loja LIMIT 1");
            $stmtCheck->execute([':id_loja' => $id_loja]);
            $contratoAtual = $stmtCheck->fetch(PDO::FETCH_ASSOC);

            if ($contratoAtual && $contratoAtual['ultima_referencia'] === $referencia) {
                error_log("AVISO: Referencia $referencia ja processada.");
                $this->db->rollBack();
                return true;
            }

            // 2. Atualiza a tabela 'contratos'
            $sqlContrato = "UPDATE contratos SET
                            tipo = :tipo,
                            data_fim = CASE
                                WHEN tipo != :tipo_check THEN DATE_ADD(NOW(), INTERVAL :dias1 DAY)
                                ELSE DATE_ADD(IF(data_fim > NOW(), data_fim, NOW()), INTERVAL :dias2 DAY)
                            END,
                            status = 'ativo',
                            numero_contrato = :num_contrato,
                            ultima_referencia = :ref
                            WHERE id_loja = :id_loja";

            $stmtC = $this->db->prepare($sqlContrato);
            $stmtC->execute([
                ':tipo' => $tipoContrato,
                ':tipo_check' => $tipoContrato,
                ':dias1' => $dias,
                ':dias2' => $dias,
                ':num_contrato' => $novoNumeroContrato,
                ':ref' => $referencia,
                ':id_loja' => $id_loja
            ]);

            // 3. Atualiza Loja e Usuários
            $this->db->prepare("UPDATE lojas SET numero_contrato = :num WHERE id_loja = :id_loja")
                     ->execute([':num' => $novoNumeroContrato, ':id_loja' => $id_loja]);

            $this->db->prepare("UPDATE usuarios_loja SET ativo = 1 WHERE id_loja = :id_loja")
                     ->execute([':id_loja' => $id_loja]);

            // 4. Grava Histórico
            $stmtIdC = $this->db->prepare("SELECT id_contrato, data_inicio, data_fim FROM contratos WHERE id_loja = :id_loja LIMIT 1");
            $stmtIdC->execute([':id_loja' => $id_loja]);
            $res = $stmtIdC->fetch(PDO::FETCH_ASSOC);

            if ($res) {
                $sqlHist = "INSERT INTO lojas_contratos_historico
                            (id_loja, id_contrato, data_inicio_contrato, data_fim_contrato, tipo_contrato, status_contrato, numero_contrato)
                            VALUES (:id_loja, :id_c, :inicio, :fim, :tipo, 'ativo', :num)";
                $this->db->prepare($sqlHist)->execute([
                    ':id_loja' => $id_loja,
                    ':id_c'    => $res['id_contrato'],
                    ':inicio'  => $res['data_inicio'],
                    ':fim'     => $res['data_fim'],
                    ':tipo'    => $tipoContrato,
                    ':num'     => $novoNumeroContrato
                ]);
            }

            $this->db->commit();
            return true;

        } catch (Exception $e) {
            if ($this->db->inTransaction()) $this->db->rollBack();
            error_log("EXCECAO NO MODEL: " . $e->getMessage());
            return false;
        }
    }

    public function checarStatusContrato($id_loja) {
        $sql = "SELECT status FROM contratos WHERE id_loja = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id_loja]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($res && $res['status'] === 'ativo');
    }
}
