<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-white fw-bold">
            <i class="bi bi-gear-wide-connected me-2 text-primary"></i>
            Gerenciar Suíço: <span class="text-info"><?= htmlspecialchars($torneio['nome_torneio']) ?></span>
        </h2>
        <a href="<?= $base ?>torneio" class="btn btn-outline-secondary btn-sm shadow-sm">
            <i class="bi bi-arrow-left"></i> Voltar para Lista
        </a>
    </div>

    <div class="card bg-dark border-secondary shadow-sm">
        <div class="card-body p-4">

            <div class="d-flex gap-4 mb-4 pb-3 border-bottom border-secondary">
                <span class="small text-uppercase fw-bold tracking-wider text-white-50">Participantes: <span class="text-white"><?= count($participantes) ?></span></span>
                <span class="small text-uppercase fw-bold tracking-wider text-white-50">Rodada: <span class="text-info"><?= $rodada['numero_rodada'] ?>/<?= $totalRodadas ?></span></span>
                <span class="small text-uppercase fw-bold tracking-wider text-white-50">Status:
                    <span class="<?= $torneio['status'] === 'finalizado' ? 'text-success' : 'text-primary' ?>">
                        <?= $torneio['status'] === 'finalizado' ? 'FINALIZADO' : 'EM ANDAMENTO' ?>
                    </span>
                </span>
            </div>

            <div class="row g-4">
                <div class="col-md-5 border-end border-secondary">
                    <h5 class="text-primary small text-uppercase fw-bold mb-4 tracking-wider">
                        <i class="bi bi-trophy me-1"></i> Ranking Atual
                    </h5>

                    <div class="table-responsive">
                        <table class="table table-dark table-hover mb-0">
                            <thead>
                                <tr class="text-white-50 small border-secondary">
                                    <th class="ps-0 border-secondary">Pos</th>
                                    <th class="border-secondary">Jogador</th>
                                    <th class="text-end border-secondary">Pts</th>
                                    <th class="text-end border-secondary">BH</th>
                                </tr>
                            </thead>
                            <tbody class="border-top-0">
                                <?php foreach ($participantes as $index => $p): ?>
                                <tr class="border-secondary align-middle">
                                    <td class="ps-0 py-2 fw-bold <?= $index < 3 ? 'text-warning' : 'text-white-50' ?>"><?= $index + 1 ?>º</td>
                                    <td class="text-white"><?= htmlspecialchars($p['nome']) ?></td>
                                    <td class="text-end fw-bold text-success"><?= $p['pontos'] ?></td>
                                    <td class="text-end small text-white-50"><?= $p['buchholz'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="text-primary small text-uppercase fw-bold mb-0 tracking-wider">
                            <i class="bi bi-controller me-1"></i> Partidas - Rodada <?= $rodada['numero_rodada'] ?>
                        </h5>
                        <div class="d-flex gap-2">
                            <button class="btn btn-dark btn-sm border-secondary text-info fw-bold" style="font-size: 0.7rem;" onclick="window.open('<?= $base ?>torneiosuico/verPareamento/<?= $torneio['id_torneio'] ?>/<?= $rodada['numero_rodada'] ?>','_blank')">
                                <i class="bi bi-broadcast"></i> TRANSMITIR
                            </button>
                            <?php if ($rodada['numero_rodada'] > 1 || $todasConcluidas): ?>
                                <button class="btn btn-dark btn-sm border-secondary text-success fw-bold" style="font-size: 0.7rem;" onclick="window.open('<?= $base ?>torneiosuico/verPontuacao/<?= $torneio['id_torneio'] ?>','_blank')">
                                    <i class="bi bi-graph-up"></i> RANKING
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="partidas-container pe-2" style="max-height: 600px; overflow-y: auto;">
                        <?php foreach ($partidas as $partida): ?>
                            <div class="mb-3 p-3 rounded bg-dark border border-secondary shadow-sm">
                                <div class="row align-items-center g-0">
                                    <div class="col-5 text-end pe-3">
                                        <span class="fw-bold text-white small"><?= htmlspecialchars($partida['nome_j1']) ?></span>
                                    </div>
                                    <div class="col-2 text-center">
                                        <span class="badge bg-secondary opacity-25" style="font-size: 0.6rem;">VS</span>
                                    </div>
                                    <div class="col-5 ps-3">
                                        <span class="fw-bold text-white small"><?= $partida['id_jogador2'] ? htmlspecialchars($partida['nome_j2']) : '<span class="text-muted italic">BYE</span>' ?></span>
                                    </div>
                                </div>

                                <div class="mt-3 text-center border-top border-secondary border-opacity-25 pt-2">
                                    <?php if (!$partida['resultado']): ?>
                                        <form action="<?= $base ?>torneiosuico/salvarResultado" method="POST" class="btn-group btn-group-sm">
                                            <input type="hidden" name="id_partida" value="<?= $partida['id_partida'] ?>">
                                            <input type="hidden" name="id_torneio" value="<?= $torneio['id_torneio'] ?>">

                                            <?php if ($torneio['tipo_torneio'] == 'suico_bo3'): ?>
                                                <button name="resultado" value="jogador1_2x0" class="btn btn-outline-success border-secondary px-2">2-0</button>
                                                <button name="resultado" value="jogador1_2x1" class="btn btn-outline-success border-secondary px-2">2-1</button>
                                                <button name="resultado" value="empate" class="btn btn-outline-warning border-secondary px-2">E</button>
                                                <button name="resultado" value="jogador2_2x1" class="btn btn-outline-primary border-secondary px-2">1-2</button>
                                                <button name="resultado" value="jogador2_2x0" class="btn btn-outline-primary border-secondary px-2">0-2</button>
                                            <?php else: ?>
                                                <button name="resultado" value="jogador1_vitoria" class="btn btn-outline-success border-secondary px-3">Vence J1</button>
                                                <button name="resultado" value="empate" class="btn btn-outline-warning border-secondary px-3">Empate</button>
                                                <button name="resultado" value="jogador2_vitoria" class="btn btn-outline-primary border-secondary px-3">Vence J2</button>
                                            <?php endif; ?>
                                        </form>
                                    <?php else: ?>
                                        <div class="d-flex align-items-center justify-content-center gap-2">
                                            <span class="badge bg-dark border border-secondary text-white-50 px-3 py-2">
                                                <i class="bi bi-check2-circle text-success me-1"></i> Resultado Definido
                                            </span>
                                            <?php if ($torneio['status'] !== 'finalizado'): ?>
                                                <a href="<?= $base ?>torneiosuico/limparResultado/<?= $partida['id_partida'] ?>/<?= $torneio['id_torneio'] ?>"
                                                   class="text-white-50 hover-undo" onclick="return confirm('Zerar resultado?')">
                                                    <i class="bi bi-arrow-counterclockwise"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="border-top border-secondary mt-5 pt-4 text-center">
                <?php if ($podeGerarProxima): ?>
                    <a href="<?= $base ?>torneiosuico/proximaRodada/<?= $torneio['id_torneio'] ?>" class="btn btn-success px-5 fw-bold shadow-sm py-2">
                        <i class="bi bi-arrow-right-circle me-1"></i> FINALIZAR RODADA E GERAR PRÓXIMA
                    </a>

                <?php elseif ($todasConcluidas && $torneio['status'] === 'finalizado'): ?>
                    <div class="alert alert-success border border-success bg-dark bg-opacity-50 text-white py-3 shadow-sm mx-auto mb-0" style="max-width: 500px; border-radius: 4px;">
                        <h4 class="fw-bold mb-1 text-success"><i class="bi bi-stars me-2 text-warning"></i>Torneio Finalizado</h4>
                        <p class="mb-0 small text-white-50 text-uppercase tracking-wider">Campeão: <span class="text-white fw-bold"><?= $participantes[0]['nome'] ?></span></p>
                    </div>

                <?php elseif ($todasConcluidas && $rodada['numero_rodada'] == $totalRodadas): ?>
                    <a href="<?= $base ?>torneiosuico/proximaRodada/<?= $torneio['id_torneio'] ?>" class="btn btn-danger px-5 fw-bold shadow-sm py-2">
                        <i class="bi bi-flag-fill me-1"></i> ENCERRAR TORNEIO E DEFINIR CAMPEÃO
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
.tracking-wider { letter-spacing: 1.5px; }
.card { border-radius: 4px; }
.table-dark { --bs-table-bg: transparent; }
.btn-outline-secondary:hover { background-color: #474d52; color: #fff; }
.hover-undo:hover { color: #dc3545 !important; }
.italic { font-style: italic; }

.partidas-container::-webkit-scrollbar { width: 4px; }
.partidas-container::-webkit-scrollbar-track { background: transparent; }
.partidas-container::-webkit-scrollbar-thumb { background: #474d52; border-radius: 10px; }

@media (max-width: 768px) {
    .border-end { border-end: none !important; border-bottom: 1px solid #474d52 !important; margin-bottom: 2rem; padding-bottom: 2rem; }
}
</style>
