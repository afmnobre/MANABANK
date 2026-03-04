<?php

class RelatorioController extends Controller {

	public function index() {
		AuthMiddleware::verificarLogin();
		$relatorioModel = new Relatorio();
		$idLoja = $_SESSION['LOJA']['id_loja'];

		$data['base'] = rtrim($this->baseUrl, '/') . '/';
		$data['mes_selecionado'] = isset($_GET['mes']) ? (int)$_GET['mes'] : 0;
		$data['ano_selecionado'] = $_GET['ano'] ?? date('Y');
		$data['anos_disponiveis'] = $relatorioModel->getAnosComPedidos($idLoja);

		// A ORDEM DEVE SER EXATAMENTE ESTA:
		$this->view('layout/header', $data);          // Abre o body e a nav
		$this->view('relatorio/index', $data); // O CONTEÚDO (Agora corrigido abaixo)
		$this->view('layout/footer', $data);          // Fecha as divs e o body
	}

    public function dados() {
        // Limpa buffers para evitar lixo no JSON
        if (ob_get_level()) ob_end_clean();

        header('Content-Type: application/json; charset=utf-8');

        try {
            if (!isset($_SESSION['LOJA']['id_loja'])) {
                throw new Exception("Sessão expirada ou loja não identificada.");
            }

            $idLoja = $_SESSION['LOJA']['id_loja'];
            $ano = $_GET['ano'] ?? date('Y');
            $mes = (isset($_GET['mes']) && $_GET['mes'] != "0") ? $_GET['mes'] : null;

            $relatorioModel = new Relatorio();

            // Monta o array de resposta
            $jsonResponse = [
                "metricas"    => $relatorioModel->getMetricas($idLoja, $ano, $mes),
                "comparativo" => $relatorioModel->getComparativo($idLoja, $ano),
                "topClientes" => $relatorioModel->getTopClientes($idLoja, $ano, $mes),
                "topProdutos" => $relatorioModel->getTopProdutos($idLoja, $ano, $mes),
                "pagamentos"  => $relatorioModel->getFaturamentoPorPagamento($idLoja, $ano, $mes),
                "desempenho"  => $relatorioModel->getDesempenhoAnual($idLoja, $ano)
            ];

            echo json_encode($jsonResponse, JSON_UNESCAPED_UNICODE);

        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => $e->getMessage()]);
        }
        exit;
    }
}
