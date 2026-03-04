<?php
require_once __DIR__ . '/Autoload.php';

class Router
{
    public function run()
    {
        // 1. Carrega configurações do seu arquivo config.php
        $config = require __DIR__ . '/../config/config.php';
        $baseUrl = $config['base_url'] ?? '/';

        $urlParam = $_GET['url'] ?? '';
        $urlPath = trim($urlParam, '/');
        $urlSegments = $urlPath ? explode('/', $urlPath) : [];

        // 2. Limpa prefixos da pasta do projeto (ex: MANABANK)
        $baseSegments = array_filter(explode('/', trim($baseUrl, '/')));
        foreach ($baseSegments as $segment) {
            if (!empty($urlSegments) && strtolower($urlSegments[0]) === strtolower($segment)) {
                array_shift($urlSegments);
            }
        }

        // 3. Detecta se é ADMIN
        $isAdmin = false;
        if (!empty($urlSegments[0]) && strtolower($urlSegments[0]) === 'admin') {
            $isAdmin = true;
            array_shift($urlSegments); // remove 'admin'
        }

        // 4. LÓGICA DE DIRECIONAMENTO SOLICITADA
        // Se a URL estiver vazia (depois de limpar admin ou MANABANK)
        if (empty($urlSegments[0])) {
            // Se estiver em /admin/ -> vai para AuthController
            // Se estiver em /MANABANK/ (APP) -> vai para AuthController (página de login)
            // Nota: se quiser que o APP abra a 'home' quando logado, mude aqui,
            // mas pelo seu requisito, ambos caem no Auth.
            $controllerBase = 'auth';
        } else {
            $controllerBase = strtolower($urlSegments[0]);
        }

        // 5. TRADUÇÃO DE URL AMIGÁVEL
        // Se o usuário digitar explicitamente /login, mandamos para o Auth
        if ($controllerBase === 'login') {
            $controllerBase = 'auth';
        }

        $controllerName = ucfirst($controllerBase) . 'Controller';
        $method = $urlSegments[1] ?? 'index';

        // 6. CAMINHO DO ARQUIVO
        $folder = $isAdmin ? 'admin' : 'app';
        $controllerPath = __DIR__ . "/../{$folder}/Controllers/{$controllerName}.php";

        if (!file_exists($controllerPath)) {
            header("HTTP/1.0 404 Not Found");
            die("Erro 404: O Controller '{$controllerName}' nao existe na pasta '{$folder}'.");
        }

        require_once $controllerPath;
        $controller = new $controllerName;

        // 7. EXECUÇÃO
        if (!method_exists($controller, $method)) {
            die("Erro 404: O metodo '{$method}' nao existe no controller '{$controllerName}'.");
        }

        $params = array_slice($urlSegments, 2);
        call_user_func_array([$controller, $method], $params);
    }
}
