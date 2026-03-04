<?php
// Como é carregada via viewRaw, incluímos o config manualmente
require_once dirname(__DIR__, 3) . '/config/config.php';

// Ajustamos o caminho dos assets baseado na raiz do sistema ($base)
$baseAssetUrl = $base . 'public';

$tempoRodadaMinutos = isset($torneio['tempo_rodada']) ? (int)$torneio['tempo_rodada'] : 50;
$nomeTorneio = isset($torneio['nome_torneio']) ? htmlspecialchars($torneio['nome_torneio']) : 'Torneio';
$dataTorneio = isset($torneio['data_evento']) ? date('d/m/Y', strtotime($torneio['data_evento'])) : date('d/m/Y');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Pareamentos - Rodada <?= $numero_rodada ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <style>
    /* Estilo para garantir visibilidade em transmissões */
    .table-dark { --bs-table-bg: #1a1a1a; }
    #timer { font-variant-numeric: tabular-nums; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); }
    .text-bye { color: #0dcaf0 !important; font-style: italic; font-weight: bold; } /* Ciano claro para leitura fácil */
  </style>
</head>
<body class="bg-dark text-light">

<div class="container-fluid py-4 text-center">

  <?php if (!empty($loja['logo'])): ?>
    <img src="<?= $baseAssetUrl ?>/storage/uploads/lojas/<?= $loja['id_loja'] ?>/<?= htmlspecialchars($loja['logo']) ?>"
         alt="Logo da Loja" class="mb-4" style="max-height:80px;">
  <?php endif; ?>

  <h3 class="mb-1 text-uppercase fw-bold" style="letter-spacing: 1px;">
    Pareamentos - Rodada <?= $numero_rodada ?>
  </h3>
  <p class="text-secondary mb-4">
    <strong><?= $nomeTorneio ?></strong> | <?= $dataTorneio ?>
  </p>

  <table class="table table-dark table-bordered w-100 align-middle text-center shadow">
    <tr>
      <td class="w-50 p-0" style="vertical-align: top;">
        <?php if (!empty($pareamentos)): ?>
          <table class="table table-dark table-striped table-hover mb-0">
            <thead class="table-secondary text-dark">
              <tr>
                <th width="80">Mesa</th>
                <th>Jogador 1</th>
                <th width="50">VS</th>
                <th>Jogador 2</th>
              </tr>
            </thead>
            <tbody style="font-size: 1.1rem;">
              <?php $mesa = 1; ?>
              <?php foreach ($pareamentos as $partida): ?>
                <tr>
                  <td class="fw-bold"><?= $mesa++ ?></td>
                  <td class="<?= $partida['jogador1'] === null ? 'text-bye' : 'fw-bold' ?>">
                    <?= $partida['jogador1'] !== null ? htmlspecialchars($partida['jogador1']) : 'BYE' ?>
                  </td>
                  <td class="text-warning small">VS</td>
                  <td class="<?= $partida['jogador2'] === null ? 'text-bye' : 'fw-bold' ?>">
                    <?= $partida['jogador2'] !== null ? htmlspecialchars($partida['jogador2']) : 'BYE' ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php else: ?>
          <div class="p-4">
            <div class="alert alert-warning">Nenhum pareamento disponível.</div>
          </div>
        <?php endif; ?>
      </td>

      <td class="w-50 align-middle bg-black">
        <div class="d-flex flex-column justify-content-center align-items-center h-100 py-5">
          <h4 class="mb-3 text-secondary"><i class="fa-solid fa-hourglass-half me-2"></i>TEMPO DE RODADA</h4>
          <div id="timer" class="display-1 fw-bold mb-4 text-success">00:00</div>
          <div class="d-print-none">
            <button id="startBtn" class="btn btn-success btn-lg me-2 px-4">
              <i class="fa-solid fa-play"></i> Iniciar
            </button>
            <button id="pauseBtn" class="btn btn-outline-danger btn-lg px-4">
              <i class="fa-solid fa-pause"></i> Pausar
            </button>
          </div>
        </div>
      </td>
    </tr>
  </table>
</div>

<script>
let timerInterval;
let running = false;
let totalSeconds = <?= $tempoRodadaMinutos ?> * 60;

function formatTime(sec) {
  const m = String(Math.floor(sec / 60)).padStart(2, '0');
  const s = String(sec % 60).padStart(2, '0');
  return `${m}:${s}`;
}

function updateTimerDisplay() {
  const timerElement = document.getElementById('timer');
  timerElement.textContent = formatTime(totalSeconds);

  // Alerta visual quando faltar menos de 5 minutos
  if (totalSeconds <= 300 && totalSeconds > 0) {
      timerElement.classList.replace('text-success', 'text-warning');
  } else if (totalSeconds === 0) {
      timerElement.classList.replace('text-warning', 'text-danger');
      timerElement.classList.add('blink');
  }
}

document.getElementById('startBtn').addEventListener('click', function() {
  if (!running) {
    running = true;
    this.classList.add('disabled');
    document.getElementById('pauseBtn').classList.remove('disabled');

    timerInterval = setInterval(() => {
      if (totalSeconds > 0) {
        totalSeconds--;
        updateTimerDisplay();
      } else {
        clearInterval(timerInterval);
        running = false;
      }
    }, 1000);
  }
});

document.getElementById('pauseBtn').addEventListener('click', function() {
  running = false;
  clearInterval(timerInterval);
  document.getElementById('startBtn').classList.remove('disabled');
});

// Inicializa display
updateTimerDisplay();
</script>
</body>
</html>
