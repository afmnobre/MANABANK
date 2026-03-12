<?php

class Contrato
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Ativa o contrato, atualiza a loja, gera histórico e reativa usuários.
     */
    public function ativarNovoContrato($id_loja, $numero_contrato, $tipo)
    {
        try {
            $this->db->beginTransaction();

            // 1. Definir datas baseadas no tipo (MEN, ANU, TES)
            $data_inicio = date('Y-m-d');
            $tipo_upper = strtoupper($tipo);

            if (strpos($tipo_upper, 'TES') !== false) {
                $dias = 7;
                $label_tipo = 'teste';
            } elseif (strpos($tipo_upper, 'ANU') !== false) {
                $dias = 365;
                $label_tipo = 'anual';
            } else {
                $dias = 30;
                $label_tipo = 'mensal';
            }
            $data_fim = date('Y-m-d', strtotime("+$dias days"));

            // 2. Criar o registro na tabela 'contratos'
            $sql_c = "INSERT INTO contratos (id_loja, tipo, data_inicio, data_fim, status, numero_contrato)
                      VALUES (:id_loja, :tipo, :inicio, :fim, 'ativo', :numero)";
            $stmt_c = $this->db->prepare($sql_c);
            $stmt_c->execute([
                'id_loja'         => $id_loja,
                'tipo'            => $label_tipo,
                'inicio'          => $data_inicio,
                'fim'             => $data_fim,
                'numero'          => $numero_contrato
            ]);
            $id_contrato = $this->db->lastInsertId();

            // 3. Atualizar campo numero_contrato na tabela 'lojas'
            $sql_l = "UPDATE lojas SET numero_contrato = :numero WHERE id_loja = :id_loja";
            $stmt_l = $this->db->prepare($sql_l);
            $stmt_l->execute(['numero' => $numero_contrato, 'id_loja' => $id_loja]);

            // 4. Inserir no Histórico
            $sql_h = "INSERT INTO lojas_contratos_historico
                      (id_loja, id_contrato, data_inicio_contrato, data_fim_contrato, tipo_contrato, status_contrato, numero_contrato)
                      VALUES (:id_loja, :id_contrato, :inicio, :fim, :tipo, 'ativo', :numero)";
            $stmt_h = $this->db->prepare($sql_h);
            $stmt_h->execute([
                'id_loja'     => $id_loja,
                'id_contrato' => $id_contrato,
                'inicio'      => $data_inicio,
                'fim'         => $data_fim,
                'tipo'        => $label_tipo,
                'numero'      => $numero_contrato
            ]);

            // 5. REATIVAR USUÁRIOS: Se o contrato está ativo, usuários ficam ativos
            $sql_u = "UPDATE usuarios_loja SET ativo = 1 WHERE id_loja = :id_loja";
            $stmt_u = $this->db->prepare($sql_u);
            $stmt_u->execute(['id_loja' => $id_loja]);

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            error_log($e->getMessage());
            return false;
        }
    }

    public function listarHistorico($id_loja)
    {
        $sql = "SELECT * FROM lojas_contratos_historico WHERE id_loja = :id_loja ORDER BY data_vinculo DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id_loja' => $id_loja]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
