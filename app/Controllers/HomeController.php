<?php

class HomeController extends Controller
{
    public function index()
    {
        AuthMiddleware::verificarLogin();

        $idLoja = $_SESSION['LOJA']['id_loja'];
        $homeModel = new Home();

        $dadosLoja = Loja::buscarPorId($idLoja);
        $clientesInativos = $homeModel->clientesInativos($idLoja);
        $resumoDia = $homeModel->resumoDia($idLoja);
        $alertas = $homeModel->alertas($idLoja);
        $contratoAtivo = $homeModel->detalhesContratoLoja($idLoja);

        // --- BUSCA DINÂMICA DOS PLANOS VIA MODEL ---
        $planosDB = $homeModel->buscarPlanos();

        $planosFormatados = [];
        foreach ($planosDB as $plano) {
            $planosFormatados[$plano['slug']] = $plano;
        }
        // -------------------------------------------

        $this->view('home', [
            'clientesInativos' => $clientesInativos,
            'resumoDia'        => $resumoDia,
            'alertas'          => $alertas,
            'dadosDaLoja'      => $dadosLoja,
            'contratoAtivo'    => $contratoAtivo,
            'planos'           => $planosFormatados
        ]);
    }
}
