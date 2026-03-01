<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Tipos de Pagamento</h3>
        <a href="/admin/tipopagamento/form" class="btn btn-primary">Novo Tipo</a>
    </div>

    <div class="card shadow">
        <div class="card-body">

            <?php if (!empty($tipos)): ?>
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Imagem</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tipos as $tipo): ?>
                                <?php
                                    $imgPath = !empty($tipo['imagem'])
                                        ? "/public/storage/uploads/tipos_pagamento/{$tipo['id_pagamento']}/{$tipo['imagem']}"
                                        : null;
                                ?>
                                <tr>
                                    <td><?= $tipo['id_pagamento'] ?></td>
                                    <td><?= htmlspecialchars($tipo['nome']) ?></td>
                                    <td>
                                        <?php if ($imgPath): ?>
                                            <img src="<?= $imgPath ?>" alt="<?= $tipo['nome'] ?>" style="height:40px;">
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="/admin/tipopagamento/form/<?= $tipo['id_pagamento'] ?>" class="btn btn-sm btn-warning">
                                            Editar
                                        </a>
                                        <a href="/admin/tipopagamento/delete/<?= $tipo['id_pagamento'] ?>" class="btn btn-sm btn-danger"
                                           onclick="return confirm('Deseja realmente excluir este tipo de pagamento?')">
                                           Excluir
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-muted">Nenhum tipo de pagamento cadastrado.</p>
            <?php endif; ?>

        </div>
    </div>

</div>

