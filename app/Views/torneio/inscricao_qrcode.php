<?php $baseAssetUrl = 'http://tcgbalcao.local/public'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>QR Code - <?= htmlspecialchars($torneio['nome_torneio'] ?? 'Torneio') ?></title>
  <!-- Bootstrap via CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome via CDN -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="d-flex flex-column justify-content-center align-items-center vh-100 text-center">

  <!-- Logo da loja -->
  <?php if (!empty($loja['logo'])): ?>
    <img src="<?= $baseAssetUrl ?>/storage/uploads/lojas/<?= $loja['id_loja'] ?>/<?= htmlspecialchars($loja['logo']) ?>"
         alt="Logo da Loja" class="mb-4" style="max-height:80px;">
  <?php endif; ?>

  <!-- Tabela com dados do torneio -->
  <table class="table table-dark table-bordered w-auto mb-4">
    <tr>
      <th>🏆 Torneio</th>
      <td><?= htmlspecialchars($torneio['nome_torneio'] ?? 'N/A') ?></td>
    </tr>
    <tr>
      <th>📅 Data</th>
      <td><?= !empty($torneio['data_criacao']) ? date('d/m/Y H:i', strtotime($torneio['data_criacao'])) : 'N/A' ?></td>
    </tr>
    <tr>
      <th>🎴 Cardgame</th>
      <td><?= htmlspecialchars($torneio['cardgame'] ?? 'N/A') ?></td>
    </tr>
  </table>

  <!-- QR Code -->
  <?php $link = "http://tcgbalcao.local/inscricao/index/{$torneio['id_torneio']}"; ?>
  <div class="p-3 bg-light rounded text-center">
    <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=<?= urlencode($link) ?>"
         alt="QR Code" class="img-fluid">
    <p class="mt-3 text-dark"><strong>Ou acesse:</strong><br><?= $link ?></p>
  </div>

  <p class="mt-4">📱 Escaneie o QR Code ou digite o link acima para confirmar sua participação</p>
</div>

<!-- Bootstrap JS via CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- FontAwesome JS via CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
</body>
</html>


