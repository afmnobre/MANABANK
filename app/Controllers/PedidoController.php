<?php

class PedidoController extends Controller
{
	public function index()
	{
		AuthMiddleware::verificarLogin();
		$pedidoModel  = new Pedido();
		$clienteModel = new Cliente();
		$produtoModel = new Produto();

		$idLoja = $_SESSION['LOJA']['id_loja'];
		$dataSelecionada = $_GET['data'] ?? date('Y-m-d');

		// Carregamento de dados básicos
		$clientes = $clienteModel->listarPorLoja($idLoja);
		$produtos = $produtoModel->listarAtivosPorLoja($idLoja);
		$cardgames = $pedidoModel->listarCardgames();
		$tipos_pagamento = $pedidoModel->listarTiposPagamento();

		// Busca pedidos da data usando o novo método unificado
		$pedidosBrutos = $pedidoModel->listarPorLojaDataTodos($idLoja, $dataSelecionada);

		$pedidosPorCliente = [];
		foreach ($pedidosBrutos as $p) {
			$p['itens'] = $pedidoModel->listarItensPorPedido($p['id_pedido']);
			$pedidosPorCliente[$p['id_cliente']] = $p;
		}

		// Listas para organização por status
		$clientesAbertos = [];
		$clientesPagos   = [];
		$clientesSem     = [];

		foreach ($clientes as $cliente) {
			$idCli = $cliente['id_cliente'];

			// Chamada ao Model corrigida para a tabela 'clientes_cardgames'
			$cliente['cardgames'] = $pedidoModel->listarCardgamesPorCliente($idCli);

			// Inicializa classe de status vazia
			$cliente['classe_total'] = '';

			if (isset($pedidosPorCliente[$idCli])) {
				$p = $pedidosPorCliente[$idCli];

				// Define a classe CSS baseada no status de pagamento
				$cliente['classe_total'] = ($p['pedido_pago'] == 1) ? 'total-pago' : 'total-aberto';

				// Separa nas listas de ordenação
				if ($p['pedido_pago'] == 0) {
					$clientesAbertos[] = $cliente;
				} else {
					$clientesPagos[] = $cliente;
				}
			} else {
				// Cliente sem pedido na data selecionada
				$clientesSem[] = $cliente;
			}
		}

		// Ordenação alfabética para cada grupo
		$ordenarNome = fn($a, $b) => strcmp($a['nome'], $b['nome']);
		usort($clientesAbertos, $ordenarNome);
		usort($clientesPagos, $ordenarNome);
		usort($clientesSem, $ordenarNome);

		// Retorno para a View com clientes unidos na ordem de prioridade (Abertos > Pagos > Sem Pedido)
		$this->view('pedido/index', [
			'clientes'          => array_merge($clientesAbertos, $clientesPagos, $clientesSem),
			'produtos'          => $produtos,
			'pedidosPorCliente' => $pedidosPorCliente,
			'dataSelecionada'   => $dataSelecionada,
			'datasPendentes'    => $pedidoModel->listarDatasPendentes($idLoja), // Mantido conforme código original
			'cardgames'         => $cardgames,
			'tipos_pagamento'   => $tipos_pagamento
		]);
	}

    public function salvar() {
        AuthMiddleware::verificarLogin();
        $pedidoModel = new Pedido();
        $dados = $_POST;
        $idLoja = $_SESSION['LOJA']['id_loja'];
        $data = $dados['dataSelecionada'] ?? date('Y-m-d');

        foreach ($dados['itens'] as $idCliente => $itens) {
            $variado = (float)str_replace(',', '.', $dados['variado'][$idCliente] ?? 0);
            $temItens = array_sum($itens) > 0;

            if ($temItens || $variado > 0) {
                $pedidoModel->salvar([
                    'id_cliente'         => $idCliente,
                    'id_loja'            => $idLoja,
                    'valor_variado'      => $variado,
                    'observacao_variado' => $dados['observacao_variado'][$idCliente] ?? null,
                    'pedido_pago'        => isset($dados['pago'][$idCliente]) ? 1 : 0,
                    'itens'              => $itens,
                    'data_pedido'        => $data
                ]);
            } elseif (isset($dados['id_pedido'][$idCliente])) {
                // Se o pedido existe mas foi zerado, removemos se for Gerente
                if ($_SESSION['USUARIO']['perfil'] === 'GERENTE') {
                    $pedidoModel->excluir($dados['id_pedido'][$idCliente]);
                }
            }
        }

        $this->redirecionarComFiltros($data, $dados['cardgamesSelecionados'] ?? []);
    }

    public function salvarPagamento() {
        AuthMiddleware::verificarLogin();
        $pedidoModel = new Pedido();
        $dados = $_POST;
        $idCliente = (int)$dados['id_cliente'];

        // Normalização de valores
        $variado = (float)str_replace(['.', ','], ['', '.'], $dados['variado'][$idCliente] ?? 0);

        $payload = [
            'id_cliente'         => $idCliente,
            'id_loja'            => $_SESSION['LOJA']['id_loja'],
            'valor_variado'      => $variado,
            'observacao_variado' => trim($dados['observacao_variado'][$idCliente] ?? ''),
            'pedido_pago'        => 1,
            'data_pedido'        => $dados['dataSelecionada'] ?? date('Y-m-d'),
            'itens'              => $dados['itens'][$idCliente] ?? []
        ];

        // O model->salvar já resolve se é INSERT ou UPDATE
        $idPedido = $pedidoModel->salvar($payload);

        // Salva os métodos de rateio
        if (!empty($dados['valor'])) {
            $pedidoModel->salvarTiposPagamento($idPedido, $dados['valor']);
        }

        $this->redirecionarComFiltros($payload['data_pedido'], $dados['cardgamesSelecionados'] ?? []);
    }

    public function recibo($id)
    {
        AuthMiddleware::verificarLogin();
        $pedidoModel = new Pedido();
        $pedido = $pedidoModel->buscarPorId($id); // Usando o método unificado
        $itens  = $pedidoModel->listarItensPorPedido($id);

        if (!$pedido) die('Pedido não encontrado');

        $this->rawView('pedido/recibo', [
            'pedido' => $pedido,
            'itens'  => $itens,
            'loja'   => Loja::buscarPorId($_SESSION['LOJA']['id_loja'])
        ]);
    }

	private function redirecionarComFiltros($data, $cardgames) {
		$params = ['data' => $data];
		if (!empty($cardgames)) {
			$params['cardgames'] = $cardgames;
		}

		// Usamos a baseUrl do Controller para garantir o caminho correto (Local ou Remoto)
		// rtrim remove a barra final para evitarmos barras duplas //
		$urlBase = rtrim($this->baseUrl, '/');

		// Montamos o link: baseUrl + / + rota + parâmetros
		header("Location: " . $urlBase . "/pedido/index?" . http_build_query($params));
		exit;
	}
}
