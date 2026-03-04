<?php

// Nota: O Controller base já cuidou do autoload ou das inclusões necessárias
// mas se precisar de models específicos que não estão no autoload:
require_once __DIR__ . '/../Models/Admin.php';

class AuthController extends Controller
{
    public function index()
    {
        $this->login();
    }

    public function login()
    {
        // Se já está logado no ADMIN, redireciona para a home do ADMIN
        if (!empty($_SESSION['ADMIN_LOGADO'])) {
            header("Location: " . $this->baseUrl . "admin/home");
            exit;
        }

        // Usa o método view da classe pai (Controller)
        // Isso vai buscar em: admin/Views/auth/login.php
        $this->view('auth/login');
    }

    public function autenticar()
    {
        $email = $_POST['login'] ?? '';
        $senha = $_POST['senha'] ?? '';

        // IMPORTANTE: Para o Admin, você deve buscar no Model de Admin ou Usuário do Admin
        // Vou assumir que você tem um Model Admin ou usa o Loja para isso
        $loja = Loja::buscarPorLogin($email);

        if ($loja && password_verify($senha, $loja['senha'])) {
            // Chaves de sessão exclusivas para o ADMIN para não conflitar com a LOJA
            $_SESSION['ADMIN_LOGADO'] = true;
            $_SESSION['ADMIN_ID']     = $loja['id_usuario'];
            $_SESSION['ADMIN_NOME']   = $loja['nome'] ?? 'Administrador';

            // Se precisar dos dados da loja no admin também:
            $_SESSION['LOJA'] = [
                'id_loja'    => $loja['id_loja'],
                'nome_loja'  => $loja['nome_loja'],
            ];

            // REDIRECIONAMENTO COM BASE_URL
            header("Location: " . $this->baseUrl . "admin/home");
            exit;
        }

        $_SESSION['erro_login'] = "Login administrativo inválido";
        header("Location: " . $this->baseUrl . "admin/auth/login");
        exit;
    }

    public function logout()
    {
        // Não precisa de session_start() aqui se o seu index.php já iniciou
        unset($_SESSION['ADMIN_LOGADO']);
        unset($_SESSION['ADMIN_ID']);
        unset($_SESSION['ADMIN_NOME']);

        header("Location: " . $this->baseUrl . "admin/");
        exit;
    }
}
