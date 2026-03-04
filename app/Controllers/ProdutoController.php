<?php

class ProdutoController extends Controller
{
    public function index()
    {
        AuthMiddleware::verificarLogin();

        $produtoModel = new Produto();
        $produtos = $produtoModel->listarTodosPorLoja($_SESSION['LOJA']['id_loja']);

        $this->view('produto/index', [
            'produtos' => $produtos
        ]);
    }

    public function criar()
    {
        AuthMiddleware::verificarLogin();
        $this->view('produto/form');
    }

    public function salvar()
    {
        AuthMiddleware::verificarLogin();
        $produtoModel = new Produto();

        $dados = [
            'id_loja'           => $_SESSION['LOJA']['id_loja'],
            'nome'              => $_POST['nome'],
            'emoji'             => $_POST['emoji'],
            'valor_venda'       => str_replace(',', '.', str_replace('.', '', $_POST['valor_venda'])),
            'valor_compra'      => str_replace(',', '.', str_replace('.', '', $_POST['valor_compra'])),
            'controlar_estoque' => isset($_POST['controla_estoque']) ? 1 : 0,
            'estoque_atual'     => $_POST['estoque_atual'] ?? 0,
            'id_fornecedor'     => $_POST['id_fornecedor'] ?? null,
            'ativo'             => 1
        ];

        $produtoModel->criar($dados);

        $_SESSION['flash'] = "Produto salvo com sucesso!";
        header('Location: ' . $this->baseUrl . 'produto');
        exit;
    }

    public function editar($id_produto)
    {
        AuthMiddleware::verificarLogin();
        $produtoModel = new Produto();
        $produto = $produtoModel->buscar($id_produto, $_SESSION['LOJA']['id_loja']);

        $this->view('produto/form', [
            'produto' => $produto
        ]);
    }

    public function atualizar($id)
    {
        AuthMiddleware::verificarLogin();
        $produtoModel = new Produto();

        // Busca o produto atual para preservar a ordem de exibição
        $produtoAtual = $produtoModel->buscar($id, $_SESSION['LOJA']['id_loja']);

        $dados = [
            'id_produto'        => $id,
            'nome'              => $_POST['nome'],
            'emoji'             => $_POST['emoji'],
            'valor_venda'       => str_replace(',', '.', str_replace('.', '', $_POST['valor_venda'])),
            'valor_compra'      => str_replace(',', '.', str_replace('.', '', $_POST['valor_compra'])),
            'controlar_estoque' => isset($_POST['controlar_estoque']) ? 1 : 0,
            'estoque_atual'     => $_POST['estoque_atual'] ?? 0,
            'estoque_alerta'    => $_POST['estoque_alerta'] ?? 0,
            'id_fornecedor'     => $_POST['id_fornecedor'] ?? null,
            'id_loja'           => $_SESSION['LOJA']['id_loja'],
            'ordem_exibicao'    => $produtoAtual['ordem_exibicao']
        ];

        $produtoModel->atualizar($dados);

        $_SESSION['flash'] = "Produto atualizado com sucesso!";
        header('Location: ' . $this->baseUrl . 'produto');
        exit;
    }

    public function ativar($id)
    {
        AuthMiddleware::verificarLogin();
        $produto = new Produto();
        $produto->ativar($id, $_SESSION['LOJA']['id_loja']);

        header('Location: ' . $this->baseUrl . 'produto');
        exit;
    }

    public function desativar($id_produto)
    {
        AuthMiddleware::verificarLogin();
        $produtoModel = new Produto();
        $produtoModel->desativar($id_produto, $_SESSION['LOJA']['id_loja']);

        header('Location: ' . $this->baseUrl . 'produto');
        exit;
    }

    public function salvarOrdem()
    {
        AuthMiddleware::verificarLogin();
        $ids_produtos = $_POST['id_produto'] ?? [];

        if (!empty($ids_produtos)) {
            $produtoModel = new Produto();
            $novaOrdem = 1;

            foreach ($ids_produtos as $id_produto) {
                $produtoModel->atualizarOrdem($id_produto, $novaOrdem);
                $novaOrdem++;
            }
            $_SESSION['flash'] = "Ordem atualizada com sucesso!";
        }

        header('Location: ' . $this->baseUrl . 'produto');
        exit;
    }
}
