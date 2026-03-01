<?php $baseAssetUrl = '/public'; ?>

<div class="container mt-4">
    <h3><?= $cardgame ? "Editar" : "Novo" ?> Cardgame</h3>

    <form action="<?= $cardgame ? '/admin/cardgame/update/'.$cardgame['id_cardgame'] : '/admin/cardgame/store' ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" value="<?= $cardgame['nome'] ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label>Imagem Fundo</label>
            <input type="file" name="imagem_fundo_card" class="form-control">
            <?php if(!empty($cardgame['imagem_fundo_card'])):
                $fundoPath = "{$baseAssetUrl}/storage/uploads/cardgames/{$cardgame['id_cardgame']}/{$cardgame['imagem_fundo_card']}";
            ?>
                <img src="<?= $fundoPath ?>" style="height:50px; margin-top:5px;">
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label>Imagem Card</label>
            <input type="file" name="imagem_card_game" class="form-control">
            <?php if(!empty($cardgame['imagem_card_game'])):
                $cardPath = "{$baseAssetUrl}/storage/uploads/cardgames/{$cardgame['id_cardgame']}/{$cardgame['imagem_card_game']}";
            ?>
                <img src="<?= $cardPath ?>" style="height:50px; margin-top:5px;">
            <?php endif; ?>
        </div>

        <button class="btn btn-success"><?= $cardgame ? "Atualizar" : "Cadastrar" ?></button>
        <a href="/admin/cardgame" class="btn btn-secondary">Cancelar</a>
    </form>
</div>


