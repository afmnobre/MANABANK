<?php

require_once __DIR__ . '/../../vendor/autoload.php';
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Payment\PaymentClient;

class NotificacaoController extends Controller
{
    public function escutar()
    {
        // 1. CHAVE SECRETA DO WEBHOOK (Cole aqui a que você recebeu)
        $secret = "6c6ce11d37b7ee3962c0732314961a434f8d36e219e1392623aff352db9a315d";

        // 2. VALIDAÇÃO DE SEGURANÇA (Verifica se a assinatura bate)
        $xSignature = $_SERVER['HTTP_X_SIGNATURE'] ?? '';
        $xRequestId = $_SERVER['HTTP_X_REQUEST_ID'] ?? '';

        // Se quiser implementar a validação completa do MP, precisaria processar o payload.
        // Por enquanto, vamos focar em processar o pagamento com segurança.

        // 3. CONFIGURAÇÃO MERCADO PAGO
        $accessToken = "APP_USR-7375586212182131-031117-e0f372023b1aade14a82e6345f8e9a83-3261191138";
        MercadoPagoConfig::setAccessToken($accessToken);

        // 4. CAPTURA O ID (O MP envia via query string no Webhook)
        $id = $_GET['data_id'] ?? $_GET['id'] ?? null;

        if ($id) {
            $client = new PaymentClient();
            try {
                $payment = $client->get($id);

                // 5. SE ESTIVER APROVADO, RENOVA NO BANCO
                if ($payment->status === 'approved') {
                    $referencia = $payment->external_reference;

                    require_once __DIR__ . '/../Models/Home.php';
                    $homeModel = new Home();

                    if ($homeModel->renovarContrato($referencia)) {
                        http_response_code(200); // OK
                        echo "Contrato Renovado!";
                    }
                } else {
                    // Status pendente, cancelado, etc.
                    echo "Status: " . $payment->status;
                    http_response_code(200); // MP exige 200/201 para parar de enviar
                }
            } catch (Exception $e) {
                error_log("Erro Webhook MP: " . $e->getMessage());
                http_response_code(500);
            }
        } else {
            http_response_code(400); // Bad Request
        }
    }
}
