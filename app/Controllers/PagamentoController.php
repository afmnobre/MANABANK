<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;

class PagamentoController extends Controller
{
    public function gerarPagamento()
    {
        AuthMiddleware::verificarLogin();

        // 1. CAPTURAR O VALOR DO FORMULÁRIO (RADIO BUTTON)
        // O name no HTML é "tipo_renovacao"
        $tipoSelecionado = $_POST['tipo_renovacao'] ?? 'mensal';

        // 2. BUSCAR DADOS DO PLANO NO BANCO (Via Model para evitar erro de Connection)
        require_once __DIR__ . '/../Models/Home.php';
        $homeModel = new Home();
        $planosDB = $homeModel->buscarPlanos(); // Aquele método que criamos antes

        // Filtrar o plano escolhido
        $planoEscolhido = null;
        foreach ($planosDB as $plano) {
            if ($plano['slug'] == $tipoSelecionado) {
                $planoEscolhido = $plano;
                break;
            }
        }

        // Se não achar o plano (erro de slug), define um padrão de segurança
        if (!$planoEscolhido) {
             die("Erro: Plano '{$tipoSelecionado}' não encontrado no banco.");
        }

        // 3. CONFIGURAR MERCADO PAGO
        $accessToken = "APP_USR-7375586212182131-031117-e0f372023b1aade14a82e6345f8e9a83-3261191138";
        MercadoPagoConfig::setAccessToken($accessToken);

        // 4. PREPARAR DADOS
        $id_loja = $_SESSION['LOJA']['id_loja'] ?? 0;
        $sufixo = ($planoEscolhido['slug'] == 'anual') ? 'ANU' : 'MEN';
        $numero_contrato = $id_loja . date('Ym') . $sufixo;
        $base = rtrim($this->baseUrl, '/') . '/';

        $client = new PreferenceClient();

        try {
            $preference = $client->create([
                "external_reference" => $numero_contrato,
                "items" => array(
                    array(
                        "title" => "Renovação MANABANK - " . $planoEscolhido['nome'],
                        "quantity" => 1,
                        // Aqui passamos o valor real do banco convertido para float
                        "unit_price" => (float) $planoEscolhido['valor'],
                        "currency_id" => "BRL"
                    )
                ),
                "back_urls" => array(
                    "success" => $base . "contrato/sucesso",
                    "failure" => $base . "contrato/erro",
                    "pending" => $base . "contrato/pendente"
                ),
                "auto_return" => "approved",
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
