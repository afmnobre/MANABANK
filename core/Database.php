<?php

class Database
{
    private static ?PDO $instance = null;

    private function __construct() {}

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {

            $config = require __DIR__ . '/../config/config.php';

            // Adicionamos a porta dinamicamente no DSN
            $host = $config['db_host'];
            $port = $config['db_port'] ?? '3306'; // Usa 3306 se não houver porta no config
            $dbname = $config['db_name'];

            $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";

            try {
                self::$instance = new PDO(
                    $dsn,
                    $config['db_user'],
                    $config['db_pass'],
                    [
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES   => false,
                    ]
                );
            } catch (PDOException $e) {
                // Em produção, seria ideal logar o erro em vez de dar die() com detalhes
                die("Erro ao conectar no banco: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}

