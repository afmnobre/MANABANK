<?php

class EstatisticasjogosController extends Controller
{
	public function index() {
		AuthMiddleware::verificarLogin();
		$id_loja = $_SESSION['LOJA']['id_loja'];
		$mes = isset($_GET['mes']) ? (int)$_GET['mes'] : (int)date('m');
		$ano = isset($_GET['ano']) ? (int)$_GET['ano'] : (int)date('Y');

		$model = new EstatisticasJogos();
		$dados = $model->getDadosCompletos($id_loja, $mes, $ano);

		$dados['evolucao_atual'] = $model->getEvolucaoMensal($id_loja, $ano);
		$dados['evolucao_anterior'] = $model->getEvolucaoMensal($id_loja, $ano - 1);

		// Novo gráfico de Dominância
		$dados['dominancia_mensal'] = $model->getCardgameMaisJogadoPorMes($id_loja, $ano);

		$this->view('estatistica/index', [
			'dados' => $dados,
			'mes_sel' => $mes,
			'ano_sel' => $ano,
			'ano_ant' => $ano - 1
		]);
	}
}
