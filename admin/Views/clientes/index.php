<?php
/**
 * View: index.php (Clientes) - Revisão Final
 */
$isMANABANK = (strpos($_SERVER['SCRIPT_NAME'], '/MANABANK/') !== false);
$baseUrl = $isMANABANK ? '/MANABANK/' : '/';

$cardgamesPath = $baseUrl . 'public/storage/uploads/cardgames/';
$lojasPath = $baseUrl . 'public/storage/uploads/lojas/';

/**
 * Função PHP para garantir que a coluna "Contato" na tabela já venha formatada
 */
function formatarTelefonePHP($tel) {
    $tel = preg_replace('/[^0-9]/', '', $tel);
    if (strlen($tel) === 11) {
        return "(" . substr($tel, 0, 2) . ") " . substr($tel, 2, 5) . "-" . substr($tel, 7);
    } elseif (strlen($tel) === 10) {
        return "(" . substr($tel, 0, 2) . ") " . substr($tel, 2, 4) . "-" . substr($tel, 6);
    }
    return $tel;
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-masker/1.2.0/vanilla-masker.min.js"></script>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">Clientes</h3>
        <span class="badge bg-primary shadow-sm"><?= count($clientes) ?> Registrados</span>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body bg-light rounded">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="small fw-bold text-muted">Nome</label>
                    <input type="text" id="filtroNome" class="form-control form-control-sm" placeholder="Pesquisar por nome">
                </div>
                <div class="col-md-3">
                    <label class="small fw-bold text-muted">Loja</label>
                    <select id="filtroLoja" class="form-select form-select-sm">
                        <option value="">Todas as lojas</option>
                        <?php
                        $todasLojas = [];
                        foreach($clientes as $c){
                            if(!empty($c['lojas_info'])){
                                foreach(explode('||', $c['lojas_info']) as $p){
                                    $d = explode(';#', $p);
                                    if(isset($d[1])) $todasLojas[$d[1]] = $d[1];
                                }
                            }
                        }
                        ksort($todasLojas);
                        foreach($todasLojas as $loja) echo "<option value=\"{$loja}\">{$loja}</option>";
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="small fw-bold text-muted">Telefone</label>
                    <input type="text" id="filtroCelular" class="form-control form-control-sm" placeholder="(00) 00000-0000">
                </div>
                <div class="col-md-3">
                    <label class="small fw-bold text-muted">Cardgame</label>
                    <select id="filtroCardgame" class="form-select form-select-sm">
                        <option value="">Todos os cardgames</option>
                        <?php
                        $todosCG = [];
                        foreach($clientes as $c){
                            if(!empty($c['cardgames_info'])){
                                foreach(explode('||', $c['cardgames_info']) as $p){
                                    $d = explode(';#', $p);
                                    if(isset($d[1])) $todosCG[$d[1]] = $d[1];
                                }
                            }
                        }
                        ksort($todosCG);
                        foreach($todosCG as $cg) echo "<option value=\"{$cg}\">{$cg}</option>";
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0 text-dark">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 bg-white" id="tabelaClientes">
                    <thead class="table-light text-secondary">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Nome</th>
                            <th>Contato</th>
                            <th>Cardgames</th>
                            <th>Lojas</th>
                            <th class="text-center pe-4">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($clientes as $cliente): ?>
                        <tr>
                            <td class="ps-4 text-muted small">#<?= $cliente['id_cliente'] ?></td>
                            <td class="fw-bold text-dark"><?= htmlspecialchars($cliente['nome']) ?></td>
                            <td>
                                <div class="small fw-bold text-dark"><?= formatarTelefonePHP($cliente['telefone']) ?></div>
                                <div class="text-muted" style="font-size: 11px;"><?= htmlspecialchars($cliente['email']) ?></div>
                            </td>
                            <td>
                                <div class="d-flex gap-2 flex-wrap">
                                    <?php
                                    if(!empty($cliente['cardgames_info'])):
                                        foreach(explode('||', $cliente['cardgames_info']) as $cg_item):
                                            $partes = explode(';#', $cg_item);
                                            if(count($partes) >= 3):
                                                list($id_cg, $nome_cg, $img_cg) = $partes;
                                                if(!empty($img_cg)): ?>
                                                    <img src="<?= $cardgamesPath . trim($id_cg) . '/' . trim($img_cg) ?>"
                                                         title="<?= htmlspecialchars($nome_cg) ?>"
                                                         style="height:35px; width:35px; object-fit:contain;"
                                                         class="rounded border bg-light p-1 shadow-sm">
                                                <?php endif;
                                            endif;
                                        endforeach;
                                    else: echo "-"; endif; ?>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex gap-2 flex-wrap">
                                    <?php
                                    if(!empty($cliente['lojas_info'])):
                                        foreach(explode('||', $cliente['lojas_info']) as $lj_item):
                                            $partes = explode(';#', $lj_item);
                                            if(count($partes) >= 3):
                                                list($id_lj, $nome_lj, $logo_lj) = $partes;
                                                if(!empty($logo_lj)): ?>
                                                    <img src="<?= $lojasPath . trim($id_lj) . '/' . trim($logo_lj) ?>"
                                                         title="<?= htmlspecialchars($nome_lj) ?>"
                                                         style="height:30px; width:45px; object-fit:contain;"
                                                         class="rounded border bg-light p-1 shadow-sm">
                                                <?php else: ?>
                                                    <span class="badge bg-light text-dark border fw-normal" style="font-size:10px;"><?= htmlspecialchars($nome_lj) ?></span>
                                                <?php endif;
                                            endif;
                                        endforeach;
                                    else: echo "-"; endif; ?>
                                </div>
                            </td>
                            <td class="text-center pe-4">
                                <button class="btn btn-outline-info btn-sm px-3 shadow-sm" onclick="abrirPedidos(<?= $cliente['id_cliente'] ?>)">
                                    Ver Pedidos
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="pedidosModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-white border-bottom d-flex justify-content-between align-items-center">
                <h5 class="modal-title fw-bold text-dark">Histórico de Pedidos</h5>
                <div class="ms-auto me-3">
                    <select id="filtroStatusPedido" class="form-select form-select-sm" style="width: 180px;">
                        <option value="todos">Todos os pedidos</option>
                        <option value="pago">Apenas Pagos</option>
                        <option value="pendente">Apenas Pendentes</option>
                    </select>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body bg-light" id="conteudoPedidos" style="min-height: 250px;"></div>
        </div>
    </div>
</div>

<script>
const baseUrl = '<?= $baseUrl ?>';
const lojasPath = '<?= $lojasPath ?>';
let cachePedidos = [];

/**
 * INICIALIZAÇÃO DE SCRIPTS APÓS CARREGAMENTO
 */
document.addEventListener('DOMContentLoaded', function() {
    // Máscara do Telefone no Filtro
    const telInput = document.getElementById("filtroCelular");
    if(telInput) {
        VMasker(telInput).maskPattern("(99) 99999-9999");
    }

    // Ativa o evento do filtro dentro do modal
    const selectFiltroStatus = document.getElementById('filtroStatusPedido');
    if(selectFiltroStatus) {
        selectFiltroStatus.addEventListener('change', function() {
            renderizarPedidos(this.value);
        });
    }

    // Ativa os filtros da tabela principal
    document.querySelectorAll('#filtroNome, #filtroLoja, #filtroCelular, #filtroCardgame').forEach(el => {
        el.addEventListener('input', filtrar);
    });
});

function abrirPedidos(id_cliente) {
    const modalEl = document.getElementById('pedidosModal');
    const myModal = new bootstrap.Modal(modalEl);
    myModal.show();

    // Resetar o select de filtro para "todos" sempre que abrir
    document.getElementById('filtroStatusPedido').value = 'todos';

    const div = document.getElementById('conteudoPedidos');
    div.innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary"></div><p class="mt-2 text-muted">Buscando dados...</p></div>';

    fetch(`${baseUrl}admin/cliente/pedidos/${id_cliente}`)
        .then(res => res.json())
        .then(data => {
            cachePedidos = data;
            renderizarPedidos('todos');
        })
        .catch(err => {
            div.innerHTML = '<div class="alert alert-danger text-center">Erro ao buscar pedidos.</div>';
        });
}

function renderizarPedidos(statusFiltro) {
    const div = document.getElementById('conteudoPedidos');

    const filtered = cachePedidos.filter(p => {
        if(statusFiltro === 'pago') return p.pedido_pago == 1;
        if(statusFiltro === 'pendente') return p.pedido_pago == 0;
        return true;
    });

    if(filtered.length === 0) {
        div.innerHTML = '<div class="alert alert-white border text-center my-4 text-muted">Nenhum registro para este status.</div>';
        return;
    }

    const grouped = {};
    filtered.forEach(p => {
        if(!grouped[p.nome_loja]) grouped[p.nome_loja] = { info: p, list: [] };
        grouped[p.nome_loja].list.push(p);
    });

    let html = '';
    for(const loja in grouped) {
        const item = grouped[loja];
        const logoImg = item.info.logo
            ? `<img src="${lojasPath}${item.info.id_loja}/${item.info.logo}" style="height:35px; width:55px; object-fit:contain;" class="me-2 rounded border bg-white p-1">`
            : '';

        html += `<div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white d-flex align-items-center py-2">
                ${logoImg} <h6 class="mb-0 fw-bold text-dark">${loja}</h6>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">ID</th>
                            <th>Data</th>
                            <th>Total (Itens + Taxas)</th>
                            <th class="text-center">Status</th>
                            <th>Observação</th>
                        </tr>
                    </thead>
                    <tbody>`;
        item.list.forEach(p => {
            const badge = p.pedido_pago == 1
                ? '<span class="badge bg-success-subtle text-success border border-success-subtle">Pago</span>'
                : '<span class="badge bg-warning-subtle text-dark border border-warning-subtle">Pendente</span>';

            // Tratamento da Data para DD/MM/AAAA (p.data_pedido vem YYYY-MM-DD)
            const dataParts = p.data_pedido.split('-');
            const dataFormatada = `${dataParts[2]}/${dataParts[1]}/${dataParts[0]}`;

            // Valor total real calculado no SQL
            const valorTotal = parseFloat(p.valor_total_real).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

            html += `<tr>
                <td class="ps-3 text-muted small">#${p.id_pedido}</td>
                <td class="text-dark">${dataFormatada}</td>
                <td class="fw-bold text-dark">${valorTotal}</td>
                <td class="text-center">${badge}</td>
                <td class="text-muted small" title="${p.observacao_variado ?? ''}">
                    ${p.observacao_variado ? (p.observacao_variado.substring(0, 30) + '...') : '-'}
                </td>
            </tr>`;
        });
        html += `</tbody></table></div></div>`;
    }
    div.innerHTML = html;
}

function filtrar() {
    const n = document.getElementById('filtroNome').value.toLowerCase();
    const l = document.getElementById('filtroLoja').value.toLowerCase();
    const t = document.getElementById('filtroCelular').value.replace(/\D/g, '');
    const c = document.getElementById('filtroCardgame').value.toLowerCase();

    const rows = document.getElementById('tabelaClientes').tBodies[0].rows;
    Array.from(rows).forEach(row => {
        const textNome = row.cells[1].innerText.toLowerCase();
        const textTel = row.cells[2].innerText.replace(/\D/g, '');
        const titleCG = Array.from(row.cells[3].querySelectorAll('img')).map(i => i.title.toLowerCase()).join(' ');
        const titleLJ = Array.from(row.cells[4].querySelectorAll('img')).map(i => i.title.toLowerCase()).join(' ') + row.cells[4].innerText.toLowerCase();

        const match = textNome.includes(n) && textTel.includes(t) && titleLJ.includes(l) && titleCG.includes(c);
        row.style.display = match ? '' : 'none';
    });
}
</script>
