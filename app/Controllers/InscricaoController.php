<?php
require_once __DIR__ . '/../Models/Torneio.php';
require_once __DIR__ . '/../Models/Loja.php';
require_once __DIR__ . '/../Models/Cliente.php';

class InscricaoController extends Controller
{
    /**
     * Exibe a tela pública de inscrição
     */
    public function index($id_torneio)
    {
        $torneioModel = new Torneio();
        $torneio = $torneioModel->buscarPublico($id_torneio);

        if (!$torneio) {
            die("Torneio não encontrado.");
        }

        // Buscar loja vinculada ao torneio
        $loja = Loja::buscarPorId($torneio['id_loja']);

        $this->rawView('torneio/inscricao', [
            'torneio' => $torneio,
            'loja' => $loja
        ]);
    }

    /**
     * Confirma inscrição de um jogador pelo celular
     */
	public function confirmar()
	{
		$telefone = preg_replace('/\D/', '', $_POST['celular'] ?? '');
		$idTorneio = (int)($_POST['id_torneio'] ?? 0);

		$clienteModel = new Cliente();
		$torneioModel = new Torneio();

		$torneio = $torneioModel->buscarPublico($idTorneio);

		header('Content-Type: application/json; charset=utf-8');

		if (!$torneio) {
			echo json_encode([
				'status' => 'error',
				'message' => 'Torneio não encontrado.'
			]);
			exit;
		}

		$cliente = $clienteModel->buscarPorCelular($telefone);

		if (!$cliente) {
			echo json_encode([
				'status' => 'error',
				'message' => 'Você não está cadastrado, por favor solicitar seu cadastro no sistema.'
			]);
			exit;
		}

		if (!$clienteModel->vinculadoLoja($cliente['id_cliente'], $torneio['id_loja'])) {
			echo json_encode([
				'status' => 'error',
				'message' => 'Você não está cadastrado nesta loja, solicitar cadastro no sistema.'
			]);
			exit;
		}

		if (!$clienteModel->vinculadoCardgame($cliente['id_cliente'], $torneio['id_cardgame'])) {
			echo json_encode([
				'status' => 'error',
				'message' => 'Você não está vinculado a esse cardgame, solicitar vínculo no sistema.'
			]);
			exit;
		}

		// Se passou em todas as validações, inscreve
		$torneioModel->inscreverParticipante($idTorneio, $cliente['id_cliente']);

		echo json_encode([
			'status' => 'success',
			'nome' => $cliente['nome'],
			'id_cliente' => $cliente['id_cliente'],
			'evento' => 'inscricaoConfirmada'
		]);
		exit;
	}
}

