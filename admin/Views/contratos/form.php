<?php
/**
 * Lógica de detecção de URL para garantir funcionamento Local e Remoto
 */
$isMANABANK = (strpos($_SERVER['SCRIPT_NAME'], '/MANABANK/') !== false);
$baseUrl = $isMANABANK ? '/MANABANK/' : '/';

// Define se é Edição ou Cadastro
$isEdit = isset($contrato) && !empty($contrato['id_contrato']);
$formAction = $isEdit
    ? $baseUrl . "admin/contrato/update/{$contrato['id_contrato']}"
    : $baseUrl . "admin/contrato/store";
?>

<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">
            <?= $isEdit ? "Editar Contrato" : "Novo Contrato de Licença" ?>
        </h3>
        <a href="<?= $baseUrl ?>admin/contrato" class="btn btn-outline-secondary btn-sm px-3">
            Voltar para Lista
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form method="POST" action="<?= $formAction ?>">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small text-muted">Loja Contratante</label>
                                <select name="id_loja" class="form-select shadow-none" required>
                                    <option value="" disabled <?= !$isEdit ? 'selected' : '' ?>>Selecione a loja...</option>
                                    <?php foreach ($lojas as $loja): ?>
                                        <option value="<?= $loja['id_loja'] ?>"
                                            <?= ($isEdit && $contrato['id_loja'] == $loja['id_loja']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($loja['nome_loja']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small text-muted">Status do Vínculo</label>
                                <select name="status" class="form-select shadow-none" required>
                                    <option value="ativo" <?= ($isEdit && $contrato['status'] == 'ativo') ? 'selected' : '' ?>>Ativo</option>
                                    <option value="suspenso" <?= ($isEdit && $contrato['status'] == 'suspenso') ? 'selected' : '' ?>>Suspenso</option>
                                    <option value="cancelado" <?= ($isEdit && $contrato['status'] == 'cancelado') ? 'selected' : '' ?>>Cancelado</option>
                                </select>
                            </div>
                        </div>

                        <hr class="my-4 opacity-25">

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold small text-muted">Plano / Tipo</label>
                                <select name="tipo" id="tipoContrato" class="form-select shadow-none" required>
                                    <option value="teste" <?= ($isEdit && $contrato['tipo'] == 'teste') ? 'selected' : '' ?>>Teste (7 dias)</option>
                                    <option value="mensal" <?= ($isEdit && $contrato['tipo'] == 'mensal') ? 'selected' : '' ?>>Mensal (30 dias)</option>
                                    <option value="anual" <?= ($isEdit && $contrato['tipo'] == 'anual') ? 'selected' : '' ?>>Anual (365 dias)</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold small text-muted">Data de Início</label>
                                <input type="date" name="data_inicio" id="dataInicio" class="form-control shadow-none"
                                       value="<?= $isEdit ? $contrato['data_inicio'] : date('Y-m-d') ?>" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold small text-muted">Data de Término</label>
                                <input type="date" name="data_fim" id="dataFim" class="form-control shadow-none bg-light"
                                       value="<?= $isEdit ? $contrato['data_fim'] : '' ?>" readonly>
                                <small class="text-info" style="font-size: 0.75rem;">Calculada automaticamente</small>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 d-flex gap-2">
                            <button type="submit" class="btn btn-success px-5 shadow-sm fw-bold">
                                <?= $isEdit ? "Atualizar Contrato" : "Salvar Contrato" ?>
                            </button>
                            <a href="<?= $baseUrl ?>admin/contrato" class="btn btn-light border px-4">Cancelar</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
window.addEventListener('DOMContentLoaded', function() {
    const tipoSelect = document.getElementById('tipoContrato');
    const dataInicioInput = document.getElementById('dataInicio');
    const dataFimInput = document.getElementById('dataFim');

    window.atualizarDataFim = function() {
        const tipo = tipoSelect.value;
        const inicioValue = dataInicioInput.value;

        if (!inicioValue) return;

        let diasAdicionar = 0;
        switch(tipo) {
            case 'teste': diasAdicionar = 7; break;
            case 'mensal': diasAdicionar = 30; break;
            case 'anual': diasAdicionar = 365; break;
        }

        // Criar a data usando partes para evitar problemas de fuso horário local
        const partes = inicioValue.split('-');
        const data = new Date(partes[0], partes[1] - 1, partes[2]);

        data.setDate(data.getDate() + diasAdicionar);

        const ano = data.getFullYear();
        const mes = String(data.getMonth() + 1).padStart(2, '0');
        const dia = String(data.getDate()).padStart(2, '0');

        dataFimInput.value = `${ano}-${mes}-${dia}`;
    };

    // Listeners
    tipoSelect.addEventListener('change', window.atualizarDataFim);
    dataInicioInput.addEventListener('change', window.atualizarDataFim);

    // Executa ao carregar se for um novo contrato para já sugerir a data fim
    if (dataInicioInput.value && !dataFimInput.value) {
        window.atualizarDataFim();
    }
});
</script>
