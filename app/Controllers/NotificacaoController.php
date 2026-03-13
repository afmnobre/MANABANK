<?php

$raiz = realpath(__DIR__ . '/../../');
require_once $raiz . '/vendor/autoload.php';
require_once $raiz . '/core/Autoload.php';

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Payment\PaymentClient;

class NotificacaoController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

	public function escutar()
	{
		// Responde 200 OK imediatamente para o MP
		http_response_code(200);

		$accessToken = "APP_USR-7375586212182131-031117-e0f372023b1aade14a82e6345f8e9a83-3261191138";
		MercadoPagoConfig::setAccessToken($accessToken);

		// 1. TENTA CAPTURAR O ID DE TODAS AS FORMAS POSSÍVEIS
		$id = null;

		// A. Tenta via parâmetros de URL (IPN clássico: ?id=123 ou ?data.id=123)
		if (isset($_GET['data_id'])) {
			$id = $_GET['data_id'];
		} elseif (isset($_GET['id'])) {
			$id = $_GET['id'];
		}

		// B. Tenta via corpo da requisição (Webhooks JSON)
		if (!$id) {
			$json = file_get_contents('php://input');
			$dados = json_decode($json, true);

			if ($dados) {
				// O ID pode estar em ['data']['id'] ou apenas ['id']
				$id = $dados['data']['id'] ?? $dados['id'] ?? null;
			}
		}

		// 2. SE ACHOU O ID, PROCESSA
		if ($id && is_numeric($id)) {
			$this->registrarLog("INFO: Processando ID identificado: " . $id);

			$client = new PaymentClient();
			try {
				$payment = $client->get($id);

				if ($payment && $payment->status === 'approved') {
					$referencia = $payment->external_reference;

					require_once __DIR__ . '/../Models/Home.php';
					$homeModel = new Home();

					if ($homeModel->renovarContrato($referencia)) {
						$this->registrarLog("SUCESSO: Pagamento $id aprovado e banco atualizado. Ref: $referencia");
					} else {
						$this->registrarLog("ERRO: Pagamento $id aprovado, mas Model falhou na renovação. Ref: $referencia");
					}
				} else {
					$status = $payment->status ?? 'status_desconhecido';
					$this->registrarLog("AVISO: Pagamento $id recebido, mas status é: $status");
				}
			} catch (Exception $e) {
				$this->registrarLog("EXCEÇÃO API: " . $e->getMessage());
			}
		} else {
			// Log de debug para ver o que exatamente o MP enviou quando falhou
			$payloadRaw = file_get_contents('php://input');
			$getRaw = json_encode($_GET);
			$this->registrarLog("ERRO: Nenhum ID encontrado. GET: $getRaw | Payload: $payloadRaw");
		}
	}

    private function registrarLog($mensagem)
    {
        $logPath = __DIR__ . '/../../log_mp.txt';
        file_put_contents($logPath, "[" . date('Y-m-d H:i:s') . "] " . $mensagem . PHP_EOL, FILE_APPEND);
    }
}
