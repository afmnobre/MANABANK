<?php
require_once __DIR__ . '/../Models/Home.php';
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../../core/AuthMiddleware.php';

class HomeController extends Controller
{
	public function index()
	{
		AuthMiddleware::verificarLogin();

		$idLoja = $_SESSION['LOJA']['id_loja'];
		$homeModel = new Home();

		$clientesInativos = $homeModel->clientesInativos($idLoja);
		$contrato = $homeModel->contratoInfo($idLoja);
		$resumoDia = $homeModel->resumoDia($idLoja);
		$alertas = $homeModel->alertas($idLoja);

		$this->view('home', [
			'clientesInativos' => $clientesInativos,
			'contrato' => $contrato,
			'resumoDia' => $resumoDia,
			'alertas' => $alertas
		]);
	}
}




