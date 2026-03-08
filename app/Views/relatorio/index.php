
	<div class="container-fluid">
		<div class="d-flex justify-content-between align-items-center mb-4">
			<h2 class="text-white fw-bold mb-0">
				<i class="bi bi-graph-up-arrow me-2 text-primary"></i> Dashboard Financeiro
			</h2>
			<div class="d-flex align-items-center">
				<button id="btnExportPDFTop" class="btn btn-outline-success btn-sm fw-bold shadow-sm px-3">
					<i class="bi bi-file-earmark-excel me-1"></i> Exportar Planilha
				</button>
			</div>
		</div>




        <div class="card bg-dark border-secondary mb-4 shadow-sm">
            <div class="card-body py-2">
                <form method="GET" action="<?= $base ?>relatorio" class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label text-secondary small mb-1">Mês</label>
                        <select name="mes" id="filtroMes" class="form-select form-select-sm bg-black text-light border-secondary shadow-none">
                            <option value="0" <?= ($mes_selecionado == 0) ? 'selected' : '' ?>>Todos os Meses</option>
                            <?php
                            $meses = [1=>'Janeiro', 2=>'Fevereiro', 3=>'Março', 4=>'Abril', 5=>'Maio', 6=>'Junho', 7=>'Julho', 8=>'Agosto', 9=>'Setembro', 10=>'Outubro', 11=>'Novembro', 12=>'Dezembro'];
                            foreach($meses as $num => $nome):
                                $sel = ($num == $mes_selecionado) ? 'selected' : '';
                            ?>
                                <option value="<?= $num ?>" <?= $sel ?>><?= $nome ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-secondary small mb-1">Ano</label>
                        <select name="ano" id="filtroAno" class="form-select form-select-sm bg-black text-light border-secondary shadow-none">
                            <?php foreach(($anos_disponiveis ?? [date('Y')]) as $a): ?>
                                <option value="<?= $a ?>" <?= ($a == $ano_selecionado) ? 'selected' : '' ?>><?= $a ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-sm w-100 fw-bold">
                            <i class="bi bi-filter me-1"></i> Filtrar Dados
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row g-3 mb-4" id="kpis"></div>

        <div class="card bg-dark border-secondary mb-4 shadow-sm">
            <div class="card-body">
                <h6 class="text-light mb-3 small text-uppercase fw-bold opacity-75">Comparativo Mensal</h6>
                <div style="height: 300px;"><canvas id="graficoMensal"></canvas></div>
            </div>
        </div>

        <div class="card bg-dark border-secondary mb-4 shadow-sm">
            <div class="card-header bg-black text-light border-secondary py-2">
                <i class="bi bi-table me-2 text-info"></i><span class="fw-bold small text-uppercase">Relatório Detalhado Anual</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-dark table-hover m-0" id="tblDesempenho">
                        <thead class="small text-secondary">
                            <tr>
                                <th>Mês</th><th>Média/Dia</th><th>Média/Sem</th><th>Total Mês</th><th>Média/Ped</th><th>Média/Cli</th><th>Menor</th><th>Maior</th>
                            </tr>
                        </thead>
                        <tbody class="border-top border-secondary"></tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card bg-dark border-secondary h-100 shadow-sm">
                    <div class="card-body">
                        <h6 class="text-light small text-uppercase fw-bold mb-3">Top 5 Clientes</h6>
                        <table class="table table-dark table-sm mb-3" id="tblClientes"><tbody></tbody></table>
                        <div style="height: 200px;"><canvas id="graficoClientes"></canvas></div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-dark border-secondary h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="text-light small text-uppercase fw-bold m-0">Top 5 Produtos</h6>
                            <select id="filtroGraficoProdutos" class="form-select form-select-sm w-auto bg-black text-light border-secondary py-0 px-2" style="font-size: 0.75rem;">
                                <option value="quantidade">Qtd</option>
                                <option value="valor">R$</option>
                            </select>
                        </div>
                        <table class="table table-dark table-sm mb-3" id="tblProdutos"><tbody></tbody></table>
                        <div style="height: 200px;"><canvas id="graficoProdutos"></canvas></div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-dark border-secondary h-100 shadow-sm">
                    <div class="card-body">
                        <h6 class="text-light small text-uppercase fw-bold mb-3"><i class="bi bi-credit-card me-2"></i>Pagamentos</h6>
                        <table class="table table-dark table-sm mb-3" id="tblPagamentos">
                            <thead>
                                <tr class="text-secondary" style="font-size: 0.75rem;">
                                    <th>Tipo</th><th class="text-end">Total</th><th class="text-center">%</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <div style="height: 180px;"><canvas id="graficoPagamentos"></canvas></div>
                    </div>
                </div>
            </div>
        </div>



<script>
// 1. Definição de Variáveis Globais e Configurações
window.graficoMensal = null;
window.graficoPagamentos = null;
window.graficoClientes = null;
window.graficoProdutos = null;
window.modoGraficoProdutos = 'quantidade';
window.BASE_URL = '<?= $base ?>';
window.coresPalette = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#6f42c1', '#fd7e14'];

// Configuração Global do Chart.js para o tema Dark do MANABANK
if (typeof Chart !== 'undefined') {
    Chart.defaults.color = '#FFF';
    Chart.defaults.borderColor = 'rgba(255,255,255,0.1)';
}

// 2. Função Principal de Carregamento
window.carregarDashboard = function() {
    if (typeof Chart === 'undefined') return;

    const ano = document.getElementById('filtroAno').value;
    const mes = document.getElementById('filtroMes').value;

    fetch(`${window.BASE_URL}relatorio/dados?ano=${ano}&mes=${mes}`)
        .then(res => res.json())
        .then(data => {
            window.renderKPI(data.metricas);
            window.renderMensal(data.comparativo);
            window.renderDesempenho(data.desempenho);
            window.renderTopClientes(data.topClientes);
            window.renderTopProdutos(data.topProdutos);
            window.renderPagamentos(data.pagamentos);
        })
        .catch(err => console.error('Erro ao carregar dashboard:', err));
};

// 3. Funções de Renderização (KPIs e Tabelas)
window.renderKPI = function(metricas) {
    const kpiDiv = document.getElementById('kpis');
    if(!kpiDiv) return;

    const totalAno = metricas.reduce((acc,m) => acc + parseFloat(m.total_mes || 0), 0);
    const totalPedidos = metricas.reduce((acc,m) => acc + parseInt(m.pedidos_mes || 0), 0);
    const ticketMedio = totalPedidos > 0 ? (totalAno / totalPedidos) : 0;

    const cards = [
        {titulo:'Total do Período', valor: totalAno.toLocaleString('pt-BR',{style:'currency',currency:'BRL'})},
        {titulo:'Total de Pedidos', valor: totalPedidos},
        {titulo:'Ticket Médio', valor: ticketMedio.toLocaleString('pt-BR',{style:'currency',currency:'BRL'})}
    ];

    kpiDiv.innerHTML = cards.map(c => `
        <div class="col-md-4 mb-3">
            <div class="card bg-dark border-secondary p-3 text-center h-100 shadow-sm">
                <h6 class="text-secondary small text-uppercase fw-bold">${c.titulo}</h6>
                <h4 class="mb-0 text-white fw-bold">${c.valor}</h4>
            </div>
        </div>`).join('');
};

window.renderDesempenho = function(dados) {
    const tbody = document.querySelector('#tblDesempenho tbody');
    if(!tbody) return;
    tbody.innerHTML = Object.keys(dados).map(mes => {
        const d = dados[mes];
        return `<tr>
            <td class="fw-bold text-primary">${mes}</td>
            <td>${parseFloat(d.media_dia).toLocaleString('pt-BR',{style:'currency',currency:'BRL'})}</td>
            <td>${parseFloat(d.media_semana).toLocaleString('pt-BR',{style:'currency',currency:'BRL'})}</td>
            <td class="fw-bold">${parseFloat(d.total_mes).toLocaleString('pt-BR',{style:'currency',currency:'BRL'})}</td>
            <td>${parseFloat(d.media_pedido).toLocaleString('pt-BR',{style:'currency',currency:'BRL'})}</td>
            <td>${parseFloat(d.media_cliente).toLocaleString('pt-BR',{style:'currency',currency:'BRL'})}</td>
            <td class="text-danger">${parseFloat(d.menor_pedido).toLocaleString('pt-BR',{style:'currency',currency:'BRL'})}</td>
            <td class="text-success">${parseFloat(d.maior_pedido).toLocaleString('pt-BR',{style:'currency',currency:'BRL'})}</td>
        </tr>`;
    }).join('');
};

// 4. Funções de Gráficos
window.renderMensal = function(dados) {
    const anoAtual = parseInt(document.getElementById('filtroAno').value);
    const anoAnterior = anoAtual - 1;
    let valoresAnoAtual = new Array(12).fill(0), valoresAnoAnterior = new Array(12).fill(0);

    dados.forEach(d => {
        const idx = parseInt(d.mes) - 1;
        if(parseInt(d.ano) === anoAtual) valoresAnoAtual[idx] = d.total;
        if(parseInt(d.ano) === anoAnterior) valoresAnoAnterior[idx] = d.total;
    });

    if(window.graficoMensal) window.graficoMensal.destroy();
    window.graficoMensal = new Chart(document.getElementById('graficoMensal'), {
        type: 'bar',
        data: {
            labels: ["Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"],
            datasets: [
                { label: `${anoAtual}`, data: valoresAnoAtual, backgroundColor: '#4e73df' },
                { label: `${anoAnterior}`, data: valoresAnoAnterior, backgroundColor: '#858796' }
            ]
        },
        options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true } } }
    });
};

window.renderTopClientes = function(clientes) {
    document.querySelector('#tblClientes tbody').innerHTML = clientes.map(c => `
        <tr><td>${c.nome}</td><td class="text-end fw-bold">${parseFloat(c.total).toLocaleString('pt-BR',{style:'currency',currency:'BRL'})}</td></tr>
    `).join('');

    if(window.graficoClientes) window.graficoClientes.destroy();
    window.graficoClientes = new Chart(document.getElementById('graficoClientes'), {
        type: 'doughnut',
        data: {
            labels: clientes.map(c => c.nome),
            datasets: [{ data: clientes.map(c => parseFloat(c.total)), backgroundColor: window.coresPalette, borderWidth: 0 }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { boxWidth: 12 } } } }
    });
};

window.renderTopProdutos = function(produtos) {
    document.querySelector('#tblProdutos tbody').innerHTML = produtos.map(p => `
        <tr><td>${p.nome}</td><td>${p.total_vendido}</td><td class="text-end fw-bold">${parseFloat(p.total_valor).toLocaleString('pt-BR',{style:'currency',currency:'BRL'})}</td></tr>
    `).join('');

    if(window.graficoProdutos) window.graficoProdutos.destroy();
    window.graficoProdutos = new Chart(document.getElementById('graficoProdutos'), {
        type: 'doughnut',
        data: {
            labels: produtos.map(p => p.nome),
            datasets: [{
                data: produtos.map(p => window.modoGraficoProdutos === 'quantidade' ? p.total_vendido : parseFloat(p.total_valor)),
                backgroundColor: window.coresPalette,
                borderWidth: 0
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { boxWidth: 12 } } } }
    });
};

window.renderPagamentos = function(pagamentos) {
    const totalGeral = pagamentos.reduce((acc,p) => acc + parseFloat(p.total), 0);
    document.querySelector('#tblPagamentos tbody').innerHTML = pagamentos.map(p => {
        const perc = totalGeral > 0 ? ((p.total / totalGeral) * 100).toFixed(1) : 0;
        return `<tr>
            <td>${p.nome}</td>
            <td class="text-end">${parseFloat(p.total).toLocaleString('pt-BR',{style:'currency',currency:'BRL'})}</td>
            <td class="text-center"><span class="badge bg-primary px-2">${perc}%</span></td>
        </tr>`;
    }).join('');

    if(window.graficoPagamentos) window.graficoPagamentos.destroy();
    window.graficoPagamentos = new Chart(document.getElementById('graficoPagamentos'), {
        type: 'doughnut',
        data: {
            labels: pagamentos.map(p => p.nome),
            datasets: [{ data: pagamentos.map(p => parseFloat(p.total)), backgroundColor: window.coresPalette, borderWidth: 0 }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { boxWidth: 12 } } } }
    });
};

// 5. Exportação Excel
window.exportExcel = function() {
    const btn = document.getElementById('btnExportPDFTop');
    const originalText = btn.innerHTML;
    btn.innerHTML = "Processando...";
    btn.disabled = true;

    try {
        const wb = XLSX.utils.book_new();
        let ws_data = [["DASHBOARD FINANCEIRO - MANABANK"], ["Gerado em: " + new Date().toLocaleString()], []];

        const extrairTabela = (idTabela, titulo) => {
            const table = document.getElementById(idTabela);
            if (!table) return;
            ws_data.push([titulo.toUpperCase()]);
            const rows = Array.from(table.querySelectorAll('tr'));
            rows.forEach(row => {
                const rowData = Array.from(row.querySelectorAll('th, td')).map(cell => cell.innerText);
                ws_data.push(rowData);
            });
            ws_data.push([]);
        };

        extrairTabela('tblDesempenho', 'Relatório Detalhado Anual');
        extrairTabela('tblClientes', 'Top 5 Clientes');
        extrairTabela('tblProdutos', 'Top 5 Produtos');
        extrairTabela('tblPagamentos', 'Meios de Pagamento');

        const ws = XLSX.utils.aoa_to_sheet(ws_data);
        XLSX.utils.book_append_sheet(wb, ws, "Relatório");
        XLSX.writeFile(wb, "Relatorio_Financeiro.xlsx");
    } catch (err) {
        console.error(err);
        alert("Erro ao exportar.");
    } finally {
        btn.innerHTML = originalText;
        btn.disabled = false;
    }
};

// 6. Inicialização dos Eventos
document.addEventListener('DOMContentLoaded', () => {
    // Tenta carregar o dashboard. Se o Chart.js não estiver pronto, tenta novamente em breves intervalos.
    const inicializar = () => {
        if (typeof Chart !== 'undefined') {
            window.carregarDashboard();
        } else {
            setTimeout(inicializar, 200);
        }
    };

    inicializar();

    document.getElementById('filtroAno').addEventListener('change', window.carregarDashboard);
    document.getElementById('filtroMes').addEventListener('change', window.carregarDashboard);
    document.getElementById('filtroGraficoProdutos').addEventListener('change', e => {
        window.modoGraficoProdutos = e.target.value;
        window.carregarDashboard();
    });
    document.getElementById('btnExportPDFTop').addEventListener('click', window.exportExcel);
});
</script>
