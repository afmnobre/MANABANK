<div class="container-fluid">
    <h2 class="text-white fw-bold mb-4">Análise de Vendas (BI)</h2>

    <div class="row">
        <div class="col-md-5">
            <div class="card bg-dark border-secondary shadow-sm">
                <div class="card-header border-secondary bg-black">
                    <h5 class="text-white mb-0 small uppercase">Faturamento por Jogo</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover mb-0">
                            <thead>
                                <tr class="text-white-50 small">
                                    <th>JOGO</th>
                                    <th class="text-center">QTD</th>
                                    <th class="text-end">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($dadosPorJogo as $jogo): ?>
                                <tr>
                                    <td class="fw-bold"><?= $jogo['jogo_base'] ?></td>
                                    <td class="text-center"><?= $jogo['qtd'] ?></td>
                                    <td class="text-end text-success">R$ <?= number_format($jogo['total'], 2, ',', '.') ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card bg-dark border-secondary shadow-sm">
                <div class="card-header border-secondary bg-black">
                    <h5 class="text-white mb-0 small uppercase">Top 10 Produtos (Maior Receita)</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped mb-0">
                            <thead>
                                <tr class="text-white-50 small">
                                    <th class="ps-3">PRODUTO</th>
                                    <th>JOGO</th>
                                    <th class="text-end">QTD</th>
                                    <th class="text-end pe-3">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($topProdutos as $p): ?>
                                <tr>
                                    <td class="ps-3 small"><?= $p['nome_produto_pt'] ?: 'N/A' ?></td>
                                    <td><span class="badge bg-secondary"><?= $p['jogo_base'] ?></span></td>
                                    <td class="text-end"><?= $p['qtd'] ?></td>
                                    <td class="text-end pe-3 text-info fw-bold">R$ <?= number_format($p['total'], 2, ',', '.') ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
