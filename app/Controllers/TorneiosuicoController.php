<?php

class TorneiosuicoController extends Controller
{
    private $db;

    public function __construct()
    {
        parent::__construct(); // Garante a inicialização das URLs na classe pai
        $this->db = Database::getInstance();
    }

    public function gerenciar($id_torneio)
    {
        AuthMiddleware::verificarLogin();
        $id_loja = $_SESSION['LOJA']['id_loja'];
        $modelSuico = new TorneioSuico();

        $torneio = $modelSuico->buscar($id_torneio, $id_loja);
        if (!$torneio)
        {
            // REFATORADO: Adicionado $this->baseUrl
            header("Location: " . $this->baseUrl . "torneio?erro=nao_encontrado");
            exit;
        }

        $rodadaAtual = $modelSuico->buscarRodadaAtual($id_torneio);

        if (!$rodadaAtual)
        {
            $modelSuico->gerarRodadaInicial($id_torneio);
            $rodadaAtual = $modelSuico->buscarRodadaAtual($id_torneio);
        }

        $partidas = $modelSuico->buscarPartidasDaRodada($rodadaAtual['id_rodada']);
        $ranking = $modelSuico->calcularRanking($id_torneio);

        $todasConcluidas = true;
        foreach ($partidas as $p)
        {
            if (empty($p['resultado']))
            {
                $todasConcluidas = false;
                break;
            }
        }

        $totalJogadores = count($ranking);
        $totalRodadas = ($totalJogadores > 0) ? (int)ceil(log($totalJogadores, 2)) : 0;

        $podeGerarProxima = ($torneio['status'] === 'em_andamento') && $todasConcluidas && ($rodadaAtual['numero_rodada'] < $totalRodadas);

        $this->view('torneio/gerenciarTorneioSuico', [
            'torneio' => $torneio,
            'rodada' => $rodadaAtual,
            'partidas' => $partidas,
            'participantes' => $ranking,
            'totalRodadas' => $totalRodadas,
            'podeGerarProxima' => $podeGerarProxima,
            'todasConcluidas' => $todasConcluidas
        ]);
    }

    public function salvarResultado()
    {
        $id_partida = $_POST['id_partida'] ?? null;
        $resultado = $_POST['resultado'] ?? null;
        $id_torneio = $_POST['id_torneio'] ?? null;

        if ($id_partida && $resultado)
        {
            $model = new TorneioSuico();
            $model->atualizarResultadoPartida($id_partida, $resultado);
        }

        // REFATORADO: Adicionado $this->baseUrl
        header("Location: " . $this->baseUrl . "torneiosuico/gerenciar/$id_torneio");
        exit;
    }

	public function proximaRodada($id_torneio)
	{
		$model = new TorneioSuico();
		$sucesso = $model->gerarProximaRodada($id_torneio);

		// Verifica se o torneio acabou de ser finalizado
		$torneio = $model->buscar($id_torneio, $_SESSION['LOJA']['id_loja']);
		if ($torneio['status'] === 'finalizado') {
			$ranking = $model->calcularRanking($id_torneio);
			$model->salvarResultadosFinais($id_torneio, $ranking);
		}

		header("Location: " . $this->baseUrl . "torneiosuico/gerenciar/$id_torneio");
		exit;
	}

	public function verPareamento($id_torneio, $numero_rodada)
	{
		// Verifica se o usuário tem permissão
		AuthMiddleware::verificarLogin();

		$modelSuico = new TorneioSuico();
		$id_loja = $_SESSION['LOJA']['id_loja'];

		// Busca dados da loja e do torneio
		$loja = $modelSuico->buscarLoja($id_loja);
		$torneio = $modelSuico->buscar($id_torneio, $id_loja);

		// Busca as informações da rodada específica
		$rodadaInfo = $modelSuico->buscarRodadaPorNumero($id_torneio, $numero_rodada);

		$pareamentos = [];
		if ($rodadaInfo) {
			$partidas = $modelSuico->buscarPartidasDaRodada($rodadaInfo['id_rodada']);
			foreach ($partidas as $p) {
				$pareamentos[] = [
					'jogador1' => $p['nome_j1'],
					'jogador2' => $p['nome_j2']
				];
			}
		}

		// Prepara as variáveis para a view
		$data = [
			'loja' => $loja,
			'torneio' => $torneio,
			'pareamentos' => $pareamentos,
			'numero_rodada' => (int)$numero_rodada,
			'base' => $this->baseUrl // Importante para os caminhos na subpasta /MANABANK/
		];

		// Extrai o array para que as chaves virem variáveis (ex: $loja, $torneio) na view
		extract($data);

		// Carrega via viewRaw (sem header/footer padrão do sistema)
		require __DIR__ . '/../Views/torneio/pareamento.php';
	}

    public function verPontuacao($id_torneio)
    {
        AuthMiddleware::verificarLogin();
        $modelSuico = new TorneioSuico();
        $id_loja = $_SESSION['LOJA']['id_loja'];

        $loja = $modelSuico->buscarLoja($id_loja);
        $dadosTorneio = $modelSuico->buscar($id_torneio, $id_loja);
        $ranking = $modelSuico->calcularRanking($id_torneio);
        $rodadaAtual = $modelSuico->buscarRodadaAtual($id_torneio);

        $extenso = [1 => 'Primeira', 2 => 'Segunda', 3 => 'Terceira', 4 => 'Quarta', 5 => 'Quinta', 6 => 'Sexta'];
        $num = $rodadaAtual['numero_rodada'] ?? 1;
        $numero_rodada_texto = ($extenso[$num] ?? $num . 'ª') . " Rodada";

        $classificacao = [];
        foreach ($ranking as $r)
        {
            $classificacao[] = ['nome' => $r['nome'], 'vitorias' => $r['vitorias'], 'derrotas' => $r['derrotas'], 'empates' => $r['empates'], 'bye' => $r['byes'], 'pontos' => $r['pontos'], 'forca_oponentes' => $r['buchholz'], 'vitorias_2x0' => $r['vitorias2x0']];
        }

        $base = $this->baseUrl; // Garante variável base nas views manuais
        if ($dadosTorneio['status'] === 'finalizado')
        {
            $classificacaoFinal = $classificacao;
            $maxRodadas = $num;
            require __DIR__ . '/../Views/torneio/resultadosuico.php';
        }
        else
        {
            require __DIR__ . '/../Views/torneio/ranking_parcial.php';
        }
    }

    public function limparResultado($id_partida, $id_torneio)
    {
        AuthMiddleware::verificarLogin();
        $model = new TorneioSuico();
        $model->resetarPartida($id_partida);

        // REFATORADO: Adicionado $this->baseUrl
        header("Location: " . $this->baseUrl . "torneiosuico/gerenciar/$id_torneio");
        exit;
    }

	public function verRegrasSuico()
	{
		AuthMiddleware::verificarLogin();
		$modelSuico = new TorneioSuico();
		$id_loja = $_SESSION['LOJA']['id_loja'];
		$loja = $modelSuico->buscarLoja($id_loja);

		$base = $this->baseUrl;
		$data = [
			'loja' => $loja,
			'base' => $base
		];

		// Extrai os dados para que virem variáveis na view
		extract($data);

		require __DIR__ . '/../Views/torneio/verRegrasSuico.php';
	}
}
