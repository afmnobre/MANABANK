<?php
/**
 * Lógica de detecção de URL (A mesma usada na index)
 */
$isMANABANK = (strpos($_SERVER['SCRIPT_NAME'], '/MANABANK/') !== false);
$baseUrl = $isMANABANK ? '/MANABANK/' : '/';

// Caminho base para os assets e uploads
$cardgamesPath = $baseUrl . 'public/storage/uploads/cardgames/';
?>

<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h3 class="card-title mb-0 text-dark fw-bold">
                <?= $cardgame ? "Editar" : "Novo" ?> Cardgame
            </h3>
        </div>
        <div class="card-body">
            <form action="<?= $cardgame ? $baseUrl . 'admin/cardgame/update/' . $cardgame['id_cardgame'] : $baseUrl . 'admin/cardgame/store' ?>"
                  method="POST"
                  enctype="multipart/form-data">

                <div class="mb-4">
                    <label class="form-label fw-bold">Nome do Jogo</label>
                    <input type="text" name="nome" class="form-control"
                           value="<?= htmlspecialchars($cardgame['nome'] ?? '') ?>"
                           placeholder="Ex: Magic: The Gathering" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold">Imagem de Fundo (Banner)</label>
                        <input type="file" name="imagem_fundo_card" class="form-control mb-2">

                        <?php if(!empty($cardgame['imagem_fundo_card'])):
                            $fundoUrl = $cardgamesPath . $cardgame['id_cardgame'] . '/' . $cardgame['imagem_fundo_card'];
                        ?>
                            <div class="mt-2 p-2 border rounded bg-light text-center">
                                <p class="small text-muted mb-1">Atual:</p>
                                <img src="<?= $fundoUrl ?>" style="max-height:100px; max-width: 100%;" class="rounded shadow-sm">
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold">Imagem do Card (Ícone)</label>
                        <input type="file" name="imagem_card_game" class="form-control mb-2">

                        <?php if(!empty($cardgame['imagem_card_game'])):
                            $cardUrl = $cardgamesPath . $cardgame['id_cardgame'] . '/' . $cardgame['imagem_card_game'];
                        ?>
                            <div class="mt-2 p-2 border rounded bg-light text-center">
                                <p class="small text-muted mb-1">Atual:</p>
                                <img src="<?= $cardUrl ?>" style="max-height:100px; max-width: 100%;" class="rounded shadow-sm">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-between">
                    <a href="<?= $baseUrl ?>admin/cardgame" class="btn btn-secondary px-4">Cancelar</a>
                    <button class="btn btn-success px-5 shadow-sm">
                        <?= $cardgame ? "Atualizar Cardgame" : "Cadastrar Cardgame" ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
