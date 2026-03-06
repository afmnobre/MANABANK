<?php
/**
 * Lógica de detecção de URL para garantir funcionamento Local e Remoto
 */
$isMANABANK = (strpos($_SERVER['SCRIPT_NAME'], '/MANABANK/') !== false);
$baseUrl = $isMANABANK ? '/MANABANK/' : '/';

// Caminho para a pasta de imagens de pagamento
$pagamentosPath = $baseUrl . 'public/storage/uploads/tipos_pagamento/';

// Define se é Edição ou Cadastro para ajustar a URL de destino (Action)
$isEdit = isset($tipo) && !empty($tipo['id_pagamento']);
$formAction = $isEdit
    ? $baseUrl . "admin/tipopagamento/update/{$tipo['id_pagamento']}"
    : $baseUrl . "admin/tipopagamento/store";
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">
            <?= $isEdit ? "Editar Método de Pagamento" : "Novo Método de Pagamento" ?>
        </h3>
        <a href="<?= $baseUrl ?>admin/tipopagamento" class="btn btn-outline-secondary btn-sm">
            Voltar para Lista
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form action="<?= $formAction ?>" method="POST" enctype="multipart/form-data">

                <div class="mb-4">
                    <label class="form-label fw-bold">Nome do Método</label>
                    <input type="text" name="nome" class="form-control"
                           value="<?= htmlspecialchars($tipo['nome'] ?? '') ?>"
                           placeholder="Ex: Pix, Cartão de Crédito, Boleto" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Ícone / Logotipo</label>
                    <input type="file" name="imagem" class="form-control mb-2">

                    <?php if($isEdit && !empty($tipo['imagem'])):
                        $imgPath = $pagamentosPath . $tipo['id_pagamento'] . '/' . $tipo['imagem'];
                    ?>
                        <div class="mt-3 p-3 border rounded bg-light d-inline-block">
                            <p class="small text-muted mb-2">Ícone Atual:</p>
                            <img src="<?= $imgPath ?>" alt="Imagem"
                                 style="height: 60px; width: auto; object-fit: contain;"
                                 class="rounded shadow-sm bg-white p-1">
                        </div>
                    <?php endif; ?>
                    <div class="form-text text-muted">Use imagens em PNG ou SVG com fundo transparente para um melhor visual.</div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end gap-2">
                    <a href="<?= $baseUrl ?>admin/tipopagamento" class="btn btn-light px-4 border">Cancelar</a>
                    <button type="submit" class="btn btn-primary px-5 shadow-sm">
                        <?= $isEdit ? "Salvar Alterações" : "Cadastrar Método" ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
