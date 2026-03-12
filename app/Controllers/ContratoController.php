<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;

class ContratoController extends Controller
{
    public function gerarPagamento()
    {
        AuthMiddleware::verificarLogin();

        // 1. CAPTURA A ESCOLHA DO MODAL (POST)
        $tipoSelecionado = $_POST['tipo_renovacao'] ?? 'mensal';

        // 2. BUSCA O PLANO NO BANCO
        require_once __DIR__ . '/../Models/Home.php';
        $homeModel = new Home();
        $planosDB = $homeModel->buscarPlanos();

        $planoEscolhido = null;
        foreach ($planosDB as $plano) {
            if ($plano['slug'] == $tipoSelecionado) {
                $planoEscolhido = $plano;
                break;
            }
        }

        if (!$planoEscolhido) {
            die("Plano inválido selecionado.");
        }

        // 3. CONFIGURA MERCADO PAGO
        $accessToken = "APP_USR-7375586212182131-031117-e0f372023b1aade14a82e6345f8e9a83-3261191138";
        MercadoPagoConfig::setAccessToken($accessToken);

        // 4. PREPARA DADOS E URLS (CORREÇÃO AQUI)
        $id_loja = $_SESSION['LOJA']['id_loja'] ?? 0;
        $sufixo = ($planoEscolhido['slug'] == 'anual') ? 'ANU' : 'MEN';
        $numero_contrato = $id_loja . date('Ym') . $sufixo;

        // IMPORTANTE: Mantendo a URL do túnel Cloudflare para o retorno funcionar no localhost
        $base = "https://makers-providing-suppose-avenue.trycloudflare.com/MANABANK/";

        $client = new PreferenceClient();

        try {
            // Datas para o PIX
            $dataHoje = new DateTime();
            $dataExpiracao = new DateTime();
            $dataExpiracao->modify('+1 day');

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
                    "success" => $base . "contrato/sucesso",
                    "failure" => $base . "contrato/erro",
                    "pending" => $base . "contrato/pendente"
                ),
                "notification_url" => $base . "notificacao/escutar", // Adicionado para o Webhook
                "auto_return" => "approved",
                "payment_methods" => [
                    "excluded_payment_methods" => [],
                    "excluded_payment_types" => [],
                    "installments" => 12
                ],
                "expires" => true,
                "expiration_date_from" => $dataHoje->format('Y-m-d\TH:i:s.vP'),
                "expiration_date_to"   => $dataExpiracao->format('Y-m-d\TH:i:s.vP'),
            ]);

            if (isset($preference->init_point)) {
                header("Location: " . $preference->init_point);
                exit();
            }
        } catch (Exception $e) {
            echo "Erro ao gerar preferência: " . $e->getMessage();
        }
    }

    public function sucesso() { $this->view('contratos/sucesso'); }
    public function erro() { $this->view('contratos/erro'); }
}
