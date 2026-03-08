<?php

class RelatorioController extends Controller {

    public function index() {
        AuthMiddleware::verificarLogin();
        $relatorioModel = new Relatorio();
        $idLoja = $_SESSION['LOJA']['id_loja'];

        // Pegando parâmetros da URL ou definindo padrões
        $mes = isset($_GET['mes']) ? (int)$_GET['mes'] : 0;
        $ano = isset($_GET['ano']) ? (int)$_GET['ano'] : (int)date('Y');

        // Seguindo a lógica do EstatisticasController:
        // Passamos tudo em um único array para a view
        $this->view('relatorio/index', [
            'base' => rtrim($this->baseUrl, '/') . '/',
            'mes_selecionado' => $mes,
            'ano_selecionado' => $ano,
            'anos_disponiveis' => $relatorioModel->getAnosComPedidos($idLoja)
        ]);
    }

    public function dados() {
        if (ob_get_level()) ob_end_clean();
        header('Content-Type: application/json; charset=utf-8');

        try {
            if (!isset($_SESSION['LOJA']['id_loja'])) {
                throw new Exception("Sessão expirada.");
            }

            $idLoja = $_SESSION['LOJA']['id_loja'];
            $ano = $_GET['ano'] ?? date('Y');
            $mes = (isset($_GET['mes']) && $_GET['mes'] != "0") ? $_GET['mes'] : null;

            $relatorioModel = new Relatorio();

            echo json_encode([
                "metricas"    => $relatorioModel->getMetricas($idLoja, $ano, $mes),
                "comparativo" => $relatorioModel->getComparativo($idLoja, $ano),
                "topClientes" => $relatorioModel->getTopClientes($idLoja, $ano, $mes),
                "topProdutos" => $relatorioModel->getTopProdutos($idLoja, $ano, $mes),
                "pagamentos"  => $relatorioModel->getFaturamentoPorPagamento($idLoja, $ano, $mes),
                "desempenho"  => $relatorioModel->getDesempenhoAnual($idLoja, $ano)
            ], JSON_UNESCAPED_UNICODE);

        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => $e->getMessage()]);
        }
        exit;
    }
}
