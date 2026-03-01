<?php

use Core\Database;

class CardgameController
{
    private $model;

    public function __construct()
    {
        $this->model = new Cardgame();
    }

    // Listar todos os cardgames
    public function index()
    {
        $cardgames = $this->model->listar();

        ob_start();
        require __DIR__ . '/../Views/cardgames/index.php';
        $content = ob_get_clean();

        $title = "Cardgames";
        require __DIR__ . '/../Views/layout/layout.php';
    }

    // Form create/edit
    public function form($id_cardgame = null)
    {
        $cardgame = $id_cardgame ? $this->model->buscarPorId($id_cardgame) : null;

        ob_start();
        require __DIR__ . '/../Views/cardgames/form.php';
        $content = ob_get_clean();

        $title = $id_cardgame ? "Editar Cardgame" : "Novo Cardgame";
        require __DIR__ . '/../Views/layout/layout.php';
    }

    // Criar
    public function store()
    {
        $dados = [
            'nome' => $_POST['nome'] ?? ''
        ];

        $id = $this->model->criar($dados);

        // Upload das imagens
        $this->uploadImagens($id);

        header("Location: /admin/cardgame");
        exit;
    }

    // Atualizar
    public function update($id_cardgame)
    {
        $dados = [
            'nome' => $_POST['nome'] ?? ''
        ];

        $this->model->atualizar($id_cardgame, $dados);

        // Upload das imagens (substituindo existentes se houver)
        $this->uploadImagens($id_cardgame);

        header("Location: /admin/cardgame");
        exit;
    }

    // Deletar
    public function delete($id_cardgame)
    {
        // Deletar do banco
        $this->model->deletar($id_cardgame);

        // Deletar pasta de imagens do servidor
        $this->removerImagens($id_cardgame);

        header("Location: /admin/cardgame");
        exit;
    }

    /* ===========================
       Funções auxiliares
    =========================== */

    private function uploadImagens($id_cardgame)
    {
        $basePath = __DIR__ . '/../../public/storage/uploads/cardgames/' . $id_cardgame . '/';
        if (!is_dir($basePath)) mkdir($basePath, 0755, true);

        // Imagem de fundo
        if (!empty($_FILES['imagem_fundo_card']['name'])) {
            $ext = pathinfo($_FILES['imagem_fundo_card']['name'], PATHINFO_EXTENSION);
            $filePath = $basePath . "fundo.{$ext}";
            move_uploaded_file($_FILES['imagem_fundo_card']['tmp_name'], $filePath);
            $this->model->atualizar($id_cardgame, ['imagem_fundo_card' => "fundo.{$ext}"]);
        }

        // Imagem do cardgame
        if (!empty($_FILES['imagem_card_game']['name'])) {
            $ext = pathinfo($_FILES['imagem_card_game']['name'], PATHINFO_EXTENSION);
            $filePath = $basePath . "cardgame.{$ext}";
            move_uploaded_file($_FILES['imagem_card_game']['tmp_name'], $filePath);
            $this->model->atualizar($id_cardgame, ['imagem_card_game' => "cardgame.{$ext}"]);
        }
    }

    private function removerImagens($id_cardgame)
    {
        $basePath = __DIR__ . '/../../public/storage/uploads/cardgames/' . $id_cardgame . '/';
        if (is_dir($basePath)) {
            $files = glob($basePath . '*'); // todos os arquivos
            foreach ($files as $file) {
                if (is_file($file)) unlink($file);
            }
            rmdir($basePath); // remove a pasta
        }
    }
}

