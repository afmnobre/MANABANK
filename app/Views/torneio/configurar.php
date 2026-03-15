<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-white fw-bold">
            <i class="bi <?= isset($torneio) ? 'bi-pencil-square' : 'bi-plus-circle-fill' ?> me-2 text-warning"></i>
            <?= isset($torneio) ? 'Editar Torneio' : 'Novo Torneio' ?>
        </h2>
        <a href="<?= $base ?>torneio" class="btn btn-outline-secondary btn-sm shadow-sm">
            <i class="bi bi-arrow-left"></i> Voltar para Lista
        </a>
    </div>

    <div class="card bg-dark border-secondary shadow-sm">
        <div class="card-body p-4">
            <form method="POST"
                  action="<?= isset($torneio) ? $base . 'torneio/atualizar/'.$torneio['id_torneio'] : $base . 'torneio/salvarConfiguracao' ?>">

                <div class="row g-4">
                    <div class="col-md-6 border-end border-secondary">
                        <h5 class="text-primary small text-uppercase fw-bold mb-4 tracking-wider">
                            <i class="bi bi-info-circle me-1"></i> Identificação
                        </h5>

                        <div class="mb-3">
                            <label for="nome_torneio" class="form-label text-white-50 small">Nome do Torneio</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-secondary text-white"><i class="bi bi-tag"></i></span>
                                <input type="text" id="nome_torneio" name="nome_torneio"
                                       class="form-control bg-dark text-white border-secondary"
                                       value="<?= $torneio['nome_torneio'] ?? '' ?>"
                                       placeholder="Ex: Prerelease Kamigawa" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="id_cardgame" class="form-label text-white-50 small">CardGame (Sistema)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-secondary text-white"><i class="bi bi-controller"></i></span>
                                <select class="form-select bg-dark text-white border-secondary" id="id_cardgame" name="id_cardgame" required>
                                    <option value="" class="text-muted">Selecione o jogo...</option>
                                    <?php foreach ($cardgames as $cg): ?>
                                        <option value="<?= $cg['id_cardgame'] ?>"
                                            <?= (isset($torneio['id_cardgame']) && $torneio['id_cardgame'] == $cg['id_cardgame']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($cg['nome']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-text text-white-50 small">Define o cardgame que sera feito o torneio.</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5 class="text-primary small text-uppercase fw-bold mb-4 tracking-wider">
                            <i class="bi bi-gear me-1"></i> Regras de Jogo
                        </h5>

                        <div class="mb-3">
                            <label for="tipo_torneio" class="form-label text-white-50 small">Formato / Sistema</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-secondary text-white"><i class="bi bi-diagram-3"></i></span>
                                <select class="form-select bg-dark text-white border-secondary" id="tipo_torneio" name="tipo_torneio" required>
                                    <?php
                                    $tipos = [
                                        'suico_bo1' => 'Suíço - Melhor de 1 (BO1)',
                                        'suico_bo3' => 'Suíço - Melhor de 3 (BO3)',
                                        'elim_dupla_bo1' => 'Eliminação Dupla - Melhor de 1',
                                        'elim_dupla_bo3' => 'Eliminação Dupla - Melhor de 3'
                                    ];
                                    foreach ($tipos as $val => $label): ?>
                                        <option value="<?= $val ?>" <?= (isset($torneio['tipo_torneio']) && $torneio['tipo_torneio'] == $val) ? 'selected' : '' ?>>
                                            <?= $label ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="tempo_rodada" class="form-label text-white-50 small">Tempo por Rodada (Minutos)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-secondary text-white"><i class="bi bi-alarm"></i></span>
                                <input type="number" id="tempo_rodada" name="tempo_rodada"
                                       class="form-control bg-dark text-white border-secondary"
                                       value="<?= $torneio['tempo_rodada'] ?? '50' ?>" min="10" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-top border-secondary mt-5 pt-4 text-end">
                    <a href="<?= $base ?>torneio" class="btn btn-outline-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-success px-4 fw-bold shadow-sm">
                        <i class="bi bi-save me-1"></i> SALVAR TORNEIO
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Padronização MANABANK (Conforme Layout Cliente) */
.tracking-wider { letter-spacing: 1.5px; }

.form-control::placeholder { color: rgba(255, 255, 255, 0.3) !important; }

.form-control:focus, .form-select:focus {
    background-color: #1a1a1a !important;
    border-color: #ffc107 !important; /* Amarelo para destacar ações de Torneio */
    color: #fff !important;
    box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
}

.form-select option {
    background-color: #212529 !important;
    color: #fff !important;
}

/* Ajuste fino para a borda vertical em mobile */
@media (max-width: 768px) {
    .border-end { border-end: none !important; border-bottom: 1px solid #474d52 !important; padding-bottom: 20px; }
}
</style>
