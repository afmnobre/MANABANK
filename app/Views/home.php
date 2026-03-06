<style>
#print-area { display: none; }

@media print {
    @page { margin: 1cm; size: auto; }
    body { background: white !important; margin: 0 !important; padding: 0 !important; }
    body * { visibility: hidden !important; }
    #print-area, #print-area * { visibility: visible !important; }
    #print-area {
        display: block !important;
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        page-break-after: avoid !important;
    }
    .p-4, div { max-height: none !important; overflow: visible !important; height: auto !important; }
    .modal-backdrop, .modal { display: none !important; }
}
</style>

<?php
// Função para máscara de telefone
function mascaraTelefone($numero) {
    $n = preg_replace('/\D/', '', $numero);
    if (strlen($n) === 11) {
        return "(" . substr($n, 0, 2) . ") " . substr($n, 2, 5) . "-" . substr($n, 7);
    } elseif (strlen($n) === 10) {
        return "(" . substr($n, 0, 2) . ") " . substr($n, 2, 4) . "-" . substr($n, 6);
    }
    return $numero;
}

// O $base já vem do seu Header.php como rtrim($this->baseUrl, '/') . '/';
?>

<div class="row">
  <div class="col-md-6">
    <div class="card mb-4 bg-dark text-light border-danger">
      <div class="card-header bg-danger text-white">
        👥 Clientes Inativos (mais de 2 meses)
      </div>
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-dark table-striped table-bordered align-middle">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>Telefone</th>
                  <th>Última Compra</th>
                  <th>Total Gasto</th>
                  <th>Ação</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($clientesInativos)): ?>
                  <?php foreach ($clientesInativos as $cliente): ?>
                    <tr>
                      <td><?= htmlspecialchars($cliente['nome']) ?></td>
                      <td><?= !empty($cliente['telefone']) ? mascaraTelefone($cliente['telefone']) : '<span class="text-muted">Sem fone</span>' ?></td>
                      <td><?= $cliente['ultima_compra'] ? date('d/m/Y', strtotime($cliente['ultima_compra'])) : 'Nunca' ?></td>
                      <td>R$ <?= number_format($cliente['total_gasto'], 2, ',', '.') ?></td>
                      <td>
                        <?php if (!empty($cliente['telefone'])): ?>
                          <a href="https://wa.me/55<?= preg_replace('/\D/', '', $cliente['telefone']) ?>?text=Olá%20<?= urlencode($cliente['nome']) ?>,%20vimos%20que%20faz%20tempo%20que%20não%20nos%20visita!"
                               target="_blank" class="btn btn-success btn-sm">WhatsApp</a>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr><td colspan="5" class="text-center">Nenhum inativo.</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card mb-4 bg-dark text-light border-primary">
        <div class="card-header bg-primary text-white">
            📅 Informações do Contrato
        </div>
        <div class="card-body">
            <p><strong>Número do Contrato:</strong>
                <span class="badge bg-info text-dark">
                    <?= (!empty($contratoAtivo['numero_contrato'])) ? $contratoAtivo['numero_contrato'] : 'Nº não cadastrado' ?>
                </span>
            </p>
            <hr>

            <?php if (!empty($contratoAtivo['id_contrato'])): ?>
                <button class="btn btn-outline-primary btn-sm" onclick="abrirContratoLogado()">
                    <i class="bi bi-file-earmark-text"></i> Visualizar Meu Contrato
                </button>
                <hr>
                <p><strong>Status:</strong>
                    <span class="text-success">Contrato Ativo</span>
                </p>
            <?php else: ?>
                <p class="text-warning">Sem contrato ativo no sistema</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="card mb-4 bg-dark text-light border-secondary">
      <div class="card-header bg-secondary text-white">
        ⚙️ Configurações do Usuário
      </div>
      <div class="card-body">
        <div class="d-flex gap-2">
            <a href="<?= $base ?>usuario/alterar-senha" class="btn btn-outline-light btn-sm">Alterar Senha</a>
            <a href="<?= $base ?>usuario/editar-dados" class="btn btn-outline-info btn-sm">Atualizar Dados</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4 bg-dark text-light border-success">
      <div class="card-header bg-success text-white">
        📊 Resumo do Dia
      </div>
      <div class="card-body">
        <div class="row text-center">
            <div class="col-md-4 border-end border-secondary mb-3 mb-md-0">
                <small class="text-light d-block mb-1 opacity-75">Pedidos Hoje</small>
                <span class="h4 fw-bold text-white"><?= $resumoDia['pedidos'] ?? 0 ?></span>
            </div>
            <div class="col-md-4 border-end border-secondary mb-3 mb-md-0">
                <small class="text-light d-block mb-1 opacity-75">Total Vendido</small>
                <span class="h4 fw-bold text-success">R$ <?= number_format($resumoDia['total_vendido'] ?? 0, 2, ',', '.') ?></span>
            </div>
            <div class="col-md-4">
                <small class="text-light d-block mb-1 opacity-75">Produto Mais Vendido</small>
                <span class="h4 fw-bold text-info"><?= htmlspecialchars($resumoDia['produto_top'] ?? '---') ?></span>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4 bg-dark text-light border-warning">
      <div class="card-header bg-warning text-light fw-bold">
        ⚠️ Alertas do Sistema
      </div>
      <div class="card-body">
        <div class="row">
            <div class="col-md-4 mb-2">
                <div class="d-flex justify-content-between align-items-center p-2 border border-secondary rounded">
                    <span>Estoque Baixo</span>
                    <span class="badge <?= ($alertas['estoque_baixo'] ?? 0) > 0 ? 'bg-danger' : 'bg-secondary' ?> rounded-pill">
                        <?= $alertas['estoque_baixo'] ?? 0 ?>
                    </span>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <div class="d-flex justify-content-between align-items-center p-2 border border-secondary rounded">
                    <span>Pagamentos Pendentes</span>
                    <span class="badge <?= ($alertas['pendencias'] ?? 0) > 0 ? 'bg-warning text-dark' : 'bg-secondary' ?> rounded-pill">
                        <?= $alertas['pendencias'] ?? 0 ?>
                    </span>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <div class="d-flex justify-content-between align-items-center p-2 border border-secondary rounded">
                    <span>Contratos a Vencer (30 dias)</span>
                    <span class="badge <?= ($alertas['contratos_vencendo'] ?? 0) > 0 ? 'bg-info text-dark' : 'bg-secondary' ?> rounded-pill">
                        <?= $alertas['contratos_vencendo'] ?? 0 ?>
                    </span>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="print-area"></div>

<div class="modal fade" id="contratoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold text-dark">Meu Contrato de Licença</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body p-4" id="conteudoContrato"></div>
            <div class="modal-footer bg-light d-print-none">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" onclick="imprimirContrato()">
                    <i class="bi bi-printer"></i> Imprimir
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Usando as variáveis injetadas pelo Controller e Header.php
window.minhaLoja = <?= json_encode($dadosDaLoja ?? []) ?>;
window.meuContrato = <?= json_encode($contratoAtivo ?? []) ?>;

window.abrirContratoLogado = function() {
    const loja = window.minhaLoja;
    const contrato = window.meuContrato;
    const base = window.BASE_URL;

    if (!loja || Object.keys(loja).length === 0) {
        alert("Dados da loja não carregados.");
        return;
    }

    const numeroContrato = contrato.numero_contrato || `CT-${(contrato.id_contrato || 0).toString().padStart(4, '0')}`;
    const dataIni = contrato.data_inicio ? new Date(contrato.data_inicio).toLocaleDateString('pt-BR') : '---';
    const dataFim = contrato.data_fim ? new Date(contrato.data_fim).toLocaleDateString('pt-BR') : '---';

    // Montagem robusta da URL da Logo
    const logoUrl = (loja.logo && loja.id_loja)
        ? `${base}public/storage/uploads/lojas/${loja.id_loja}/${loja.logo}`
        : '';

    const html = `
        <div class="text-dark secao-impressao">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h4 class="mb-0 fw-bold text-dark">ManaBank / TCG Balcão</h4>
                    <p class="text-muted small">Nº do Contrato: <strong>${numeroContrato}</strong></p>
                </div>
                ${logoUrl ? `<img src="${logoUrl}" style="height:50px; border:1px solid #dee2e6; padding:5px; border-radius:5px; background: white;" onerror="this.style.display='none'">` : ''}
            </div>

            <div class="row mb-4">
                <div class="col-sm-6 text-dark">
                    <p class="mb-1 small text-muted text-uppercase fw-bold">Contratante</p>
                    <p class="fw-bold mb-0 text-dark">${loja.nome_loja || 'Não identificado'}</p>
                    <p class="small mb-0 text-secondary">CNPJ: ${loja.cnpj || 'Não informado'}</p>
                </div>
                <div class="col-sm-6 text-sm-end text-dark">
                    <p class="mb-1 small text-muted text-uppercase fw-bold">Vigência</p>
                    <p class="fw-bold mb-0 text-primary">${dataIni} até ${dataFim}</p>
                    <p class="small mb-0 text-secondary">Plano: ${(contrato.tipo || '---').toUpperCase()}</p>
                </div>
            </div>

            <hr class="border-secondary opacity-25">

            <div class="p-4 border rounded shadow-sm"
                 style="background-color: #fdfdfd; color: #333; font-size: 0.95rem; max-height: 400px; overflow-y: auto; line-height: 1.6;">

                <h6 class="fw-bold text-center mb-4 text-dark text-uppercase" style="border-bottom: 2px solid #eee; padding-bottom: 10px;">
                    Contrato de Licença de Uso de Software
                </h6>

                <p>Este documento estabelece os termos de uso do sistema <strong>TCG BALCÃO</strong> pela contratante <strong>${loja.nome_loja || '---'}</strong>.</p>
                <p><strong>1. Objeto:</strong> Licença de uso temporário de software de gestão comercial (SaaS) especializado em Trading Card Games.</p>
                <p><strong>2. Suporte:</strong> A ManaBank garante suporte técnico para correção de falhas e atualizações de segurança.</p>
                <p><strong>3. Vencimento:</strong> O acesso será interrompido em caso de não renovação após o dia <strong>${dataFim}</strong>.</p>

                <div class="mt-5 text-center">
                    <div style="border-top: 1px solid #ccc; width: 250px; margin: 0 auto;"></div>
                    <p class="text-muted small mt-1">Assinatura Digital - Validado via Sistema ManaBank em <?= date('d/m/Y') ?></p>
                </div>
            </div>
        </div>
    `;

    document.getElementById('conteudoContrato').innerHTML = html;
    const myModal = new bootstrap.Modal(document.getElementById('contratoModal'));
    myModal.show();
}

window.imprimirContrato = function() {
    const conteudo = document.getElementById('conteudoContrato').innerHTML;
    const printArea = document.getElementById('print-area');
    printArea.innerHTML = conteudo.trim();

    setTimeout(() => {
        window.print();
        printArea.innerHTML = '';
    }, 250);
}
</script>
