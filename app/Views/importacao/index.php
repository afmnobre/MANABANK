<div class="container-fluid text-white">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">
                <i class="bi bi-graph-up-arrow me-2 text-success"></i> Inteligência de Negócio (BI)
            </h2>
            <p class="text-white-50 small mb-0">Gerencie e analise suas vendas da LigaMagic</p>
        </div>

        <a href="<?= $base ?>importacao/dashboard" class="btn btn-info fw-bold shadow-sm">
            <i class="bi bi-pie-chart-fill me-2"></i> Dashboard Geral Consolidado
        </a>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card bg-dark border-secondary shadow-sm">
                <div class="card-header border-secondary bg-black py-3 text-center">
                    <h5 class="card-title mb-0 small text-uppercase fw-bold">
                        <i class="bi bi-cloud-upload me-2 text-success"></i> Nova Importação CSV
                    </h5>
                </div>
                <div class="card-body">
                    <form action="<?= $base ?>importacao/processar" method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label text-white-50 small">Tipo de Relatório:</label>
                            <select name="tipo_arquivo" class="form-select bg-black text-white border-secondary">
                                <option value="mensal">Relatório Mensal</option>
                                <option value="semanal">Relatório Semanal</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-white-50 small">Referência (Ex: Março 2026):</label>
                            <input type="text" name="referencia_periodo" class="form-control bg-black text-white border-secondary" placeholder="Digite o período..." required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-white-50 small">Arquivo da LigaMagic:</label>
                            <input type="file" name="arquivo_csv" class="form-control bg-black text-white border-secondary" accept=".csv" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100 fw-bold py-2 shadow">
                            <i class="bi bi-upload me-2"></i> Processar Dados
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card bg-dark border-secondary shadow-sm">
                <div class="card-header border-secondary bg-black py-3">
                    <h5 class="card-title mb-0 small text-uppercase fw-bold">
                        <i class="bi bi-journal-text me-2 text-info"></i> Lotes Importados
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover align-middle mb-0">
                            <thead class="text-white-50 small">
                                <tr class="border-secondary">
                                    <th class="ps-4 py-3">ID</th>
                                    <th>REFERÊNCIA</th>
                                    <th>TIPO</th>
                                    <th class="text-end">TOTAL (R$)</th>
                                    <th class="text-center">ITENS</th>
                                    <th class="text-end pe-4">AÇÕES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($lotes)): foreach ($lotes as $lote): ?>
                                    <tr class="border-secondary">
                                        <td class="ps-4 fw-bold text-secondary">#<?= $lote['id_lote'] ?></td>
                                        <td class="fw-bold"><?= htmlspecialchars($lote['referencia_periodo']) ?></td>
                                        <td>
                                            <span class="badge bg-secondary small"><?= strtoupper($lote['tipo_arquivo']) ?></span>
                                        </td>
                                        <td class="text-end text-success fw-bold">
                                            R$ <?= number_format($lote['valor_total_lote'], 2, ',', '.') ?>
                                        </td>
                                        <td class="text-center small text-white-50">
                                            <?= number_format($lote['total_itens_processados'], 0, ',', '.') ?>
                                        </td>
                                        <td class="text-end pe-4">
                                            <div class="btn-group shadow-sm">
                                                <a href="<?= $base ?>importacao/detalhes/<?= $lote['id_lote'] ?>"
                                                   class="btn btn-sm btn-info" title="Ver Dashboard deste Lote">
                                                    <i class="bi bi-graph-up"></i> Dashboard
                                                </a>

                                                <a href="<?= $base ?>importacao/excluir/<?= $lote['id_lote'] ?>"
                                                   class="btn btn-sm btn-outline-danger"
                                                   onclick="return confirm('Deseja excluir permanentemente este lote e todos os seus dados?')"
                                                   title="Excluir Lote">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">
                                            Nenhuma importação realizada.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card-header.bg-black { background-color: #000 !important; }
    .form-control:focus, .form-select:focus {
        box-shadow: none;
        border-color: #0dcaf0;
        background-color: #000 !important;
    }
    .table-hover tbody tr:hover { background-color: rgba(255,255,255,0.03); }
</style>
