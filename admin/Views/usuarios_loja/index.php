<?php
/**
 * Lógica de detecção de URL para garantir funcionamento Local e Remoto
 */
$isMANABANK = (strpos($_SERVER['SCRIPT_NAME'], '/MANABANK/') !== false);
$baseUrl = $isMANABANK ? '/MANABANK/' : '/';
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">Usuários das Lojas</h3>
        <a href="<?= $baseUrl ?>admin/usuarioLoja/form" class="btn btn-primary shadow-sm">
            <i class="bi bi-person-plus"></i> Cadastrar Usuário
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 bg-white">
                    <thead class="table-light text-secondary">
                        <tr>
                            <th class="ps-4" style="width: 80px;">ID</th>
                            <th>Loja</th>
                            <th>Nome / Email</th>
                            <th>Perfil</th>
                            <th class="text-center">Status</th>
                            <th class="text-center pe-4">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($usuarios)): ?>
                            <?php foreach ($usuarios as $u): ?>
                                <tr>
                                    <td class="ps-4 text-muted small">#<?= $u['id_usuario'] ?></td>
                                    <td>
                                        <span class="badge bg-light text-dark border fw-normal">
                                            <?= htmlspecialchars($u['nome_loja']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark"><?= htmlspecialchars($u['nome']) ?></div>
                                        <div class="small text-muted"><?= htmlspecialchars($u['email']) ?></div>
                                    </td>
                                    <td>
                                        <span class="small"><?= ucfirst($u['perfil']) ?></span>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($u['ativo']): ?>
                                            <span class="badge bg-success-subtle text-success border border-success-subtle">Ativo</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle">Inativo</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center pe-4">
                                        <div class="btn-group">
                                            <a href="<?= $baseUrl ?>admin/usuarioLoja/form/<?= $u['id_usuario'] ?>"
                                               class="btn btn-sm btn-outline-warning px-3">
                                                Editar
                                            </a>
                                            <a href="<?= $baseUrl ?>admin/usuarioLoja/delete/<?= $u['id_usuario'] ?>"
                                               class="btn btn-sm btn-outline-danger"
                                               onclick="return confirm('Deseja realmente excluir este usuário?')">
                                                Excluir
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    Nenhum usuário encontrado.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
