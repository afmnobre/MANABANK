<?php
class AuthMiddleware
{
    public static function verificarLogin()
    {
        // Detecta se estamos no ambiente Admin ou App pelo SCRIPT_NAME
        $isAdmin = (strpos($_SERVER['SCRIPT_NAME'], 'admin.php') !== false);

        if ($isAdmin) {
            // Se for Admin, verifica a sessão do Admin
            if (empty($_SESSION['ADMIN'])) {
                header("Location: /admin/auth/login");
                exit;
            }
        } else {
            // Se for App, verifica a sessão da Loja
            if (empty($_SESSION['LOJA'])) {
                header("Location: /login");
                exit;
            }
        }
    }
}
