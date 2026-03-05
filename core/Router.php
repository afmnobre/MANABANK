<?php
require_once __DIR__ . '/Autoload.php';

class Router
{
    public function run()
    {
        // 1. Pega a URL vinda do .htaccess
        $urlParam = $_GET['url'] ?? '';
        $urlPath = trim($urlParam, '/');
        $urlSegments = $urlPath ? explode('/', $urlPath) : [];

        // 2. Define a pasta (App ou Admin) baseado no arquivo de entrada
        $scriptName = $_SERVER['SCRIPT_NAME'];
        $isAdmin = (strpos($scriptName, 'admin.php') !== false);
        $folder = $isAdmin ? 'admin' : 'app';

        // 3. Define Controller e Método
        // Se a URL estiver vazia, carrega o AuthController como padrão
        if (empty($urlSegments[0])) {
            $controllerBase = 'auth';
            $method = 'index';
        } else {
            $controllerBase = strtolower($urlSegments[0]);
            $method = $urlSegments[1] ?? 'index';
        }

        // Tradução amigável: se digitar /login, vai para o Auth
        if ($controllerBase === 'login') {
            $controllerBase = 'auth';
        }

        $controllerName = ucfirst($controllerBase) . 'Controller';

        // 4. Caminho do arquivo do Controller
        $controllerPath = __DIR__ . "/../{$folder}/Controllers/{$controllerName}.php";

        if (!file_exists($controllerPath)) {
            header("HTTP/1.0 404 Not Found");
            die("Erro 404: O Controller '{$controllerName}' não existe na pasta '{$folder}/Controllers'.");
        }

        // 5. Instanciação e Execução
        require_once $controllerPath;

        if (!class_exists($controllerName)) {
            die("Erro 404: A classe '{$controllerName}' não foi encontrada no arquivo.");
        }

        $controller = new $controllerName;

        if (!method_exists($controller, $method)) {
            die("Erro 404: O método '{$method}' não existe no controller '{$controllerName}' da pasta '{$folder}'.");
        }

        // Passa os segmentos restantes como parâmetros para o método
        $params = array_slice($urlSegments, 2);
        call_user_func_array([$controller, $method], $params);
    }
}
