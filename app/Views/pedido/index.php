
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-white fw-bold mb-0">
            <i class="bi bi-cart-fill me-2 text-success"></i> Pedidos do Balcão
        </h2>
        <div class="d-flex gap-2 align-items-center">
            <div class="alert mb-0 py-1 px-3 d-flex align-items-center shadow-sm" style="background-color: #000F00; color: #00d400; border: 1px solid #00d400; font-weight: bold; border-radius: 6px;">
                <small class="text-uppercase me-2" style="font-size: 0.6rem; opacity: 0.8;">Total Recebido:</small>
                <span id="totalRecebido" style="font-size: 1.1rem;">R$ 0,00</span>
            </div>
            <input type="date" id="dataPedido" value="<?= $dataSelecionada ?>"
                   class="form-control form-control-sm bg-dark text-light border-secondary w-auto shadow-none">
        </div>
    </div>

<div class="card bg-dark border-secondary mb-4 shadow-sm">

		<div class="card-body p-2">
			<div class="d-flex align-items-center justify-content-between flex-nowrap w-100" style="gap: 15px;">

				<div style="flex: 0 0 250px;">
					<div class="input-group">
						<span class="input-group-text bg-transparent border-0 text-white pe-0">
							<i class="bi bi-search"></i>
						</span>
						<input type="text" id="pesquisaCliente" placeholder="Pesquisar..."
							   class="form-control bg-transparent text-white border-0 shadow-none">
					</div>
				</div>

				<div class="border-start border-secondary ps-3" style="flex: 1; min-width: 0; overflow: hidden;">
					<div class="d-flex align-items-center">
						<strong class="text-secondary me-3 small text-nowrap">FILTRAR:</strong>
						<div class="d-flex flex-row align-items-center flex-nowrap custom-scroll" style="gap: 10px; overflow-x: auto; padding: 5px 2px; scrollbar-width: none;">
							<?php foreach ($cardgames as $cardgame): ?>
								<?php
									$checked = in_array((string)$cardgame['id_cardgame'], array_map('strval', ($_GET['cardgames'] ?? []))) ? 'checked' : '';
									$nomeCardgame = htmlspecialchars($cardgame['nome']);
									$idInput = "cg_" . $cardgame['id_cardgame']; // ID único para garantir o clique
								?>

								<div class="flex-shrink-0" style="width: 52px; height: 73px;">
									<input class="magic-check" type="checkbox" name="cardgames[]"
										   id="<?= $idInput ?>"
										   value="<?= $cardgame['id_cardgame'] ?>" <?= $checked ?>
										   onchange="filtrarClientes()" style="display:none;">

									<label for="<?= $idInput ?>" class="magic-card-fixed" title="<?= $nomeCardgame ?>"
										   style="width: 52px !important; min-width: 52px !important; height: 73px !important; position: relative; cursor: pointer; border-radius: 4px; overflow: hidden; border: 2px solid #444; display: block; transition: all 0.2s;">

										<img src="<?= $this->baseUrl ?>public/storage/uploads/cardgames/<?= $cardgame['id_cardgame'] ?>/<?= htmlspecialchars($cardgame['imagem_fundo_card']) ?>"
											 alt="<?= $nomeCardgame ?>"
											 style="width: 100% !important; height: 100% !important; object-fit: cover; pointer-events: none;">

										<div class="card-overlay" style="position: absolute; bottom: 0; width: 100%; background: rgba(0,0,0,0.75); color: #fff; font-size: 10px; text-align: center; font-weight: bold; padding: 2px 0; pointer-events: none;">
											<?= mb_substr($nomeCardgame, 0, 5) ?>
										</div>
									</label>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>

				<div class="flex-shrink-0">
					<button type="submit" form="formPedidos" class="btn btn-success fw-bold shadow-sm px-4 text-nowrap">
						<i class="bi bi-save me-1"></i> Salvar
					</button>
				</div>

			</div>
		</div>


	<style>
		/* CSS para destacar a carta selecionada */
		.magic-check:checked + .magic-card-fixed {
			border-color: #00d400 !important;
			box-shadow: 0 0 10px rgba(0, 212, 0, 0.5);
			transform: translateY(-2px);
		}

		/* Filtro para cartas não selecionadas (opcional, para dar foco) */
		.magic-check:not(:checked) + .magic-card-fixed img {
			filter: grayscale(0.6) brightness(0.7);
		}
	</style>
</div>

    <div class="card bg-dark border-secondary shadow-sm overflow-hidden">
        <div class="card-header bg-dark border-secondary py-3">
            <h6 class="m-0 text-light fw-bold"><i class="bi bi-grid-3x3-gap me-2"></i>Grade de Consumo Diário</h6>
        </div>
        <div class="card-body p-0">
            <form id="formPedidos" method="POST" action="<?= $this->baseUrl ?>pedido/salvar">
                <input type="hidden" name="dataSelecionada" id="dataSelecionadaHidden" value="<?= $dataSelecionada ?>">
                <div id="cardgamesSelecionados"></div>

                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle mb-0">
                        <thead>
                            <tr class="small text-muted border-secondary bg-black">
                                <th class="ps-4 border-secondary py-3">CLIENTE</th>
								<?php foreach ($produtos as $produto): ?>
									<?php
										// Garantimos que os valores sejam tratados como números
										$controlar = (int)($produto['controlar_estoque'] ?? 0);
										$estoqueAtual = (int)($produto['estoque_atual'] ?? 0);
										$estoqueAlerta = (int)($produto['estoque_alerta'] ?? 0);

										// O alerta deve disparar se o controle estiver ativo E o estoque for menor ou igual ao alerta
										$emAlerta = ($controlar === 1 && $estoqueAtual <= $estoqueAlerta);

										// Criamos um estilo inline de segurança para o fundo se estiver em alerta
										$styleAlerta = $emAlerta ? 'background-color: rgba(255, 68, 68, 0.15) !important;' : '';
										$colorAlerta = $emAlerta ? 'color: #ff4444 !important;' : '';
									?>
									<th class="text-center border-secondary" style="<?= $styleAlerta ?>">
										<span style="<?= $colorAlerta ?> display: block; width: 100%;">
											<span style="font-size: 1.2rem;"><?= htmlspecialchars($produto['emoji']) ?></span> <br>
											<small class="<?= $emAlerta ? 'fw-bold' : '' ?>" style="font-size: 0.75rem;">
												<?= htmlspecialchars($produto['nome']) ?>
											</small>
											<?php if ($emAlerta): ?>
												<br><span class="badge bg-danger" style="font-size: 0.6rem;">ESTOQUE BAIXO</span>
											<?php endif; ?>
										</span>
									</th>
								<?php endforeach; ?>

                                <th class="text-center border-secondary">VARIADO</th>
                                <th class="text-center border-secondary">TOTAL</th>
                                <th class="text-center border-secondary">PAGO?</th>
                                <th class="text-center pe-4 border-secondary">RECIBO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($clientes as $cliente): ?>
                                <?php
                                    $idCli = $cliente['id_cliente'];
                                    $pedido = $pedidosPorCliente[$idCli] ?? null;
                                    $isPago = ($pedido['pedido_pago'] ?? 0) == 1;

                                    $totalPedido = (float)($pedido['valor_variado'] ?? 0);
                                    if ($pedido && !empty($pedido['itens'])) {
                                        foreach ($pedido['itens'] as $item) {
                                            $totalPedido += $item['quantidade'] * ($item['valor_unitario'] ?? 0);
                                        }
                                    }
                                ?>
                                <tr data-cardgames="<?= implode(',', $cliente['cardgames']) ?>" class="border-secondary">
                                    <td class="ps-4 fw-bold text-light border-secondary"><?= htmlspecialchars($cliente['nome']) ?></td>

                                    <?php if ($pedido): ?>
                                        <input type="hidden" name="id_pedido[<?= $idCli ?>]" value="<?= $pedido['id_pedido'] ?>">
                                    <?php endif; ?>
                                    <input type="hidden" name="observacao_variado[<?= $idCli ?>]" id="observacao_variado_<?= $idCli ?>" value="<?= htmlspecialchars($pedido['observacao_variado'] ?? '') ?>">

                                    <?php foreach ($produtos as $produto): ?>
                                        <?php
                                            $qtd = 0;
                                            if ($pedido && !empty($pedido['itens'])) {
                                                foreach ($pedido['itens'] as $item) {
                                                    if ($item['id_produto'] == $produto['id_produto']) { $qtd = $item['quantidade']; break; }
                                                }
                                            }
                                        ?>
                                        <td class="text-center border-secondary">
                                            <input type="number"
                                                   name="itens[<?= $idCli ?>][<?= $produto['id_produto'] ?>]"
                                                   value="<?= $qtd ?>"
                                                   min="0"
                                                   class="form-control form-control-sm bg-dark text-light border-secondary mx-auto input-item text-center shadow-none"
                                                   style="width:65px;"
                                                   data-preco="<?= $produto['valor_venda'] ?>"
                                                   data-cliente="<?= $idCli ?>"
                                                   data-nome="<?= htmlspecialchars($produto['nome']) ?>"
                                                   data-estoque="<?= (int)$produto['estoque_atual'] ?>"
                                                   data-controla="<?= (int)$produto['controlar_estoque'] ?>"
                                                   onchange="window.atualizarTotalLinha(<?= $idCli ?>)"
                                                   onblur="window.verificarEstoqueDisponivel(this)">
                                        </td>
                                    <?php endforeach; ?>

                                    <td class="border-secondary text-center">
                                        <div class="input-group input-group-sm mx-auto shadow-sm" style="width: 135px;">
                                            <span class="input-group-text bg-dark border-secondary text-secondary" style="font-size: 0.7rem;">R$</span>
                                            <input type="text" name="variado[<?= $idCli ?>]"
                                                   value="<?= number_format((float)($pedido['valor_variado'] ?? 0), 2, ',', '.') ?>"
                                                   class="form-control bg-dark text-light border-secondary text-center input-variado shadow-none"
                                                   data-cliente="<?= $idCli ?>"
                                                   onchange="atualizarTotalLinha(<?= $idCli ?>)">
                                            <button class="btn btn-outline-secondary border-secondary" type="button" onclick="abrirPopupVariado(<?= $idCli ?>)">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </div>
                                    </td>

                                    <td id="total_<?= $idCli ?>" class="text-center fw-bold border-secondary" data-total="<?= $totalPedido ?>">
                                        <span class="badge <?= $totalPedido > 0 ? ($isPago ? 'bg-success' : 'bg-danger') : 'bg-secondary' ?> p-2 w-100 shadow-sm" style="min-width: 100px;">
                                            R$ <?= number_format($totalPedido, 2, ',', '.') ?>
                                        </span>
                                    </td>

                                    <td class="text-center border-secondary">
                                        <div class="form-check form-switch d-inline-block">
                                            <input class="form-check-input check-pago" type="checkbox" name="pago[<?= $idCli ?>]"
                                                   onchange="abrirModalPagamento(<?= $pedido['id_pedido'] ?? 0 ?>, <?= $idCli ?>, this.parentNode.parentNode.previousElementSibling.dataset.total, this)"
                                                   <?= $isPago ? 'checked' : '' ?>>
                                        </div>
                                    </td>

                                    <td class="text-center pe-4 border-secondary">
                                        <?php if ($isPago): ?>
                                            <button type="button" class="btn btn-sm btn-outline-info shadow-sm" onclick="abrirRecibo(<?= (int)$pedido['id_pedido'] ?>)">
                                                <i class="bi bi-receipt"></i>
                                            </button>
                                        <?php else: ?>
                                            <span class="text-muted small">Aguardando</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPagamento" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-dark text-light border-secondary shadow-lg">
            <div class="modal-header border-secondary">
                <h5 class="modal-title"><i class="bi bi-cash-stack me-2 text-success"></i>Método de Pagamento</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form id="formPagamento" method="POST" action="<?= $this->baseUrl ?>pedido/salvarPagamento">
                    <input type="hidden" id="modal_id_pedido" name="id_pedido" value="">
                    <input type="hidden" id="modal_id_cliente" name="id_cliente" value="">
                    <input type="hidden" name="dataSelecionada" value="<?= $dataSelecionada ?>">

                    <div class="mb-4 p-3 rounded shadow-sm" style="background-color: #1a1a1a; border-left: 4px solid #0d6efd;">
                        <p class="mb-1 fw-bold">Total do Pedido: <span class="text-info">R$ <span id="totalPedidoLabel"></span></span></p>
                        <p class="mb-0 fw-bold">Restante a distribuir: <span class="text-warning">R$ <span id="valorRestante"></span></span></p>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-dark table-bordered align-middle border-secondary shadow-sm">
                            <thead class="bg-black">
                                <tr class="border-secondary text-secondary small">
                                    <th>TIPO DE PAGAMENTO</th>
                                    <th>VALOR (R$)</th>
                                    <th class="text-center">SELECIONAR</th>
                                    <th>AÇÃO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tipos_pagamento as $tp): ?>
                                <?php
                                    $imagemPath = !empty($tp['imagem'])
                                        ? "{$this->baseUrl}public/storage/uploads/tipos_pagamento/{$tp['id_pagamento']}/{$tp['imagem']}"
                                        : null;
                                ?>
                                <tr class="border-secondary">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <?php if ($imagemPath): ?>
                                                <img src="<?= $imagemPath ?>" alt="<?= htmlspecialchars($tp['nome']) ?>" class="me-2 rounded shadow-sm" style="height:30px; width:30px; object-fit: contain;">
                                            <?php endif; ?>
                                            <span><?= htmlspecialchars($tp['nome']) ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" min="0" class="form-control form-control-sm bg-dark text-light border-secondary pagamento-valor shadow-none" name="valor[<?= $tp['id_pagamento'] ?>]" data-id="<?= $tp['id_pagamento'] ?>" value="0.00">
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input pagamento-check shadow-none" data-id="<?= $tp['id_pagamento'] ?>">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-info distribuir-btn w-100 shadow-sm" data-id="<?= $tp['id_pagamento'] ?>">Distribuir</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-secondary">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success fw-bold px-4 shadow-sm" onclick="salvarPagamento()">Confirmar Pagamento</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalRecibo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 450px;">
        <div class="modal-content bg-dark border-secondary shadow-lg">
            <div class="modal-header border-secondary text-light">
                <h5 class="modal-title"><i class="bi bi-receipt me-2"></i>Recibo de Venda</h5>
                <div class="d-flex align-items-center">
                    <button type="button" class="btn btn-outline-light btn-sm me-2 shadow-sm" onclick="imprimirRecibo()">
                        <i class="bi bi-printer"></i>
                    </button>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
                </div>
            </div>
            <div class="modal-body p-0">
                <iframe id="iframeRecibo" src="" style="width:100%; height:600px; border:none; background-color: white;"></iframe>
            </div>
            <div class="modal-footer border-secondary">
                <button type="button" class="btn btn-secondary w-100 fw-bold shadow-sm" data-bs-dismiss="modal">Fechar Visualização</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEstoque" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-light border-danger shadow-lg">
            <div class="modal-header border-secondary bg-black">
                <h5 class="modal-title text-danger fw-bold"><i class="bi bi-exclamation-triangle-fill me-2"></i> Estoque Insuficiente</h5>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <p id="msgEstoque" class="fs-5 mb-4"></p>
                <div class="row g-0 rounded overflow-hidden border border-secondary shadow-sm">
                    <div class="col-6 p-3 bg-black">
                        <small class="d-block text-secondary text-uppercase mb-1" style="font-size: 0.7rem;">Disponível</small>
                        <span id="estoqueDisponivel" class="badge bg-success fs-5 px-3 shadow-sm">0</span>
                    </div>
                    <div class="col-6 p-3 bg-black border-start border-secondary text-center">
                        <small class="d-block text-secondary text-uppercase mb-1" style="font-size: 0.7rem;">Tentativa</small>
                        <span id="estoqueTentativa" class="badge bg-danger fs-5 px-3 shadow-sm">0</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-secondary bg-black">
                <button type="button" class="btn btn-danger w-100 fw-bold shadow-sm py-2" data-bs-dismiss="modal">Entendido, vou ajustar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="popupVariado" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-light border-secondary shadow-lg">
            <div class="modal-header border-secondary">
                <h5 class="modal-title"><i class="bi bi-pencil-square me-2 text-primary"></i>Detalhes: Valor Variado</h5>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="variado_cliente_id">
                <label for="descricaoVariado" class="form-label small text-secondary">Descrição do lançamento extra:</label>
                <textarea id="descricaoVariado" class="form-control bg-dark text-light border-secondary shadow-none" rows="5" placeholder="Ex: Taxa de embalagem, frete, itens extras, etc..."></textarea>
            </div>
            <div class="modal-footer border-secondary">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary px-4 fw-bold shadow-sm" onclick="salvarDescricaoVariado()">Salvar Observação</button>
            </div>
        </div>
    </div>
</div>

<script>
    const BASE_URL = "<?= $this->baseUrl ?>";

    function abrirRecibo(idPedido) {
        if(!idPedido) return;
        const url = BASE_URL + "pedido/gerarRecibo/" + idPedido;
        document.getElementById('iframeRecibo').src = url;
        new bootstrap.Modal(document.getElementById('modalRecibo')).show();
    }

    function imprimirRecibo() {
        const iframe = document.getElementById('iframeRecibo');
        if (iframe.contentWindow) {
            iframe.contentWindow.print();
        }
    }
</script>
