<div class="container mt-4">
    <h3>Clientes</h3>

    <!-- FILTROS -->
    <div class="row mb-3">
        <div class="col-md-3">
            <input type="text" id="filtroNome" class="form-control" placeholder="Pesquisar por nome">
        </div>

        <div class="col-md-3">
            <select id="filtroLoja" class="form-select">
                <option value="">Todas as lojas</option>
                <?php
                // Gerar opções de lojas dinamicamente
                $todasLojas = [];
                foreach($clientes as $c){
                    if(!empty($c['lojas'])){
                        foreach(explode(', ', $c['lojas']) as $loja){
                            $todasLojas[$loja] = $loja;
                        }
                    }
                }
                ksort($todasLojas);
                foreach($todasLojas as $loja) {
                    echo "<option value=\"{$loja}\">{$loja}</option>";
                }
                ?>
            </select>
        </div>

        <div class="col-md-3">
            <input type="text" id="filtroCelular" class="form-control" placeholder="Pesquisar por telefone">
        </div>

        <div class="col-md-3">
            <select id="filtroCardgame" class="form-select">
                <option value="">Todos os cardgames</option>
                <?php
                $todosCardgames = [];
                foreach($clientes as $c){
                    if(!empty($c['cardgames'])){
                        foreach(explode(', ', $c['cardgames']) as $cg){
                            $todosCardgames[$cg] = $cg;
                        }
                    }
                }
                ksort($todosCardgames);
                foreach($todosCardgames as $cg){
                    echo "<option value=\"{$cg}\">{$cg}</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <!-- TABELA -->
    <table class="table table-striped align-middle" id="tabelaClientes">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Cardgames</th>
                <th>Lojas</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($clientes as $cliente): ?>
            <tr>
                <td><?= $cliente['id_cliente'] ?></td>
                <td><?= htmlspecialchars($cliente['nome']) ?></td>
                <td><?= htmlspecialchars($cliente['telefone']) ?></td>
                <td><?= htmlspecialchars($cliente['email']) ?></td>
                <td><?= htmlspecialchars($cliente['cardgames'] ?? '-') ?></td>
                <td><?= htmlspecialchars($cliente['lojas'] ?? '-') ?></td>
                <td>
                    <button class="btn btn-info btn-sm" onclick="abrirPedidos(<?= $cliente['id_cliente'] ?>)">
                        Ver Pedidos
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<!-- Modal Pedidos -->
<div class="modal fade" id="pedidosModal" tabindex="-1" aria-labelledby="pedidosModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content text-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="pedidosModalLabel">Pedidos do Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body" id="conteudoPedidos">
        <!-- Conteúdo carregado via JS -->
      </div>
    </div>
  </div>
</div>

<script>
function abrirPedidos(id_cliente) {
    const modalEl = document.getElementById('pedidosModal');
    const myModal = new bootstrap.Modal(modalEl);
    myModal.show();

    const conteudo = document.getElementById('conteudoPedidos');
    conteudo.innerHTML = '<div class="text-center">Carregando pedidos...</div>';

    fetch(`/admin/cliente/pedidos/${id_cliente}`)
        .then(res => res.json())
        .then(data => {
            if(data.length === 0){
                conteudo.innerHTML = '<p class="text-center">Nenhum pedido encontrado.</p>';
                return;
            }

            // Agrupar pedidos por loja
            const grouped = {};
            data.forEach(p => {
                if(!grouped[p.nome_loja]) grouped[p.nome_loja] = [];
                grouped[p.nome_loja].push(p);
            });

            let html = '';
            for(const loja in grouped){
                html += `<h5>${loja}</h5>`;
                html += `<table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID Pedido</th>
                                    <th>Data</th>
                                    <th>Valor</th>
                                    <th>Observação</th>
                                </tr>
                            </thead>
                            <tbody>`;
                grouped[loja].forEach(p => {
                    html += `<tr>
                                <td>${p.id_pedido}</td>
                                <td>${new Date(p.data_pedido).toLocaleDateString('pt-BR')}</td>
                                <td>${p.valor_variado}</td>
                                <td>${p.observacao_variado ?? '-'}</td>
                             </tr>`;
                });
                html += '</tbody></table>';
            }

            conteudo.innerHTML = html;
        })
        .catch(err => {
            console.error(err);
            conteudo.innerHTML = '<p class="text-danger text-center">Erro ao carregar pedidos.</p>';
        });
}


const filtroNome     = document.getElementById('filtroNome');
const filtroLoja     = document.getElementById('filtroLoja');
const filtroCelular  = document.getElementById('filtroCelular');
const filtroCardgame = document.getElementById('filtroCardgame');
const tabela         = document.getElementById('tabelaClientes').getElementsByTagName('tbody')[0];

function filtrarClientes() {
    const nomeVal     = filtroNome.value.toLowerCase();
    const lojaVal     = filtroLoja.value.toLowerCase();
    const celularVal  = filtroCelular.value.toLowerCase();
    const cardgameVal = filtroCardgame.value.toLowerCase();

    for(let row of tabela.rows){
        const nome     = row.cells[1].textContent.toLowerCase();
        const telefone = row.cells[2].textContent.toLowerCase();
        const cardgames= row.cells[4].textContent.toLowerCase();
        const lojas    = row.cells[5].textContent.toLowerCase();

        const match = nome.includes(nomeVal)
                   && telefone.includes(celularVal)
                   && lojas.includes(lojaVal)
                   && cardgames.includes(cardgameVal);

        row.style.display = match ? '' : 'none';
    }
}

// Eventos
filtroNome.addEventListener('input', filtrarClientes);
filtroLoja.addEventListener('change', filtrarClientes);
filtroCelular.addEventListener('input', filtrarClientes);
filtroCardgame.addEventListener('change', filtrarClientes);


</script>

