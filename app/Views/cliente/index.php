<?php if (!empty($_SESSION['flash'])): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= htmlspecialchars($_SESSION['flash']) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
  </div>
  <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
  <h2 class="text-light">Clientes da Loja</h2>
  <a href="<?= $this->baseUrl ?>cliente/criar" class="btn btn-primary btn-sm">➕ Novo Cliente</a>
</div>

<div class="card bg-dark border-secondary mb-3">
    <div class="card-body p-2">
        <div class="input-group">
            <span class="input-group-text bg-dark border-secondary text-light">🔍</span>
            <input type="text" id="buscaCliente" class="form-control bg-dark text-light border-secondary"
                   placeholder="Digite o nome do cliente para filtrar...">
        </div>
    </div>
</div>

<div class="table-responsive">
  <table class="table table-dark table-striped table-hover align-middle">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>CardGames</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody id="tabelaClientesCorpo">
      <?php if (!empty($clientes)): ?>
        <?php foreach ($clientes as $cliente): ?>
          <tr class="item-cliente" data-nome="<?= strtolower(htmlspecialchars($cliente['nome'])) ?>">
            <td><?= htmlspecialchars($cliente['nome']) ?></td>
            <td><?= htmlspecialchars($cliente['email']) ?></td>
            <td class="telefone-coluna"><?= htmlspecialchars($cliente['telefone']) ?></td>
			<td>
				<div class="d-flex flex-wrap gap-1">
				  <?php foreach ($cliente['cardgames'] as $game):
					// Usamos a variável $base que já foi criada lá no header.php
					$urlImagem = $base . "public/storage/uploads/cardgames/" . $game['id_cardgame'] . "/" . $game['imagem_fundo_card'];
				  ?>
					<div class="cliente-cardgame-thumb text-center"
						 title="<?= htmlspecialchars($game['nome']) ?>"
						 style="background-image: url('<?= $urlImagem ?>');
								background-size: cover;
								background-position: center;
								width: 60px;
								height: 80px;
								position: relative;
								border-radius: 4px;
								border: 1px solid #444;">
					  <span class="cliente-cardgame-name bg-dark bg-opacity-75 text-light small px-1"
							style="position:absolute; bottom:0; left:0; right:0; font-size: 10px;">
						<?= htmlspecialchars($game['nome']) ?>
					  </span>
					</div>
				  <?php endforeach; ?>
				</div>
			</td>             <td>
              <a href="<?= $this->baseUrl ?>cliente/editar/<?= $cliente['id_cliente'] ?>" class="btn btn-warning btn-sm">✏️ Editar</a>
              <a href="<?= $this->baseUrl ?>cliente/excluir/<?= $cliente['id_cliente'] ?>"
                 onclick="return confirm('Tem certeza que deseja excluir este cliente?')"
                 class="btn btn-danger btn-sm">🗑️ Excluir</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr id="semResultados">
          <td colspan="5" class="text-center text-muted">Nenhum cliente cadastrado ainda.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

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
