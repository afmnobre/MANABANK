<?php

class TorneioeliminacaoController extends Controller {
    private $db;

    public function __construct() {
        parent::__construct(); // Garante a inicialização das URLs na classe pai
        $this->db = Database::getInstance();
    }

    public function gerenciar($id_torneio) {
        AuthMiddleware::verificarLogin();
        $model = new TorneioEliminacao();
        $torneio = $model->buscarTorneio($id_torneio);

        if (!$torneio) {
            header("Location: " . $this->baseUrl . "torneio?erro=nao_encontrado");
            exit;
        }

        $stmtCheck = $this->db->prepare("SELECT COUNT(*) FROM torneio_rodadas WHERE id_torneio = ?");
        $stmtCheck->execute([$id_torneio]);
        if ($stmtCheck->fetchColumn() == 0) {
            $model->iniciarTorneio($id_torneio);
        }

        $rodadaAtiva = $model->buscarRodadaAtual($id_torneio);

        $sql = "SELECT p.*, r.numero_rodada, r.tipo_chave, r.status, c1.nome as nome_j1, c2.nome as nome_j2
                FROM torneio_rodadas r
                LEFT JOIN torneio_partidas p ON r.id_rodada = p.id_rodada
                LEFT JOIN clientes c1 ON p.id_jogador1 = c1.id_cliente
                LEFT JOIN clientes c2 ON p.id_jogador2 = c2.id_cliente
                WHERE r.id_torneio = ?
                ORDER BY r.numero_rodada ASC, r.tipo_chave DESC, p.id_partida ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_torneio]);
        $partidas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $model->registrarLogEstado($id_torneio, "VIEW_LOAD");

        $this->view('torneio/gerenciarTorneioEliminacao', [
            'torneio' => $torneio,
            'rodadaAtual' => $rodadaAtiva ?: ['numero_rodada' => 1, 'tipo_chave' => 'WB'],
            'partidas' => $partidas,
            'id_torneio' => $id_torneio
        ]);
    }

    public function salvarResultado() {
        $model = new TorneioEliminacao();
        $id_partida = $_POST['id_partida'];
        $id_torneio = $_POST['id_torneio'];
        $resultado = $_POST['resultado'];

        $model->processarResultado($id_partida, $resultado);
        $model->registrarLogEstado($id_torneio, "RESULTADO_SALVO_PARTIDA_{$id_partida}");

        // REFATORADO: Redirecionamento dinâmico
        header("Location: " . $this->baseUrl . "TorneioEliminacao/gerenciar/" . $id_torneio);
        exit;
    }

    public function avancarRodada() {
        $model = new TorneioEliminacao();
        $id_torneio = $_POST['id_torneio'];
        $rodada_atual_num = (int)$_POST['rodada_atual'];
        $tipo_chave_post = $_POST['tipo_chave'];

        $stmtStatus = $this->db->prepare("SELECT status FROM torneio_rodadas WHERE id_torneio = ? AND numero_rodada = ? AND tipo_chave = ?");
        $stmtStatus->execute([$id_torneio, $rodada_atual_num, $tipo_chave_post]);
        $statusAtual = $stmtStatus->fetchColumn();

        if ($statusAtual === 'F') {
            header("Location: " . $this->baseUrl . "TorneioEliminacao/gerenciar/" . $id_torneio);
            exit;
        }

        $model->registrarLogEstado($id_torneio, "EXEC_AVANCAR_{$tipo_chave_post}_R{$rodada_atual_num}");

        if ($tipo_chave_post == 'GF') {
            $this->db->prepare("UPDATE torneio_rodadas SET status = 'F' WHERE id_torneio = ? AND tipo_chave = 'GF'")->execute([$id_torneio]);
            $this->db->prepare("UPDATE torneios SET status = 'finalizado' WHERE id_torneio = ?")->execute([$id_torneio]);
            $model->registrarLogEstado($id_torneio, "TORNEIO_FINALIZADO");
            header("Location: " . $this->baseUrl . "TorneioEliminacao/gerenciar/" . $id_torneio);
            exit;
        }

        $this->db->prepare("UPDATE torneio_rodadas SET status = 'F' WHERE id_torneio = ? AND numero_rodada = ? AND tipo_chave = ?")
                 ->execute([$id_torneio, $rodada_atual_num, $tipo_chave_post]);

        $stmt = $this->db->prepare("
            SELECT p.* FROM torneio_partidas p
            JOIN torneio_rodadas r ON p.id_rodada = r.id_rodada
            WHERE r.id_torneio = ? AND r.numero_rodada = ? AND r.tipo_chave = ?
            ORDER BY p.id_partida ASC
        ");
        $stmt->execute([$id_torneio, $rodada_atual_num, $tipo_chave_post]);
        $partidas_atuais = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($partidas_atuais as $index => $partida) {
            $vencedor = $partida['vencedor_id'];
            if (!$vencedor && $partida['id_jogador1']) {
                $vencedor = $partida['id_jogador1'];
            }

            $perdedor = null;
            if ($partida['id_jogador1'] && $partida['id_jogador2']) {
                $perdedor = ($vencedor == $partida['id_jogador1']) ? $partida['id_jogador2'] : $partida['id_jogador1'];
            }

            if ($tipo_chave_post == 'WB') {
                if ($vencedor) $this->avancarVencedorWinners($id_torneio, $rodada_atual_num, $index, $vencedor);
                if ($perdedor && $perdedor > 0) $this->cairParaLosers($id_torneio, $rodada_atual_num, $index, $perdedor);
            } else if ($tipo_chave_post == 'LB') {
                if ($vencedor) $this->avancarVencedorLosers($id_torneio, $rodada_atual_num, $index, $vencedor, count($partidas_atuais));
            }
        }

        $this->desbloquearProximaLogica($id_torneio, $rodada_atual_num, $tipo_chave_post);
        $model->registrarLogEstado($id_torneio, "AVANCO_CONCLUIDO");

        header("Location: " . $this->baseUrl . "TorneioEliminacao/gerenciar/" . $id_torneio);
        exit;
    }

    private function desbloquearProximaLogica($id_torneio, $rodada_atual, $tipo_chave) {
        if ($tipo_chave == 'WB') {
            $proxima_wb = $rodada_atual + 1;
            $this->ativarRodadaSimples($id_torneio, $proxima_wb, 'WB');
            if ($rodada_atual == 1) $this->ativarRodadaSimples($id_torneio, 1, 'LB');
        } else if ($tipo_chave == 'LB') {
            $proxima_lb = $rodada_atual + 1;
            $stmt = $this->db->prepare("SELECT id_rodada FROM torneio_rodadas WHERE id_torneio = ? AND numero_rodada = ? AND tipo_chave = 'LB'");
            $stmt->execute([$id_torneio, $proxima_lb]);
            if ($stmt->fetch()) {
                $this->ativarRodadaSimples($id_torneio, $proxima_lb, 'LB');
            } else {
                $this->db->prepare("UPDATE torneio_rodadas SET status = 'A' WHERE id_torneio = ? AND tipo_chave = 'GF'")->execute([$id_torneio]);
            }
        }
    }

    private function ativarRodadaSimples($id_torneio, $numero, $tipo) {
        $sql = "UPDATE torneio_rodadas SET status = 'A' WHERE id_torneio = ? AND numero_rodada = ? AND tipo_chave = ?";
        $this->db->prepare($sql)->execute([$id_torneio, $numero, $tipo]);
    }

    private function avancarVencedorWinners($id_torneio, $rodada, $index, $vencedor_id) {
        if (!$vencedor_id) return;
        $stmt = $this->db->prepare("
            SELECT p.id_partida FROM torneio_partidas p
            JOIN torneio_rodadas r ON p.id_rodada = r.id_rodada
            WHERE r.id_torneio = ? AND r.tipo_chave = 'WB' AND r.numero_rodada = ?
            ORDER BY p.id_partida ASC
        ");
        $stmt->execute([$id_torneio, $rodada + 1]);
        $proximas = $stmt->fetchAll(PDO::FETCH_COLUMN);

        if (isset($proximas[floor($index / 2)])) {
            $this->alocarNoSlotCerto($vencedor_id, $proximas[floor($index / 2)], $index);
        } else {
            $this->enviarParaGrandeFinal($id_torneio, $vencedor_id, 'id_jogador1');
        }
    }

    private function avancarVencedorLosers($id_torneio, $rodada, $index, $vencedor_id, $qtd_partidas_atuais) {
        if (!$vencedor_id) return;
        $stmt = $this->db->prepare("
            SELECT p.id_partida FROM torneio_partidas p
            JOIN torneio_rodadas r ON p.id_rodada = r.id_rodada
            WHERE r.id_torneio = ? AND r.tipo_chave = 'LB' AND r.numero_rodada = ?
            ORDER BY p.id_partida ASC
        ");
        $stmt->execute([$id_torneio, $rodada + 1]);
        $proximas = $stmt->fetchAll(PDO::FETCH_COLUMN);

        if ($proximas) {
            $target_index = (count($proximas) == $qtd_partidas_atuais) ? $index : floor($index / 2);
            $this->alocarNoSlotCerto($vencedor_id, $proximas[$target_index], $index);
        } else {
            $this->enviarParaGrandeFinal($id_torneio, $vencedor_id, 'id_jogador2');
        }
    }

    private function cairParaLosers($id_torneio, $rodada_origem, $index_origem, $id_perdedor) {
        if (!$id_perdedor || $id_perdedor <= 0) return;
        $rodada_destino_num = 0;
        $index_destino = 0;
        $coluna_player = '';

        if ($rodada_origem == 1) {
            $rodada_destino_num = 1;
            $index_destino = floor($index_origem / 2);
            $coluna_player = ($index_origem % 2 == 0) ? 'id_jogador1' : 'id_jogador2';
            if ($index_origem > 1) return;
        } else if ($rodada_origem == 2) {
            $rodada_destino_num = 2;
            $index_destino = $index_origem;
            $coluna_player = 'id_jogador2';
        }

        if ($rodada_destino_num > 0) {
            $stmtBusca = $this->db->prepare("
                SELECT tp.id_partida FROM torneio_partidas tp
                JOIN torneio_rodadas tr ON tp.id_rodada = tr.id_rodada
                WHERE tr.id_torneio = ? AND tr.tipo_chave = 'LB' AND tr.numero_rodada = ?
                ORDER BY tp.id_partida ASC LIMIT ?, 1
            ");
            $stmtBusca->execute([$id_torneio, $rodada_destino_num, (int)$index_destino]);
            $id_partida_destino = $stmtBusca->fetchColumn();

            if ($id_partida_destino) {
                $check = $this->db->prepare("SELECT id_partida FROM torneio_partidas WHERE id_partida = ? AND (id_jogador1 = ? OR id_jogador2 = ?)");
                $check->execute([$id_partida_destino, $id_perdedor, $id_perdedor]);

                if ($check->rowCount() == 0) {
                    $this->db->prepare("UPDATE torneio_partidas SET $coluna_player = ? WHERE id_partida = ?")->execute([$id_perdedor, $id_partida_destino]);
                }
            }
        }
    }

    private function alocarNoSlotCerto($jogador_id, $id_partida_destino, $index_origem) {
        $coluna = ($index_origem % 2 == 0) ? 'id_jogador1' : 'id_jogador2';
        $this->db->prepare("UPDATE torneio_partidas SET $coluna = ? WHERE id_partida = ?")->execute([$jogador_id, $id_partida_destino]);
    }

    private function enviarParaGrandeFinal($id_torneio, $jogador_id, $coluna) {
        $stmt = $this->db->prepare("
            SELECT p.id_partida FROM torneio_partidas p
            JOIN torneio_rodadas r ON p.id_rodada = r.id_rodada
            WHERE r.id_torneio = ? AND r.tipo_chave = 'GF'
        ");
        $stmt->execute([$id_torneio]);
        $id_gf = $stmt->fetchColumn();
        if ($id_gf) {
            $this->db->prepare("UPDATE torneio_partidas SET $coluna = ? WHERE id_partida = ?")->execute([$jogador_id, $id_gf]);
        }
    }
}
