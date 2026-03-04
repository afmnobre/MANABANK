<?php
// Resolve a base de forma resiliente para o servidor remoto
$base = rtrim($this->baseUrl, '/') . '/';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MANABANK</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #0d0d0d; /* Fundo idêntico ao header.php */
            color: #f8f9fa;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        .login-card {
            background-color: #1a1a1a;
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px;
        }

        .login-card h2 {
            font-weight: 800;
            letter-spacing: 2px;
            color: #fff;
            margin-bottom: 0.2rem;
            text-transform: uppercase;
        }

        .form-control {
            background-color: #000 !important;
            border: 1px solid #333;
            color: #fff !important;
            padding: 12px;
        }

        .form-control:focus {
            border-color: #6f42c1;
            box-shadow: 0 0 0 0.25rem rgba(111, 66, 193, 0.25);
        }

        .btn-login {
            background-color: #6f42c1;
            border: none;
            padding: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background-color: #59359a;
            transform: translateY(-2px);
        }

        .brand-logo {
            font-size: 3.5rem;
            color: #6f42c1;
            margin-bottom: 0.5rem;
            filter: drop-shadow(0 0 10px rgba(111, 66, 193, 0.3));
        }

        .developer-credit {
            font-size: 0.7rem;
            color: #666;
            margin-top: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>

<div class="login-card text-center">
    <div class="brand-logo">
        <i class="fas fa-bolt-lightning"></i>
    </div>
    <h2>MANABANK</h2>
    <p class="text-secondary mb-4 small">Gestão Avançada de TCG</p>

    <?php if (!empty($_SESSION['erro_login'])): ?>
        <div class="alert alert-danger d-flex align-items-center small py-2" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <div>
                <?= $_SESSION['erro_login']; unset($_SESSION['erro_login']); ?>
            </div>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= $base ?>auth/autenticar">
        <div class="mb-3 text-start">
            <label for="login" class="form-label small fw-bold text-secondary">USUÁRIO</label>
            <div class="input-group shadow-sm">
                <span class="input-group-text bg-black border-secondary text-secondary">
                    <i class="fas fa-user-shield"></i>
                </span>
                <input type="text" id="login" name="login" class="form-control" placeholder="Login da loja" required autofocus>
            </div>
        </div>

        <div class="mb-4 text-start">
            <label for="senha" class="form-label small fw-bold text-secondary">SENHA</label>
            <div class="input-group shadow-sm">
                <span class="input-group-text bg-black border-secondary text-secondary">
                    <i class="fas fa-key"></i>
                </span>
                <input type="password" id="senha" name="senha" class="form-control" placeholder="Sua senha" required>
            </div>
        </div>

        <button type="submit" class="btn btn-login btn-primary w-100 mb-3 shadow">
            ACESSAR PAINEL <i class="fas fa-chevron-right ms-2"></i>
        </button>
    </form>

    <div class="developer-credit border-top border-secondary pt-3">
        SISTEMA DESENVOLVIDO POR<br>
        <strong>LUCAS NOBRE FERREIRA MARTINS</strong>
    </div>
</div>

</body>
</html>
