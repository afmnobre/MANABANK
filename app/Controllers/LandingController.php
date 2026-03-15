<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../core/Autoload.php';

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;

class LandingController extends Controller
{
    // Exibe a página de vendas (Pública)
    public function index() {
        $landingModel = new Landing();

        // CORRETO: $planos recebe a matriz de arrays
        $planos = $landingModel->listarPlanos();

        // TESTE DE FOGO: Se o count der 1 aqui, o erro é no fetchAll do Model.
        // Se der 2, o erro é na View.
        // echo count($planos); die();

        $this->rawView('landing/index', [
            'planos' => $planos
        ]);
    }

    // Processa a escolha do plano e envia para o Mercado Pago
    public function contratar()
    {
        $slug = $_POST['plano_slug'] ?? 'mensal';

        $landingModel = new Landing();
        $plano = $landingModel->buscarPlanoPorSlug($slug);

        if (!$plano) die('Plano inválido');

        $config = require __DIR__ . '/../../config/config.php';
        $urlBase = rtrim($config['mercadopago_url'], '/') . '/';
        $accessToken = "APP_USR-7375586212182131-031117-e0f372023b1aade14a82e6345f8e9a83-3261191138";

        MercadoPagoConfig::setAccessToken($accessToken);

        // Referência para identificarmos que é uma NOVA loja no retorno
        $referencia_externa = "NEW_" . strtoupper($slug) . "_" . time();

        $client = new PreferenceClient();
        try {
            $preference = $client->create([
                "external_reference" => $referencia_externa,
                "items" => [[
                    "title" => "Assinatura MANABANK - " . $plano['nome'],
                    "quantity" => 1,
                    "unit_price" => (float) $plano['valor'],
                    "currency_id" => "BRL"
                ]],
                "back_urls" => [
                    "success" => $urlBase . "landing/sucesso"
                ],
                "auto_return" => "approved"
            ]);

            header("Location: " . $preference->init_point);
            exit();
        } catch (Exception $e) {
            echo "Erro MP: " . $e->getMessage();
        }
    }

    // Tela de sucesso após pagamento para preencher dados da loja
    public function sucesso()
    {
        $ref = $_GET['external_reference'] ?? '';

        if (empty($ref)) {
            header("Location: /");
            exit();
        }

        // Extrai o slug do plano da referência (Ex: NEW_MENSAL_123456)
        $partes = explode('_', $ref);
        $slug_plano = strtolower($partes[1] ?? 'mensal');

        // Carrega a View de configuração inicial da loja que você criou
        $this->rawView('onboarding/ConfigurarLoja', [
            'ref' => $ref,
            'plano_slug' => $slug_plano
        ]);
    }

	public function criarNovaEstrutura($dadosLoja, $dadosGerente, $atendentes, $plano_slug)
	{
		try {
			$this->db->beginTransaction();

			// 1. Cria a Loja
			$sqlLoja = "INSERT INTO lojas (nome_loja, cnpj, data_cadastro) VALUES (:nome, :cnpj, NOW())";
			$stmt = $this->db->prepare($sqlLoja);
			$stmt->execute(['nome' => $dadosLoja['nome_loja'], 'cnpj' => $dadosLoja['cnpj']]);
			$id_loja = $this->db->lastInsertId();

			// 2. Busca info do plano
			$stmtP = $this->db->prepare("SELECT intervalo_dias FROM planos WHERE slug = :slug");
			$stmtP->execute(['slug' => $plano_slug]);
			$p = $stmtP->fetch(PDO::FETCH_ASSOC);

			// 3. Datas e Numero do Contrato (ID + ANO + MES + TIPO)
			$sufixo = ($plano_slug == 'anual') ? 'ANU' : 'MEN';
			$num_contrato = $id_loja . date('Ym') . $sufixo;
			$fim = date('Y-m-d', strtotime("+{$p['intervalo_dias']} days"));

			// 4. Insere Contrato
			$sqlC = "INSERT INTO contratos (id_loja, tipo, data_inicio, data_fim, status, numero_contrato)
					 VALUES (?, ?, CURDATE(), ?, 'ativo', ?)";
			$this->db->prepare($sqlC)->execute([$id_loja, $plano_slug, $fim, $num_contrato]);
			$id_contrato = $this->db->lastInsertId();

			// 5. Atualiza Loja com o contrato
			$this->db->prepare("UPDATE lojas SET numero_contrato = ? WHERE id_loja = ?")->execute([$num_contrato, $id_loja]);

			// 6. Histórico
			$sqlH = "INSERT INTO lojas_contratos_historico (id_loja, id_contrato, data_inicio_contrato, data_fim_contrato, tipo_contrato, status_contrato, numero_contrato)
					 VALUES (?, ?, CURDATE(), ?, ?, 'ativo', ?)";
			$this->db->prepare($sqlH)->execute([$id_loja, $id_contrato, $fim, $plano_slug, $num_contrato]);

			// 7. Usuário Gerente
			$sqlG = "INSERT INTO usuarios_loja (id_loja, nome, email, senha, perfil, ativo) VALUES (?, ?, ?, ?, 'gerente', 1)";
			$this->db->prepare($sqlG)->execute([$id_loja, $dadosGerente['nome'], $dadosGerente['email'], $dadosGerente['senha']]);

			// 8. Atendentes
			foreach ($atendentes as $at) {
				if(!empty($at)) {
					$this->db->prepare("INSERT INTO usuarios_loja (id_loja, nome, email, senha, perfil, ativo) VALUES (?, ?, ?, '123456', 'atendente', 1)")
							 ->execute([$id_loja, $at, 'atendente@'.time().'.com']);
				}
			}

			$this->db->commit();
			return true;
		} catch (Exception $e) {
			$this->db->rollBack();
			return false;
		}
	}

    public function configurar()
    {
        $slug = $_POST['plano_slug'] ?? 'mensal';

        $landingModel = new Landing();
        $plano = $landingModel->buscarPlanoPorSlug($slug);

        if (!$plano) die('Plano inválido');

        // Access Token fornecido
        $accessToken = "APP_USR-7375586212182131-031117-e0f372023b1aade14a82e6345f8e9a83-3261191138";
        MercadoPagoConfig::setAccessToken($accessToken);

        // Define a URL de retorno usando a BASE_URL do sistema
        $urlRetorno = (defined('BASE_URL') ? BASE_URL : 'http://' . $_SERVER['HTTP_HOST'] . '/');

        // Referência para identificarmos que é uma NOVA loja no retorno
        $referencia_externa = "NEW_" . strtoupper($slug) . "_" . time();

        $client = new PreferenceClient();
        try {
            $preference = $client->create([
                "external_reference" => $referencia_externa,
                "items" => [[
                    "title" => "Assinatura MANABANK - " . $plano['nome'],
                    "quantity" => 1,
                    "unit_price" => (float) $plano['valor'],
                    "currency_id" => "BRL"
                ]],
                "back_urls" => [
                    "success" => $urlRetorno . "landing/sucesso",
                    "failure" => $urlRetorno . "landing",
                    "pending" => $urlRetorno . "landing"
                ],
                "auto_return" => "approved"
            ]);

            header("Location: " . $preference->init_point);
            exit();
        } catch (Exception $e) {
            echo "Erro ao gerar preferência no Mercado Pago: " . $e->getMessage();
        }
    }

}
