<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

<div class="container-fluid text-white">
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <div class="d-flex align-items-center">
                <div>
                    <h2 class="fw-bold mb-0 text-white" style="font-size: 1.5rem;">
                        Análise: <?= htmlspecialchars($lote['referencia_periodo']) ?>
                    </h2>
                    <span class="badge bg-dark text-white-50 border border-secondary">Lote #<?= $lote['id_lote'] ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <button onclick="window.exportarParaExcel()" class="btn btn-success fw-bold shadow-sm px-4">
                <i class="bi bi-file-earmark-excel me-2"></i> Gerar Relatório Excel
            </button>
            <a href="<?= $base ?>importacao" class="btn btn-outline-light fw-bold shadow-sm px-4 ms-2">
                <i class="bi bi-arrow-left me-2"></i> Voltar
            </a>
        </div>
    </div>

    <?php
        $totalSelado = 0;
        $totalSingles = 0;
        foreach($dadosTipo as $dt) {
            if (stripos($dt['tipo_produto'], 'Produto') !== false) {
                $totalSelado += (float)$dt['total'];
            } else {
                $totalSingles += (float)$dt['total'];
            }
        }
    ?>

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card bg-dark border-info p-3 h-100 text-center shadow-sm">
                <small class="text-white-50 text-uppercase fw-bold">Total em Singles (Avulsas)</small>
                <h3 class="text-info fw-bold mb-0">R$ <?= number_format($totalSingles, 2, ',', '.') ?></h3>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-dark border-warning p-3 h-100 text-center shadow-sm">
                <small class="text-white-50 text-uppercase fw-bold">Total em Produtos Selados</small>
                <h3 class="text-warning fw-bold mb-0">R$ <?= number_format($totalSelado, 2, ',', '.') ?></h3>
            </div>
        </div>
    </div>

    <div class="row mb-4 g-3">
        <div class="col-md-4">
            <div class="card bg-dark border-secondary h-100 shadow-sm">
                <div class="card-header bg-black text-white small fw-bold text-center">RECEITA POR CARDGAME</div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <canvas id="chartCardgames" style="max-height: 250px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-dark border-secondary h-100 shadow-sm">
                <div class="card-header bg-black text-white small fw-bold text-center">FORMA DE PAGAMENTO</div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <canvas id="chartPagamento" style="max-height: 250px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-dark border-secondary h-100 shadow-sm">
                <div class="card-header bg-black text-white small fw-bold text-center">MÉTODO DE ENVIO</div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <canvas id="chartEnvio" style="max-height: 250px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4 bg-dark border-secondary">
        <div class="card-header py-3 bg-black">
            <h6 class="m-0 font-weight-bold text-primary text-uppercase small">Faturamento por Categoria</h6>
        </div>
        <div class="card-body">
            <div style="height: 300px;">
                <canvas id="chartCategorias"></canvas>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4 bg-dark border-info">
        <div class="card-header py-3 bg-black border-info">
            <h6 class="m-0 font-weight-bold text-info text-uppercase small">Detalhamento por Categoria</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="tabelaCategorias" class="table table-dark table-hover table-striped mb-0">
                    <thead>
                        <tr class="text-info small">
                            <th class="ps-4">CATEGORIA COMPLETA</th>
                            <th class="text-center">QTD ITENS</th>
                            <th class="text-end pe-4">TOTAL (R$)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($dadosCategorias)): foreach ($dadosCategorias as $cat): ?>
                        <tr>
                            <td class="ps-4 small"><?= htmlspecialchars($cat['categoria_completa']) ?></td>
                            <td class="text-center">
                                <span class="badge bg-info text-dark"><?= $cat['total_qtd'] ?></span>
                            </td>
                            <td class="text-end pe-4 fw-bold">R$ <?= number_format($cat['total_valor'], 2, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="3" class="text-center py-3 text-muted">Nenhum dado encontrado.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-dark border-warning shadow-sm">
                <div class="card-header border-warning bg-black py-3">
                    <h6 class="text-warning mb-0 small text-uppercase fw-bold">
                        <i class="bi bi-box-seam me-2"></i> Inventário de Produtos Selados
                    </h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="tabelaSelados" class="table table-dark table-hover align-middle mb-0">
                            <thead>
                                <tr class="text-white-50 small border-secondary">
                                    <th class="ps-4">PRODUTO</th>
                                    <th>CARDGAME</th>
                                    <th class="text-center">QTD</th>
                                    <th class="text-end pe-4">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($listaSelados)): foreach($listaSelados as $selado): ?>
                                    <tr class="border-secondary">
                                        <td class="ps-4 fw-bold small"><?= htmlspecialchars($selado['nome_produto']) ?></td>
                                        <td><span class="badge bg-dark border border-secondary text-info"><?= $selado['jogo'] ?></span></td>
                                        <td class="text-center fw-bold"><?= $selado['quantidade'] ?></td>
                                        <td class="text-end pe-4 text-success fw-bold">R$ <?= number_format($selado['total'], 2, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach; else: ?>
                                    <tr><td colspan="4" class="text-center py-3 text-muted">Nenhum selado neste lote.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card bg-dark border-secondary mb-4 shadow-sm">
                <div class="card-header bg-black text-white small fw-bold">DETALHES DE PAGAMENTO</div>
                <div class="card-body p-0">
                    <table id="tabelaPagto" class="table table-dark mb-0">
                        <?php foreach($dadosPagto as $p): ?>
                            <tr>
                                <td class="small ps-3"><?= $p['forma_pagamento'] ?></td>
                                <td class="text-end pe-3 text-success">R$ <?= number_format($p['total'], 2, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
            <div class="card bg-dark border-secondary shadow-sm">
                <div class="card-header bg-black text-white small fw-bold">MÉTODOS DE ENVIO</div>
                <div class="card-body p-0">
                    <table id="tabelaEnvio" class="table table-dark mb-0">
                        <?php foreach($dadosEnvio as $e): ?>
                            <tr>
                                <td class="small ps-3"><?= $e['forma_envio'] ?></td>
                                <td class="text-end pe-3"><?= $e['qtd_pedidos'] ?> ordens</td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card bg-dark border-secondary h-100 shadow-sm">
                <div class="card-header border-secondary bg-black py-3">
                    <h6 class="text-white mb-0 small text-uppercase fw-bold">Top Itens do Lote</h6>
                </div>
                <div class="card-body p-0">
                    <table id="tabelaTopItens" class="table table-dark table-striped align-middle mb-0">
                        <thead>
                            <tr class="text-white-50 small border-secondary">
                                <th class="ps-3">PRODUTO</th>
                                <th>CARDGAME</th>
                                <th class="text-end pe-3">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($topProdutos as $p): ?>
                                <tr class="border-secondary">
                                    <td class="ps-3 fw-bold small"><?= htmlspecialchars($p['nome_produto']) ?></td>
                                    <td><span class="badge bg-dark border border-secondary text-info"><?= $p['jogo'] ?></span></td>
                                    <td class="text-end pe-3 text-success fw-bold">R$ <?= number_format($p['total'], 2, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
window.renderizarGraficos = function() {
    const cores = ['#0dcaf0', '#198754', '#ffc107', '#fd7e14', '#6610f2', '#0d6efd', '#dc3545'];
    const legendaConfig = { color: '#fff', font: { size: 11 } };

    // 1. Cardgames
    const dadosCard = <?= json_encode($dadosGraficoCardgame ?? []) ?>;
    if (dadosCard.length > 0) {
        new Chart(document.getElementById('chartCardgames'), {
            type: 'pie',
            data: {
                labels: dadosCard.map(item => item.cardgame),
                datasets: [{
                    data: dadosCard.map(item => item.total),
                    backgroundColor: ['#0dcaf0', '#198754', '#ffc107', '#6c757d'],
                    borderColor: '#212529',
                    borderWidth: 2
                }]
            },
            options: { responsive: true, plugins: { legend: { position: 'bottom', labels: legendaConfig } } }
        });
    }

    // 2. Pagamento
    const dPagto = <?= json_encode($dadosPagto ?? []) ?>;
    if (dPagto.length > 0) {
        new Chart(document.getElementById('chartPagamento'), {
            type: 'pie',
            data: {
                labels: dPagto.map(item => item.forma_pagamento),
                datasets: [{
                    data: dPagto.map(item => item.total),
                    backgroundColor: cores.slice().reverse(),
                    borderColor: '#212529',
                    borderWidth: 2
                }]
            },
            options: { responsive: true, plugins: { legend: { position: 'bottom', labels: legendaConfig } } }
        });
    }

    // 3. Envio
    const dEnvio = <?= json_encode($dadosEnvio ?? []) ?>;
    if (dEnvio.length > 0) {
        new Chart(document.getElementById('chartEnvio'), {
            type: 'pie',
            data: {
                labels: dEnvio.map(item => item.forma_envio),
                datasets: [{
                    data: dEnvio.map(item => item.qtd_pedidos),
                    backgroundColor: ['#20c997', '#e83e8c', '#fd7e14', '#6f42c1'],
                    borderColor: '#212529',
                    borderWidth: 2
                }]
            },
            options: { responsive: true, plugins: { legend: { position: 'bottom', labels: legendaConfig } } }
        });
    }

    // 4. Categorias (Barras)
    const lCat = <?= json_encode(array_column($dadosCategorias ?? [], 'categoria_completa')) ?>;
    const vCat = <?= json_encode(array_column($dadosCategorias ?? [], 'total_valor')) ?>;
    if (lCat.length > 0) {
        new Chart(document.getElementById("chartCategorias"), {
            type: 'bar',
            data: {
                labels: lCat,
                datasets: [{
                    label: "Total Vendido (R$)",
                    backgroundColor: "#4e73df",
                    data: vCat,
                }],
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, ticks: { color: '#fff', callback: v => 'R$ ' + v.toLocaleString('pt-BR') } },
                    x: { ticks: { color: '#fff', font: { size: 10 } } }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(c) {
                                return "Total: " + new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(c.parsed.y);
                            }
                        }
                    }
                }
            }
        });
    }
};

window.exportarParaExcel = function() {
    const wb = XLSX.utils.book_new();
    const ref = "<?= addslashes($lote['referencia_periodo']) ?>";
    const nomeArq = `Analise_Lote_${ref.replace(/ /g, '_')}.xlsx`;

    const addSheet = (id, name) => {
        const el = document.getElementById(id);
        if(el) XLSX.utils.book_append_sheet(wb, XLSX.utils.table_to_sheet(el), name);
    };

    addSheet('tabelaCategorias', "Resumo Categorias");
    addSheet('tabelaSelados', "Produtos Selados");
    addSheet('tabelaTopItens', "Top 15 Itens");

    // Aba Financeira unificada
    const wsFin = XLSX.utils.table_to_sheet(document.getElementById('tabelaPagto'));
    XLSX.utils.sheet_add_dom(wsFin, document.getElementById('tabelaEnvio'), {origin: -1});
    XLSX.utils.book_append_sheet(wb, wsFin, "Financeiro e Envio");

    XLSX.writeFile(wb, nomeArq);
};

document.addEventListener('DOMContentLoaded', window.renderizarGraficos);
</script>
