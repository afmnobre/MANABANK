<?php
/**
 * Lógica de detecção de URL para garantir funcionamento Local e Remoto
 */
$isMANABANK = (strpos($_SERVER['SCRIPT_NAME'], '/MANABANK/') !== false);
$baseUrl = $isMANABANK ? '/MANABANK/' : '/';

// Caminho para a pasta de tipos de pagamento
$pagamentosPath = $baseUrl . 'public/storage/uploads/tipos_pagamento/';
?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">Tipos de Pagamento</h3>
        <a href="<?= $baseUrl ?>admin/tipopagamento/form" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-lg"></i> Novo Tipo
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <?php if (!empty($tipos)): ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 bg-white">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4" style="width: 80px;">ID</th>
                                <th>Nome do Método</th>
                                <th>Ícone / Imagem</th>
                                <th class="text-center pe-4">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tipos as $tipo): ?>
                                <?php
                                    $imgPath = !empty($tipo['imagem'])
                                        ? $pagamentosPath . $tipo['id_pagamento'] . '/' . $tipo['imagem']
                                        : null;
                                ?>
                                <tr>
                                    <td class="ps-4 text-muted">#<?= $tipo['id_pagamento'] ?></td>
                                    <td>
                                        <span class="fw-bold text-dark"><?= htmlspecialchars($tipo['nome']) ?></span>
                                    </td>
                                    <td>
                                        <?php if ($imgPath): ?>
                                            <img src="<?= $imgPath ?>" alt="<?= $tipo['nome'] ?>"
                                                 style="height: 40px; width: 60px; object-fit: contain;"
                                                 class="rounded border bg-light p-1">
                                        <?php else: ?>
                                            <span class="badge bg-light text-secondary border">Sem imagem</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center pe-4">
                                        <div class="btn-group">
                                            <a href="<?= $baseUrl ?>admin/tipopagamento/form/<?= $tipo['id_pagamento'] ?>"
                                               class="btn btn-sm btn-outline-warning">
                                               Editar
                                            </a>
                                            <a href="<?= $baseUrl ?>admin/tipopagamento/delete/<?= $tipo['id_pagamento'] ?>"
                                               class="btn btn-sm btn-outline-danger"
                                               onclick="return confirm('Deseja realmente excluir este tipo de pagamento?')">
                                               Excluir
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="py-5 text-center">
                    <p class="text-muted mb-0">Nenhum tipo de pagamento cadastrado no sistema.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>
