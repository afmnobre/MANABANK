<h2 class="text-light mb-4">Pedidos do Balcão</h2>

<div class="row mb-3">
    <div class="col-md-3">
        <label class="form-label text-light">Data:</label>
        <input type="date" id="dataPedido" value="<?= $dataSelecionada ?>" class="form-control bg-dark text-light border-secondary">
    </div>
    <div class="col-md-4">
        <label class="form-label text-light">Pesquisar Cliente:</label>
        <input type="text" id="pesquisaCliente" placeholder="Digite o nome..." class="form-control bg-dark text-light border-secondary">
    </div>
    <div class="col-md-5 d-flex align-items-end">
        <div class="alert w-100 mb-0" style="background-color: #000F00; color: #fff; border: 1px solid #00d400; font-weight: bold;">
            <strong>Total Recebido no Dia:</strong> <span id="totalRecebido">R$ 0,00</span>
        </div>
    </div>
</div>

<div class="bg-dark py-3 px-3 w-100 border-bottom border-secondary mb-3">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center flex-grow-1 overflow-hidden">
            <strong class="text-light me-3 text-nowrap">Filtrar por Cardgames:</strong>
            <div class="d-flex flex-row align-items-center flex-nowrap custom-scroll flex-grow-1" style="gap: 12px; overflow-x: auto; padding: 10px 0; scrollbar-width: none;">
                <?php foreach ($cardgames as $cardgame): ?>
                    <?php $checked = in_array((string)$cardgame['id_cardgame'], array_map('strval', ($_GET['cardgames'] ?? []))) ? 'checked' : ''; ?>
                    <label class="magic-card p-0 m-0 flex-shrink-0">
                        <input class="magic-check" type="checkbox" name="cardgames[]" value="<?= $cardgame['id_cardgame'] ?>" <?= $checked ?> onchange="filtrarClientes()">
                        <img src="<?= $this->baseUrl ?>public/storage/uploads/cardgames/<?= $cardgame['id_cardgame'] ?>/<?= htmlspecialchars($cardgame['imagem_fundo_card']) ?>" alt="<?= htmlspecialchars($cardgame['nome']) ?>" class="img-fluid">
                        <div class="card-overlay"></div>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="ms-4 flex-shrink-0">
            <button type="submit" form="formPedidos" class="btn btn-success px-4 fw-bold text-nowrap">💾 Salvar Pedidos</button>
        </div>
    </div>
</div>

<form id="formPedidos" method="POST" action="<?= $this->baseUrl ?>pedido/salvar">
    <input type="hidden" name="dataSelecionada" id="dataSelecionadaHidden" value="<?= $dataSelecionada ?>">
    <div id="cardgamesSelecionados"></div>

    <div class="table-responsive">
        <table class="table table-dark table-striped align-middle">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <?php foreach ($produtos as $produto): ?>
                        <th class="<?= ((int)$produto['controlar_estoque'] === 1 && (int)$produto['estoque_atual'] <= (int)$produto['estoque_alerta']) ? 'estoque-alerta-vivo' : '' ?>">
                            <?= htmlspecialchars($produto['emoji']) ?> <?= htmlspecialchars($produto['nome']) ?>
                        </th>
                    <?php endforeach; ?>
                    <th>💰 Variado</th>
                    <th>Total</th>
                    <th>Pago?</th>
                    <th>Recibo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <?php
                        $idCli = $cliente['id_cliente'];
                        $pedido = $pedidosPorCliente[$idCli] ?? null;
                        $isPago = ($pedido['pedido_pago'] ?? 0) == 1;
                    ?>
                    <tr data-cardgames="<?= implode(',', $cliente['cardgames']) ?>">
                        <td><?= htmlspecialchars($cliente['nome']) ?></td>

                        <?php if ($pedido): ?>
                            <input type="hidden" name="id_pedido[<?= $idCli ?>]" value="<?= $pedido['id_pedido'] ?>">
                        <?php endif; ?>

                        <input type="hidden" name="observacao_variado[<?= $idCli ?>]" id="observacao_variado_<?= $idCli ?>" value="<?= htmlspecialchars($pedido['observacao_variado'] ?? '') ?>">

                        <?php foreach ($produtos as $produto): ?>
                            <?php
                                $qtd = 0;
                                if ($pedido && !empty($pedido['itens'])) {
                                    foreach ($pedido['itens'] as $item) {
                                        if ($item['id_produto'] == $produto['id_produto']) {
                                            $qtd = $item['quantidade'];
                                            break;
                                        }
                                    }
                                }
                            ?>
                            <td>
                                <input type="number"
                                    name="itens[<?= $idCli ?>][<?= $produto['id_produto'] ?>]"
                                    value="<?= $qtd ?>"
                                    min="0"
                                    class="form-control form-control-sm bg-dark text-light border-secondary input-item"
                                    style="width:70px;"
                                    data-preco="<?= $produto['valor_venda'] ?>"
                                    data-cliente="<?= $idCli ?>"
                                    data-nome="<?= htmlspecialchars($produto['nome']) ?>"
                                    data-estoque="<?= (int)$produto['estoque_atual'] ?>"
                                    data-controla="<?= (int)$produto['controlar_estoque'] ?>"
                                    onchange="atualizarTotalLinha(<?= $idCli ?>)">
                            </td>
                        <?php endforeach; ?>

                        <td>
                            <div class="input-group input-group-sm" style="min-width: 120px;">
                                <span class="input-group-text bg-secondary text-white border-secondary">R$</span>
                                <input type="text" name="variado[<?= $idCli ?>]" value="<?= number_format((float)($pedido['valor_variado'] ?? 0), 2, ',', '.') ?>"
                                       class="form-control bg-dark text-light border-secondary text-center input-variado"
                                       style="width: 55px;" data-cliente="<?= $idCli ?>" onchange="atualizarTotalLinha(<?= $idCli ?>)">
                                <button class="btn btn-outline-secondary py-0 px-2" type="button" onclick="abrirPopupVariado(<?= $idCli ?>)">📝</button>
                            </div>
                        </td>

                        <?php
                            $totalPedido = (float)($pedido['valor_variado'] ?? 0);
                            if ($pedido && !empty($pedido['itens'])) {
                                foreach ($pedido['itens'] as $item) {
                                    $totalPedido += $item['quantidade'] * ($item['valor_unitario'] ?? 0);
                                }
                            }
                        ?>
                        <td id="total_<?= $idCli ?>"
                            class="text-center fw-bold <?= ($totalPedido > 0) ? 'text-white' : '' ?>"
                            style="<?= ($totalPedido > 0) ? ($isPago ? 'background-color: #28a745 !important; box-shadow: none !important;' : 'background-color: #ff0000 !important; box-shadow: none !important;') : '' ?>"
                            data-total="<?= $totalPedido ?>">
                            R$ <?= number_format($totalPedido, 2, ',', '.') ?>
                        </td>
                        <td class="text-center">
                            <input type="checkbox" name="pago[<?= $idCli ?>]" class="check-pago"
                                   onchange="abrirModalPagamento(<?= $pedido['id_pedido'] ?? 0 ?>, <?= $idCli ?>, this.parentNode.previousElementSibling.dataset.total, this)"
                                   <?= $isPago ? 'checked' : '' ?>>
                        </td>

                        <td class="text-center">
                            <?php if ($isPago): ?>
                                <a href="#" onclick="abrirRecibo(<?= (int)$pedido['id_pedido'] ?>); return false;">🧾</a>
                            <?php else: ?> — <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</form>

<div class="modal fade" id="modalPagamento" tabindex="-1" aria-labelledby="modalPagamentoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-dark text-light">
      <div class="modal-header">
        <h5 class="modal-title" id="modalPagamentoLabel">Método de Pagamento</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <form id="formPagamento" method="POST" action="<?= $this->baseUrl ?>pedido/salvarPagamento">
          <input type="hidden" id="modal_id_pedido" name="id_pedido" value="">
          <input type="hidden" id="modal_id_cliente" name="id_cliente" value="">
          <input type="hidden" name="dataSelecionada" value="<?= $dataSelecionada ?>">

          <div class="mb-3">
            <label class="fw-bold">Total do Pedido: R$ <span id="totalPedidoLabel"></span></label><br>
            <label class="fw-bold">Valor restante a distribuir: R$ <span id="valorRestante"></span></label>
          </div>

          <table class="table table-dark table-bordered align-middle">
            <thead>
              <tr>
                <th>Tipo de Pagamento</th>
                <th>Valor</th>
                <th>Selecionar</th>
                <th>Ação</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($tipos_pagamento as $tp): ?>
              <?php
                // AJUSTE: Caminho da imagem do tipo de pagamento corrigido
                $imagemPath = !empty($tp['imagem'])
                    ? "{$this->baseUrl}public/storage/uploads/tipos_pagamento/{$tp['id_pagamento']}/{$tp['imagem']}"
                    : null;
              ?>
              <tr>
                <td>
                  <?php if ($imagemPath): ?>
                    <img src="<?= $imagemPath ?>" alt="<?= htmlspecialchars($tp['nome']) ?>" style="height:40px;">
                  <?php else: ?>
                    -
                  <?php endif; ?>
                  <?= htmlspecialchars($tp['nome']) ?>
                </td>
                <td>
                  <input type="number" step="0.01" min="0" class="form-control pagamento-valor" name="valor[<?= $tp['id_pagamento'] ?>]" data-id="<?= $tp['id_pagamento'] ?>" value="0.00">
                </td>
                <td>
                  <input type="checkbox" class="form-check-input pagamento-check" data-id="<?= $tp['id_pagamento'] ?>">
                </td>
                <td>
                  <button type="button" class="btn btn-sm btn-info distribuir-btn" data-id="<?= $tp['id_pagamento'] ?>">Distribuir restante</button>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="salvarPagamento()">Salvar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalRecibo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 450px;">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title">Recibo</h5>
                <button type="button" class="btn btn-outline-light btn-sm me-2" onclick="imprimirRecibo()">🖨️</button>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <iframe id="iframeRecibo" src="" style="width:100%; height:600px; border:none;"></iframe>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEstoque" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-light border-danger">
            <div class="modal-header border-secondary">
                <h5 class="modal-title text-danger">⚠️ Estoque Insuficiente</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p id="msgEstoque" class="fs-5"></p>
                <hr class="border-secondary">
                <div class="d-flex justify-content-around">
                    <div>
                        <small class="d-block text-secondary">Disponível</small>
                        <span id="estoqueDisponivel" class="badge bg-success fs-6">0</span>
                    </div>
                    <div>
                        <small class="d-block text-secondary">Tentativa</small>
                        <span id="estoqueTentativa" class="badge bg-danger fs-6">0</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-secondary">
                <button type="button" class="btn btn-primary w-100" data-bs-dismiss="modal">Entendido, vou ajustar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="popupVariado" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered text-dark">
        <div class="modal-content bg-dark text-light border-secondary">
            <div class="modal-header border-secondary">
                <h5 class="modal-title">Observação do Valor Variado</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="variado_cliente_id">
                <textarea id="descricaoVariado" class="form-control bg-dark text-light border-secondary" rows="5" placeholder="Descreva o motivo do valor extra..."></textarea>
            </div>
            <div class="modal-footer border-secondary">
                <button type="button" class="btn btn-primary w-100" onclick="salvarDescricaoVariado()">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Define a baseUrl para o arquivo JS externo (pedidos.js)
    const BASE_URL = "<?= $this->baseUrl ?>";

    // Exemplo de como a função abrirRecibo deve usar a constante
    function abrirRecibo(idPedido) {
        const url = BASE_URL + "pedido/gerarRecibo/" + idPedido;
        document.getElementById('iframeRecibo').src = url;
        new bootstrap.Modal(document.getElementById('modalRecibo')).show();
    }
</script>
