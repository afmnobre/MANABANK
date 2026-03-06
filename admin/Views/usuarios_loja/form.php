<?php
/**
 * Lógica de detecção de URL para garantir funcionamento Local e Remoto
 */
$isMANABANK = (strpos($_SERVER['SCRIPT_NAME'], '/MANABANK/') !== false);
$baseUrl = $isMANABANK ? '/MANABANK/' : '/';

// Define se é Edição ou Cadastro
$isEdit = isset($usuario) && !empty($usuario['id_usuario']);
$formAction = $isEdit
    ? $baseUrl . "admin/usuarioLoja/update/{$usuario['id_usuario']}"
    : $baseUrl . "admin/usuarioLoja/store";
?>

<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">
            <?= $isEdit ? "Editar Usuário" : "Novo Usuário de Loja" ?>
        </h3>
        <a href="<?= $baseUrl ?>admin/usuarioLoja" class="btn btn-outline-secondary btn-sm px-3">
            Voltar para Lista
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form method="POST" action="<?= $formAction ?>">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold small">Vincular à Loja</label>
                        <select name="id_loja" class="form-select shadow-none" required>
                            <option value="" disabled <?= !$isEdit ? 'selected' : '' ?>>Selecione a loja...</option>
                            <?php foreach ($lojas as $loja): ?>
                                <option value="<?= $loja['id_loja'] ?>"
                                    <?= ($isEdit && $usuario['id_loja'] == $loja['id_loja']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($loja['nome_loja']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold small">Perfil de Acesso</label>
                        <select name="perfil" class="form-select shadow-none" required>
                            <option value="atendente" <?= ($isEdit && $usuario['perfil'] == 'atendente') ? 'selected' : '' ?>>Atendente</option>
                            <option value="gerente" <?= ($isEdit && $usuario['perfil'] == 'gerente') ? 'selected' : '' ?>>Gerente</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold small">Status</label>
                        <select name="ativo" class="form-select shadow-none">
                            <option value="1" <?= ($isEdit && $usuario['ativo'] == 1) ? 'selected' : '' ?>>Ativo</option>
                            <option value="0" <?= ($isEdit && $usuario['ativo'] == 0) ? 'selected' : '' ?>>Inativo</option>
                        </select>
                    </div>
                </div>

                <hr class="my-4 text-light">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold small">Nome Completo</label>
                        <input type="text" name="nome" class="form-control shadow-none" required
                               placeholder="Ex: João Silva"
                               value="<?= $isEdit ? htmlspecialchars($usuario['nome']) : '' ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold small">E-mail (Login de Acesso)</label>
                        <input type="email" name="email" class="form-control shadow-none" required
                               placeholder="email@loja.com"
                               value="<?= $isEdit ? htmlspecialchars($usuario['email']) : '' ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold small">
                            Senha <?= $isEdit ? '<span class="fw-normal text-muted">(preencha apenas para alterar)</span>' : '' ?>
                        </label>
                        <div class="input-group">
                            <input type="password" name="senha" id="passInput" class="form-control shadow-none" <?= $isEdit ? "" : "required" ?>>
                            <button class="btn btn-outline-secondary" type="button" id="togglePass">
                                <i class="bi bi-eye">🔑</i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-5 shadow-sm">
                        <?= $isEdit ? "Atualizar Usuário" : "Salvar Usuário" ?>
                    </button>
                    <a href="<?= $baseUrl ?>admin/usuarioLoja" class="btn btn-light border px-4">Cancelar</a>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
window.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('togglePass');
    const passInput = document.getElementById('passInput');

    if (toggleBtn && passInput) {
        toggleBtn.addEventListener('click', function() {
            const isPass = passInput.type === 'password';
            passInput.type = isPass ? 'text' : 'password';

            // Troca o ícone (assumindo que você usa Bootstrap Icons)
            const icon = this.querySelector('i');
            if (icon) {
                icon.className = isPass ? 'bi bi-eye-slash' : 'bi bi-eye';
            }
        });
    }
});
</script>
