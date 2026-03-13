<?php

class Landing
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function buscarPlanoPorSlug($slug)
    {
        $sql = "SELECT * FROM planos WHERE slug = :slug LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['slug' => $slug]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listarPlanos() {
        $sql = "SELECT * FROM planos ORDER BY valor ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        // Use exatamente assim. Sem [0] ou fetch()
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
