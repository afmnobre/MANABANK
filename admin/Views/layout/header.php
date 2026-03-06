<?php
$isMANABANK = (strpos($_SERVER['SCRIPT_NAME'], '/MANABANK/') !== false);
$baseUrl = $isMANABANK ? '/MANABANK/' : '/';
$publicUrl = $baseUrl . 'public/';


/**
 * Logica de roteamento global do Admin - Blindada
 */
if (!defined('BASE_URL')) {
    $scriptPath = $_SERVER['SCRIPT_NAME'];
    $isMANABANK = (strpos($scriptPath, '/MANABANK/') !== false);
    $isLocal = ($_SERVER['REMOTE_ADDR'] == '127.0.0.1' || $_SERVER['HTTP_HOST'] == 'manabank.local');

    // Define a base principal como constante global
    if ($isMANABANK) {
        define('BASE_URL', '/MANABANK/');
    } elseif ($isLocal) {
        define('BASE_URL', '/');
    } else {
        define('BASE_URL', '/');
    }
}

// Criamos as outras constantes baseadas na BASE_URL
if (!defined('PUBLIC_URL')) define('PUBLIC_URL', BASE_URL . 'public/');
if (!defined('UPLOADS_URL')) define('UPLOADS_URL', PUBLIC_URL . 'storage/uploads/');
if (!defined('CARDGAMES_URL')) define('CARDGAMES_URL', UPLOADS_URL . 'cardgames/');

// Mantém variáveis simples apenas para os links da Navbar abaixo não quebrarem
$baseUrl = BASE_URL;
$publicUrl = PUBLIC_URL;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Painel Admin' ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $publicUrl ?>css/admin.css">
</head>

<body class="bg-dark text-light d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark bg-black shadow-sm fixed-top">
    <div class="container-fluid">

        <a class="navbar-brand fw-bold" href="<?= $baseUrl ?>admin/home">
            TCG Balcão Admin
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarAdmin">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Lojas
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="<?= $baseUrl ?>admin/loja">Lista de Lojas</a></li>
                        <li><a class="dropdown-item" href="<?= $baseUrl ?>admin/loja/create">Nova Loja</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= $baseUrl ?>admin/usuarioLoja">Usuários das Lojas</a></li>
                        <li><a class="dropdown-item" href="<?= $baseUrl ?>admin/contrato">Contratos</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= $baseUrl ?>admin/cliente">
                        Clientes
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= $baseUrl ?>admin/cardgame">
                        Cardgames
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= $baseUrl ?>admin/tipopagamento">
                        Métodos Pagamento
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Auditoria
                    </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="<?= $baseUrl ?>admin/auditoria">Logs Gerais</a></li>
                        <li><a class="dropdown-item" href="<?= $baseUrl ?>admin/logPedidos">Logs Pedidos</a></li>
                    </ul>
                </li>

            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <?= $_SESSION['ADMIN']['nome'] ?? 'Admin' ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                        <li>
                            <a class="dropdown-item text-danger" href="<?= $baseUrl ?>admin/auth/logout">
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>

<main class="flex-fill container-fluid mt-5 pt-3">
