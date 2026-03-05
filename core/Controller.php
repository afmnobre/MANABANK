    <?php

class Controller
{
    protected string $baseUrl;
    protected string $publicUrl;
    protected string $storageUrl;

    public function __construct()
    {
        $config = require __DIR__ . '/../config/config.php';

        // A baseUrl deve vir do config.php (Ex: '/' no local ou '/MANABANK/' no remoto)
        $this->baseUrl = $config['base_url'] ?? '/';
        $this->publicUrl = $this->baseUrl . 'public/';
        $this->storageUrl = $this->baseUrl . 'public/storage/';
    }

    /**
     * Verifica se a execução atual partiu do porteiro admin.php
     */
    protected function isInternalAdmin(): bool
    {
        return (strpos($_SERVER['SCRIPT_NAME'], 'admin.php') !== false);
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

        $folder = $this->isInternalAdmin() ? 'admin' : 'app';
        $basePath = realpath(__DIR__ . "/../{$folder}/Views");

        if ($basePath === false) {
            die("BasePath inválido para views em: {$folder}");
        }

        // Variável $base para uso em assets dentro da view (CSS/JS)
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

        if (!class_exists($model)) {
            die("Erro: A classe '{$model}' não existe dentro do arquivo.");
        }

        return new $model();
    }
}
