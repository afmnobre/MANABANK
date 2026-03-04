<?php
// Correção para o servidor remoto: Sobe 3 níveis para encontrar a pasta /config na raiz
require_once dirname(__DIR__, 3) . '/config/config.php';

// Ajustamos o caminho dos assets baseado na raiz do sistema ($base)
$baseAssetUrl = $base . 'public';

// URL de inscrição que será convertida em QR Code
// Exemplo: magic.4sql.net/MANABANK/torneio/inscrever/356
// No arquivo app/Views/torneio/inscricao_qrcode.php
$urlInscricao = "http://" . $_SERVER['HTTP_HOST'] . $base . "inscricao/index/" . $torneio['id_torneio'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscrição - <?= htmlspecialchars($torneio['nome_torneio']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #121212; color: white; overflow: hidden; }
        .qr-container { background: white; padding: 20px; border-radius: 15px; display: inline-block; }
        .logo-loja { max-height: 80px; margin-bottom: 20px; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">

<div class="text-center">
    <?php if (!empty($loja['logo'])): ?>
        <img src="<?= $baseAssetUrl ?>/storage/uploads/lojas/<?= $loja['id_loja'] ?>/<?= htmlspecialchars($loja['logo']) ?>"
             class="logo-loja" alt="Logo">
    <?php endif; ?>

    <h2 class="fw-bold text-uppercase mb-1"><?= htmlspecialchars($torneio['nome_torneio']) ?></h2>
    <p class="text-secondary mb-4">Aponte a câmera para se inscrever</p>

    <div class="qr-container shadow-lg mb-4">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=<?= urlencode($urlInscricao) ?>&ecc=M&margin=1"
             alt="QR Code de Inscrição"
            style="width: 300px; height: 300px;">
    </div>

    <div class="mt-2">
        <p class="mb-1 small text-secondary text-uppercase" style="letter-spacing: 2px;">Link Direto:</p>
        <code class="text-info"><?= $urlInscricao ?></code>
    </div>

    <div class="mt-5 d-print-none">
        <button onclick="window.print()" class="btn btn-outline-light me-2">
            <i class="fas fa-print"></i> Imprimir
        </button>
        <button onclick="window.close()" class="btn btn-danger">
            <i class="fas fa-times"></i> Fechar
        </button>
    </div>
</div>

</body>
</html>
