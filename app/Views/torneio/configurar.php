<h2 class="text-light mb-3">
    <?= isset($torneio) ? '✏️ Editar Torneio' : '🏆 Novo Torneio' ?>
</h2>

<form action="<?= isset($torneio) ? $base . 'torneio/atualizar/'.$torneio['id_torneio'] : $base . 'torneio/salvarConfiguracao' ?>"
      method="POST"
      class="bg-dark text-light p-4 rounded border border-secondary">

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="nome_torneio" class="form-label">Nome do Torneio</label>
                <input type="text" id="nome_torneio" name="nome_torneio" class="form-control"
                       value="<?= $torneio['nome_torneio'] ?? '' ?>" required>
            </div>

            <div class="mb-3">
                <label for="id_cardgame" class="form-label">Cardgame</label>
                <select class="form-select" id="id_cardgame" name="id_cardgame" required>
                    <option value="">Selecione...</option>
                    <?php foreach ($cardgames as $cg): ?>
                        <option value="<?= $cg['id_cardgame'] ?>"
                            <?= (isset($torneio['id_cardgame']) && $torneio['id_cardgame'] == $cg['id_cardgame']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cg['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="tipo_torneio" class="form-label">Tipo de Torneio</label>
                <select class="form-select" id="tipo_torneio" name="tipo_torneio" required>
                    <?php
                    $tipos = [
                        'suico_bo1' => 'Suíço - Melhor de 1',
                        'suico_bo3' => 'Suíço - Melhor de 3',
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

            <div class="mb-3">
                <label for="tempo_rodada" class="form-label">Tempo de Rodada (minutos)</label>
                <input type="number" id="tempo_rodada" name="tempo_rodada" class="form-control"
                       value="<?= $torneio['tempo_rodada'] ?? '50' ?>" min="10" required>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">💾 Salvar</button>
        <a href="<?= $base ?>torneio" class="btn btn-secondary">↩️ Voltar</a>
    </div>
</form>
