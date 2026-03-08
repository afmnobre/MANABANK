<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-white fw-bold">
            <i class="bi bi-box-seam me-2 text-warning"></i> Produtos da Loja
        </h2>
        <div class="d-flex gap-2">
            <span class="badge bg-secondary opacity-75 d-none d-md-inline-block py-2 px-3">
                <i class="bi bi-info-circle me-1"></i> Arraste as linhas para reordenar
            </span>
            <a href="<?= $base ?>produto/criar" class="btn btn-primary btn-sm shadow-sm">
                <i class="bi bi-plus-lg"></i> Novo Produto
            </a>
        </div>
    </div>

    <div class="card bg-dark border-secondary shadow-sm overflow-hidden">
        <div class="card-body p-0">
            <form id="formOrdem" method="POST" action="<?= $base ?>produto/salvarOrdem">
                <div class="table-responsive">
                    <table class="table table-dark table-striped table-hover align-middle mb-0">
                        <thead>
                            <tr class="border-secondary">
                                <th width="50" class="ps-3"></th>
                                <th>Nome</th>
                                <th class="text-center">Emoji</th>
                                <th>Venda</th>
                                <th>Compra</th>
                                <th class="text-center">Controla Estoque</th>
                                <th class="text-center">Estoque Atual</th>
                                <th class="text-center">Ordem</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody id="sortable-produtos">
                            <?php foreach ($produtos as $produto): ?>
                                <?php
                                    $alertaEstoque = false;
                                    if ($produto['controlar_estoque'] == 1 && $produto['estoque_atual'] <= $produto['estoque_alerta']) {
                                        $alertaEstoque = true;
                                    }
                                ?>
                                <tr class="border-secondary" data-id="<?= $produto['id_produto'] ?>">
                                    <td class="ps-3 text-muted handle" style="cursor: move;">
                                        <i class="bi bi-grip-vertical"></i>
                                    </td>
                                    <td>
                                        <input type="hidden" name="id_produto[]" value="<?= $produto['id_produto'] ?>">
                                        <span class="fw-bold <?= $produto['ativo'] == 0 ? 'text-muted text-decoration-line-through' : 'text-info' ?>">
                                            <?= htmlspecialchars($produto['nome']) ?>
                                        </span>
                                    </td>
                                    <td class="text-center fs-5"><?= htmlspecialchars($produto['emoji']) ?></td>
                                    <td>
                                        <span class="badge bg-success-subtle text-success border border-success px-2 py-1">
                                            R$ <?= number_format($produto['valor_venda'], 2, ',', '.') ?>
                                        </span>
                                    </td>
                                    <td class="small text-white-50">
                                        R$ <?= number_format($produto['valor_compra'], 2, ',', '.') ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($produto['controlar_estoque'] == 1): ?>
                                            <span class="badge bg-primary shadow-sm" style="min-width: 60px;">
                                                <i class="bi bi-check-circle-fill me-1" style="font-size: 0.5rem;"></i> Sim
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-dark border border-secondary text-secondary shadow-sm" style="min-width: 60px;">
                                                <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i> Não
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($produto['controlar_estoque'] == 1): ?>
                                            <span class="badge <?= $alertaEstoque ? 'bg-danger' : 'bg-dark border border-secondary text-info' ?> shadow-sm">
                                                <i class="bi <?= $alertaEstoque ? 'bi-exclamation-triangle-fill' : 'bi-box' ?> me-1"></i>
                                                <?= $produto['estoque_atual'] ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="text-muted" title="Sem controle de estoque">∞</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-dark border border-secondary show-ordem" style="font-size: 0.7rem;">
                                            <?= $produto['ordem_exibicao'] ?>
                                        </span>
                                    </td>
                                    <td class="text-center px-3">
                                        <div class="btn-group shadow-sm">
                                            <a href="<?= $base ?>produto/editar/<?= $produto['id_produto'] ?>" class="btn btn-sm btn-outline-warning" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <?php if ($produto['ativo'] == 1): ?>
                                                <a href="<?= $base ?>produto/desativar/<?= $produto['id_produto'] ?>" class="btn btn-sm btn-outline-danger" title="Desativar">
                                                    <i class="bi bi-toggle-on"></i>
                                                </a>
                                            <?php else: ?>
                                                <a href="<?= $base ?>produto/ativar/<?= $produto['id_produto'] ?>" class="btn btn-sm btn-outline-success" title="Ativar">
                                                    <i class="bi bi-toggle-off"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer bg-dark border-top border-secondary p-3 text-end">
                    <button class="btn btn-success btn-sm fw-bold shadow-sm" type="submit">
                        <i class="bi bi-save me-1"></i> SALVAR NOVA ORDEM
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Estilos replicados da sua view de Torneios */
.btn-group .btn-outline-warning,
.btn-group .btn-outline-success,
.btn-group .btn-outline-danger {
    border-color: #444;
}
.btn-group .btn-outline-warning:hover { background-color: #ffc107; color: #000; }
.btn-group .btn-outline-success:hover { background-color: #198754; color: #fff; }
.btn-group .btn-outline-danger:hover { background-color: #dc3545; color: #fff; }

.handle:hover {
    color: #ffc107 !important;
}
</style>
