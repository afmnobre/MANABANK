<?php

class TorneioController extends Controller
{
    public function index()
    {
        AuthMiddleware::verificarLogin();

        $model = new Torneio();
        $id_loja = $_SESSION['LOJA']['id_loja'];

        $torneios = $model->listarTodos($id_loja);

        $this->view('torneio/index', ['torneios' => $torneios]);
    }

    public function criar()
    {
        $this->configuracao();
    }

    public function configuracao($id = null)
    {
        AuthMiddleware::verificarLogin();
        $model = new Torneio();

        require_once __DIR__ . '/../Models/CardGame.php';
        $cardGameModel = new CardGame();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dadosParaSalvar = $_POST;
            $dadosParaSalvar['id_loja'] = $_SESSION['LOJA']['id_loja'];

            if(empty($dadosParaSalvar['id_torneio'])) {
                $dadosParaSalvar['status'] = 'aberto';
            }

            $id_salvo = $model->salvar($dadosParaSalvar);

            if ($id_salvo) {
                // REFATORADO
                header("Location: " . $this->baseUrl . "torneio/ListarParticipantes/$id_salvo");
                exit;
            }
        }

        $dados = [
            'torneio' => $id ? $model->buscar($id, $_SESSION['LOJA']['id_loja']) : null,
            'cardgames' => $cardGameModel->listarTodos()
        ];

        $this->view('torneio/configurar', $dados);
    }

    public function participantes($id_torneio)
    {
        AuthMiddleware::verificarLogin();
        $model = new Torneio();
        $id_loja = $_SESSION['LOJA']['id_loja'];

        $torneio = $model->buscar($id_torneio, $id_loja);
        if (!$torneio) {
            // REFATORADO
            header("Location: " . $this->baseUrl . "torneio/index?erro=nao_encontrado");
            exit;
        }

        $cgModel = new CardGame();
        $dadosCG = $cgModel->buscar($torneio['id_cardgame']);
        $torneio['cardgame'] = $dadosCG['nome'] ?? 'N/A';

        $tipos = [
            'suico_bo1' => 'Suíço (MD1)',
            'suico_bo3' => 'Suíço (MD3)',
            'elim_dupla_bo1' => 'Eliminação Dupla (MD1)',
            'elim_dupla_bo3' => 'Eliminação Dupla (MD3)'
        ];
        $torneio['tipo_legivel'] = $tipos[$torneio['tipo_torneio']] ?? $torneio['tipo_torneio'];

        $participantes = $model->listarClientesParaTorneio($id_loja, $torneio['id_cardgame'], $id_torneio);

        $this->view('torneio/participantes', [
            'torneio' => $torneio,
            'participantes' => $participantes
        ]);
    }

    public function gerenciar($id_torneio)
    {
        AuthMiddleware::verificarLogin();
        $model = new Torneio();
        $torneio = $model->buscar($id_torneio, $_SESSION['LOJA']['id_loja']);

        if (strpos($torneio['tipo_torneio'], 'suico') !== false) {
            // REFATORADO
            header("Location: " . $this->baseUrl . "torneiosuico/gerenciar/$id_torneio");
        } else {
            // REFATORADO
            header("Location: " . $this->baseUrl . "torneioeliminacao/gerenciar/$id_torneio");
        }
        exit;
    }

    public function salvarConfiguracao()
    {
        AuthMiddleware::verificarLogin();
        $model = new Torneio();

        $dados = [
            'id_torneio'    => $_POST['id_torneio'] ?? null,
            'id_loja'       => $_SESSION['LOJA']['id_loja'],
            'nome_torneio'  => $_POST['nome_torneio'],
            'id_cardgame'   => $_POST['id_cardgame'],
            'tipo_torneio'  => $_POST['tipo_torneio'],
            'tempo_rodada'  => $_POST['tempo_rodada'] ?? 50,
            'status'        => 'aberto'
        ];

        $id_salvo = $model->salvar($dados);

        // REFATORADO
        header("Location: " . $this->baseUrl . "torneio/ListarParticipantes/$id_salvo");
        exit;
    }

    public function ListarParticipantes($id_torneio)
    {
        AuthMiddleware::verificarLogin();
        $model = new Torneio();
        $id_loja = $_SESSION['LOJA']['id_loja'];

        $torneio = $model->buscar($id_torneio, $id_loja);
        if (!$torneio) {
            // REFATORADO
            header("Location: " . $this->baseUrl . "torneio/index?erro=nao_encontrado");
            exit;
        }

        require_once __DIR__ . '/../Models/CardGame.php';
        $cgModel = new CardGame();
        $dadosCG = $cgModel->buscar($torneio['id_cardgame']);
        $torneio['cardgame'] = $dadosCG['nome'] ?? 'N/A';

        $tipos = [
            'suico_bo1' => 'Suíço (MD1)',
            'suico_bo3' => 'Suíço (MD3)',
            'elim_dupla_bo1' => 'Eliminação Dupla (MD1)',
            'elim_dupla_bo3' => 'Eliminação Dupla (MD3)'
        ];
        $torneio['tipo_legivel'] = $tipos[$torneio['tipo_torneio']] ?? $torneio['tipo_torneio'];

        $participantes = $model->listarClientesParaTorneio($id_loja, $torneio['id_cardgame'], $id_torneio);

        $this->view('torneio/participantes', [
            'torneio' => $torneio,
            'participantes' => $participantes
        ]);
    }

    public function salvarParticipantes()
    {
        AuthMiddleware::verificarLogin();
        $model = new Torneio();

        $id_torneio = $_POST['id_torneio'];
        $selecionados = $_POST['participantes'] ?? [];

        if (empty($selecionados)) {
            // REFATORADO
            header("Location: " . $this->baseUrl . "torneio/ListarParticipantes/$id_torneio?erro=selecione_ao_menos_um");
            exit;
        }

        $model->vincularParticipantes($id_torneio, $selecionados);
        $torneio = $model->buscar($id_torneio, $_SESSION['LOJA']['id_loja']);

        // REFATORADO (Usando lógica ternária para limpar)
        $controllerRedirect = (strpos($torneio['tipo_torneio'], 'suico') !== false) ? 'torneiosuico' : 'torneioeliminacao';
        header("Location: " . $this->baseUrl . "$controllerRedirect/gerenciar/$id_torneio");
        exit;
    }

    public function excluir($id) {
        AuthMiddleware::verificarLogin();
        $id_loja = $_SESSION['LOJA']['id_loja'];
        $model = new Torneio();

        if ($model->excluirTorneioCompleto($id, $id_loja)) {
            $_SESSION['msg_sucesso'] = "Torneio e todos os dados vinculados foram removidos.";
        } else {
            $_SESSION['msg_erro'] = "Erro crítico ao tentar excluir o torneio.";
        }

        // REFATORADO
        header("Location: " . $this->baseUrl . "torneio");
        exit;
    }

    public function inscricaoQRCode($id_torneio) {
        AuthMiddleware::verificarLogin();
        $model = new Torneio();
        $torneio = $model->buscar($id_torneio, $_SESSION['LOJA']['id_loja']);
        require_once __DIR__ . '/../Models/Loja.php';
        $loja = Loja::buscarPorId($_SESSION['LOJA']['id_loja']);

        $this->rawView('torneio/inscricao_qrcode', [
            'torneio' => $torneio,
            'loja' => $loja
        ]);
    }

    public function inscricao($id_torneio) {
        $model = new Torneio();
        $torneio = $model->buscar($id_torneio, $_SESSION['LOJA']['id_loja']);
        $loja = Loja::buscarPorId($torneio['id_loja']);

        $this->rawView('torneio/inscricao', [
            'torneio' => $torneio,
            'loja' => $loja
        ]);
    }

    public function confirmarInscricao() {
        $dados = $_POST;
        $celular = preg_replace('/\D/', '', $dados['celular']);
        $idTorneio = (int)$dados['id_torneio'];

        $clienteModel = new Cliente();
        $torneioModel = new Torneio();

        $cliente = $clienteModel->buscarPorCelular($celular);

        if ($cliente) {
            $torneioModel->inscreverParticipante($idTorneio, $cliente['id_cliente']);
            // REFATORADO
            header("Location: " . $this->baseUrl . "torneio/participantes/$idTorneio");
            exit;
        } else {
            echo "Celular não encontrado. Procure a organização.";
        }
    }

    public function listarAjax($id_torneio)
    {
        AuthMiddleware::verificarLogin();
        $model = new Torneio();
        $torneio = $model->buscar($id_torneio, $_SESSION['LOJA']['id_loja']);
        $clientes = $model->listarClientesParaTorneio($_SESSION['LOJA']['id_loja'], $torneio['id_cardgame'], $id_torneio);

        foreach ($clientes as $cliente) {
            echo '<div class="col-md-6 mb-2 item-jogador" data-nome="'.strtolower(htmlspecialchars($cliente['nome'])).'">';
            echo '<label class="list-group-item bg-dark text-light border-secondary d-flex justify-content-between align-items-center py-3 px-3 rounded" style="cursor: pointer; border: 1px solid #444;">';
            echo '<div class="text-truncate d-flex align-items-center">';
            echo '<input type="checkbox" name="participantes[]" value="'.$cliente['id_cliente'].'" class="form-check-input me-3" style="flex-shrink: 0;" '.($cliente['inscrito'] ? 'checked' : '').'>';
            echo '<div class="text-truncate">';
            echo '<span class="fw-bold text-light nome-texto">'.htmlspecialchars($cliente['nome']).'</span>';
            echo '</div></div>';
            echo '<span class="badge rounded-pill bg-secondary text-dark d-none d-lg-inline ms-3">Cliente</span>';
            echo '</label></div>';
        }
    }
}
