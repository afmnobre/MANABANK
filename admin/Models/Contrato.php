<?php

class Contrato
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

	// Listar todos os contratos (opcional filtro por loja) com nome e logo da loja
	public function listar($id_loja = null)
	{
		if ($id_loja) {
			$stmt = $this->db->prepare("
				SELECT c.*, l.nome_loja, l.logo
				FROM contratos c
				LEFT JOIN lojas l ON c.id_loja = l.id_loja
				WHERE c.id_loja = :id_loja
				ORDER BY c.data_inicio DESC
			");
			$stmt->execute(['id_loja' => $id_loja]);
		} else {
			$stmt = $this->db->query("
				SELECT c.*, l.nome_loja, l.logo
				FROM contratos c
				LEFT JOIN lojas l ON c.id_loja = l.id_loja
				ORDER BY c.data_inicio DESC
			");
		}

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

    // Buscar contrato por id
    public function buscarPorId($id_contrato)
    {
        $stmt = $this->db->prepare("SELECT * FROM contratos WHERE id_contrato = :id_contrato");
        $stmt->execute(['id_contrato' => $id_contrato]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Criar contrato
	public function criar($dados)
    {
        // 1. Gerar o número único: IDLOJA + ANO + MES + TIPO
        $ano = date('Y');
        $mes = date('m');
        $siglaTipo = strtoupper(substr($dados['tipo'], 0, 3));
        $numeroGerado = $dados['id_loja'] . $ano . $mes . $siglaTipo;

        // 2. Se for ativo, suspende outros e atualiza a tabela LOJAS
        if ($dados['status'] === 'ativo') {
            $stmt = $this->db->prepare("UPDATE contratos SET status = 'suspenso' WHERE id_loja = :id_loja AND status = 'ativo'");
            $stmt->execute(['id_loja' => $dados['id_loja']]);

            $stmtL = $this->db->prepare("UPDATE lojas SET numero_contrato = :numero WHERE id_loja = :id_loja");
            $stmtL->execute(['numero' => $numeroGerado, 'id_loja' => $dados['id_loja']]);
        }

        // 3. Insere na tabela CONTRATOS com o novo campo
        $sql = "INSERT INTO contratos (id_loja, tipo, data_inicio, data_fim, status, numero_contrato)
                VALUES (:id_loja, :tipo, :data_inicio, :data_fim, :status, :numero_contrato)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id_loja'         => $dados['id_loja'],
            'tipo'            => $dados['tipo'],
            'data_inicio'     => $dados['data_inicio'],
            'data_fim'        => $dados['data_fim'],
            'status'          => $dados['status'],
            'numero_contrato' => $numeroGerado // Gravando na tabela contratos
        ]);

        $id_contrato = $this->db->lastInsertId();

        $this->atualizarUsuariosPorStatus($dados['id_loja'], $dados['status']);

        // Retornamos um array para o Controller ter acesso ao ID e ao Número Gerado
        return [
            'id'     => $id_contrato,
            'numero' => $numeroGerado
        ];
    }

    // Atualizar contrato
    public function atualizar($dados)
    {
        // Se alterar para ativo, suspende outros contratos
        if ($dados['status'] === 'ativo') {
            $stmt = $this->db->prepare("UPDATE contratos SET status = 'suspenso' WHERE id_loja = :id_loja AND id_contrato != :id_contrato AND status = 'ativo'");
            $stmt->execute([
                'id_loja'     => $dados['id_loja'],
                'id_contrato' => $dados['id_contrato']
            ]);

            // Recupera o numero_contrato deste contrato para atualizar na tabela LOJAS
            $c = $this->buscarPorId($dados['id_contrato']);
            $stmtL = $this->db->prepare("UPDATE lojas SET numero_contrato = :numero WHERE id_loja = :id_loja");
            $stmtL->execute(['numero' => $c['numero_contrato'], 'id_loja' => $dados['id_loja']]);
        }

        $sql = "UPDATE contratos SET
                    tipo = :tipo,
                    data_inicio = :data_inicio,
                    data_fim = :data_fim,
                    status = :status
                WHERE id_contrato = :id_contrato";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'tipo'        => $dados['tipo'],
            'data_inicio' => $dados['data_inicio'],
            'data_fim'    => $dados['data_fim'],
            'status'      => $dados['status'],
            'id_contrato' => $dados['id_contrato']
        ]);

        $this->atualizarUsuariosPorStatus($dados['id_loja'], $dados['status']);
    }

    // Deletar contrato
    public function deletar($id_contrato)
    {
        $contrato = $this->buscarPorId($id_contrato);
        if ($contrato) {
            $stmt = $this->db->prepare("DELETE FROM contratos WHERE id_contrato = :id_contrato");
            $stmt->execute(['id_contrato' => $id_contrato]);

            // Atualiza usuários da loja se contrato ativo
            if ($contrato['status'] === 'ativo') {
                $this->atualizarUsuariosPorStatus($contrato['id_loja'], 'suspenso');
            }
        }
    }

    // Atualiza status dos usuários de uma loja
    private function atualizarUsuariosPorStatus($id_loja, $statusContrato)
    {
        $ativo = $statusContrato === 'ativo' ? 1 : 0;
        $stmt = $this->db->prepare("UPDATE usuarios_loja SET ativo = :ativo WHERE id_loja = :id_loja");
        $stmt->execute([
            'ativo'   => $ativo,
            'id_loja' => $id_loja
        ]);
    }

	public function listarAtivos()
	{
		$stmt = $this->db->query("SELECT * FROM contratos WHERE status = 'ativo' ORDER BY data_inicio DESC");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

    // Em admin/Models/Contrato.php
    public function totalAtivos()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM contratos WHERE status = 'ativo'");
        $stmt->execute();
        return $stmt->fetchColumn();
    }


}

