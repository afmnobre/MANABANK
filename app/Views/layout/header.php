<!DOCTYPE html>
<?php
// 1. Puxa as informações da sessão
$loja = $_SESSION['LOJA'] ?? [];
$idLoja      = $loja['id_loja'] ?? 0;
$nomeLoja    = $loja['nome_loja'] ?? 'Sistema TCGBalcão';
$logoFile    = $loja['logo'] ?? 'logo.png';
$faviconFile = $loja['favicon'] ?? 'favicon.ico';
$corTema     = $loja['cor_tema'] ?? '#000';

// 2. RECUPERANDO A BASEURL
$base = rtrim($this->baseUrl, '/') . '/';

// 3. Montagem dos caminhos
$logoPath    = $base . "public/storage/uploads/lojas/{$idLoja}/{$logoFile}";
$faviconPath = $base . "public/storage/uploads/lojas/{$idLoja}/{$faviconFile}";

// 4. Dados do Usuário
$usuarioLogado = $_SESSION['USUARIO'] ?? [];
$nomeUsuario   = $usuarioLogado['nome'] ?? 'Usuário';
$perfilUsuario = $usuarioLogado['perfil'] ?? 'Membro';
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($nomeLoja) ?></title>

    <script>
        window.AppConfig = {
            baseUrl: '<?= $base ?>'
        };
        window.BASE_URL = "<?= $base ?>";
    </script>

    <link rel="icon" href="<?= htmlspecialchars($faviconPath) ?>" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css">

    <script src="https://cdn.jsdelivr.net/npm/picmo@5.8.5/dist/umd/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@picmo/renderer-fontawesome@5.8.5/dist/umd/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

    <link rel="stylesheet" href="<?= $base ?>public/css/style.css">
    <link rel="stylesheet" href="<?= $base ?>public/css/pedido.css">
    <link rel="stylesheet" href="<?= $base ?>public/css/produto.css">
    <link rel="stylesheet" href="<?= $base ?>public/css/torneioEliminacao.css">

</head>
<body class="bg-dark text-light">

<nav class="navbar navbar-expand-lg fixed-top shadow" style="background-color: <?= htmlspecialchars($corTema) ?>;">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="<?= $base ?>home">
            <img src="<?= htmlspecialchars($logoPath) ?>" alt="Logo" height="40" class="me-2">
            <span class="fw-bold"><?= htmlspecialchars($nomeLoja) ?></span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="<?= $base ?>home">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $base ?>pedido">Pedidos</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $base ?>cliente">Clientes</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $base ?>torneio">Torneios</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $base ?>produto">Produtos & Estoque</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $base ?>relatorio">Relatórios</a></li>

                <li class="nav-item px-2 d-none d-lg-block">
                    <div class="vr h-100 bg-white" style="width: 1px; opacity: 0.5;"></div>
                </li>

                <li class="nav-item d-flex flex-column align-items-end me-3">
                    <span class="fw-bold small" style="line-height: 1;">
                        <?= htmlspecialchars($nomeUsuario) ?>
                    </span>
                    <span class="badge badge-perfil mt-1">
                        <?= htmlspecialchars($perfilUsuario) ?>
                    </span>
                </li>

                <li class="nav-item">
                    <a class="btn btn-outline-light btn-sm" href="<?= $base ?>auth/logout">Sair</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="main-content container-fluid">
