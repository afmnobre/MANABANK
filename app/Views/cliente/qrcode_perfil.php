<?php
// Define o caminho dos assets baseado na variável $base que vem do seu Controller/Config
$baseAssetUrl = $base . 'public';
// URL para o cliente acessar
$urlPerfil = "http://" . $_SERVER['HTTP_HOST'] . $base . "cliente/perfil/" . ($loja['id_loja'] ?? '');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code - Perfil do Jogador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #121212; color: white; overflow: hidden; font-family: sans-serif; }
        .qr-container { background: white; padding: 25px; border-radius: 20px; display: inline-block; }
        .logo-loja { max-height: 100px; margin-bottom: 20px; }
        @media print {
            .d-print-none { display: none !important; }
            body { background-color: white !important; color: black !important; }
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">

<div class="text-center">
    <?php if (!empty($loja['logo'])): ?>
        <img src="<?= $baseAssetUrl ?>/storage/uploads/lojas/<?= htmlspecialchars($loja['id_loja']) ?>/<?= htmlspecialchars($loja['logo']) ?>"
             class="logo-loja" alt="Logo">
    <?php endif; ?>

    <h1 class="fw-bold text-uppercase mb-1" style="color: <?= $loja['cor_tema'] ?? '#00d4ff' ?>;">
        CENTRAL DO JOGADOR
    </h1>
    <h4 class="text-secondary mb-4"><?= htmlspecialchars($loja['nome_loja']) ?></h4>

    <div class="qr-container shadow-lg mb-4">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=<?= urlencode($urlPerfil) ?>&ecc=H&margin=1"
             alt="QR Code Perfil" style="width: 300px; height: 300px;">
    </div>

    <div class="mt-2">
        <code class="text-info" style="font-size: 1.1rem;"><?= $urlPerfil ?></code>
    </div>

    <div class="mt-5 d-print-none">
        <button onclick="window.print()" class="btn btn-lg btn-outline-light me-2 px-4">
            <i class="fas fa-print me-2"></i> Imprimir
        </button>
        <button onclick="window.close()" class="btn btn-lg btn-danger px-4">
            <i class="fas fa-times me-2"></i> Fechar
        </button>
    </div>
</div>

</body>
</html>
