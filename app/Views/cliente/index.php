<?php if (!empty($_SESSION['flash'])): ?>
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> <?= htmlspecialchars($_SESSION['flash']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-white fw-bold mb-0">
            <i class="bi bi-people-fill me-2 text-primary"></i> Clientes da Loja
        </h2>

        <div class="d-flex gap-2">
            <a href="<?= $this->baseUrl ?>cliente/qrcode_perfil" target="_blank" class="btn btn-info btn-sm shadow-sm px-3 fw-bold">
                <i class="bi bi-qr-code-scan me-1"></i> QR Code Perfil
            </a>

            <a href="<?= $this->baseUrl ?>cliente/criar" class="btn btn-primary btn-sm shadow-sm px-3 fw-bold">
                <i class="bi bi-person-plus-fill me-1"></i> Novo Cliente
            </a>
        </div>
    </div>

    </div>

    <div class="card bg-dark border-secondary mb-4 shadow-sm">
        <div class="card-body p-2">
            <div class="input-group">
                <span class="input-group-text bg-transparent border-0 text-muted">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" id="buscaCliente" class="form-control bg-transparent text-white border-0 shadow-none"
                       placeholder="Filtrar por nome do cliente...">
            </div>
        </div>
    </div>

    <div class="card bg-dark border-secondary shadow-sm overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover align-middle mb-0">
                    <thead>
                        <tr class="border-secondary">
                            <th class="ps-4 py-3 text-uppercase tracking-wider small text-white-50">Nome do Cliente</th>
                            <th class="py-3 text-uppercase tracking-wider small text-white-50">Contato</th>
                            <th class="py-3 text-uppercase tracking-wider small text-white-50">Interesses</th>
                            <th class="py-3 text-end pe-4 text-uppercase tracking-wider small text-white-50">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="tabelaClientesCorpo">
                        <?php if (!empty($clientes)): ?>
                            <?php foreach ($clientes as $cliente): ?>
                                <tr class="item-cliente border-secondary" data-nome="<?= strtolower(htmlspecialchars($cliente['nome'])) ?>">
                                    <td class="ps-4">
                                        <span class="fw-bold text-info">
                                            <?= htmlspecialchars($cliente['nome']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="text-white small">
                                                <i class="bi bi-envelope-at text-warning me-1"></i> <?= htmlspecialchars($cliente['email']) ?>
                                            </span>
                                            <span class="text-white-50 small">
                                                <i class="bi bi-whatsapp text-success me-1"></i> <?= Utils::maskPhone($cliente['telefone']) ?>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2">
                                            <?php foreach ($cliente['cardgames'] as $game):
                                                $urlImagem = $base . "public/storage/uploads/cardgames/" . $game['id_cardgame'] . "/" . $game['imagem_fundo_card'];
                                            ?>
                                                <div class="magic-card-mini shadow-sm" title="<?= htmlspecialchars($game['nome']) ?>">
                                                    <img src="<?= $urlImagem ?>" alt="<?= htmlspecialchars($game['nome']) ?>">
                                                    <div class="overlay-mini"><?= mb_substr(htmlspecialchars($game['nome']), 0, 3) ?></div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group shadow-sm">
                                            <a href="<?= $this->baseUrl ?>cliente/editar/<?= $cliente['id_cliente'] ?>"
                                               class="btn btn-sm btn-outline-warning" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="<?= $this->baseUrl ?>cliente/excluir/<?= $cliente['id_cliente'] ?>"
                                               onclick="return confirm('Tem certeza que deseja excluir este cliente?')"
                                               class="btn btn-sm btn-outline-danger" title="Excluir">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bi bi-people d-block mb-2 opacity-25" style="font-size: 3rem;"></i>
                                    Nenhum cliente encontrado.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.tracking-wider { letter-spacing: 1px; }

/* Estilo para as miniaturas de CardGames na listagem */
.magic-card-mini {
    position: relative;
    width: 32px;
    height: 42px;
    border-radius: 3px;
    overflow: hidden;
    border: 1px solid #444;
}
.magic-card-mini img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.overlay-mini {
    position: absolute;
    bottom: 0;
    width: 100%;
    font-size: 5px;
    background: rgba(0,0,0,0.8);
    color: #fff;
    text-align: center;
    text-transform: uppercase;
    padding: 1px 0;
}

/* Ajustes de botões da tabela */
.btn-group .btn-sm {
    padding: 0.25rem 0.6rem;
    border-color: #444;
}
.btn-group .btn-outline-warning:hover { background-color: #ffc107; color: #000; }
.btn-group .btn-outline-danger:hover { background-color: #dc3545; color: #fff; }

#buscaCliente:focus { background-color: transparent !important; color: #fff; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputBusca = document.getElementById('buscaCliente');
    const itensClientes = document.querySelectorAll('.item-cliente');

    if (inputBusca) {
        inputBusca.addEventListener('input', function() {
            const termoBusca = this.value.toLowerCase()
                                        .normalize('NFD')
                                        .replace(/[\u0300-\u036f]/g, "");

            itensClientes.forEach(item => {
                const nomeCliente = item.getAttribute('data-nome')
                                        .normalize('NFD')
                                        .replace(/[\u0300-\u036f]/g, "");

                item.style.display = nomeCliente.includes(termoBusca) ? '' : 'none';
            });
        });
    }
});
</script>
