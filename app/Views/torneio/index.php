<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-light">Torneios</h2>
        <div>
            <button class="btn btn-outline-info btn-sm me-2" onclick="window.open('<?= $base ?>torneiosuico/verRegrasSuico', '_blank', 'width=800,height=600')">
                <i class="bi bi-info-circle"></i> Regras Suíço
            </button>
            <a href="<?= $base ?>torneio/criar" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> Novo Torneio
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <?php if (!empty($torneios)): ?>
                <div class="card bg-secondary border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-dark table-striped table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-3">Nome</th>
                                        <th>Cardgame</th>
                                        <th>Data</th>
                                        <th>Status</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($torneios as $torneio): ?>
                                        <tr>
                                            <td class="ps-3 fw-bold text-info"><?= htmlspecialchars($torneio['nome_torneio']) ?></td>
                                            <td><span class="badge bg-dark border border-secondary"><?= htmlspecialchars($torneio['cardgame'] ?? 'N/A') ?></span></td>
                                            <td class="small"><?= date('d/m/Y', strtotime($torneio['data_criacao'])) ?></td>
                                            <td>
                                                <?php
                                                    $status = strtolower($torneio['status']);
                                                    $badgeClass = ($status == 'finalizado') ? 'bg-success' : (($status == 'em andamento') ? 'bg-warning text-dark' : 'bg-primary');
                                                ?>
                                                <span class="badge <?= $badgeClass ?>"><?= ucfirst($torneio['status']) ?></span>
                                            </td>
                                            <td class="text-center px-3">
                                                <div class="btn-group">
                                                    <a href="<?= $base ?>torneio/participantes/<?= $torneio['id_torneio'] ?>" class="btn btn-sm btn-success" title="Participantes"><i class="bi bi-people"></i></a>
                                                    <a href="<?= $base ?>torneio/gerenciar/<?= $torneio['id_torneio'] ?>" class="btn btn-sm btn-info text-white" title="Gerenciar Rodadas"><i class="bi bi-controller"></i></a>
                                                    <button class="btn btn-sm btn-primary" onclick="window.open('<?= $base ?>torneiosuico/verPontuacao/<?= $torneio['id_torneio'] ?>','_blank')" title="Ver Classificação"><i class="bi bi-award"></i></button>
                                                    <a href="<?= $base ?>torneio/excluir/<?= $torneio['id_torneio'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Confirma exclusão permanente?')" title="Excluir"><i class="bi bi-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-dark border-secondary text-center py-5">
                    <h5>Nenhum torneio encontrado.</h5>
                </div>
            <?php endif; ?>
        </div>

		<?php
		if (!function_exists('renderListaRanking')) {
			function renderListaRanking($jogadores) {
				if (empty($jogadores)) return ''; // Não deve cair aqui com o foreach dinâmico

				$html = '<div class="list-group list-group-flush">';
				foreach ($jogadores as $key => $j) {
					$pos = $key + 1;
					$cor = ($pos == 1) ? 'text-warning' : 'text-white-50';
					$primeiroNome = explode(' ', $j['nome'])[0];

					$html .= "
					<div class='list-group-item bg-transparent text-light border-0 px-0 py-1 d-flex justify-content-between align-items-center' style='font-size: 0.7rem;'>
						<span class='text-truncate'><b class='{$cor}'>{$pos}º</b> {$primeiroNome}</span>
						<span class='badge bg-secondary rounded-pill' style='font-size: 0.6rem;'>{$j['total_pontos']}</span>
					</div>";
				}
				$html .= '</div>';
				return $html;
			}
		}
		?>
			<div class="col-md-4">
				<div class="card bg-dark border-primary shadow-sm h-100">
					<div class="card-header bg-primary text-white text-center py-2">
						<h5 class="mb-0 small fw-bold"><i class="bi bi-trophy"></i> RANKINGS TOP 3</h5>
					</div>
					<div class="card-body p-2">
						<div class="row g-2">

							<div class="col-6 border-end border-secondary">
								<div class="text-center mb-3">
									<span class="badge bg-info text-dark w-100 py-1">MENSAL</span>
								</div>
								<?php if (empty($rankingMensal)): ?>
                                    <div class="text-white text-center small py-2:w
">Sem torneios este mês.</div>
								<?php else: ?>
									<?php foreach ($rankingMensal as $jogo => $jogadores): ?>
										<div class="mb-3">
											<h6 class="text-info text-uppercase fw-bold m-0" style="font-size: 0.65rem; border-bottom: 1px solid #333;"><?= $jogo ?></h6>
											<?= renderListaRanking($jogadores); ?>
										</div>
									<?php endforeach; ?>
								<?php endif; ?>
							</div>

							<div class="col-6">
								<div class="text-center mb-3">
									<span class="badge bg-warning text-dark w-100 py-1">ANUAL</span>
								</div>
								<?php if (empty($rankingAnual)): ?>
									<div class="text-white text-center small py-2">Sem torneios este ano.</div>
								<?php else: ?>
									<?php foreach ($rankingAnual as $jogo => $jogadores): ?>
										<div class="mb-3">
											<h6 class="text-info text-uppercase fw-bold m-0" style="font-size: 0.65rem; border-bottom: 1px solid #333;"><?= $jogo ?></h6>
											<?= renderListaRanking($jogadores); ?>
										</div>
									<?php endforeach; ?>
								<?php endif; ?>
							</div>

						</div>
					</div>
				</div>
			</div>
    </div>
</div>

<?php
/**
 * Função Auxiliar para renderizar o Top 3 de cada Card Game
 */
function renderRankingPorCardgame($dadosRanking) {
    if (empty($dadosRanking)) {
        echo '<p class="text-muted text-center small my-4">Sem dados para este período.</p>';
        return;
    }

    // Agrupa os resultados por cardgame caso não venham agrupados do Controller
    $agrupado = [];
    foreach ($dadosRanking as $row) {
        $agrupado[$row['cardgame']][] = $row;
    }

    foreach ($agrupado as $jogo => $jogadores): ?>
        <div class="mb-4">
            <h6 class="text-info text-uppercase fw-bold small border-bottom border-secondary pb-1">
                <?= htmlspecialchars($jogo) ?>
            </h6>
            <div class="list-group list-group-flush bg-transparent">
                <?php foreach (array_slice($jogadores, 0, 3) as $index => $player): ?>
                    <div class="list-group-item bg-transparent text-light border-0 px-0 py-1 d-flex justify-content-between align-items-center" style="font-size: 0.85rem;">
                        <span>
                            <span class="text-warning fw-bold"><?= $index + 1 ?>º</span>
                            <?= htmlspecialchars($player['nome_jogador']) ?>
                        </span>
                        <span class="badge bg-secondary rounded-pill"><?= $player['pontos'] ?> pts</span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach;
}
?>
