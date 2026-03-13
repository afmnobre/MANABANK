<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;

class PagamentoController extends Controller
{
    public function gerarPagamento()
    {
        AuthMiddleware::verificarLogin();

        // 1. CARREGA AS CONFIGURAÇÕES E DEFINE A URL BASE
        $config = require __DIR__ . '/../../config/config.php';
        $urlBase = rtrim($config['mercadopago_url'], '/') . '/';

        //Utils::debug($urlBase);

        // 2. CAPTURAR O VALOR DO FORMULÁRIO (RADIO BUTTON)
        $tipoSelecionado = $_POST['tipo_renovacao'] ?? 'mensal';

        // 3. BUSCAR DADOS DO PLANO NO BANCO
        require_once __DIR__ . '/../Models/Home.php';
        $homeModel = new Home();
        $planosDB = $homeModel->buscarPlanos();

        // Filtrar o plano escolhido
        $planoEscolhido = null;
        foreach ($planosDB as $plano) {
            if ($plano['slug'] == $tipoSelecionado) {
                $planoEscolhido = $plano;
                break;
            }
        }

        if (!$planoEscolhido) {
             die("Erro: Plano '{$tipoSelecionado}' não encontrado no banco.");
        }

        // 4. CONFIGURAR MERCADO PAGO
        $accessToken = "APP_USR-7375586212182131-031117-e0f372023b1aade14a82e6345f8e9a83-3261191138";
        MercadoPagoConfig::setAccessToken($accessToken);

        // 5. PREPARAR REFERÊNCIA ÚNICA (ID_LOJA + TIMESTAMP + SUFIXO)
        $id_loja = $_SESSION['LOJA']['id_loja'] ?? 0;
        $sufixo = ($planoEscolhido['slug'] == 'anual') ? 'ANU' : 'MEN';
        // Usamos timestamp para a referência ser sempre única e não dar erro de duplicidade no MP
        $numero_contrato = $id_loja . "_" . date('YmdHis') . "_" . $sufixo;

        $client = new PreferenceClient();

        try {
            $preference = $client->create([
                "external_reference" => $numero_contrato,
                "items" => array(
                    array(
                        "title" => "Renovação MANABANK - " . $planoEscolhido['nome'],
                        "quantity" => 1,
                        "unit_price" => (float) $planoEscolhido['valor'],
                        "currency_id" => "BRL"
                    )
                ),
                "back_urls" => array(
                    "success" => $urlBase . "contrato/sucesso",
                    "failure" => $urlBase . "contrato/erro",
                    "pending" => $urlBase . "contrato/pendente"
                ),
                "notification_url" => $urlBase . "notificacao/escutar",
                "auto_return" => "approved",
                "binary_mode" => true // Força aprovação imediata para disparar o gatilho
            ]);

            if (isset($preference->init_point)) {
                header("Location: " . $preference->init_point);
                exit();
            }
        } catch (Exception $e) {
            echo "Erro MP: " . $e->getMessage();
        }
    }
}
