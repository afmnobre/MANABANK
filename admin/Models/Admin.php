<?php

class Admin
{
    private $db;

    public function __construct()
    {
        // O Autoload carregará a classe Database automaticamente da pasta core/
        $this->db = Database::getInstance();
    }

    /**
     * Busca o administrador global na tabela admin_lojas
     */
    public function buscarPorEmail($email)
    {
        $sql = "SELECT * FROM admin_lojas WHERE email = :email LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        // Retorna como array associativo para facilitar o uso no Controller
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
