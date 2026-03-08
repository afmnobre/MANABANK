<?php
/**
 * Funções Auxiliares de Renderização - Definidas no topo para evitar erro de Call to Undefined Function
 */
if (!function_exists('renderListaRanking')) {
    function renderListaRanking($jogadores) {
        if (empty($jogadores)) return '';
        $html = '<div class="list-group list-group-flush">';
        foreach ($jogadores as $key => $j) {
            $pos = $key + 1;
            // Cores baseadas no pódio (Ouro, Prata, Bronze)
            $corPos = ($pos == 1) ? 'text-warning' : (($pos == 2) ? 'text-secondary-emphasis' : (($pos == 3) ? 'text-brown' : 'text-muted'));

            $nomeFull = $j['nome'] ?? $j['nome_jogador'] ?? 'Jogador';
            $primeiroNome = explode(' ', $nomeFull)[0];
            $pontos = $j['total_pontos'] ?? $j['pontos'] ?? 0;

            $html .= "
            <div class='list-group-item bg-transparent text-white border-0 px-0 py-2 d-flex justify-content-between align-items-center border-bottom border-secondary-subtle' style='font-size: 0.8rem; border-style: dotted !important;'>
                <span class='text-truncate'>
                    <small class='fw-bold {$corPos} me-2' style='min-width: 20px; d-inline-block;'>{$pos}º</small>
                    <span class='text-white-50'>" . htmlspecialchars($primeiroNome) . "</span>
                </span>
                <span class='badge bg-dark border border-secondary text-info' style='font-size: 0.65rem;'>{$pontos} pts</span>
            </div>";
        }
        $html .= '</div>';
        return $html;
    }
}
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-white fw-bold mb-0">
            <i class="bi bi-trophy-fill me-2 text-warning"></i> Torneios
        </h2>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-info btn-sm shadow-sm px-3" onclick="window.open('<?= $base ?>torneiosuico/verRegrasSuico', '_blank', 'width=800,height=600')">
                <i class="bi bi-info-circle"></i> Regras Suíço
            </button>
            <a href="<?= $base ?>torneio/criar" class="btn btn-primary btn-sm shadow-sm px-3">
                <i class="bi bi-plus-lg"></i> Novo Torneio
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-xl-8 col-lg-7">
            <?php if (!empty($torneios)): ?>
                <div class="card bg-dark border-secondary shadow-sm overflow-hidden">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-dark table-striped table-hover align-middle mb-0">
                                <thead>
                                    <tr class="border-secondary">
                                        <th class="ps-4 py-3 text-uppercase small tracking-wider text-white-50 border-0">Torneio</th>
                                        <th class="py-3 text-center text-uppercase small tracking-wider text-white-50 border-0">Cardgame</th>
                                        <th class="py-3 text-uppercase small tracking-wider text-white-50 border-0">Data</th>
                                        <th class="py-3 text-uppercase small tracking-wider text-white-50 border-0">Status</th>
                                        <th class="text-end pe-4 py-3 text-uppercase small tracking-wider text-white-50 border-0">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($torneios as $torneio): ?>
                                        <tr class="border-secondary">
                                            <td class="ps-4">
                                                <span class="fw-bold text-info"><?= htmlspecialchars($torneio['nome_torneio']) ?></span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge-cardgame">
                                                    <?= htmlspecialchars($torneio['cardgame'] ?? 'N/A') ?>
                                                </span>
                                            </td>
                                            <td class="small text-white-50">
                                                <i class="bi bi-calendar3 me-1"></i> <?= date('d/m/Y', strtotime($torneio['data_criacao'])) ?>
                                            </td>
                                            <td>
                                                <?php
                                                    $status = strtolower($torneio['status']);
                                                    $badgeStyle = ($status == 'finalizado') ? 'status-finished' : (($status == 'em andamento') ? 'status-ongoing' : 'status-open');
                                                ?>
                                                <span class="status-badge <?= $badgeStyle ?>">
                                                    <i class="bi bi-circle-fill me-1"></i>
                                                    <?= ucfirst($torneio['status']) ?>
                                                </span>
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="btn-group shadow-sm">
                                                    <a href="<?= $base ?>torneio/participantes/<?= $torneio['id_torneio'] ?>" class="btn btn-sm btn-outline-light" title="Participantes"><i class="bi bi-people"></i></a>
                                                    <a href="<?= $base ?>torneio/gerenciar/<?= $torneio['id_torneio'] ?>" class="btn btn-sm btn-outline-light" title="Gerenciar"><i class="bi bi-controller"></i></a>
                                                    <button class="btn btn-sm btn-outline-light" onclick="window.open('<?= $base ?>torneiosuico/verPontuacao/<?= $torneio['id_torneio'] ?>','_blank')" title="Classificação"><i class="bi bi-award"></i></button>
                                                    <a href="<?= $base ?>torneio/excluir/<?= $torneio['id_torneio'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Confirma exclusão permanente?')" title="Excluir"><i class="bi bi-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="card bg-dark border-secondary border-dashed py-5 text-center">
                    <div class="card-body">
                        <i class="bi bi-trophy text-secondary mb-3 opacity-25" style="font-size: 3.5rem;"></i>
                        <h5 class="text-white-50">Nenhum torneio ativo.</h5>
                        <p class="small text-muted mb-4">Inicie um novo evento para ver os dados aqui.</p>
                        <a href="<?= $base ?>torneio/criar" class="btn btn-primary btn-sm px-4">Criar Primeiro Torneio</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="card bg-dark border-secondary shadow-sm">
                <div class="card-header bg-transparent border-secondary py-3">
                    <h6 class="mb-0 fw-bold text-primary text-uppercase tracking-wider text-center">
                        <i class="bi bi-star-fill me-1"></i> Rankings Top 3
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-6 border-end border-secondary">
                            <div class="text-center mb-3">
                                <span class="badge bg-info-subtle text-info border border-info px-3 py-1 fw-bold w-100" style="font-size: 0.65rem;">MENSAL</span>
                            </div>
                            <?php if (empty($rankingMensal)): ?>
                                <div class="text-muted text-center small py-4">Sem dados.</div>
                            <?php else: ?>
                                <?php foreach ($rankingMensal as $jogo => $jogadores): ?>
                                    <div class="mb-3">
                                        <h6 class="text-warning text-uppercase fw-bold mb-2" style="font-size: 0.6rem; letter-spacing: 0.5px;">
                                            <?= htmlspecialchars($jogo) ?>
                                        </h6>
                                        <?= renderListaRanking($jogadores); ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                        <div class="col-6">
                            <div class="text-center mb-3">
                                <span class="badge bg-warning-subtle text-warning border border-warning px-3 py-1 fw-bold w-100" style="font-size: 0.65rem;">ANUAL</span>
                            </div>
                            <?php if (empty($rankingAnual)): ?>
                                <div class="text-muted text-center small py-4">Sem dados.</div>
                            <?php else: ?>
                                <?php foreach ($rankingAnual as $jogo => $jogadores): ?>
                                    <div class="mb-3">
                                        <h6 class="text-warning text-uppercase fw-bold mb-2" style="font-size: 0.6rem; letter-spacing: 0.5px;">
                                            <?= htmlspecialchars($jogo) ?>
                                        </h6>
                                        <?= renderListaRanking($jogadores); ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-secondary py-2">
                    <p class="text-muted text-center mb-0" style="font-size: 0.6rem;">
                        <i class="bi bi-info-circle me-1"></i>Atualizado via rodadas finalizadas.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.tracking-wider { letter-spacing: 1px; }
.text-brown { color: #cd7f32; } /* Cor Bronze */

/* Badges de Status Personalizadas */
.status-badge {
    font-size: 0.65rem;
    padding: 3px 10px;
    border-radius: 50px;
    font-weight: bold;
    text-transform: uppercase;
    display: inline-flex;
    align-items: center;
}
.status-badge i { font-size: 0.4rem; }

.status-finished { background: rgba(25, 135, 84, 0.1); color: #198754; border: 1px solid #198754; }
.status-ongoing { background: rgba(255, 193, 7, 0.1); color: #ffc107; border: 1px solid #ffc107; }
.status-open { background: rgba(13, 110, 253, 0.1); color: #0d6efd; border: 1px solid #0d6efd; }

/* Badge de Cardgame */
.badge-cardgame {
    background: #222;
    color: #aaa;
    border: 1px solid #444;
    font-size: 0.65rem;
    padding: 2px 8px;
    border-radius: 4px;
    text-transform: uppercase;
}

/* Estilo Botoes Ações */
.btn-group .btn-sm {
    border-color: #333;
    color: #888;
}
.btn-group .btn-sm:hover {
    background-color: #444;
    color: #fff;
    border-color: #555;
}
.btn-group .btn-outline-danger:hover { background-color: #dc3545; color: #fff; }

.border-dashed {
    border: 2px dashed #444 !important;
    background: transparent !important;
}
</style>
