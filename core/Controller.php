<?php

class Controller
{
    protected string $baseUrl;
    protected string $publicUrl;
    protected string $storageUrl;

    public function __construct()
    {
        $config = require __DIR__ . '/../config/config.php';
        $this->baseUrl = $config['base_url'] ?? '/';

        // Define as URLs globais
        $this->baseUrl = $config['base_url'] ?? '/';
        $this->publicUrl = $this->baseUrl . 'public/';
        $this->storageUrl = $this->baseUrl . 'public/storage/';
    }

    private function isInternalAdmin(): bool
    {
        // Detecta se a URL atual contém /admin/
        return (strpos($_SERVER['REQUEST_URI'], $this->baseUrl . 'admin') !== false);
    }

    protected function view($view, $data = [])
    {
        extract($data);
        $folder = $this->isInternalAdmin() ? 'admin' : 'app';
        $basePath = realpath(__DIR__ . "/../{$folder}/Views");

        $header = $basePath . DIRECTORY_SEPARATOR . 'layout' . DIRECTORY_SEPARATOR . 'header.php';
        $footer = $basePath . DIRECTORY_SEPARATOR . 'layout' . DIRECTORY_SEPARATOR . 'footer.php';
        $file   = $basePath . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $view) . '.php';

        if (!file_exists($file)) die("View nao encontrada: " . $file);

        require_once $header;
        require_once $file;
        require_once $footer;
    }

	protected function rawView($view, $data = [])
	{
		extract($data);

		// Identifica se é Admin ou App
		$basePath = (strpos($_SERVER['SCRIPT_NAME'], 'admin.php') !== false)
			? realpath(__DIR__ . '/../admin/Views')
			: realpath(__DIR__ . '/../app/Views');

		if ($basePath === false) {
			die("BasePath inválido para views");
		}

		// Define a baseUrl para que os assets (CSS/JS) funcionem na tela de login
		$base = $this->baseUrl;

		$file = $basePath . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $view) . '.php';

		if (!file_exists($file)) {
			die("View não encontrada: " . $file);
		}

		require_once $file;
	}

	protected function model($model)
	{
		$folder = $this->isInternalAdmin() ? 'admin' : 'app';
		$basePath = realpath(__DIR__ . "/../{$folder}/Models");
		$file = $basePath . DIRECTORY_SEPARATOR . $model . '.php';

		if (!file_exists($file)) {
			die("Erro: O arquivo do Model não foi encontrado em: " . $file);
		}

		require_once $file;

		// Verifica se a classe existe após o require
		if (!class_exists($model)) {
			die("Erro: O arquivo '{$model}.php' foi carregado, mas a classe '{$model}' não existe dentro dele. Verifique o nome da classe.");
		}

		return new $model();
	}
}
