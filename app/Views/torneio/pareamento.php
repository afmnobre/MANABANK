<?php
$baseAssetUrl = 'http://tcgbalcao.local/public';
$tempoRodadaMinutos = isset($torneio['tempo_rodada']) ? (int)$torneio['tempo_rodada'] : 50;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Pareamentos - Rodada <?= $numero_rodada ?></title>
  <!-- Bootstrap via CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome via CDN -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container-fluid py-4 text-center">

  <!-- Logo da loja -->
  <?php if (!empty($loja['logo'])): ?>
    <img src="<?= $baseAssetUrl ?>/storage/uploads/lojas/<?= $loja['id_loja'] ?>/<?= htmlspecialchars($loja['logo']) ?>"
         alt="Logo da Loja" class="mb-4" style="max-height:80px;">
  <?php endif; ?>
  <h3 class="mb-4">Pareamentos - Rodada <?= $numero_rodada ?></h3>

  <!-- Tabela principal com pareamentos + timer -->
  <table class="table table-dark table-bordered w-100 align-middle text-center">
    <tr>
      <!-- Coluna da tabela de pareamentos -->
      <td class="w-50">
        <?php if (!empty($pareamentos)): ?>
          <table class="table table-dark table-bordered mb-0">
            <thead>
              <tr>
                <th>Mesa</th>
                <th>Jogador 1</th>
                <th>Jogador 2</th>
              </tr>
            </thead>
            <tbody>
              <?php $mesa = 1; ?>
              <?php foreach ($pareamentos as $partida): ?>
                <tr>
                  <td><?= $mesa++ ?></td>
                  <td><?= $partida['jogador1'] !== null ? htmlspecialchars($partida['jogador1']) : 'BYE' ?></td>
                  <td><?= $partida['jogador2'] !== null ? htmlspecialchars($partida['jogador2']) : 'BYE' ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php else: ?>
          <div class="alert alert-warning">Nenhum pareamento disponível.</div>
        <?php endif; ?>
      </td>

      <!-- Coluna do timer -->
      <td class="w-50 align-middle">
        <div class="d-flex flex-column justify-content-center align-items-center h-100">
          <h4 class="mb-3"><i class="fa-solid fa-hourglass-half"></i> Tempo de Rodada</h4>
          <div id="timer" class="display-1 fw-bold mb-4"></div>
          <div>
            <button id="startBtn" class="btn btn-success btn-lg me-2">
              <i class="fa-solid fa-play"></i> Start
            </button>
            <button id="pauseBtn" class="btn btn-danger btn-lg">
              <i class="fa-solid fa-pause"></i> Pause
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
  document.getElementById('timer').textContent = formatTime(totalSeconds);
}

document.getElementById('startBtn').addEventListener('click', function() {
  if (!running) {
    running = true;
    timerInterval = setInterval(() => {
      if (totalSeconds > 0) {
        totalSeconds--;
        updateTimerDisplay();
      } else {
        clearInterval(timerInterval);
        running = false;
        document.getElementById('timer').textContent = "00:00";
      }
    }, 1000);
  }
});

document.getElementById('pauseBtn').addEventListener('click', function() {
  running = false;
  clearInterval(timerInterval);
});

// Inicializa display
updateTimerDisplay();
</script>
</body>
</html>

