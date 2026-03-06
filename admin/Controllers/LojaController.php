<?php

class LojaController
{
    private $uploadBasePath;
    private $baseUrl;

    public function __construct()
    {
        $isLocal = ($_SERVER['REMOTE_ADDR'] == '127.0.0.1' || $_SERVER['HTTP_HOST'] == 'manabank.local');
        $this->baseUrl = $isLocal ? '/' : '/MANABANK/';
        $this->uploadBasePath = __DIR__ . '/../../public/storage/uploads/lojas/';
    }

    public function index()
    {
        $lojaModel = new Loja();

        // Agora o PHP terá carregado o arquivo correto que contém este método
        $lojas = $lojaModel->listarComUltimoContrato();

        $title = "Lojas";
        ob_start();
        require __DIR__ . '/../Views/lojas/index.php';
        $content = ob_get_clean();

        require __DIR__ . '/../Views/layout/layout.php';
    }

    /* =========================================================
       FORM CREATE
    ==========================================================*/
    public function create()
    {
        $title = "Cadastrar Loja";
        ob_start();
        require __DIR__ . '/../Views/lojas/form.php';
        $content = ob_get_clean();

        require __DIR__ . '/../Views/layout/layout.php';
    }

    /* =========================================================
       STORE
    ==========================================================*/
    public function store()
    {
        $lojaModel = new Loja();

        $dados = [
            'nome_loja' => $_POST['nome_loja'] ?? null,
            'cnpj'      => $_POST['cnpj'] ?? null,
            'endereco'  => $_POST['endereco'] ?? null,
            'cor_tema'  => $_POST['cor_tema'] ?? null,
        ];

        $id_loja = $lojaModel->criar($dados);
        $lojaPath = $this->uploadBasePath . $id_loja . '/';

        if (!is_dir($lojaPath)) {
            mkdir($lojaPath, 0755, true);
        }

        $logoNome = null;
        if (!empty($_FILES['logo']['name'])) {
            $ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
            $logoNome = 'logo.' . strtolower($ext);
            move_uploaded_file($_FILES['logo']['tmp_name'], $lojaPath . $logoNome);
        }

        $faviconNome = null;
        if (!empty($_FILES['favicon']['name'])) {
            $ext = pathinfo($_FILES['favicon']['name'], PATHINFO_EXTENSION);
            $faviconNome = 'favicon.' . strtolower($ext);
            move_uploaded_file($_FILES['favicon']['tmp_name'], $lojaPath . $faviconNome);
        }

        $lojaModel->atualizarImagens($id_loja, $logoNome, $faviconNome);

        header("Location: " . $this->baseUrl . "admin/loja");
        exit;
    }

    /* =========================================================
       FORM EDIT
    ==========================================================*/
    public function edit($id)
    {
        $lojaModel     = new Loja();
        $contratoModel = new Contrato();

        $loja      = $lojaModel->buscarPorId($id);
        $contratos = $contratoModel->listarAtivos();

        $title = "Editar Loja";
        ob_start();
        require __DIR__ . '/../Views/lojas/form.php';
        $content = ob_get_clean();

        require __DIR__ . '/../Views/layout/layout.php';
    }

    /* =========================================================
       UPDATE
    ==========================================================*/
    public function update($id)
    {
        $lojaModel = new Loja();
        $lojaAtual = $lojaModel->buscarPorId($id);

        $dados = [
            'nome_loja' => $_POST['nome_loja'],
            'cnpj'      => $_POST['cnpj'],
            'endereco'  => $_POST['endereco'],
            'cor_tema'  => $_POST['cor_tema'],
            'id_loja'   => $id
        ];
        $lojaModel->atualizar($dados);

        $lojaPath = $this->uploadBasePath . $id . '/';
        if (!is_dir($lojaPath)) {
            mkdir($lojaPath, 0755, true);
        }

        $logoNome = $lojaAtual['logo'] ?? null;
        $faviconNome = $lojaAtual['favicon'] ?? null;

        if (!empty($_FILES['logo']['name'])) {
            $ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
            $logoNome = 'logo.' . strtolower($ext);
            move_uploaded_file($_FILES['logo']['tmp_name'], $lojaPath . $logoNome);
        }

        if (!empty($_FILES['favicon']['name'])) {
            $ext = pathinfo($_FILES['favicon']['name'], PATHINFO_EXTENSION);
            $faviconNome = 'favicon.' . strtolower($ext);
            move_uploaded_file($_FILES['favicon']['tmp_name'], $lojaPath . $faviconNome);
        }

        $lojaModel->atualizarImagens($id, $logoNome, $faviconNome);

        header("Location: " . $this->baseUrl . "admin/loja");
        exit;
    }

    /* =========================================================
       DELETE
    ==========================================================*/
    public function delete($id)
    {
        $lojaModel = new Loja();
        $lojaPath  = $this->uploadBasePath . $id;

        if (is_dir($lojaPath)) {
            $files = glob($lojaPath . '/*');
            foreach ($files as $file) {
                if (is_file($file)) unlink($file);
            }
            rmdir($lojaPath);
        }

        $lojaModel->deletar($id);

        header("Location: " . $this->baseUrl . "admin/loja");
        exit;
    }
}
