<?php

class AuthController extends Controller
{
    // Este é o método que geralmente a rota "/" ou "/auth" chama
    public function index() {
        if (!empty($_SESSION['USUARIO'])) {
            header("Location: " . $this->baseUrl . "home");
            exit;
        }
        $this->rawView('auth/login', ['titulo' => 'Login']);
    }

    public function login()
    {
        if (!empty($_SESSION['USUARIO'])) {
            header("Location: " . $this->baseUrl . "home");
            exit;
        }

        $this->rawView('auth/login', ['titulo' => 'Login']);
    }

	public function autenticar()
	{
		$login = $_POST['login'] ?? '';
		$senha = $_POST['senha'] ?? '';

		// 1. Como temos Autoload, não precisamos de require.
		// E como o método buscarPorLogin é STATIC no seu Model Loja,
		// chamamos direto sem instanciar se preferir, ou usamos a classe Loja.
		$usuario = Loja::buscarPorLogin($login);

		if ($usuario && password_verify($senha, $usuario['senha'])) {

			// 2. Popula a sessão com os dados que o INNER JOIN do Model Loja já traz
			$_SESSION['LOJA'] = [
				'id_loja'   => $usuario['id_loja'],
				'nome_loja' => $usuario['nome_loja'] ?? 'Loja',
				'logo'      => $usuario['logo'] ?? 'logo.png',
				'favicon'   => $usuario['favicon'] ?? 'favicon.ico',
				'cor_tema'  => $usuario['cor_tema'] ?? '#000',
			];

			$_SESSION['USUARIO'] = [
				'id_usuario' => $usuario['id_usuario'],
				'nome'       => $usuario['nome'],
				'email'      => $usuario['email'],
				'perfil'     => $usuario['perfil'] ?? 'atendente'
			];

			// 3. Redirecionamento correto usando a baseUrl
			header("Location: " . $this->baseUrl . "home");
			exit;
		}

		// Caso falhe:
		$_SESSION['erro_login'] = "Credenciais inválidas.";

		// Importante: Redirecionar para a rota de login correta usando baseUrl
		header("Location: " . $this->baseUrl . "auth/index");
		exit;
	}

    // Dentro do AuthController.php
    public function logout() {
        session_destroy();
        header("Location: " . $this->baseUrl . "auth/index");
        exit;
    }
}
