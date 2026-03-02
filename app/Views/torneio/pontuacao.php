<?php
$baseAssetUrl = 'http://tcgbalcao.local/public';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Pontuação - Rodada <?= $numero_rodada ?></title>
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
  <h3 class="mb-4">Pontuação - Rodada <?= $numero_rodada ?></h3>

  <!-- Tabela de pontuação -->
  <?php if (!empty($classificacao)): ?>
    <table class="table table-dark table-bordered w-auto mx-auto align-middle text-center">
      <thead>
        <tr>
          <th>Posição</th>
          <th>Jogador</th>
          <?php if (str_starts_with($_GET['tipo_torneio'], 'suico')): ?>
            <th>Pontos</th>
            <th>Força dos Oponentes</th>
          <?php else: ?>
            <th>Vitórias</th>
            <th>Derrotas</th>
          <?php endif; ?>
        </tr>
      </thead>
      <tbody>
        <?php $posicao = 1; ?>
        <?php foreach ($classificacao as $linha): ?>
          <tr>
            <td><?= $posicao++ ?></td>
            <td>
              <?= htmlspecialchars($linha['nome']) ?>
              <?php if (!empty($linha['bye']) && $linha['bye'] === true): ?>
                <span class="text-secondary">(BY)</span>
              <?php endif; ?>
            </td>
            <?php if (str_starts_with($_GET['tipo_torneio'], 'suico')): ?>
              <td><?= $linha['pontos'] ?></td>
              <td><?= $linha['forca_oponentes'] ?></td>
            <?php else: ?>
              <td><?= $linha['vitorias'] ?></td>
              <td><?= $linha['derrotas'] ?></td>
            <?php endif; ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <div class="alert alert-warning">Não foi possível calcular a pontuação desta rodada.</div>
  <?php endif; ?>
</div>

</body>
</html>

