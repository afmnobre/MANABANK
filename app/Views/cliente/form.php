<h2 class="text-light mb-3">
    <?= isset($cliente) ? '✏️ Editar Cliente' : '➕ Novo Cliente' ?>
</h2>

<form method="POST"
      action="<?= $base ?><?= isset($cliente) ? 'cliente/atualizar/'.$cliente['id_cliente'] : 'cliente/salvar' ?>"
      class="bg-dark text-light p-4 rounded border border-secondary">

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone (Celular)</label>
                <input type="text" id="telefone" name="telefone" class="form-control"
                       value="<?= htmlspecialchars($cliente['telefone'] ?? '') ?>"
                       maxlength="15" required>
                <span id="statusCliente" class="small"></span>
            </div>

            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" id="nome" name="nome" class="form-control"
                       value="<?= htmlspecialchars($cliente['nome'] ?? '') ?>">
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control"
                       value="<?= htmlspecialchars($cliente['email'] ?? '') ?>">
            </div>

            <div class="mb-3 d-none d-md-block" style="height: 85px;"></div>
        </div>
    </div>

    <hr class="border-secondary my-4">
    <h3 class="text-light mb-3">CardGames que o cliente joga:</h3>

    <div class="cards-grid mt-3">
        <?php if (!empty($cardgames)): ?>
            <?php foreach ($cardgames as $cg): ?>
                <?php
                $checked = (!empty($cardgamesCliente) && in_array($cg['id_cardgame'], array_column($cardgamesCliente, 'id_cardgame'))) ? 'checked' : '';

                // AJUSTE: Montagem da imagem usando o padrão que funcionou (public/storage)
                $urlImgThumb = $base . "public/storage/uploads/cardgames/" . $cg['id_cardgame'] . "/" . $cg['imagem_fundo_card'];
                ?>

                <label class="magic-card">
                    <input class="magic-check"
                           type="checkbox"
                           name="cardgames[]"
                           value="<?= $cg['id_cardgame'] ?>"
                           <?= $checked ?>>

                    <img src="<?= $urlImgThumb ?>"
                         alt="<?= htmlspecialchars($cg['nome']) ?>">

                    <div class="card-overlay">
                        <small><?= htmlspecialchars($cg['nome']) ?></small>
                    </div>
                </label>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted">Nenhum cardgame cadastrado.</p>
        <?php endif; ?>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">💾 Salvar</button>
        <a href="<?= $base ?>cliente" class="btn btn-secondary">↩️ Voltar</a>
    </div>
</form>
