<style>
#emoji {
    text-align: center;
    font-size: 1.5rem;
    width: 80px;
    flex: none;
}
#picker-container {
    position: absolute;
    z-index: 9999;
}
/* Estilo para inputs focados no tema dark */
.form-control:focus {
    background-color: #1a1a1a !important;
    border-color: #ffc107 !important;
    color: #fff !important;
    box-shadow: 0 0 0 0.25 mil rem rgba(255, 193, 7, 0.25);
}
</style>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-white fw-bold">
            <i class="bi <?= isset($produto) ? 'bi-pencil-square' : 'bi-plus-circle-fill' ?> me-2 text-warning"></i>
            <?= isset($produto) ? 'Editar Produto' : 'Novo Produto' ?>
        </h2>
        <a href="<?= $base ?>produto" class="btn btn-outline-secondary btn-sm shadow-sm">
            <i class="bi bi-arrow-left"></i> Voltar para Lista
        </a>
    </div>

    <div class="card bg-dark border-secondary shadow-sm">
        <div class="card-body p-4">
            <form method="POST"
                  action="<?= $base ?><?= isset($produto) ? 'produto/atualizar/'.$produto['id_produto'] : 'produto/salvar' ?>">

                <div class="row g-4">
                    <div class="col-md-6 border-end border-secondary">
                        <h5 class="text-warning small text-uppercase fw-bold mb-4 tracking-wider">
                            <i class="bi bi-info-circle me-1"></i> Informações Básicas
                        </h5>

                        <div class="mb-3">
                            <label for="nome" class="form-label text-white-50 small">Nome do Produto</label>
                            <input type="text" id="nome" name="nome" class="form-control bg-dark text-white border-secondary"
                                   value="<?= htmlspecialchars($produto['nome'] ?? '') ?>" required placeholder="Ex: Deck Box Magic">
                        </div>

                        <div class="mb-3">
                            <label for="emoji" class="form-label text-white-50 small">Ícone / Emoji</label>
                            <div class="input-group">
                                <input type="text" class="form-control bg-dark text-white border-secondary text-center fs-4"
                                       id="emoji" name="emoji" value="<?= htmlspecialchars($produto['emoji'] ?? '📦') ?>" readonly>
                                <button class="btn btn-outline-info" type="button" id="emoji-trigger">
                                    <i class="bi bi-emoji-smile"></i> Escolher
                                </button>
                            </div>
                            <div id="picker-container"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="valor_venda" class="form-label text-white-50 small">Preço de Venda</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark border-secondary text-success">R$</span>
                                    <input type="text" id="valor_venda" name="valor_venda" class="form-control bg-dark text-white border-secondary money"
                                           value="<?= isset($produto['valor_venda']) ? number_format($produto['valor_venda'], 2, ',', '.') : '' ?>">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="valor_compra" class="form-label text-white-50 small">Preço de Custo</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark border-secondary text-secondary">R$</span>
                                    <input type="text" id="valor_compra" name="valor_compra" class="form-control bg-dark text-white border-secondary money"
                                           value="<?= isset($produto['valor_compra']) ? number_format($produto['valor_compra'], 2, ',', '.') : '' ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5 class="text-warning small text-uppercase fw-bold mb-4 tracking-wider">
                            <i class="bi bi-boxes me-1"></i> Controle de Estoque
                        </h5>

                        <div class="form-check form-switch mb-4">
                            <input type="checkbox" id="controlar_estoque" name="controlar_estoque" class="form-check-input"
                                   role="switch" <?= !empty($produto['controlar_estoque']) ? 'checked' : '' ?>>
                            <label for="controlar_estoque" class="form-check-label text-info fw-bold">Ativar Controle de Estoque</label>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="estoque_atual" class="form-label text-white-50 small">Qtd. em Estoque</label>
                                <input type="number" id="estoque_atual" name="estoque_atual" class="form-control bg-dark text-white border-secondary"
                                       value="<?= $produto['estoque_atual'] ?? 0 ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="estoque_alerta" class="form-label text-white-50 small">Alerta Mínimo</label>
                                <input type="number" id="estoque_alerta" name="estoque_alerta" class="form-control bg-dark text-white border-secondary"
                                       value="<?= $produto['estoque_alerta'] ?? 0 ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="id_fornecedor" class="form-label text-white-50 small">Fornecedor Padrão</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-secondary text-muted"><i class="bi bi-truck"></i></span>
                                <input type="number" id="id_fornecedor" name="id_fornecedor" class="form-control bg-dark text-muted border-secondary" value="1" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-top border-secondary mt-4 pt-4 text-end">
                    <a href="<?= $base ?>produto" class="btn btn-outline-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-success px-4 fw-bold">
                        <i class="bi bi-save me-1"></i> Salvar Produto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.tracking-wider { letter-spacing: 1px; }
.form-check-input:checked { background-color: #0dcaf0; border-color: #0dcaf0; }
</style>
