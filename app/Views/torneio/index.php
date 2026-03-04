<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-light">Torneios</h2>
        <div>
            <button class="btn btn-outline-info btn-sm me-2" onclick="window.open('<?= $base ?>torneiosuico/verRegrasSuico', '_blank', 'width=800,height=600')">
                <i class="bi bi-info-circle"></i> Regras Suíço
            </button>
            <a href="<?= $base ?>torneio/criar" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> Novo Torneio
            </a>
        </div>
    </div>

    <?php if (!empty($torneios)): ?>
        <div class="card bg-secondary border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-dark table-striped table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-3">Nome</th>
                                <th>Cardgame</th>
                                <th>Tipo</th>
                                <th>Data Criação</th>
                                <th>Status</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($torneios as $torneio): ?>
                                <tr>
                                    <td class="ps-3 fw-bold text-info"><?= htmlspecialchars($torneio['nome_torneio']) ?></td>
                                    <td><span class="badge bg-dark border border-secondary"><?= htmlspecialchars($torneio['cardgame'] ?? 'N/A') ?></span></td>
                                    <td><?= htmlspecialchars($torneio['tipo_legivel'] ?? $torneio['tipo_torneio'] ?? 'Não definido') ?></td>
                                    <td class="small"><?= date('d/m/Y H:i', strtotime($torneio['data_criacao'])) ?></td>
                                    <td>
                                        <?php
                                            $status = strtolower($torneio['status']);
                                            $badgeClass = ($status == 'finalizado') ? 'bg-success' : (($status == 'em andamento') ? 'bg-warning text-dark' : 'bg-primary');
                                        ?>
                                        <span class="badge <?= $badgeClass ?>"><?= ucfirst($torneio['status']) ?></span>
                                    </td>
                                    <td class="text-center px-3">
                                        <div class="btn-group">
                                            <a href="<?= $base ?>torneio/participantes/<?= $torneio['id_torneio'] ?>" class="btn btn-sm btn-success" title="Participantes">
                                                <i class="bi bi-people"></i>
                                            </a>
                                            <a href="<?= $base ?>torneio/gerenciar/<?= $torneio['id_torneio'] ?>" class="btn btn-sm btn-info text-white" title="Gerenciar Rodadas">
                                                <i class="bi bi-controller"></i>
                                            </a>
                                            <button class="btn btn-sm btn-primary" onclick="window.open('<?= $base ?>torneiosuico/verPontuacao/<?= $torneio['id_torneio'] ?>','_blank')" title="Ver Classificação">
                                                <i class="bi bi-award"></i>
                                            </button>
                                            <a href="<?= $base ?>torneio/excluir/<?= $torneio['id_torneio'] ?>"
                                               class="btn btn-sm btn-danger"
                                               onclick="return confirm('ATENÇÃO: Isso apagará permanentemente o torneio e todos os dados vinculados. Confirma?')"
                                               title="Excluir">
                                                <i class="bi bi-trash"></i>
                                            </a>
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
        <div class="alert alert-dark border-secondary text-center py-5">
            <i class="bi bi-emoji-frown fs-1 d-block mb-3"></i>
            <h5>Nenhum torneio encontrado.</h5>
            <p class="text-muted small">Crie seu primeiro torneio clicando no botão acima.</p>
        </div>
    <?php endif; ?>
</div>
