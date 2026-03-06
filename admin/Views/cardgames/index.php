<?php
/**
 * Lógica de detecção de URL para garantir funcionamento Local e Remoto
 */
$isMANABANK = (strpos($_SERVER['SCRIPT_NAME'], '/MANABANK/') !== false);
$baseUrl = $isMANABANK ? '/MANABANK/' : '/';

// Caminho para a pasta de cardgames
$cardgamesPath = $baseUrl . 'public/storage/uploads/cardgames/';
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-light">Cardgames Cadastrados</h3>
        <a href="<?= $baseUrl ?>admin/cardgame/form" class="btn btn-primary shadow-sm">
            Novo Cardgame
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 bg-white">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" style="width: 80px;">ID</th>
                            <th>Nome do Jogo</th>
                            <th>Imagem Fundo</th>
                            <th>Imagem Card</th>
                            <th class="text-center pe-4">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($cardgames)): ?>
                            <?php foreach ($cardgames as $c):
                                // Montagem do caminho: /MANABANK/public/storage/uploads/cardgames/9/fundo.png
                                $folder = $cardgamesPath . $c['id_cardgame'] . '/';
                            ?>
                                <tr>
                                    <td class="ps-4 text-muted">#<?= $c['id_cardgame'] ?></td>
                                    <td>
                                        <span class="fw-bold text-dark"><?= htmlspecialchars($c['nome']) ?></span>
                                    </td>
                                    <td>
                                        <?php if (!empty($c['imagem_fundo_card'])): ?>
                                            <img src="<?= $folder . $c['imagem_fundo_card'] ?>"
                                                 style="height: 45px; width: 80px; object-fit: cover;"
                                                 class="rounded border shadow-sm">
                                        <?php else: ?>
                                            <span class="badge bg-light text-secondary border">Sem fundo</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($c['imagem_card_game'])): ?>
                                            <img src="<?= $folder . $c['imagem_card_game'] ?>"
                                                 style="height: 45px; width: 45px; object-fit: contain;"
                                                 class="rounded border shadow-sm bg-light">
                                        <?php else: ?>
                                            <span class="badge bg-light text-secondary border">Sem card</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center pe-4">
                                        <div class="btn-group">
                                            <a href="<?= $baseUrl ?>admin/cardgame/form/<?= $c['id_cardgame'] ?>"
                                               class="btn btn-sm btn-outline-warning">Editar</a>
                                            <a href="<?= $baseUrl ?>admin/cardgame/delete/<?= $c['id_cardgame'] ?>"
                                               class="btn btn-sm btn-outline-danger"
                                               onclick="return confirm('Deseja excluir?')">Excluir</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">Nenhum registro encontrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
