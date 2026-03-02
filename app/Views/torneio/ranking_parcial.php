<?php
$baseAssetUrl = 'http://tcgbalcao.local/public';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Classificação Parcial - <?= htmlspecialchars($dadosTorneio['nome_torneio']) ?></title>
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
  <h3 class="mb-4">Classificação Parcial - <?= htmlspecialchars($dadosTorneio['nome_torneio']) ?></h3>

  <p class="mb-4">Classificação atualizada após os resultados da rodada <strong><?= $numero_rodada_texto ?></strong>.</p>

  <!-- Tabela de classificação -->
  <?php if (!empty($classificacao)): ?>
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
        <?php $pos = 1; foreach ($classificacao as $r): ?>
          <tr>
            <td><?= $pos++ ?>º</td>
            <td><?= htmlspecialchars($r['nome']) ?></td>
            <td><?= $r['vitorias'] ?></td>
            <td><?= $r['derrotas'] ?></td>
            <td><?= $r['empates'] ?></td>
            <td><?= $r['bye'] ?></td>
            <td><strong><?= $r['pontos'] ?></strong></td>
            <td><?= $r['forca_oponentes'] ?></td>
            <td><?= $r['vitorias_2x0'] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <div class="alert alert-warning">Não foi possível calcular a classificação parcial.</div>
  <?php endif; ?>
</div>

</body>
</html>

