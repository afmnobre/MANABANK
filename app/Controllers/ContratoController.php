<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;

class ContratoController extends Controller
{
    public function gerarPagamento()
    {
        AuthMiddleware::verificarLogin();

        // 1. CARREGA AS CONFIGURAÇÕES DO SISTEMA
        $config = require __DIR__ . '/../../config/config.php';

        // Usa exatamente a variável 'mercadopago_url' e limpa barras extras
        $urlBase = isset($config['mercadopago_url']) ? rtrim($config['mercadopago_url'], '/') . '/' : '/';

        // 2. CAPTURA A ESCOLHA DO MODAL (POST)
        $tipoSelecionado = $_POST['tipo_renovacao'] ?? 'mensal';

        // 3. BUSCA O PLANO NO BANCO
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

        // 4. CONFIGURA MERCADO PAGO
        $accessToken = "APP_USR-7375586212182131-031117-e0f372023b1aade14a82e6345f8e9a83-3261191138";
        MercadoPagoConfig::setAccessToken($accessToken);

        // 5. PREPARA REFERÊNCIA ÚNICA
        $id_loja = $_SESSION['LOJA']['id_loja'] ?? 0;
        $sufixo = ($planoEscolhido['slug'] == 'anual') ? 'ANU' : 'MEN';
        $numero_contrato = $id_loja . "_" . date('YmdHis') . "_" . $sufixo;

        $client = new PreferenceClient();

        try {
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
                    "success" => $urlBase . "contrato/sucesso",
                    "failure" => $urlBase . "contrato/erro",
                    "pending" => $urlBase . "contrato/pendente"
                ),
                // URL de Notificação IPN (Crucial para atualização automática)
                //"notification_url" => "https://magic.4sql.net/MANABANK/notificacao/escutar",
                "notification_url" => $urlBase . "notificacao/escutar",
                "auto_return" => "approved",

                // Força aprovação ou recusa imediata (evita status "em medição")
                "binary_mode" => true,

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

    public function verificarStatus() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }

        $id_loja = $_SESSION['LOJA']['id_loja'] ?? 0;

        require_once __DIR__ . '/../Models/Home.php';
        $homeModel = new Home();
        $ativo = $homeModel->checarStatusContrato($id_loja);

        header('Content-Type: application/json');
        echo json_encode(['ativo' => (bool)$ativo]);
        exit();
    }

	public function sucesso() {
		// 1. Pega o ID do pagamento que o MP envia de volta na URL
		$payment_id = $_GET['payment_id'] ?? null;
		$status = $_GET['status'] ?? '';

		if ($payment_id && $status === 'approved') {
			$accessToken = "APP_USR-7375586212182131-031117-e0f372023b1aade14a82e6345f8e9a83-3261191138";

			// Faz a consulta manual agora mesmo
			$ch = curl_init("https://api.mercadopago.com/v1/payments/" . $payment_id);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer $accessToken"]);
			$response = json_decode(curl_exec($ch), true);
			curl_close($ch);

			if (isset($response['status']) && $response['status'] === 'approved') {
				$referencia = $response['external_reference'];

				require_once __DIR__ . '/../Models/Home.php';
				$homeModel = new Home();

				// Atualiza o banco aqui mesmo, já que o IPN falhou
				$homeModel->renovarContrato($referencia);
			}
		}

		$this->view('contratos/sucesso');
    }

    public function erro() { $this->view('contratos/erro'); }
}
