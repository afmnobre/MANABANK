<?php
/**
 * Lógica de detecção de URL para garantir funcionamento Local e Remoto
 */
$isMANABANK = (strpos($_SERVER['SCRIPT_NAME'], '/MANABANK/') !== false);
$baseUrl = $isMANABANK ? '/MANABANK/' : '/';

// Caminho base para os logos das lojas
$lojasPath = $baseUrl . 'public/storage/uploads/lojas/';
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-light">Lojas Cadastradas</h3>
        <a href="<?= $baseUrl ?>admin/loja/create" class="btn btn-primary shadow-sm">
            Nova Loja
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <?php if (!empty($lojas)): ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 bg-white">
                        <thead class="table-light text-secondary">
                            <tr>
                                <th class="ps-4" style="width: 80px;">ID</th>
                                <th>Logo</th>
                                <th>Nome da Loja</th>
                                <th>CNPJ</th>
                                <th>Contrato</th>
                                <th>Tema</th>
                                <th class="text-center pe-4">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lojas as $loja):
                                $logoImg = !empty($loja['logo'])
                                    ? $lojasPath . $loja['id_loja'] . '/' . $loja['logo']
                                    : null;
                            ?>
                                <tr>
                                    <td class="ps-4 text-muted small">#<?= $loja['id_loja'] ?></td>
                                    <td>
                                        <?php if ($logoImg): ?>
                                            <img src="<?= $logoImg ?>" alt="Logo"
                                                 style="height: 40px; width: 60px; object-fit: contain;"
                                                 class="rounded border bg-light p-1">
                                        <?php else: ?>
                                            <span class="badge bg-light text-secondary border fw-normal">Sem logo</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-dark"><?= htmlspecialchars($loja['nome_loja']) ?></span>
                                    </td>
                                    <td><small class="text-muted"><?= htmlspecialchars($loja['cnpj']) ?></small></td>
                                    <td>
                                        <?php if(!empty($loja['numero_contrato'])): ?>
                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2">
                                                <?= htmlspecialchars($loja['numero_contrato']) ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="text-muted small italic">Sem contrato</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div style="width:20px; height:20px; background:<?= $loja['cor_tema'] ?>; border-radius:4px; border: 1px solid rgba(0,0,0,0.1);"></div>
                                            <small class="text-muted"><?= strtoupper($loja['cor_tema']) ?></small>
                                        </div>
                                    </td>
                                    <td class="text-center pe-4">
                                        <div class="btn-group">
                                            <button class="btn btn-outline-info btn-sm" onclick="abrirHistorico(<?= $loja['id_loja'] ?>)">
                                                Histórico
                                            </button>
                                            <a href="<?= $baseUrl ?>admin/loja/edit/<?= $loja['id_loja'] ?>" class="btn btn-outline-warning btn-sm">Editar</a>
                                            <a href="<?= $baseUrl ?>admin/loja/delete/<?= $loja['id_loja'] ?>"
                                               class="btn btn-outline-danger btn-sm"
                                               onclick="return confirm('Deseja realmente excluir esta loja?')">Excluir</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="py-5 text-center">
                    <p class="text-muted mb-0">Nenhuma loja cadastrada no sistema.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="modal fade" id="historicoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold text-dark">Histórico de Contratos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body" id="conteudoHistorico">
                </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script>
// Capturamos a baseUrl do PHP para o JavaScript
const baseUrl = '<?= $baseUrl ?>';

function abrirHistorico(id_loja) {
    const modalEl = document.getElementById('historicoModal');
    const myModal = new bootstrap.Modal(modalEl);
    myModal.show();

    const conteudo = document.getElementById('conteudoHistorico');
    conteudo.innerHTML = '<div class="text-center py-4"><div class="spinner-border spinner-border-sm text-primary"></div><p class="mt-2 small">Buscando histórico...</p></div>';

    fetch(`${baseUrl}admin/contrato/historico/${id_loja}`)
        .then(res => res.json())
        .then(data => {
            if (!data || data.length === 0) {
                conteudo.innerHTML = '<div class="alert alert-light text-center border">Nenhum histórico encontrado para esta loja.</div>';
                return;
            }

            let html = `<div class="table-responsive">
                            <table class="table table-sm table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nº Contrato</th>
                                        <th>Tipo</th>
                                        <th>Vigência</th>
                                        <th>Status</th>
                                        <th>Vínculo</th>
                                    </tr>
                                </thead>
                                <tbody>`;

            data.forEach(h => {
                const inicio = new Date(h.data_inicio_contrato).toLocaleDateString('pt-BR');
                const fim = new Date(h.data_fim_contrato).toLocaleDateString('pt-BR');
                const vinculo = new Date(h.data_vinculo).toLocaleDateString('pt-BR');

                // Exibe o novo numero_contrato ou o ID como fallback
                const nContrato = h.numero_contrato || `#${h.id_contrato}`;

                html += `<tr>
                            <td class="fw-bold text-primary small">${nContrato}</td>
                            <td class="fw-bold small">${h.tipo_contrato}</td>
                            <td class="small">${inicio} a ${fim}</td>
                            <td><span class="badge bg-light text-dark border small fw-normal">${h.status_contrato}</span></td>
                            <td class="small text-muted">${vinculo}</td>
                         </tr>`;
            });

            html += '</tbody></table></div>';
            conteudo.innerHTML = html;
        })
        .catch(err => {
            console.error(err);
            conteudo.innerHTML = '<p class="text-danger text-center">Erro ao carregar histórico.</p>';
        });
}
</script>
