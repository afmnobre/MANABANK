<?php

class ContratoController
{
    private $baseUrl;

    public function __construct()
    {
        // Detecta o ambiente igual ao LojaController para evitar erros de redirecionamento
        $isMANABANK = (strpos($_SERVER['SCRIPT_NAME'], '/MANABANK/') !== false);
        $this->baseUrl = $isMANABANK ? '/MANABANK/' : '/';
    }

    /**
     * Listar contratos
     */
    public function index()
    {
        $contratoModel = new Contrato();
        $lojaModel = new Loja();

        $contratos = $contratoModel->listar();
        $lojas = $lojaModel->listar();

        $title = "Contratos";
        ob_start();
        require __DIR__ . '/../Views/contratos/index.php';
        $content = ob_get_clean();

        require __DIR__ . '/../Views/layout/layout.php';
    }

    /**
     * Formulário create/edit
     */
    public function form($id_contrato = null)
    {
        $contratoModel = new Contrato();
        $lojaModel = new Loja();

        $contrato = $id_contrato ? $contratoModel->buscarPorId($id_contrato) : null;
        $lojas = $lojaModel->listar();

        $title = $id_contrato ? "Editar Contrato" : "Cadastrar Contrato";
        ob_start();
        require __DIR__ . '/../Views/contratos/form.php';
        $content = ob_get_clean();

        require __DIR__ . '/../Views/layout/layout.php';
    }

    /**
     * Criar novo contrato
     */
    public function store()
    {
        $contratoModel = new Contrato();
        $historicoModel = new ContratoHistorico();

        $dados = [
            'id_loja'     => $_POST['id_loja'],
            'tipo'        => $_POST['tipo'],
            'data_inicio' => $_POST['data_inicio'],
            'data_fim'    => $_POST['data_fim'],
            'status'      => $_POST['status']
        ];

        // Criar contrato e obter os dados gerados (incluindo o numero_contrato formatado)
        $resultado = $contratoModel->criar($dados);

        // Salvar histórico com o campo numero_contrato
        $historicoModel->registrar(
            $dados['id_loja'],
            $resultado['id'],
            $dados['data_inicio'],
            $dados['data_fim'],
            $dados['tipo'],
            $dados['status'],
            $resultado['numero']
        );

        // Redirecionamento utilizando o baseUrl dinâmico
        header("Location: " . $this->baseUrl . "admin/contrato");
        exit;
    }

    /**
     * Atualizar contrato existente
     */
    public function update($id_contrato)
    {
        $contratoModel = new Contrato();
        $historicoModel = new ContratoHistorico();

        $dados = [
            'id_contrato' => $id_contrato,
            'id_loja'     => $_POST['id_loja'],
            'tipo'        => $_POST['tipo'],
            'data_inicio' => $_POST['data_inicio'],
            'data_fim'    => $_POST['data_fim'],
            'status'      => $_POST['status'],
        ];

        // Atualizar contrato
        $contratoModel->atualizar($dados);

        // O buscarPorId deve retornar o numero_contrato para manter consistência no histórico
        $contratoAtualizado = $contratoModel->buscarPorId($id_contrato);

        // Salvar histórico da alteração
        $historicoModel->registrar(
            $dados['id_loja'],
            $id_contrato,
            $dados['data_inicio'],
            $dados['data_fim'],
            $dados['tipo'],
            $dados['status'],
            $contratoAtualizado['numero_contrato'] ?? null
        );

        // Redirecionamento utilizando o baseUrl dinâmico
        header("Location: " . $this->baseUrl . "admin/contrato");
        exit;
    }

    /**
     * Deletar contrato
     */
    public function delete($id_contrato)
    {
        $contratoModel = new Contrato();
        $contratoModel->deletar($id_contrato);

        // Redirecionamento utilizando o baseUrl dinâmico para evitar loops de admin/admin/...
        header("Location: " . $this->baseUrl . "admin/contrato");
        exit;
    }

    /**
     * Retorna o histórico de contratos de uma loja em JSON (para o Modal)
     */
    public function historico($id_loja)
    {
        $historicoModel = new ContratoHistorico();
        $historicos = $historicoModel->listarPorLoja($id_loja);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($historicos);
        exit;
    }
}
