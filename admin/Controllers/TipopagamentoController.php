<?php

class TipopagamentoController
{
    public function index()
    {
        $model = new TipoPagamento();
        $tipos = $model->listar();

        ob_start();
        require __DIR__ . '/../Views/tipos_pagamento/index.php';
        $content = ob_get_clean();

        $title = "Tipos de Pagamento";
        require __DIR__ . '/../Views/layout/layout.php';
    }

    public function form($id_pagamento = null)
    {
        $model = new TipoPagamento();
        $tipo = $id_pagamento ? $model->buscarPorId($id_pagamento) : null;

        ob_start();
        require __DIR__ . '/../Views/tipos_pagamento/form.php';
        $content = ob_get_clean();

        $title = $id_pagamento ? "Editar Tipo de Pagamento" : "Novo Tipo de Pagamento";
        require __DIR__ . '/../Views/layout/layout.php';
    }

    public function store()
    {
        $model = new TipoPagamento();
        $dados = ['nome' => $_POST['nome']];

        $id = $model->criar($dados);

        // Upload imagem
        if (!empty($_FILES['imagem'])) {
            $fileName = $model->uploadImagem($_FILES['imagem'], $id);
            if ($fileName) $model->atualizar($id, ['imagem' => $fileName]);
        }

        header("Location: /admin/tipopagamento");
        exit;
    }

	public function update($id_pagamento)
	{
		$tipoModel = new TipoPagamento();

		$dados = [
			'nome' => $_POST['nome']
		];

		// Se enviou arquivo
		if (isset($_FILES['imagem']) && $_FILES['imagem']['tmp_name']) {
			$nomeArquivo = $tipoModel->uploadImagem($_FILES['imagem'], $id_pagamento);
			if ($nomeArquivo) {
				$dados['imagem'] = $nomeArquivo;
			}
		}

		$tipoModel->atualizar($id_pagamento, $dados);

		header("Location: /admin/tipopagamento");
		exit;
    }

    public function delete($id_pagamento)
    {
        $model = new TipoPagamento();
        $model->deletar($id_pagamento);

        header("Location: /admin/tipopagamento");
        exit;
    }
}

