<?php

class HomeController extends Controller
{
    public function index()
    {
        AuthMiddleware::verificarLogin();

        // 1. Pega o ID da loja logada
        $idLoja = $_SESSION['LOJA']['id_loja'];
        $homeModel = new Home();

        // 2. Busca os dados cadastrais completos (CNPJ, Endereço, etc.)
        $dadosLoja = Loja::buscarPorId($idLoja);

        // 3. Busca os dados operacionais da Home
        $clientesInativos = $homeModel->clientesInativos($idLoja);
        $resumoDia = $homeModel->resumoDia($idLoja);
        $alertas = $homeModel->alertas($idLoja);

        // 4. Busca os detalhes do contrato ativo para o Modal
        $contratoAtivo = $homeModel->detalhesContratoLoja($idLoja);

        // 5. Enviamos com nomes ÚNICOS para não conflitar com a Sessão
        $this->view('home', [
            'clientesInativos' => $clientesInativos,
            'resumoDia' => $resumoDia,
            'alertas' => $alertas,
            'dadosDaLoja' => $dadosLoja,     // Variável renomeada para garantir o CNPJ
            'contratoAtivo' => $contratoAtivo
        ]);
    }
}
