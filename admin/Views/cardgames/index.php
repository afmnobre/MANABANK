<?php $baseAssetUrl = '/public'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Cardgames</h3>
        <a href="/admin/cardgame/form" class="btn btn-primary">Novo Cardgame</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Imagem Fundo</th>
                    <th>Imagem Card</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($cardgames as $c):
                    $fundoPath = "{$baseAssetUrl}/storage/uploads/cardgames/{$c['id_cardgame']}/{$c['imagem_fundo_card']}";
                    $cardPath  = "{$baseAssetUrl}/storage/uploads/cardgames/{$c['id_cardgame']}/{$c['imagem_card_game']}";
                ?>
                    <tr>
                        <td><?= $c['id_cardgame'] ?></td>
                        <td><?= htmlspecialchars($c['nome']) ?></td>
                        <td>
                            <?php if(!empty($c['imagem_fundo_card'])): ?>
                                <img src="<?= $fundoPath ?>" style="height:50px;">
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if(!empty($c['imagem_card_game'])): ?>
                                <img src="<?= $cardPath ?>" style="height:50px;">
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="/admin/cardgame/form/<?= $c['id_cardgame'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="/admin/cardgame/delete/<?= $c['id_cardgame'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir este cardgame?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

