<?php
$baseAssetUrl = 'http://tcgbalcao.local/public';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Regras de Pontuação - Sistema Suíço</title>
  <!-- Bootstrap via CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome via CDN -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container py-4 text-center">

  <!-- Logo da loja -->
  <?php if (!empty($loja['logo'])): ?>
    <img src="<?= $baseAssetUrl ?>/storage/uploads/lojas/<?= $loja['id_loja'] ?>/<?= htmlspecialchars($loja['logo']) ?>"
         alt="Logo da Loja" class="mb-4" style="max-height:80px;">
  <?php endif; ?>
  <h2 class="mb-4">Regras de Pontuação - Sistema Suíço</h2>

  <!-- Título com bandeiras -->
  <div class="d-flex justify-content-center align-items-center mb-4">
    <img src="https://upload.wikimedia.org/wikipedia/commons/f/f3/Flag_of_Switzerland.svg"
         class="me-3" style="height:30px;" alt="Bandeira Suíça">
    <span class="fw-bold">TORNEIO SUÍÇO</span>
    <img src="https://upload.wikimedia.org/wikipedia/commons/f/f3/Flag_of_Switzerland.svg"
         class="ms-3" style="height:30px;" alt="Bandeira Suíça">
  </div>

  <!-- Regras MD3 -->
  <div class="card bg-secondary text-light mb-4 mx-auto" style="max-width:600px;">
    <div class="card-header fw-bold">Regras Melhor de 3 (MD3)</div>
    <div class="card-body text-start">
      <table class="table table-dark table-bordered mb-3">
        <tr><td>Vitória / BYE</td><td><strong>3 Pontos</strong></td></tr>
        <tr><td>Empate</td><td><strong>1 Ponto</strong></td></tr>
        <tr><td>Derrota</td><td><strong>0 Pontos</strong></td></tr>
      </table>
      <strong>Critérios de Desempate:</strong>
      <ul class="mt-2">
        <li><strong>1º Força do oponente (Buchholz):</strong> Soma da pontuação de todos os adversários enfrentados.</li>
        <li><strong>2º Performance de Sets:</strong> Jogadores que venceram por 2x0 têm vantagem sobre vitórias por 2x1.</li>
      </ul>
    </div>
  </div>

  <!-- Regras MD1 -->
  <div class="card bg-secondary text-light mb-4 mx-auto" style="max-width:600px;">
    <div class="card-header fw-bold">Regras Melhor de 1 (MD1)</div>
    <div class="card-body text-start">
      <table class="table table-dark table-bordered mb-3">
        <tr><td>Vitória / BYE</td><td><strong>3 Pontos</strong></td></tr>
        <tr><td>Empate</td><td><strong>1 Ponto</strong></td></tr>
        <tr><td>Derrota</td><td><strong>0 Pontos</strong></td></tr>
      </table>
      <strong>Critérios de Desempate:</strong>
      <ul class="mt-2">
        <li><strong>1º Força do oponente (Buchholz):</strong> Soma da pontuação de todos os adversários enfrentados.</li>
      </ul>
    </div>
  </div>

  <!-- Botões -->
  <div class="mt-4">
    <button class="btn btn-light me-2" onclick="window.print()">
      <i class="fa-solid fa-print"></i> Imprimir Regras
    </button>
    <button class="btn btn-danger" onclick="window.close()">
      <i class="fa-solid fa-xmark"></i> Fechar Janela
    </button>
  </div>
</div>

</body>
</html>

