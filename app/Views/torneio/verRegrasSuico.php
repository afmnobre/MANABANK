<?php
// Correção do caminho: Sobe 3 níveis para chegar na raiz e encontrar a pasta /config
require_once dirname(__DIR__, 3) . '/config/config.php';

// Ajuste dinâmico do caminho dos assets baseado na raiz do sistema ($base)
$baseAssetUrl = $base . 'public';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Regras de Pontuação - Sistema Suíço</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <style>
    .card { border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 4px 6px rgba(0,0,0,0.3); }
    .card-header { background-color: rgba(0,0,0,0.2) !important; letter-spacing: 1px; }
    /* Estilo para impressão (fundo branco para economizar tinta) */
    @media print {
      .btn, .d-print-none { display: none !important; }
      body { background-color: white !important; color: black !important; }
      .card { border: 1px solid #ccc !important; background-color: white !important; color: black !important; }
      .table-dark { --bs-table-bg: white; color: black; border-color: #ccc; }
      .text-light { color: black !important; }
      .badge { border: 1px solid #000; color: #000 !important; background: none !important; }
    }
  </style>
</head>
<body class="bg-dark text-light">

<div class="container py-4 text-center">

  <?php if (!empty($loja['logo'])): ?>
    <img src="<?= $baseAssetUrl ?>/storage/uploads/lojas/<?= $loja['id_loja'] ?>/<?= htmlspecialchars($loja['logo']) ?>"
         alt="Logo da Loja" class="mb-4" style="max-height:80px;">
  <?php endif; ?>

  <h2 class="mb-4 fw-bold text-uppercase">Regras de Pontuação</h2>

  <div class="d-flex justify-content-center align-items-center mb-4">
    <img src="https://upload.wikimedia.org/wikipedia/commons/f/f3/Flag_of_Switzerland.svg"
         class="me-3 shadow-sm" style="height:30px; border-radius: 3px;" alt="Bandeira Suíça">
    <span class="fw-bold h4 mb-0" style="letter-spacing: 2px;">SISTEMA SUÍÇO</span>
    <img src="https://upload.wikimedia.org/wikipedia/commons/f/f3/Flag_of_Switzerland.svg"
         class="ms-3 shadow-sm" style="height:30px; border-radius: 3px;" alt="Bandeira Suíça">
  </div>

  <div class="card bg-secondary text-light mb-4 mx-auto" style="max-width:600px;">
    <div class="card-header fw-bold py-3"><i class="fas fa-layer-group me-2"></i>Melhor de 3 (MD3)</div>
    <div class="card-body text-start">
      <table class="table table-dark table-bordered mb-3">
        <tr><td>Vitória / BYE</td><td class="text-center"><span class="badge bg-success">3 Pontos</span></td></tr>
        <tr><td>Empate</td><td class="text-center"><span class="badge bg-warning text-dark">1 Ponto</span></td></tr>
        <tr><td>Derrota</td><td class="text-center"><span class="badge bg-danger">0 Pontos</span></td></tr>
      </table>
      <div class="px-2">
          <strong>Critérios de Desempate:</strong>
          <ul class="mt-2 mb-0">
            <li><strong>1º Buchholz (Força):</strong> Soma da pontuação de todos os adversários enfrentados.</li>
            <li><strong>2º Performance (2x0):</strong> Vitórias por 2x0 têm prioridade sobre 2x1.</li>
          </ul>
      </div>
    </div>
  </div>

  <div class="card bg-secondary text-light mb-4 mx-auto" style="max-width:600px;">
    <div class="card-header fw-bold py-3"><i class="fas fa-bolt me-2"></i>Melhor de 1 (MD1)</div>
    <div class="card-body text-start">
      <table class="table table-dark table-bordered mb-3">
        <tr><td>Vitória / BYE</td><td class="text-center"><span class="badge bg-success">3 Pontos</span></td></tr>
        <tr><td>Empate</td><td class="text-center"><span class="badge bg-warning text-dark">1 Ponto</span></td></tr>
        <tr><td>Derrota</td><td class="text-center"><span class="badge bg-danger">0 Pontos</span></td></tr>
      </table>
      <div class="px-2">
          <strong>Critérios de Desempate:</strong>
          <ul class="mt-2 mb-0">
            <li><strong>1º Buchholz (Força):</strong> Soma da pontuação de todos os adversários enfrentados.</li>
          </ul>
      </div>
    </div>
  </div>

  <div class="mt-4 d-print-none">
    <button class="btn btn-light btn-lg me-2 px-4 shadow" onclick="window.print()">
      <i class="fa-solid fa-print me-2"></i> Imprimir
    </button>
    <button class="btn btn-outline-danger btn-lg px-4" onclick="window.close()">
      <i class="fa-solid fa-xmark me-2"></i> Fechar
    </button>
  </div>
</div>

</body>
</html>
