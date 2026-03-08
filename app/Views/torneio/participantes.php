<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-white fw-bold m-0">
        <i class="bi bi-people-fill me-2 text-primary"></i> Selecionar Participantes
    </h2>
    <span class="badge bg-primary px-3 py-2 shadow-sm" id="contadorParticipantes" style="font-size: 0.9rem;">
        0 Jogadores Selecionados
    </span>
</div>

<div class="bg-dark text-white p-3 rounded border border-secondary mb-4 shadow-sm">
    <h5 class="mb-2 fw-bold text-info"><i class="bi bi-info-circle me-1"></i> <?= htmlspecialchars($torneio['nome_torneio']) ?></h5>
    <div class="d-flex flex-wrap gap-3 small text-white-50">
        <span><strong class="text-white"><i class="bi bi-controller me-1"></i> Cardgame:</strong> <?= htmlspecialchars($torneio['cardgame']) ?></span>
        <span class="d-none d-md-inline">|</span>
        <span><strong class="text-white"><i class="bi bi-diagram-3 me-1"></i> Tipo:</strong> <?= htmlspecialchars($torneio['tipo_legivel']) ?></span>
    </div>
</div>

<div class="row mb-4 g-3">
    <div class="col-md-4">
        <button class="btn btn-warning w-100 fw-bold shadow-sm"
                onclick="window.open('<?= $base ?>torneio/inscricaoQRCode/<?= $torneio['id_torneio'] ?>',
                'InscricaoQRCode', 'width=400,height=450,menubar=no,toolbar=no,location=no,status=no');">
            <i class="bi bi-qr-code-scan me-2"></i> Inscrição via QR Code
        </button>
    </div>
    <div class="col-md-8">
        <div class="input-group shadow-sm">
            <span class="input-group-text bg-dark border-secondary text-white"><i class="bi bi-search"></i></span>
            <input type="text" id="buscaJogador" class="form-control bg-dark text-white border-secondary"
                   placeholder="Digite o nome do jogador para filtrar...">
        </div>
    </div>
</div>

<form action="<?= $base ?>torneio/salvarParticipantes/<?= $torneio['id_torneio'] ?>" method="POST"
      class="bg-dark text-white p-4 rounded border border-secondary shadow-lg">

    <div class="mb-4">
        <label class="form-label mb-3 text-white-50 small fw-bold text-uppercase">Lista de Clientes Disponíveis</label>

        <div class="row g-2" id="listaParticipantes">
            <?php foreach ($clientes as $cliente): ?>
                <div class="col-md-6 item-jogador" data-nome="<?= strtolower(htmlspecialchars($cliente['nome'])) ?>">
                    <label class="list-group-item bg-dark text-white border-secondary d-flex justify-content-between align-items-center py-3 px-3 rounded player-card shadow-sm"
                           style="cursor: pointer; transition: all 0.2s ease;">

                        <div class="text-truncate d-flex align-items-center w-100">
                            <input type="checkbox" name="participantes[]" value="<?= $cliente['id_cliente'] ?>"
                                   class="form-check-input me-3 border-secondary bg-dark" style="width: 1.2rem; height: 1.2rem; flex-shrink: 0;"
                                   <?= $cliente['inscrito'] ? 'checked' : '' ?>>

                            <div class="text-truncate">
                                <span class="fw-bold text-white d-block mb-0"><?= htmlspecialchars($cliente['nome']) ?></span>
                                <?php if (!empty($cliente['email'])): ?>
                                    <small class="text-white-50"><i class="bi bi-envelope small me-1"></i><?= htmlspecialchars($cliente['email']) ?></small>
                                <?php endif; ?>
                            </div>
                        </div>

                        <i class="bi bi-person-check-fill ms-2 text-primary opacity-50 check-icon d-none"></i>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="mt-5 d-flex gap-2">
        <input type="hidden" name="id_torneio" value="<?= $torneio['id_torneio'] ?>">
        <button type="submit" class="btn btn-success px-4 fw-bold">
            <i class="bi bi-check-lg me-1"></i> Confirmar Participantes
        </button>
        <a href="<?= $base ?>torneio" class="btn btn-outline-light px-4">
            <i class="bi bi-arrow-left me-1"></i> Voltar
        </a>
    </div>
</form>

<style>
/* Efeito de hover nos cards de jogadores */
.player-card:hover {
    background-color: #2c3034 !important;
    border-color: #0d6efd !important;
}

/* Estilo para quando o checkbox está marcado (via CSS para feedback imediato) */
.player-card:has(input:checked) {
    border-color: #198754 !important;
    background-color: rgba(25, 135, 84, 0.1) !important;
}

.player-card:has(input:checked) .check-icon {
    display: block !important;
}

.form-control::placeholder {
    color: rgba(255, 255, 255, 0.4) !important;
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputBusca = document.getElementById('buscaJogador');
    const contador = document.getElementById('contadorParticipantes');
    const BASE_URL = '<?= $base ?>';

    function atualizarContador() {
        const totalSelecionados = document.querySelectorAll('input[name="participantes[]"]:checked').length;
        contador.innerText = `${totalSelecionados} Jogadores Selecionados`;

        if (totalSelecionados > 0) {
            contador.classList.replace('bg-secondary', 'bg-primary');
        } else {
            contador.classList.replace('bg-primary', 'bg-secondary');
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

    // Intervalo de atualização automática mantido em 5s
    setInterval(atualizarParticipantes, 5000);
});
</script>
