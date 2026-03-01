<?php

use Core\Database;

class TipoPagamento
{
    private $db;
    private $uploadPath = '/public/storage/uploads/tipos_pagamento';

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    // Listar todos
    public function listar()
    {
        $stmt = $this->db->query("SELECT * FROM tipos_pagamento ORDER BY nome ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar por ID
    public function buscarPorId(int $id_pagamento)
    {
        $stmt = $this->db->prepare("SELECT * FROM tipos_pagamento WHERE id_pagamento = :id");
        $stmt->execute(['id' => $id_pagamento]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Criar
    public function criar(array $dados)
    {
        $stmt = $this->db->prepare("
            INSERT INTO tipos_pagamento (nome, imagem)
            VALUES (:nome, :imagem)
        ");
        $stmt->execute([
            'nome' => $dados['nome'],
            'imagem' => $dados['imagem'] ?? null
        ]);

        return $this->db->lastInsertId();
    }

    // Atualizar
    public function atualizar(int $id_pagamento, array $dados)
    {
        $fields = [];
        $params = ['id' => $id_pagamento];

        foreach ($dados as $col => $val) {
            $fields[] = "$col = :$col";
            $params[$col] = $val;
        }

        $sql = "UPDATE tipos_pagamento SET " . implode(", ", $fields) . " WHERE id_pagamento = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    // Upload de imagem
    public function uploadImagem(array $file, int $id_pagamento)
    {
        if (!isset($file['tmp_name']) || empty($file['tmp_name'])) return null;

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = "imagem." . strtolower($ext);

        $dir = $_SERVER['DOCUMENT_ROOT'] . "{$this->uploadPath}/{$id_pagamento}";
        if (!is_dir($dir)) mkdir($dir, 0755, true);

        $dest = $dir . '/' . $fileName;

        if (move_uploaded_file($file['tmp_name'], $dest)) {
            return $fileName;
        }

        return null;
    }

    // Deletar
    public function deletar(int $id_pagamento)
    {
        // Primeiro, remover a pasta com a imagem
        $dir = $_SERVER['DOCUMENT_ROOT'] . "{$this->uploadPath}/{$id_pagamento}";
        if (is_dir($dir)) {
            $files = glob($dir . '/*');
            foreach ($files as $f) {
                if (is_file($f)) unlink($f);
            }
            rmdir($dir);
        }

        // Depois, deletar do banco
        $stmt = $this->db->prepare("DELETE FROM tipos_pagamento WHERE id_pagamento = :id");
        return $stmt->execute(['id' => $id_pagamento]);
    }
}

