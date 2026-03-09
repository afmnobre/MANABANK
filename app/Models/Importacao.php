<?php

class Importacao
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function criarLote($id_loja, $nome, $tipo, $ref)
    {
        $sql = "INSERT INTO lotes_importacao (id_loja, nome_arquivo, tipo_arquivo, referencia_periodo, status_processamento)
                VALUES (:id_loja, :nome, :tipo, :ref, 'processando')";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id_loja' => $id_loja,
            'nome'    => $nome,
            'tipo'    => $tipo,
            'ref'     => $ref
        ]);
        return $this->db->lastInsertId();
    }

    public function inserirVenda($dados)
    {
        $sql = "INSERT INTO vendas_ligamagic (
                    id_loja, id_lote, tipo_produto, status_venda, forma_envio, forma_pagamento,
                    nome_produto_pt, nome_produto_en, categoria_completa, quantidade,
                    preco_total, preco_medio, jogo_base, subcategoria
                ) VALUES (
                    :id_loja, :id_lote, :tipo_p, :status, :envio, :pagto,
                    :nome_pt, :nome_en, :cat_comp, :qtd,
                    :total, :medio, :jogo, :subcat
                )";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($dados);
    }

    public function finalizarLote($id_lote, $totalItens, $valorTotal)
    {
        $sql = "UPDATE lotes_importacao SET
                total_itens_processados = :itens,
                valor_total_lote = :valor,
                status_processamento = 'concluido'
                WHERE id_lote = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['itens' => $totalItens, 'valor' => $valorTotal, 'id' => $id_lote]);
    }

    public function listarLotes($id_loja)
    {
        $sql = "SELECT * FROM lotes_importacao WHERE id_loja = :id ORDER BY data_importacao DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id_loja]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function limparMoeda($valor)
    {
        $valor = str_replace('.', '', $valor);
        $valor = str_replace(',', '.', $valor);
        return (float)$valor;
    }
}
