<?php

class ContratoHistorico
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    // ADICIONE o parâmetro $numero_contrato ao final do método
    public function registrar($id_loja, $id_contrato, $inicio, $fim, $tipo, $status, $numero_contrato)
    {
        $sql = "INSERT INTO lojas_contratos_historico
                (id_loja, id_contrato, data_inicio_contrato, data_fim_contrato, tipo_contrato, status_contrato, numero_contrato)
                VALUES
                (:id_loja, :id_contrato, :inicio, :fim, :tipo, :status, :numero_contrato)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id_loja'         => $id_loja,
            'id_contrato'     => $id_contrato,
            'inicio'          => $inicio,
            'fim'             => $fim,
            'tipo'            => $tipo,
            'status'          => $status,
            'numero_contrato' => $numero_contrato // Este é o valor que estava faltando gravar
        ]);
    }

    public function listarPorLoja($id_loja)
    {
        $stmt = $this->db->prepare("SELECT * FROM lojas_contratos_historico WHERE id_loja = :id_loja ORDER BY data_vinculo DESC");
        $stmt->execute(['id_loja' => $id_loja]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
