<?php
/**
 * Lógica de detecção de URL para garantir funcionamento Local e Remoto
 */
$isMANABANK = (strpos($_SERVER['SCRIPT_NAME'], '/MANABANK/') !== false);
$baseUrl = $isMANABANK ? '/MANABANK/' : '/';

// Caminho base para os arquivos da loja
$lojasPath = $baseUrl . 'public/storage/uploads/lojas/';

// Define se é Edição ou Cadastro
$isEdit = isset($loja) && !empty($loja['id_loja']);
$formAction = $isEdit
    ? $baseUrl . "admin/loja/update/{$loja['id_loja']}"
    : $baseUrl . "admin/loja/store";
?>

<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-light">
            <?= $isEdit ? 'Editar Loja' : 'Cadastrar Nova Loja' ?>
        </h3>
        <a href="<?= $baseUrl ?>admin/loja" class="btn btn-outline-secondary btn-sm px-3">
            Voltar para Lista
        </a>
    </div>

    <form method="POST" action="<?= $formAction ?>" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0 fw-bold text-muted">Informações Gerais</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Nome da Loja</label>
                            <input type="text" name="nome_loja" class="form-control shadow-none"
                                   placeholder="Nome fantasia da unidade" required
                                   value="<?= $isEdit ? htmlspecialchars($loja['nome_loja']) : '' ?>">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">CNPJ</label>
                                <input type="text" name="cnpj" id="cnpjInput" class="form-control shadow-none"
                                       placeholder="00.000.000/0000-00" required maxlength="18"
                                       value="<?= $isEdit ? htmlspecialchars($loja['cnpj']) : '' ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">Cor do Tema</label>
                                <div class="d-flex align-items-center gap-2">
                                    <input type="color" name="cor_tema" class="form-control form-control-color border-0"
                                           value="<?= $isEdit ? $loja['cor_tema'] : '#0d6efd' ?>" title="Escolha a cor da loja">
                                    <span class="text-muted small">Identidade visual</span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-bold small">Endereço Completo</label>
                            <input type="text" name="endereco" class="form-control shadow-none"
                                   placeholder="Rua, número, bairro e cidade"
                                   value="<?= $isEdit ? htmlspecialchars($loja['endereco']) : '' ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0 fw-bold text-muted">Identidade Visual</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label fw-bold small">Logo da Loja</label>
                            <input type="file" name="logo" class="form-control form-control-sm mb-2 shadow-none">

                            <?php if($isEdit && !empty($loja['logo'])):
                                $logoUrl = $lojasPath . $loja['id_loja'] . '/' . $loja['logo'];
                            ?>
                                <div class="p-2 border rounded bg-light text-center">
                                    <img src="<?= $logoUrl ?>" alt="Logo" style="max-height: 60px; max-width: 100%;" class="rounded">
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-bold small">Favicon</label>
                            <input type="file" name="favicon" class="form-control form-control-sm mb-2 shadow-none">

                            <?php if($isEdit && !empty($loja['favicon'])):
                                $favUrl = $lojasPath . $loja['id_loja'] . '/' . $loja['favicon'];
                            ?>
                                <div class="p-2 border rounded bg-light text-center d-inline-block w-100">
                                    <img src="<?= $favUrl ?>" alt="Favicon" style="height: 24px; width: 24px;" class="border">
                                    <span class="ms-2 small text-muted">Atual</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success py-2 shadow-sm fw-bold">
                        <?= $isEdit ? 'Atualizar Dados' : 'Salvar Loja' ?>
                    </button>
                    <a href="<?= $baseUrl ?>admin/loja" class="btn btn-light border py-2">Cancelar</a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
/**
 * Inicialização da Máscara de CNPJ vinculada ao objeto window
 */
window.addEventListener('DOMContentLoaded', function() {
    const cnpjInput = document.getElementById('cnpjInput');

    if (cnpjInput) {
        cnpjInput.addEventListener('input', function(e) {
            let value = e.target.value;

            // 1. Remove tudo que não é número
            value = value.replace(/\D/g, '');

            // 2. Aplica a formatação progressivamente
            if (value.length > 2) value = value.replace(/^(\d{2})(\d)/, '$1.$2');
            if (value.length > 5) value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
            if (value.length > 8) value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
            if (value.length > 12) value = value.replace(/(\d{4})(\d)/, '$1-$2');

            // 3. Atualiza o valor do campo limitado ao tamanho do CNPJ
            e.target.value = value.substring(0, 18);
        });

        // Caso o valor já venha preenchido (no Editar), formata ao carregar
        cnpjInput.dispatchEvent(new Event('input'));
    }
});
</script>
