<?php
/**
 * Lógica de detecção de URL para garantir funcionamento Local e Remoto
 */
$isMANABANK = (strpos($_SERVER['SCRIPT_NAME'], '/MANABANK/') !== false);
$baseUrl = $isMANABANK ? '/MANABANK/' : '/';

// Caminho base para os logos
$lojasPath = $baseUrl . 'public/storage/uploads/lojas/';
?>

<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-light">Gestão de Contratos</h3>
        <a href="<?= $baseUrl ?>admin/contrato/form" class="btn btn-primary shadow-sm">
            <i class="bi bi-file-earmark-plus"></i> Novo Contrato
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 bg-white">
                    <thead class="table-light text-secondary">
                        <tr>
                            <th class="ps-4">Logo</th>
                            <th>Loja / Cliente</th>
                            <th>Nº Contrato</th>
                            <th>Tipo Plano</th>
                            <th>Vigência</th>
                            <th class="text-center">Status</th>
                            <th class="text-center pe-4">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($contratos)): ?>
                            <?php foreach($contratos as $c):
                                // Busca a loja correspondente ao contrato
                                $lojaData = array_filter($lojas, fn($l) => $l['id_loja'] == $c['id_loja']);
                                $loja = array_values($lojaData)[0] ?? null;

                                if ($loja):
                                    $logoImg = !empty($loja['logo'])
                                        ? $lojasPath . $loja['id_loja'] . '/' . $loja['logo']
                                        : null;
                            ?>
                                <tr>
                                    <td class="ps-4">
                                        <?php if ($logoImg): ?>
                                            <img src="<?= $logoImg ?>" alt="Logo"
                                                 style="height: 35px; width: 50px; object-fit: contain;"
                                                 class="rounded border bg-light p-1">
                                        <?php else: ?>
                                            <div class="bg-light border rounded text-center small text-muted" style="width: 50px; line-height: 35px;">S/L</div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark"><?= htmlspecialchars($loja['nome_loja']) ?></div>
                                        <small class="text-muted">ID Loja: #<?= $loja['id_loja'] ?></small>
                                    </td>
                                    <td>
                                        <span class="text-primary fw-bold small">
                                            <?= htmlspecialchars($c['numero_contrato'] ?? 'N/A') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border fw-normal">
                                            <?= ucfirst(htmlspecialchars($c['tipo'])) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="small">
                                            <span class="text-success"><?= date('d/m/Y', strtotime($c['data_inicio'])) ?></span>
                                            <span class="text-muted mx-1">até</span>
                                            <span class="text-danger"><?= date('d/m/Y', strtotime($c['data_fim'])) ?></span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                            $statusClass = ($c['status'] == 'ativo') ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary';
                                        ?>
                                        <span class="badge <?= $statusClass ?> border px-2">
                                            <?= ucfirst(htmlspecialchars($c['status'])) ?>
                                        </span>
                                    </td>
                                    <td class="text-center pe-4">
                                        <div class="btn-group shadow-sm">
                                            <button class="btn btn-sm btn-outline-info" onclick="abrirContrato(<?= $c['id_contrato'] ?>)" title="Ver Detalhes">
                                                Visualizar
                                            </button>
                                            <a href="<?= $baseUrl ?>admin/contrato/form/<?= $c['id_contrato'] ?>" class="btn btn-sm btn-outline-warning" title="Editar">
                                                Editar
                                            </a>
                                            <a href="<?= $baseUrl ?>admin/contrato/delete/<?= $c['id_contrato'] ?>"
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Deseja realmente excluir este contrato?')">
                                                Excluir
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">Nenhum contrato registrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="contratoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold text-dark" id="modalTitulo">Contrato de Prestação de Serviço</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body p-4" id="conteudoContrato">
                </div>
            <div class="modal-footer bg-light d-print-none">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" onclick="window.print()"><i class="bi bi-printer"></i> Imprimir</button>
            </div>
        </div>
    </div>
</div>

<script>
window.contratosData = <?= json_encode($contratos) ?>;
window.lojasData = <?= json_encode($lojas) ?>;
window.baseUrlPath = "<?= $baseUrl ?>";

window.abrirContrato = function(id_contrato) {
    const contrato = window.contratosData.find(c => c.id_contrato == id_contrato);
    const loja = window.lojasData.find(l => l.id_loja == contrato.id_loja);

    if (!contrato || !loja) return;

    // Prioriza o numero_contrato gerado no banco
    const numeroContrato = contrato.numero_contrato || `CT-${contrato.id_contrato.toString().padStart(4, '0')}`;
    const dataIni = new Date(contrato.data_inicio).toLocaleDateString('pt-BR');
    const dataFim = new Date(contrato.data_fim).toLocaleDateString('pt-BR');
    const logoUrl = `${window.baseUrlPath}public/storage/uploads/lojas/${loja.id_loja}/${loja.logo}`;

    const html = `
        <div class="text-dark">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h4 class="mb-0 fw-bold text-dark">ManaBank / TCG Balcão</h4>
                    <p class="text-muted small">Nº do Contrato: <strong>${numeroContrato}</strong></p>
                </div>
                ${loja.logo ? `<img src="${logoUrl}" style="height:50px; border:1px solid #dee2e6; padding:5px; border-radius:5px; background: white;">` : ''}
            </div>

            <div class="row mb-4">
                <div class="col-sm-6 text-dark">
                    <p class="mb-1 small text-muted text-uppercase fw-bold">Contratante</p>
                    <p class="fw-bold mb-0 text-dark">${loja.nome_loja}</p>
                    <p class="small mb-0 text-secondary">CNPJ: ${loja.cnpj || 'Não informado'}</p>
                </div>
                <div class="col-sm-6 text-sm-end text-dark">
                    <p class="mb-1 small text-muted text-uppercase fw-bold">Vigência</p>
                    <p class="fw-bold mb-0 text-primary">${dataIni} até ${dataFim}</p>
                    <p class="small mb-0 text-secondary">Plano: ${contrato.tipo.toUpperCase()}</p>
                </div>
            </div>

            <hr class="border-secondary opacity-25">

            <div class="p-4 border rounded shadow-sm"
                 style="background-color: #fdfdfd; color: #333; font-size: 0.95rem; max-height: 400px; overflow-y: auto; line-height: 1.6;">

                <h6 class="fw-bold text-center mb-4 text-dark text-uppercase" style="border-bottom: 2px solid #eee; padding-bottom: 10px;">
                    Contrato de Licença de Uso de Software
                </h6>

                <p>Este documento estabelece os termos de uso do sistema <strong>TCG BALCÃO</strong> pela contratante <strong>${loja.nome_loja}</strong>.</p>
                <p><strong>1. Objeto:</strong> Licença de uso temporário de software de gestão comercial (SaaS) especializado em Trading Card Games, com acesso via navegador.</p>
                <p><strong>2. Suporte:</strong> A ManaBank garante suporte técnico para correção de falhas e atualizações de segurança durante o período vigente.</p>
                <p><strong>3. Vencimento:</strong> O acesso ao banco de dados e funcionalidades será interrompido automaticamente em caso de não renovação após o dia <strong>${dataFim}</strong>.</p>

                <div class="mt-5 text-center">
                    <div style="border-top: 1px solid #ccc; width: 250px; margin: 0 auto;"></div>
                    <p class="text-muted small mt-1">Assinatura Digital - Validado via Sistema ManaBank</p>
                </div>
            </div>
        </div>
    `;

    document.getElementById('conteudoContrato').innerHTML = html;
    const myModal = new bootstrap.Modal(document.getElementById('contratoModal'));
    myModal.show();
}
</script>
