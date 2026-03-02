<?php
function formatarDataHora($valor) {
    if (empty($valor)) return 'N/D';
    $dt = new DateTime($valor);
    return $dt->format('d/m/Y H:i');
}
$baseAssetUrl = 'http://tcgbalcao.local/public';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Resultado Final - <?= htmlspecialchars($dadosTorneio['nome_torneio'] ?? 'Torneio') ?></title>
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
  <h2 class="mb-4">Resultado Final - <?= htmlspecialchars($dadosTorneio['nome_torneio'] ?? 'Torneio') ?></h2>

  <p class="mb-4">
    <strong>Rodadas:</strong> <?= htmlspecialchars($maxRodadas) ?><br>
    <strong>Criado em:</strong> <?= formatarDataHora($dadosTorneio['data_criacao'] ?? null) ?>
  </p>

  <!-- Tabela de classificação final -->
  <?php if (!empty($classificacaoFinal)): ?>
    <table class="table table-dark table-bordered w-auto mx-auto align-middle text-center">
      <thead>
        <tr>
          <th>Posição</th>
          <th>Jogador</th>
          <th>Vitórias</th>
          <th>Derrotas</th>
          <th>Empates</th>
          <th>BYE</th>
          <th>Pontos</th>
          <th>Força dos Oponentes</th>
          <th>Vitórias 2x0</th>
        </tr>
      </thead>
      <tbody>
        <?php $posicao = 1; ?>
        <?php foreach ($classificacaoFinal as $linha): ?>
          <tr>
            <td class="fw-bold">
              <?php
              if ($posicao == 1) {
                echo '<span style="color:#FFD700;font-size:20px;">🥇</span><br><small class="text-warning">1º Lugar</small>';
              } elseif ($posicao == 2) {
                echo '<span style="color:#C0C0C0;font-size:20px;">🥈</span><br><small class="text-secondary">2º Lugar</small>';
              } elseif ($posicao == 3) {
                echo '<span style="color:#CD7F32;font-size:20px;">🥉</span><br><small style="color:#CD7F32;">3º Lugar</small>';
              } else {
                echo $posicao . 'º';
              }
              ?>
            </td>
            <td class="<?= $posicao <= 3 ? 'fw-bold' : '' ?>">
              <?= $linha['nome'] !== null ? htmlspecialchars($linha['nome']) : 'BYE' ?>
            </td>
            <td><?= $linha['vitorias'] ?></td>
            <td><?= $linha['derrotas'] ?></td>
            <td><?= $linha['empates'] ?></td>
            <td><?= $linha['bye'] ?></td>
            <td class="fw-bold"><?= $linha['pontos'] ?></td>
            <td><?= $linha['forca_oponentes'] ?></td>
            <td><?= $linha['vitorias_2x0'] ?></td>
          </tr>
          <?php $posicao++; ?>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <div class="alert alert-warning">Nenhum resultado disponível.</div>
  <?php endif; ?>
</div>

</body>
</html>

