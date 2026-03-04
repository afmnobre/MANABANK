<?php
/**
 * View Parcial: _blocoPartidas.php
 * Exibe a tabela de confrontos para uma rodada específica de Eliminação (Simples ou Dupla)
 */

// Busca os pareamentos baseado no tipo de chave (WB = Upper Bracket / LB = Lower Bracket)
// Nota: Certifique-se de que $torneioModel e $torneio estão disponíveis no escopo global da view pai.
if ($rodada['tipo_chave'] === 'WB') {
    $pareamentos = $torneioModel->listarPareamentoTorneioEliminacaoDuplaWB($torneio['id_torneio'], $rodada['numero_rodada']);
} else {
    $pareamentos = $torneioModel->listarPareamentoTorneioEliminacaoDuplaLB($torneio['id_torneio'], $rodada['numero_rodada']);
}
?>

<?php if (!empty($pareamentos)): ?>
<div class="table-responsive">
    <table class="table table-dark table-sm table-hover border-secondary align-middle shadow-sm">
        <thead class="table-secondary text-dark">
            <tr>
                <th style="width: 35%;" class="ps-3">Jogador 1</th>
                <th style="width: 30%; text-align: center;">Resultado</th>
                <th style="width: 35%; text-align: right;" class="pe-3">Jogador 2</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pareamentos as $partida): ?>
            <tr class="border-bottom border-secondary">
                <td class="ps-3">
                    <span class="fw-bold <?= ($rodada["status"] === "finalizada" && str_contains(($partida['resultado'] ?? ''), $partida['jogador1'])) ? 'text-success' : '' ?>">
                        <?= htmlspecialchars($partida["jogador1"] ?? "A definir") ?>
                    </span>
                </td>

                <td class="text-center py-2">
                    <?php if ($rodada["status"] === "finalizada"): ?>
                        <span class="badge bg-dark border border-info text-info px-3">
                            <?= htmlspecialchars($partida["resultado"] ?? 'Finalizado') ?>
                        </span>
                    <?php else: ?>
                        <?php
                        // Checa se o Jogador 2 é BYE ou está vazio para conceder vitória automática
                        $isBye = (empty($partida["jogador2"]) || strtoupper($partida["jogador2"]) === 'BYE');

                        if ($isBye): ?>
                            <input type="hidden" name="resultados[<?= $partida["id_partida"] ?>]" value="jogador1_vitoria">
                            <span class="badge bg-success w-100 py-2">
                                <i class="fas fa-forward me-1"></i> VITÓRIA AUTOMÁTICA (BYE)
                            </span>
                        <?php else: ?>
                            <select name="resultados[<?= $partida["id_partida"] ?>]" class="form-select form-select-sm bg-dark text-light border-secondary" required>
                                <option value="">Lançar Resultado...</option>
                                <?php if (str_contains($torneio["tipo_torneio"], "bo3")): ?>
                                    <optgroup label="Vitória <?= htmlspecialchars($partida["jogador1"]) ?>">
                                        <option value="jogador1_2x0">2 x 0</option>
                                        <option value="jogador1_2x1">2 x 1</option>
                                    </optgroup>
                                    <optgroup label="Vitória <?= htmlspecialchars($partida["jogador2"]) ?>">
                                        <option value="jogador2_2x0">2 x 0</option>
                                        <option value="jogador2_2x1">2 x 1</option>
                                    </optgroup>
                                <?php else: ?>
                                    <option value="jogador1_vitoria">Vence: <?= htmlspecialchars($partida["jogador1"]) ?></option>
                                    <option value="jogador2_vitoria">Vence: <?= htmlspecialchars($partida["jogador2"]) ?></option>
                                <?php endif; ?>
                            </select>
                        <?php endif; ?>
                    <?php endif; ?>
                </td>

                <td class="text-end pe-3">
                    <span class="fw-bold <?= ($rodada["status"] === "finalizada" && str_contains(($partida['resultado'] ?? ''), $partida['jogador2'])) ? 'text-success' : '' ?>">
                        <?= !empty($partida["jogador2"]) ? htmlspecialchars($partida["jogador2"]) : '<span class="text-muted italic">BYE</span>' ?>
                    </span>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php else: ?>
    <div class="p-3 text-center border border-secondary rounded">
        <small class="text-muted italic">Aguardando definição dos confrontos desta rodada...</small>
    </div>
<?php endif; ?>
