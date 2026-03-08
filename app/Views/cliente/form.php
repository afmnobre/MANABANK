<style>
    /* Seletor ultra-específico para ignorar o CSS global do header */
    .custom-scroll label.magic-card.magic-card-fixed {
        /* Travas de Largura (O dobro de 26px = 52px) */
        width: 52px !important;
        min-width: 52px !important;
        max-width: 52px !important;

        /* Travas de Altura Proporcional TCG (1:1.4) */
        height: 73px !important;
        min-height: 73px !important;
        max-height: 73px !important;

        display: block !important;
        position: relative !important;
        overflow: hidden !important;
        border-radius: 5px !important;
        padding: 0 !important;
        margin: 0 !important;
        border: 1px solid #343a40 !important;
        background-color: #000 !important;
    }

    /* Força a imagem a preencher o card sem deformar */
    .magic-card-fixed img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important; /* Corta as bordas da imagem original para caber no 52x73 */
        display: block !important;
    }

    /* Ajuste do Overlay para a nova largura */
    .magic-card-fixed .card-overlay {
        font-size: 0.55rem !important;
        bottom: 0 !important;
        width: 100% !important;
        background: rgba(0, 0, 0, 0.75) !important;
        color: #fff !important;
        text-align: center !important;
        position: absolute !important;
        padding: 2px 0 !important;
        font-weight: bold !important;
        white-space: nowrap !important;
    }

    /* Efeito de Seleção MANABANK */
    .magic-card-fixed:has(input.magic-check:checked) {
        border-color: #00d400 !important;
        box-shadow: 0 0 8px rgba(0, 212, 0, 0.6) !important;
        transform: scale(1.05);
    }
</style>


<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-white fw-bold">
            <i class="bi <?= isset($cliente) ? 'bi-pencil-square' : 'bi-person-plus-fill' ?> me-2 text-primary"></i>
            <?= isset($cliente) ? 'Editar Cliente' : 'Novo Cliente' ?>
        </h2>
        <a href="<?= $base ?>cliente" class="btn btn-outline-secondary btn-sm shadow-sm">
            <i class="bi bi-arrow-left"></i> Voltar para Lista
        </a>
    </div>

    <div class="card bg-dark border-secondary shadow-sm">
        <div class="card-body p-4">
            <form method="POST"
                  action="<?= $base ?><?= isset($cliente) ? 'cliente/atualizar/'.$cliente['id_cliente'] : 'cliente/salvar' ?>">

                <div class="row g-4">
                    <div class="col-md-6 border-end border-secondary">
                        <h5 class="text-primary small text-uppercase fw-bold mb-4 tracking-wider">
                            <i class="bi bi-person-lines-fill me-1"></i> Dados do Cliente
                        </h5>

                        <div class="mb-3">
                            <label for="nome" class="form-label text-white-50 small">Nome Completo</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-secondary text-white"><i class="bi bi-person"></i></span>
                                <input type="text" id="nome" name="nome" class="form-control bg-dark text-white border-secondary"
                                       value="<?= htmlspecialchars($cliente['nome'] ?? '') ?>" placeholder="Ex: João Silva" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="telefone" class="form-label text-white-50 small">Telefone / WhatsApp</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-secondary text-success"><i class="bi bi-whatsapp"></i></span>
                                <input type="text" id="telefone" name="telefone" class="form-control bg-dark text-white border-secondary"
                                       value="<?= htmlspecialchars($cliente['telefone'] ?? '') ?>"
                                       maxlength="15" required placeholder="(11) 99999-9999">
                            </div>
                            <span id="statusCliente" class="small text-info"></span>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label text-white-50 small">E-mail</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-secondary text-primary"><i class="bi bi-envelope"></i></span>
                                <input type="email" id="email" name="email" class="form-control bg-dark text-white border-secondary"
                                       value="<?= htmlspecialchars($cliente['email'] ?? '') ?>" placeholder="cliente@email.com">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5 class="text-primary small text-uppercase fw-bold mb-4 tracking-wider">
                            <i class="bi bi-controller me-1"></i> CardGames de Interesse
                        </h5>

<div class="d-flex flex-row align-items-center flex-nowrap custom-scroll" style="gap: 10px; overflow-x: auto; padding: 10px 0; scrollbar-width: none;">
    <?php foreach ($cardgames as $cardgame): ?>
        <?php
            // Lógica de checked (adaptada para funcionar em ambas as views)
            $checked = '';
            if (isset($cardgamesCliente)) {
                $checked = in_array($cardgame['id_cardgame'], array_column($cardgamesCliente, 'id_cardgame')) ? 'checked' : '';
            } else {
                $checked = in_array((string)$cardgame['id_cardgame'], array_map('strval', ($_GET['cardgames'] ?? []))) ? 'checked' : '';
            }
            $nomeCardgame = htmlspecialchars($cardgame['nome']);
        ?>

        <label class="magic-card magic-card-fixed p-0 m-0 flex-shrink-0" title="<?= $nomeCardgame ?>">
            <input class="magic-check" type="checkbox" name="cardgames[]"
                   value="<?= $cardgame['id_cardgame'] ?>" <?= $checked ?>
                   style="display:none;"
                   <?= isset($cardgamesCliente) ? '' : 'onchange="filtrarClientes()"' ?>>

            <img src="<?= $this->baseUrl ?>public/storage/uploads/cardgames/<?= $cardgame['id_cardgame'] ?>/<?= htmlspecialchars($cardgame['imagem_fundo_card']) ?>"
                 alt="<?= $nomeCardgame ?>">

            <div class="card-overlay"><?= mb_substr($nomeCardgame, 0, 5) ?></div>
        </label>
    <?php endforeach; ?>
</div>
                    </div>
                </div>

                <div class="border-top border-secondary mt-5 pt-4 text-end">
                    <a href="<?= $base ?>cliente" class="btn btn-outline-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-success px-4 fw-bold shadow-sm">
                        <i class="bi bi-save me-1"></i> SALVAR CLIENTE
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Padronização MANABANK */
.tracking-wider { letter-spacing: 1.5px; }

.form-control::placeholder { color: rgba(255, 255, 255, 0.3) !important; }

.form-control:focus {
    background-color: #1a1a1a !important;
    border-color: #0d6efd !important; /* Azul para clientes */
    color: #fff !important;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

/* Manter o estilo das Magic Cards que você já tem */
.magic-card {
    position: relative;
    width: 60px;
    height: 80px;
    cursor: pointer;
    border-radius: 4px;
    overflow: hidden;
    border: 2px solid transparent;
    transition: 0.2s;
}

.magic-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: grayscale(100%);
}

.magic-check { display: none; }

.magic-check:checked + img {
    filter: grayscale(0%);
}

.magic-check:checked ~ .card-overlay {
    background: rgba(13, 110, 253, 0.8);
}

.magic-card:has(.magic-check:checked) {
    border-color: #0d6efd;
    transform: translateY(-5px);
}

.card-overlay {
    position: absolute;
    bottom: 0;
    width: 100%;
    font-size: 0.5rem;
    text-align: center;
    background: rgba(0,0,0,0.7);
    padding: 2px 0;
    text-transform: uppercase;
}
</style>
