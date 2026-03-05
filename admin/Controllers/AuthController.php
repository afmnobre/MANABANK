<?php

class AuthController extends Controller
{
    /**
     * Ponto de entrada padrão: http://manabank.local/admin/
     */
    public function index()
    {
        // Se já está logado, vai direto para a Home
        if (!empty($_SESSION['ADMIN'])) {
            header("Location: " . $this->baseUrl . "admin/home");
            exit;
        }

        // Login SEMPRE usa rawView para não carregar menu/footer
        return $this->rawView('auth/login');
    }

    /**
     * Caso o sistema redirecione explicitamente para /admin/auth/login
     */
    public function login()
    {
        // Apenas chama o index para garantir que use o rawView
        return $this->index();
    }

	public function autenticar()
	{
		$email = $_POST['login'] ?? '';
		$senha = $_POST['senha'] ?? '';

		// Como o seu Model não é estático (usa $this->db), precisamos instanciá-lo
		$adminModel = new Admin();
		$admin = $adminModel->buscarPorEmail($email);

		// No fetch() sem parâmetros, o PHP costuma trazer índices numéricos e strings.
		// É seguro usar password_verify aqui.
		if ($admin && password_verify($senha, $admin['senha'])) {

			// Gravando a sessão
			$_SESSION['ADMIN'] = [
				'id'     => $admin['id'] ?? $admin[0],
				'nome'   => $admin['nome'] ?? 'Admin Master',
				'perfil' => 'master'
			];

			header("Location: " . $this->baseUrl . "admin/home");
			exit;
		}

		$_SESSION['erro_login'] = "Credenciais administrativas inválidas.";
		header("Location: " . $this->baseUrl . "admin");
		exit;
	}

    public function logout()
    {
        unset($_SESSION['ADMIN']);
        header("Location: " . $this->baseUrl . "admin");
        exit;
    }
}
