<?php
// Correção do caminho: Sobe 3 níveis para chegar na raiz e encontrar a pasta /config
require_once dirname(__DIR__, 3) . '/config/config.php';

function formatarDataHora($valor) {
    if (empty($valor)) return 'N/D';
    try {
        $dt = new DateTime($valor);
        return $dt->format('d/m/Y H:i');
    } catch (Exception $e) {
        return 'N/D';
    }
}

// Ajuste dinâmico do caminho dos assets para o servidor remoto
$baseAssetUrl = $base . 'public';

$nomeTorneio = isset($dadosTorneio['nome_torneio']) ? htmlspecialchars($dadosTorneio['nome_torneio']) : 'Torneio';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Resultado Final - <?= $nomeTorneio ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <style>
    .table-dark { --bs-table-bg: #1a1a1a; }
    .gold { background: linear-gradient(45deg, #ffd70033, transparent) !important; }
    .silver { background: linear-gradient(45deg, #c0c0c033, transparent) !important; }
    .bronze { background: linear-gradient(45deg, #cd7f3233, transparent) !important; }
    .podium-icon { font-size: 1.5rem; display: block; }
    /* Cor de destaque para colunas secundárias (BYE e BH) */
    .text-highlight-alt { color: #0dcaf0 !important; font-weight: 500; }
  </style>
</head>
<body class="bg-dark text-light">

<div class="container-fluid py-5 text-center">

  <?php if (!empty($loja['logo'])): ?>
    <img src="<?= $baseAssetUrl ?>/storage/uploads/lojas/<?= $loja['id_loja'] ?>/<?= htmlspecialchars($loja['logo']) ?>"
         alt="Logo da Loja" class="mb-4" style="max-height:100px;">
  <?php endif; ?>

  <h1 class="display-5 fw-bold text-uppercase mb-2" style="letter-spacing: 2px;">
    <i class="fas fa-trophy text-warning me-2"></i> Resultado Final
  </h1>
  <h3 class="text-secondary mb-4"><?= $nomeTorneio ?></h3>

  <div class="d-inline-block bg-black p-3 rounded mb-5 border border-secondary text-light">
    <span class="me-4"><strong>Rodadas:</strong> <?= htmlspecialchars($maxRodadas) ?></span>
    <span><strong>Encerrado em:</strong> <?= formatarDataHora($dadosTorneio['data_criacao'] ?? null) ?></span>
  </div>

  <?php if (!empty($classificacaoFinal)): ?>
    <div class="table-responsive px-md-5">
        <table class="table table-dark table-striped table-hover table-bordered w-auto mx-auto align-middle text-center shadow-lg">
          <thead class="table-light text-dark">
            <tr>
              <th width="120">Posição</th>
              <th width="300">Jogador</th>
              <th title="Vitórias">V</th>
              <th title="Derrotas">D</th>
              <th title="Empates">E</th>
              <th title="BYE">B</th>
              <th width="100">Pontos</th>
              <th title="Buchholz (Força dos Oponentes)">BH</th>
              <th title="Vitórias por 2x0">2x0</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $posicao = 1;
            foreach ($classificacaoFinal as $linha):
                $rowClass = '';
                if($posicao == 1) $rowClass = 'gold';
                elseif($posicao == 2) $rowClass = 'silver';
                elseif($posicao == 3) $rowClass = 'bronze';
            ?>
              <tr class="<?= $rowClass ?>">
                <td class="fw-bold">
                  <?php
                  if ($posicao == 1) {
                    echo '<span class="podium-icon">🥇</span><small class="text-warning text-uppercase fw-bold">Campeão</small>';
                  } elseif ($posicao == 2) {
                    echo '<span class="podium-icon">🥈</span><small class="text-secondary text-uppercase fw-bold">Vice</small>';
                  } elseif ($posicao == 3) {
                    echo '<span class="podium-icon">🥉</span><small style="color:#CD7F32;" class="text-uppercase fw-bold">3º Lugar</small>';
                  } else {
                    echo $posicao . 'º';
                  }
                  ?>
                </td>
                <td class="text-start ps-4 <?= $posicao <= 3 ? 'fs-5 fw-bold' : '' ?>">
                  <?= $linha['nome'] !== null ? htmlspecialchars($linha['nome']) : '<span class="text-highlight-alt italic">BYE</span>' ?>
                </td>
                <td class="text-success fw-bold"><?= $linha['vitorias'] ?></td>
                <td class="text-danger fw-bold"><?= $linha['derrotas'] ?></td>
                <td class="text-warning fw-bold"><?= $linha['empates'] ?></td>
                <td class="text-highlight-alt"><?= $linha['bye'] ?></td>
                <td class="fs-5 fw-bold bg-dark shadow-sm"><?= $linha['pontos'] ?></td>
                <td class="text-highlight-alt"><?= $linha['forca_oponentes'] ?></td>
                <td class="small fw-bold"><?= $linha['vitorias_2x0'] ?></td>
              </tr>
              <?php $posicao++; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
    </div>
  <?php else: ?>
    <div class="alert alert-warning d-inline-block px-5">
        <i class="fas fa-exclamation-circle me-2"></i> Nenhum resultado disponível para este torneio.
    </div>
  <?php endif; ?>

  <div class="mt-5 d-print-none">
      <button onclick="window.print()" class="btn btn-outline-light btn-lg">
          <i class="fas fa-print me-2"></i> Imprimir Resultado
      </button>
  </div>
</div>

</body>
</html>
