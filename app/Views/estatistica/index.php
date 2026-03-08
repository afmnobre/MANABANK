<div class="container-fluid mb-5">
    <div class="row mb-4 align-items-center g-3">
        <div class="col-md-6">
            <h2 class="fw-bold text-white mb-0">
                <i class="bi bi-bar-chart-line text-warning me-2"></i> Estatísticas
            </h2>
            <p class="text-white-50 small mb-0">Análise de performance, engajamento e dominância de mercado.</p>
        </div>
        <div class="col-md-6">
            <form method="GET" class="d-flex gap-2 justify-content-md-end">
                <select name="mes" class="form-select bg-dark text-white border-secondary w-auto shadow-sm">
                    <option value="0" <?= $mes_sel == 0 ? 'selected' : '' ?>>📅 Todos os Meses</option>
                    <?php
                    $meses = [1=>'Janeiro', 2=>'Fevereiro', 3=>'Março', 4=>'Abril', 5=>'Maio', 6=>'Junho', 7=>'Julho', 8=>'Agosto', 9=>'Setembro', 10=>'Outubro', 11=>'Novembro', 12=>'Dezembro'];
                    foreach($meses as $n => $m): ?>
                        <option value="<?= $n ?>" <?= $mes_sel == $n ? 'selected' : '' ?>><?= $m ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="ano" class="form-select bg-dark text-white border-secondary w-auto shadow-sm">
                    <?php for($a=2024; $a<=2027; $a++): ?>
                        <option value="<?= $a ?>" <?= $ano_sel == $a ? 'selected' : '' ?>><?= $a ?></option>
                    <?php endfor; ?>
                </select>
                <button type="submit" class="btn btn-primary px-3 fw-bold">
                    <i class="bi bi-funnel-fill"></i> Filtrar
                </button>
            </form>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-4 col-md-6">
            <div class="card bg-dark border-secondary h-100 shadow-sm">
                <div class="card-header border-secondary bg-transparent py-3">
                    <h6 class="text-info fw-bold mb-0 text-uppercase tracking-wider">
                        <i class="bi bi-pie-chart me-2"></i> Popularidade por Jogo
                    </h6>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center p-4">
                    <div style="position: relative; height:250px; width:100%">
                        <canvas id="chartPopularidade"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card bg-dark border-secondary h-100 shadow-sm">
                <div class="card-header border-secondary bg-transparent py-3">
                    <h6 class="text-warning fw-bold mb-0 text-uppercase tracking-wider">
                        <i class="bi bi-trophy me-2"></i> Top Vencedores
                    </h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover mb-0 align-middle">
                            <thead>
                                <tr class="text-white-50 small border-secondary">
                                    <th class="ps-3 border-0">Jogador</th>
                                    <th class="text-center border-0">Títulos</th>
                                </tr>
                            </thead>
                            <tbody class="border-top-0">
                                <?php foreach($dados['vencedores'] as $v): ?>
                                    <tr class="border-secondary">
                                        <td class="ps-3 fw-bold"><?= htmlspecialchars($v['nome']) ?></td>
                                        <td class="text-center">
                                            <span class="badge bg-warning text-dark rounded-pill px-3"><?= $v['vitorias'] ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12">
            <div class="card bg-dark border-secondary h-100 shadow-sm">
                <div class="card-header border-secondary bg-transparent py-3">
                    <h6 class="text-success fw-bold mb-0 text-uppercase tracking-wider">
                        <i class="bi bi-people me-2"></i> Clientes Assíduos
                    </h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover mb-0 align-middle">
                            <thead>
                                <tr class="text-white-50 small border-secondary">
                                    <th class="ps-3 border-0">Cliente</th>
                                    <th class="text-center border-0">Presenças</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($dados['frequencia'] as $f): ?>
                                    <tr class="border-secondary">
                                        <td class="ps-3"><?= htmlspecialchars($f['nome']) ?></td>
                                        <td class="text-center text-success fw-bold">
                                            <i class="bi bi-calendar-check me-1"></i> <?= $f['total_presencas'] ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card bg-dark border-secondary shadow-sm">
                <div class="card-header border-secondary bg-transparent d-flex justify-content-between align-items-center">
                    <h6 class="text-white fw-bold mb-0 text-uppercase tracking-wider">
                        <i class="bi bi-graph-up-arrow me-2 text-info"></i> Inscrições em Torneios: <?= $ano_ant ?> vs <?= $ano_sel ?>
                    </h6>
                    <span class="badge bg-dark border border-secondary text-white-50">Comparativo Anual</span>
                </div>
                <div class="card-body p-4">
                    <div style="height: 300px;">
                        <canvas id="chartEvolucao"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card bg-dark border-secondary shadow-sm">
                <div class="card-header border-secondary bg-transparent d-flex justify-content-between align-items-center py-3">
                    <h6 class="text-white fw-bold mb-0 text-uppercase tracking-wider">
                        <i class="bi bi-stars text-warning me-2"></i> Dominância Mensal: Cardgame em Destaque (<?= $ano_sel ?>)
                    </h6>
                </div>
                <div class="card-body p-4">
                    <div style="height: 350px;">
                        <canvas id="chartDominancia"></canvas>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-secondary py-2">
                    <small class="text-white-50 italic">As logos representam o jogo com maior volume de torneios no respectivo mês.</small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.tracking-wider { letter-spacing: 1.2px; font-size: 0.85rem; }
.card { transition: transform 0.2s; }
.card:hover { border-color: #555 !important; }
.table th { font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const baseUrl = "<?= $base ?>";

    // 1. Gráfico de Popularidade (Doughnut)
    new Chart(document.getElementById('chartPopularidade'), {
        type: 'doughnut',
        data: {
            labels: <?= json_encode(array_column($dados['popularidade_cardgames'], 'nome')) ?>,
            datasets: [{
                data: <?= json_encode(array_column($dados['popularidade_cardgames'], 'total_torneios')) ?>,
                backgroundColor: ['#0d6efd', '#ffc107', '#dc3545', '#fd7e14', '#6610f2', '#198754'],
                hoverOffset: 15,
                borderWidth: 2,
                borderColor: '#212529'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { color: '#aaa', padding: 20, font: { size: 11 } }
                }
            },
            cutout: '70%'
        }
    });

    // 2. Gráfico de Evolução (Line)
    new Chart(document.getElementById('chartEvolucao'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            datasets: [
                {
                    label: 'Ano <?= $ano_ant ?>',
                    data: <?= json_encode($dados['evolucao_anterior']) ?>,
                    borderColor: '#6c757d',
                    borderDash: [5, 5],
                    tension: 0.3,
                    fill: false
                },
                {
                    label: 'Ano <?= $ano_sel ?>',
                    data: <?= json_encode($dados['evolucao_atual']) ?>,
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13, 110, 253, 0.1)',
                    tension: 0.3,
                    pointBackgroundColor: '#0d6efd',
                    fill: true
                }
            ]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: { grid: { color: '#333' }, ticks: { color: '#aaa' } },
                x: { grid: { display: false }, ticks: { color: '#aaa' } }
            },
            plugins: { legend: { labels: { color: '#fff' } } }
        }
    });

    // 3. Gráfico de Dominância Mensal (Barra com Logo)
    document.addEventListener("DOMContentLoaded", function() {
        const dadosD = <?= json_encode($dados['dominancia_mensal'] ?? ['nomes'=>[], 'valores'=>[], 'imagens'=>[], 'ids'=>[]]) ?>;
        const canvasDom = document.getElementById('chartDominancia');
        if (!canvasDom || !dadosD.valores.length) return;

        const ctxD = canvasDom.getContext('2d');
        const imgObjs = {};

        // Pré-carregamento
        dadosD.imagens.forEach((imgNome, i) => {
            if (imgNome && dadosD.ids[i]) {
                const img = new Image();
                img.src = `${baseUrl}public/storage/uploads/cardgames/${dadosD.ids[i]}/${imgNome}`;
                imgObjs[i] = img;
                img.onload = () => chartDominancia.draw();
            }
        });

        const chartDominancia = new Chart(ctxD, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                datasets: [{
                    data: dadosD.valores,
                    backgroundColor: 'rgba(13, 110, 253, 0.2)',
                    borderColor: '#0d6efd',
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: { label: (ctx) => ` ${dadosD.nomes[ctx.dataIndex]}: ${ctx.raw} Torneios` }
                    }
                },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#333' }, ticks: { color: '#aaa' } },
                    x: { ticks: { color: '#fff', font: { weight: 'bold' } }, grid: { display: false } }
                }
            },
            plugins: [{
                id: 'barImageInsideDraw',
                afterDraw(chart) {
                    const { ctx } = chart;
                    chart.getDatasetMeta(0).data.forEach((bar, i) => {
                        const img = imgObjs[i];
                        if (img && img.complete && dadosD.valores[i] > 0) {
                            const size = bar.width * 0.6;
                            const centerY = (bar.y + bar.base) / 2;
                            ctx.drawImage(img, bar.x - size / 2, centerY - size / 2, size, size);
                        }
                    });
                }
            }]
        });
    });
</script>
