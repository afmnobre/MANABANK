<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="text-light m-0">👥 Selecionar Participantes</h2>
    <span class="badge bg-primary p-2" id="contadorParticipantes">
        0 Jogadores Selecionados
    </span>
</div>

<div class="bg-dark text-light p-3 rounded border border-secondary mb-3">
    <h5 class="mb-1 text-light"><?= htmlspecialchars($torneio['nome_torneio']) ?></h5>
    <p class="mb-0 small" style="color: #bbb;">
        <strong class="text-light">🎴 Cardgame:</strong> <?= htmlspecialchars($torneio['cardgame']) ?> |
        <strong class="text-light">⚙️ Tipo:</strong> <?= htmlspecialchars($torneio['tipo_legivel']) ?>
    </p>
</div>

<div class="mb-3">
  <button class="btn btn-warning"
          onclick="window.open('<?= $base ?>torneio/inscricaoQRCode/<?= $torneio['id_torneio'] ?>',
                               'InscricaoQRCode',
                               'width=400,height=450,menubar=no,toolbar=no,location=no,status=no');">
    📱 Abrir inscrição via QR Code
  </button>
</div>

<div class="mb-3">
    <div class="input-group">
        <span class="input-group-text bg-dark border-secondary text-light">🔍</span>
        <input type="text" id="buscaJogador" class="form-control bg-dark text-light border-secondary"
               placeholder="Digite o nome do jogador para filtrar...">
    </div>
</div>

<form action="<?= $base ?>torneio/salvarParticipantes/<?= $torneio['id_torneio'] ?>" method="POST"
      class="bg-dark text-light p-4 rounded border border-secondary">
    <div class="mb-3">
        <label class="form-label mb-3 text-light">Selecione os jogadores abaixo:</label>

        <div class="row" id="listaParticipantes">
            <?php foreach ($clientes as $cliente): ?>
                <div class="col-md-6 mb-2 item-jogador" data-nome="<?= strtolower(htmlspecialchars($cliente['nome'])) ?>">
                    <label class="list-group-item bg-dark text-light border-secondary d-flex justify-content-between align-items-center py-3 px-3 rounded"
                           style="cursor: pointer; border: 1px solid #444;">

                        <div class="text-truncate d-flex align-items-center">
                            <input type="checkbox" name="participantes[]" value="<?= $cliente['id_cliente'] ?>"
                                   class="form-check-input me-3" style="flex-shrink: 0;"
                                   <?= $cliente['inscrito'] ? 'checked' : '' ?>>

                            <div class="text-truncate">
                                <span class="fw-bold text-light nome-texto"><?= htmlspecialchars($cliente['nome']) ?></span>
                                <?php if (!empty($cliente['email'])): ?>
                                    <br class="d-md-none">
                                    <span class="ms-md-2 small" style="color: #aaa;">| <?= htmlspecialchars($cliente['email']) ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <span class="badge rounded-pill bg-secondary text-dark d-none d-lg-inline ms-3">
                            Cliente
                        </span>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="mt-4">
        <input type="hidden" name="id_torneio" value="<?= $torneio['id_torneio'] ?>">
        <button type="submit" class="btn btn-primary">💾 Confirmar Participantes</button>
        <a href="<?= $base ?>torneio" class="btn btn-secondary">↩️ Voltar</a>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputBusca = document.getElementById('buscaJogador');
    const contador = document.getElementById('contadorParticipantes');
    // Definimos a base para o JavaScript
    const BASE_URL = '<?= $base ?>';

    function atualizarContador() {
        const totalSelecionados = document.querySelectorAll('input[name="participantes[]"]:checked').length;
        contador.innerText = `${totalSelecionados} Jogadores Selecionados`;
        if (totalSelecionados > 0) {
            contador.classList.add('bg-primary');
            contador.classList.remove('bg-secondary');
        } else {
            contador.classList.add('bg-secondary');
            contador.classList.remove('bg-primary');
        }
    }

    function aplicarFiltro() {
        const termoBusca = inputBusca.value.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "");
        document.querySelectorAll('.item-jogador').forEach(item => {
            const nomeJogador = item.getAttribute('data-nome').normalize('NFD').replace(/[\u0300-\u036f]/g, "");
            item.style.display = nomeJogador.includes(termoBusca) ? 'block' : 'none';
        });
    }

    inputBusca.addEventListener('input', aplicarFiltro);

    document.addEventListener('change', function(e) {
        if (e.target.matches('input[name="participantes[]"]')) {
            atualizarContador();
        }
    });

    atualizarContador();

    function atualizarParticipantes() {
        const selecionados = [];
        document.querySelectorAll('input[name="participantes[]"]:checked').forEach(cb => {
            selecionados.push(cb.value);
        });

        // AJUSTADO: Utiliza BASE_URL para a chamada AJAX
        $.get(BASE_URL + 'torneio/listarAjax/<?= $torneio['id_torneio'] ?>', function(html){
            $('#listaParticipantes').html(html);

            selecionados.forEach(id => {
                const cb = document.querySelector(`input[name="participantes[]"][value="${id}"]`);
                if (cb) cb.checked = true;
            });

            atualizarContador();
            aplicarFiltro();
        });
    }

    setInterval(atualizarParticipantes, 5000);
});
</script>
