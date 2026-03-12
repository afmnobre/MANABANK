<style>
/* Estilização de Impressão e UI */
#print-area { display: none; }
.tracking-wider { letter-spacing: 1px; }
.kpi-card { transition: transform 0.2s; border-left: 4px solid; }
.kpi-card:hover { transform: translateY(-3px); }

@media print {
    @page { margin: 1cm; size: auto; }
    body { background: white !important; margin: 0 !important; padding: 0 !important; }
    body * { visibility: hidden !important; }
    #print-area, #print-area * { visibility: visible !important; }
    #print-area {
        display: block !important;
        position: absolute;
        left: 0; top: 0; width: 100%;
    }
}
</style>

<?php
function mascaraTelefone($numero) {
    $n = preg_replace('/\D/', '', $numero);
    if (strlen($n) === 11) return "(" . substr($n, 0, 2) . ") " . substr($n, 2, 5) . "-" . substr($n, 7);
    if (strlen($n) === 10) return "(" . substr($n, 0, 2) . ") " . substr($n, 2, 4) . "-" . substr($n, 6);
    return $numero;
}
?>

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="card bg-dark border-secondary kpi-card shadow-sm h-100" style="border-left-color: #0d6efd !important;">
                <div class="card-body">
                    <small class="text-white-50 text-uppercase tracking-wider fw-bold">Pedidos Hoje</small>
                    <div class="d-flex align-items-center mt-2">
                        <h2 class="mb-0 fw-bold text-white"><?= $resumoDia['pedidos'] ?? 0 ?></h2>
                        <i class="bi bi-cart-check ms-auto text-primary fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="card bg-dark border-secondary kpi-card shadow-sm h-100" style="border-left-color: #198754 !important;">
                <div class="card-body">
                    <small class="text-white-50 text-uppercase tracking-wider fw-bold">Total Vendido</small>
                    <div class="d-flex align-items-center mt-2">
                        <h2 class="mb-0 fw-bold text-success">R$ <?= number_format($resumoDia['total_vendido'] ?? 0, 2, ',', '.') ?></h2>
                        <i class="bi bi-cash-stack ms-auto text-success fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-dark border-secondary kpi-card shadow-sm h-100" style="border-left-color: #0dcaf0 !important;">
                <div class="card-body">
                    <small class="text-white-50 text-uppercase tracking-wider fw-bold">Top Produto</small>
                    <div class="d-flex align-items-center mt-2">
                        <h2 class="mb-0 fs-5 fw-bold text-info text-truncate"><?= htmlspecialchars($resumoDia['produto_top'] ?? '---') ?></h2>
                        <i class="bi bi-star ms-auto text-info fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-7 mb-4">
            <div class="card bg-dark border-secondary shadow-sm h-100">
                <div class="card-header bg-transparent border-secondary py-3 d-flex justify-content-between align-items-center">
                    <h6 class="text-danger fw-bold mb-0 text-uppercase tracking-wider">
                        <i class="bi bi-person-x me-2"></i> Clientes Inativos (+2 meses)
                    </h6>
                    <span class="badge bg-danger rounded-pill"><?= count($clientesInativos) ?></span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover mb-0 align-middle">
                            <thead>
                                <tr class="text-white-50 small border-secondary">
                                    <th class="ps-3 border-0">Nome</th>
                                    <th class="border-0">Última Visita</th>
                                    <th class="border-0">Gasto Total</th>
                                    <th class="text-end pe-3 border-0">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($clientesInativos)): ?>
                                    <?php foreach ($clientesInativos as $cliente): ?>
                                        <tr class="border-secondary">
                                            <td class="ps-3 fw-bold"><?= htmlspecialchars($cliente['nome']) ?></td>
                                            <td class="small text-white-50"><?= $cliente['ultima_compra'] ? date('d/m/Y', strtotime($cliente['ultima_compra'])) : 'Nunca' ?></td>
                                            <td class="text-white">R$ <?= number_format($cliente['total_gasto'], 2, ',', '.') ?></td>
                                            <td class="text-end pe-3">
                                                <?php if (!empty($cliente['telefone'])): ?>
                                                    <a href="https://wa.me/55<?= preg_replace('/\D/', '', $cliente['telefone']) ?>?text=Olá%20<?= urlencode($cliente['nome']) ?>,%20vimos%20que%20faz%20tempo%20que%20não%20nos%20visita!"
                                                       target="_blank" class="btn btn-success btn-sm rounded-pill px-3">
                                                        <i class="bi bi-whatsapp"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="4" class="text-center py-4 text-white-50">Tudo em dia! Nenhum inativo.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card bg-dark border-secondary shadow-sm mb-4">
                <div class="card-header bg-transparent border-secondary py-3 text-warning fw-bold text-uppercase tracking-wider small">
                    <i class="bi bi-exclamation-triangle me-2"></i> Alertas do Sistema
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush bg-transparent">
                        <div class="list-group-item bg-transparent border-secondary d-flex justify-content-between align-items-center px-0">
                            <span class="text-white-50">Estoque Baixo</span>
                            <span class="badge <?= ($alertas['estoque_baixo'] ?? 0) > 0 ? 'bg-danger' : 'bg-secondary' ?> rounded-pill"><?= $alertas['estoque_baixo'] ?? 0 ?></span>
                        </div>
                        <div class="list-group-item bg-transparent border-secondary d-flex justify-content-between align-items-center px-0">
                            <span class="text-white-50">Pagamentos Pendentes</span>
                            <span class="badge <?= ($alertas['pendencias'] ?? 0) > 0 ? 'bg-warning text-dark' : 'bg-secondary' ?> rounded-pill"><?= $alertas['pendencias'] ?? 0 ?></span>
                        </div>
                        <div class="list-group-item bg-transparent border-0 d-flex justify-content-between align-items-center px-0">
                            <span class="text-white-50">Contratos a Vencer</span>
                            <span class="badge <?= ($alertas['contratos_vencendo'] ?? 0) > 0 ? 'bg-info text-dark' : 'bg-secondary' ?> rounded-pill"><?= $alertas['contratos_vencendo'] ?? 0 ?></span>
                        </div>
                    </div>
                </div>
            </div>

			<div class="card bg-dark border-secondary shadow-sm mb-4">
				<div class="card-header bg-transparent border-secondary py-3 text-primary fw-bold text-uppercase tracking-wider small">
					<i class="bi bi-shield-check me-2"></i> Licença ManaBank
				</div>
				<div class="card-body">
					<div class="d-flex align-items-center mb-3">
						<div class="me-3">
							<i class="bi bi-file-earmark-text text-white-50 fs-2"></i>
						</div>
						<div>
							<p class="mb-0 text-white small">Nº Contrato: <strong><?= (!empty($contratoAtivo['numero_contrato'])) ? $contratoAtivo['numero_contrato'] : '---' ?></strong></p>

							<div class="d-flex align-items-center gap-2 mt-1">
								<?php
									// Cálculo de dias usando a coluna 'data_fim' da sua tabela
									$dataExp = !empty($contratoAtivo['data_fim']) ? new DateTime($contratoAtivo['data_fim']) : null;
									$hoje = new DateTime();

									// Resetamos as horas para garantir que o cálculo considere apenas os dias
									$hoje->setTime(0,0,0);
									if($dataExp) $dataExp->setTime(0,0,0);

									$vencido = ($dataExp && $hoje > $dataExp);
									$diasRestantes = $dataExp ? (int)$hoje->diff($dataExp)->format("%r%a") : 0;

									if ($vencido):
								?>
									<span class="badge bg-danger-subtle text-danger border border-danger px-2 py-1 small" style="font-size: 0.7rem;">EXPIRADO</span>
									<small class="text-danger fw-bold" style="font-size: 0.7rem;">(<?= abs($diasRestantes) ?> dias de atraso)</small>
								<?php else: ?>
									<span class="badge bg-success-subtle text-success border border-success px-2 py-1 small" style="font-size: 0.7rem;">ATIVO</span>
									<small class="text-white-50" style="font-size: 0.7rem;"><i class="bi bi-clock me-1"></i><?= $diasRestantes ?> dias restantes</small>
								<?php endif; ?>
							</div>
						</div>
					</div>

					<button class="btn btn-outline-secondary btn-sm w-100 fw-bold mb-2" onclick="abrirContratoLogado()" style="font-size: 0.75rem;">
						<i class="bi bi-eye me-1"></i> VISUALIZAR DOCUMENTO
					</button>

					<?php
						$btnColor = "btn-primary";
						$labelRenovar = "RENOVAR ASSINATURA";

						if ($diasRestantes <= 15 && $diasRestantes > 0) {
							$btnColor = "btn-warning";
							$labelRenovar = "RENOVAR (VENCE EM $diasRestantes DIAS)";
						} elseif ($vencido) {
							$btnColor = "btn-danger";
							$labelRenovar = "REGULARIZAR LICENÇA";
						}
					?>
					<button class="btn <?= $btnColor ?> btn-sm w-100 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalRenovacao">
						<i class="bi bi-arrow-repeat me-1"></i> <?= $labelRenovar ?>
					</button>
				</div>
				<div class="card-footer bg-transparent border-secondary py-2 d-flex justify-content-between">
					<a href="<?= $base ?>usuario/alterar-senha" class="text-white-50 small text-decoration-none hover-white"><i class="bi bi-key me-1"></i> Senha</a>
					<a href="<?= $base ?>usuario/editar-dados" class="text-white-50 small text-decoration-none hover-white"><i class="bi bi-person-gear me-1"></i> Perfil</a>
				</div>
			</div>
        </div>
    </div>
</div>

<div id="print-area"></div>
<div class="modal fade" id="contratoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg bg-light">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body p-4" id="conteudoContrato"></div>
            <div class="modal-footer border-0 d-print-none">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" onclick="imprimirContrato()">
                    <i class="bi bi-printer me-2"></i> Imprimir Contrato
                </button>
            </div>
        </div>
    </div>
</div>

<script>
window.minhaLoja = <?= json_encode($dadosDaLoja ?? []) ?>;
window.meuContrato = <?= json_encode($contratoAtivo ?? []) ?>;

window.abrirContratoLogado = function() {
    const loja = window.minhaLoja;
    const contrato = window.meuContrato;
    const base = window.BASE_URL;

    if (!loja || !contrato) return alert("Erro ao carregar dados.");

    const numeroContrato = contrato.numero_contrato || `CT-${(contrato.id_contrato || 0).toString().padStart(4, '0')}`;
    const dataIni = contrato.data_inicio ? new Date(contrato.data_inicio).toLocaleDateString('pt-BR') : '---';
    const dataFim = contrato.data_fim ? new Date(contrato.data_fim).toLocaleDateString('pt-BR') : '---';

    // Definição da URL do Logo ou placeholder caso não exista
    const logoUrl = (loja.logo && loja.id_loja)
        ? `${base}public/storage/uploads/lojas/${loja.id_loja}/${loja.logo}`
        : `${base}public/assets/img/placeholder-loja.png`;

    const html = `
        <div class="text-dark">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="d-flex align-items-center">
                    <img src="${logoUrl}" alt="Logo ${loja.nome_loja}" class="rounded me-3 border shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                    <div>
                        <h5 class="fw-bold mb-0 text-dark">${loja.nome_loja}</h5>
                        <p class="text-muted small mb-0">Licença de Uso: <span class="badge bg-secondary text-uppercase">${contrato.tipo || 'Padrão'}</span></p>
                    </div>
                </div>
                <div class="text-end">
                    <h4 class="fw-bold mb-0 text-dark">MANABANK</h4>
                    <p class="text-muted small mb-0">Gestão de TCG</p>
                </div>
            </div>

            <hr class="mt-0 mb-4">

            <div class="row mb-4 bg-white p-3 rounded border mx-0 shadow-sm">
                <div class="col-6 border-end">
                    <p class="mb-0 small text-muted">CONTRATANTE</p>
                    <p class="fw-bold mb-0">${loja.nome_loja}</p>
                    <p class="small text-muted mb-0">CNPJ: ${loja.cnpj || '---'}</p>
                </div>
                <div class="col-6 text-end">
                    <p class="mb-0 small text-muted">VIGÊNCIA DO PLANO</p>
                    <p class="fw-bold mb-0 text-primary">${dataIni} - ${dataFim}</p>
                    <p class="small text-muted mb-0">Contrato: ${numeroContrato}</p>
                </div>
            </div>

            <div class="p-3 border rounded bg-light small shadow-inner" style="line-height:1.6; max-height:300px; overflow-y:auto; border-left: 4px solid #0d6efd !important;">
                <h6 class="fw-bold text-dark mb-3"><i class="bi bi-file-earmark-text me-2"></i>TERMOS DE USO (SaaS)</h6>
                <p>1. <strong>Objeto:</strong> O presente instrumento regula o licenciamento de uso do software <strong>MANABANK</strong> para gestão balcão de lojas de TCG que ofertam cartas (MTG, Pokémon, Yu-Gi-Oh!), controle de PDV e gestão de comunidades.</p>
                <p>2. <strong>Propriedade:</strong> Todo o código-fonte, marcas e propriedade intelectual pertencem exclusivamente ao ecossistema ManaBank.</p>
                <p>3. <strong>Vencimento:</strong> Esta licença de uso é válida impreterivelmente até <strong>${dataFim}</strong>, sujeita a renovação conforme o tipo de contrato: <u>${contrato.tipo || 'Padrão'}</u>.</p>
                <p>4. <strong>Suporte:</strong> O suporte técnico é oferecido via canais oficiais de desenvolvedor para garantir a integridade do banco de dados MySQL.</p>
            </div>
        </div>
    `;

    document.getElementById('conteudoContrato').innerHTML = html;
    new bootstrap.Modal(document.getElementById('contratoModal')).show();
}

window.imprimirContrato = function() {
    document.getElementById('print-area').innerHTML = document.getElementById('conteudoContrato').innerHTML;
    window.print();
}
</script>

<div class="modal fade" id="modalRenovacao" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="background-color: #161b22; color: white;">

            <div class="modal-header border-secondary">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-arrow-repeat text-primary me-2"></i>Renovação ManaBank
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-4">
                <div class="bg-dark p-3 rounded border border-secondary mb-4">
                    <div class="d-flex justify-content-between small mb-2">
                        <span class="text-white-50">Contrato Atual:</span>
                        <span class="fw-bold"><?= $contratoAtivo['numero_contrato'] ?></span>
                    </div>
                    <div class="d-flex justify-content-between small mb-2">
                        <span class="text-white-50">Vence em:</span>
                        <span class="fw-bold text-warning"><?= date('d/m/Y', strtotime($contratoAtivo['data_fim'])) ?></span>
                    </div>
                    <div class="d-flex justify-content-between small">
                        <span class="text-white-50">Tipo:</span>
                        <span class="badge bg-primary-subtle text-primary text-uppercase"><?= $contratoAtivo['tipo'] ?></span>
                    </div>
                </div>

                <h6 class="small fw-bold text-uppercase mb-3">Escolha o período de renovação:</h6>

				<form action="<?= $base ?>contrato/gerarpagamento" method="POST" target="_blank">
					<input type="hidden" name="id_loja" value="<?= $loja['id_loja'] ?>">

					<?php if(isset($planos['anual'])): ?>
					<div class="card bg-dark border-primary mb-3">
						<div class="card-body d-flex align-items-center">
							<input class="form-check-input me-3" type="radio" name="tipo_renovacao" value="anual" id="planAnual" checked>
							<label class="form-check-label w-100" for="planAnual">
								<div class="d-flex justify-content-between align-items-center">
									<span><?= $planos['anual']['nome'] ?></span>
									<span class="fw-bold text-primary">R$ <?= number_format($planos['anual']['valor'], 2, ',', '.') ?></span>
								</div>
								<small class="text-white-50 d-block">Economia garantida e suporte VIP</small>
							</label>
						</div>
					</div>
					<?php endif; ?>

					<?php if(isset($planos['mensal'])): ?>
					<div class="card bg-dark border-secondary mb-4">
						<div class="card-body d-flex align-items-center">
							<input class="form-check-input me-3" type="radio" name="tipo_renovacao" value="mensal" id="planMensal">
							<label class="form-check-label w-100" for="planMensal">
								<div class="d-flex justify-content-between align-items-center">
									<span><?= $planos['mensal']['nome'] ?></span>
									<span class="fw-bold">R$ <?= number_format($planos['mensal']['valor'], 2, ',', '.') ?></span>
								</div>
							</label>
						</div>
					</div>
					<?php endif; ?>

					<button type="submit" class="btn btn-primary w-100 py-3 fw-bold">
						GERAR PAGAMENTO NO MERCADO PAGO
					</button>
				</form>
            </div>
        </div>
    </div>
</div>
