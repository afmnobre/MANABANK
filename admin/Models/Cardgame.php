<?php

class Cardgame
{
    private $db;
    private $uploadPath = '/public/storage/uploads/cardgames';

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    // Listar todos
    public function listar()
    {
        $stmt = $this->db->query("SELECT * FROM cardgames ORDER BY nome ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar por ID
    public function buscarPorId($id_cardgame)
    {
        $stmt = $this->db->prepare("SELECT * FROM cardgames WHERE id_cardgame = :id");
        $stmt->execute(['id' => $id_cardgame]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Criar
    public function criar(array $dados)
    {
        $stmt = $this->db->prepare("
            INSERT INTO cardgames (nome, imagem_fundo_card, imagem_card_game)
            VALUES (:nome, :fundo, :card)
        ");
        $stmt->execute([
            'nome' => $dados['nome'],
            'fundo' => $dados['imagem_fundo_card'] ?? null,
            'card'  => $dados['imagem_card_game'] ?? null
        ]);

        return $this->db->lastInsertId();
    }

    // Atualizar
    public function atualizar(int $id_cardgame, array $dados)
    {
        $fields = [];
        $params = ['id' => $id_cardgame];

        foreach ($dados as $col => $val) {
            $fields[] = "$col = :$col";
            $params[$col] = $val;
        }

        $sql = "UPDATE cardgames SET " . implode(", ", $fields) . " WHERE id_cardgame = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    // Upload de imagem
    public function uploadImagem(array $file, int $id_cardgame, string $campo)
    {
        if (!isset($file['tmp_name']) || empty($file['tmp_name'])) return null;

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = strtolower($campo . '.' . $ext); // fundo.png ou card.png

        $dir = $_SERVER['DOCUMENT_ROOT'] . "{$this->uploadPath}/{$id_cardgame}";
        if (!is_dir($dir)) mkdir($dir, 0755, true);

        $dest = $dir . '/' . $fileName;

        if (move_uploaded_file($file['tmp_name'], $dest)) {
            return $fileName;
        }

        return null;
    }

    // Deletar cardgame + imagens do servidor
    public function deletar(int $id_cardgame)
    {
        // Remover registro do banco
        $stmt = $this->db->prepare("DELETE FROM cardgames WHERE id_cardgame = :id");
        $stmt->execute(['id' => $id_cardgame]);

        // Remover pasta do cardgame no servidor
        $dir = $_SERVER['DOCUMENT_ROOT'] . "{$this->uploadPath}/{$id_cardgame}";
        if (is_dir($dir)) {
            $this->removerDiretorioRecursivo($dir);
        }
    }

    // Função auxiliar para remover diretórios recursivamente
    private function removerDiretorioRecursivo(string $dir)
    {
        $files = array_diff(scandir($dir), ['.', '..']);
        foreach ($files as $file) {
            $path = "$dir/$file";
            if (is_dir($path)) {
                $this->removerDiretorioRecursivo($path);
            } else {
                unlink($path);
            }
        }
        rmdir($dir);
    }
}

