<?php $baseAssetUrl = $base . 'public'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Jogador - <?= htmlspecialchars($loja['nome_loja'] ?? 'Pai Nerd') ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body { background-color: #0d1117; color: white; font-family: sans-serif; }
        .text-tema { color: <?= $loja['cor_tema'] ?? '#00d4ff' ?>; }

        .container-ranking {
            border: 1px solid #30363d;
            border-radius: 12px;
            overflow: hidden;
            background: #161b22;
            margin-bottom: 2rem;
        }

        /* Coluna 1: Branding e Saldos */
        .col-stats { border-right: 1px solid #30363d; display: flex; flex-direction: column; }
        .header-logo-white { background-color: #ffffff; display: flex; justify-content: center; align-items: center; padding: 5px; height: 75px; }

        .my-score-bar {
            background: #000;
            padding: 8px 5px;
            border-left: 3px solid <?= $loja['cor_tema'] ?? '#00d4ff' ?>;
            flex-grow: 1;
        }

        .score-item { display: flex; justify-content: space-between; align-items: center; padding: 2px 5px; }
        .score-label { font-size: 0.45rem; color: #8b949e; text-transform: uppercase; font-weight: bold; }
        .score-value { font-size: 0.75rem; font-weight: bold; }

        /* Coluna 2: Ranking Mensal */
        .col-ranking-mensal { background: #0d1117; border-right: 1px solid #30363d; padding: 0; }
        .rank-header-mensal { font-size: 0.55rem; font-weight: bold; padding: 6px; text-align: center; background: #161b22; color: <?= $loja['cor_tema'] ?? '#00d4ff' ?>; border-bottom: 1px solid #30363d; }

        /* Coluna 3: Ranking Anual - MODIFICADO: Cor do título igual aos pontos anuais */
        .col-ranking-anual { background: #1c2128; padding: 0; }
        .rank-header-anual { font-size: 0.55rem; font-weight: bold; padding: 6px; text-align: center; background: #2d333b; color: #ffc107; border-bottom: 1px solid #444c56; }

        .table-top { margin-bottom: 0; font-size: 0.65rem; width: 100%; }
        .table-top td { border: none; padding: 5px; vertical-align: middle; white-space: nowrap; color: #c9d1d9; }

        .row-me {
            background-color: <?= ($loja['cor_tema'] ?? '#00d4ff') . '40' ?> !important;
            color: white !important; font-weight: bold;
        }

        .pedido-item { background: #161b22; border: 1px solid #30363d; border-radius: 8px; margin-bottom: 8px; padding: 10px; }
        .form-control { background: #010409; border: 1px solid #30363d; color: white; }
        .btn-tema { background-color: <?= $loja['cor_tema'] ?? '#00d4ff' ?>; color: #000; font-weight: bold; border: none; }
    </style>
</head>
<body>

<div class="container py-4" style="max-width: 650px;">

    <div class="text-center mb-4">
        <?php if(!empty($loja['id_loja']) && !empty($loja['logo'])): ?>
            <img src="<?= $baseAssetUrl ?>/storage/uploads/lojas/<?= htmlspecialchars($loja['id_loja']) ?>/<?= htmlspecialchars($loja['logo']) ?>" style="max-height: 55px;" class="mb-1">
        <?php endif; ?>
        <h6 class="fw-bold text-uppercase text-tema m-0" style="letter-spacing: 2px;"><?= htmlspecialchars($loja['nome_loja'] ?? 'PAI NERD') ?></h6>
    </div>

    <?php if (isset($perfil)): ?>

        <div class="text-center mb-4">
            <h3 class="fw-bold mb-0 text-uppercase"><?= htmlspecialchars($perfil['nome']) ?></h3>
            <div class="badge bg-dark border border-secondary text-white-50 mt-1" style="font-size: 0.6rem;">PAINEL DO JOGADOR</div>
        </div>

        <h6 class="text-uppercase small fw-bold mb-3 text-white-50"><i class="bi bi-trophy me-2"></i> Meus Saldos e Rankings</h6>

        <?php if(!empty($rankings)): foreach($rankings as $rank):
            $idGame = $rank['id_cardgame'] ?? null;
            $imgName = $rank['imagem_card_game'] ?? null;
            $urlImgGame = ($idGame && $imgName) ? $baseAssetUrl . "/storage/uploads/cardgames/" . $idGame . "/" . $imgName : null;
        ?>
            <div class="container-ranking shadow-lg">
                <div class="row g-0 d-flex flex-nowrap">

                    <div class="col-4 col-stats">
                        <div class="header-logo-white">
                            <?php if($urlImgGame): ?>
                                <img src="<?= $urlImgGame ?>" style="max-height: 50px; max-width: 95%; object-fit: contain;">
                            <?php else: ?>
                                <span class="text-dark fw-bold text-uppercase" style="font-size: 0.6rem;"><?= $rank['cardgame'] ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="my-score-bar d-flex flex-column justify-content-center">
                            <div class="score-item">
                                <span class="score-label">Pontos/Mensal</span>
                                <span class="score-value text-white"><?= $rank['meu_ponto_mensal'] ?? 0 ?></span>
                            </div>
                            <div class="score-item border-top border-secondary mt-1 pt-1">
                                <span class="score-label">Pontos/Anual</span>
                                <span class="score-value text-warning"><?= $rank['meu_ponto_anual'] ?? 0 ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-4 col-ranking-mensal">
                        <div class=" text-white rank-header-mensal text-uppercase">
                            <i class="bi bi-calendar3 me-1"></i> Mensal
                        </div>
                        <table class="table table-dark table-top">
                            <tbody>
                                <?php if(!empty($rank['top5_mensal'])): foreach($rank['top5_mensal'] as $index => $top): $isMe = ($top['id_cliente'] == $perfil['id_cliente']); ?>
                                    <tr class="<?= $isMe ? 'row-me' : '' ?>">
                                        <td style="width: 18px;"><?= $index + 1 ?>º</td>
                                        <td class="text-truncate" style="max-width: 55px;"><?= htmlspecialchars(explode(' ', $top['nome'])[0]) ?></td>
                                        <td class="text-end fw-bold text-tema"><?= $top['pontos'] ?></td>
                                    </tr>
                                <?php endforeach; else: ?>
                                    <tr><td class="text-center py-4 text-white-50" style="font-size: 0.5rem;">Vazio</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-4 col-ranking-anual">
                        <div class="rank-header-anual text-uppercase">
                            <i class="bi bi-award me-1"></i> Anual
                        </div>
                        <table class="table table-dark table-top">
                            <tbody>
                                <?php if(!empty($rank['top5_anual'])): foreach($rank['top5_anual'] as $index => $top): $isMe = ($top['id_cliente'] == $perfil['id_cliente']); ?>
                                    <tr class="<?= $isMe ? 'row-me' : '' ?>">
                                        <td style="width: 18px;"><?= $index + 1 ?>º</td>
                                        <td class="text-truncate" style="max-width: 55px;"><?= htmlspecialchars(explode(' ', $top['nome'])[0]) ?></td>
                                        <td class="text-end fw-bold text-warning"><?= $top['pontos'] ?></td>
                                    </tr>
                                <?php endforeach; else: ?>
                                    <tr><td class="text-center py-4 text-white-50" style="font-size: 0.5rem;">Vazio</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        <?php endforeach; endif; ?>

        <h6 class="text-uppercase small fw-bold mt-4 mb-3 text-white-50"><i class="bi bi-bag-check me-2"></i> Pedidos Recentes</h6>
        <div class="mb-5">
            <?php if(!empty($pedidos)): foreach(array_slice($pedidos, 0, 5) as $p): ?>
                <div class="pedido-item d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small fw-bold text-white"><?= date('d/m/Y', strtotime($p['data_pedido'])) ?></div>
                        <div class="text-white-50" style="font-size: 0.65rem;">Pedido realizado na loja</div>
                    </div>
                    <div class="text-end">
                        <div class="fw-bold text-success">R$ <?= number_format(($p['valor_variado'] ?? 0) + ($p['total_itens'] ?? 0), 2, ',', '.') ?></div>
                    </div>
                </div>
            <?php endforeach; else: ?>
                <div class="text-center p-3 border border-secondary rounded text-white-50 small">Nenhum pedido recente.</div>
            <?php endif; ?>
        </div>

        <div class="text-center pb-5">
            <a href="<?= $base ?>cliente/perfil/<?= $id_loja ?>" class="btn btn-sm btn-outline-secondary px-5">SAIR</a>
        </div>

    <?php else: ?>
        <div class="card card-geek p-4 text-center">
             <form action="<?= $base ?>cliente/consultar" method="POST">
                <input type="hidden" name="id_loja" value="<?= $id_loja ?>">
                <input type="text" id="tel_mascara" name="telefone" class="form-control form-control-lg text-center fw-bold mb-4" placeholder="(00) 00000-0000" required>
                <button type="submit" class="btn btn-lg btn-tema w-100">ACESSAR PERFIL</button>
            </form>
        </div>
    <?php endif; ?>

    <p class="text-center text-white-50" style="font-size: 0.5rem; opacity: 0.3;">
        MANABANK RETAIL SYSTEM &copy; 2026
    </p>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-masker/1.2.0/vanilla-masker.min.js"></script>
<script>
    var telInput = document.getElementById('tel_mascara');
    if (telInput) {
        var maskHandler = function(val) { return val.replace(/\D/g, '').length === 11 ? '(99) 99999-9999' : '(99) 9999-99999'; };
        VMasker(telInput).maskPattern(maskHandler(telInput.value));
        telInput.addEventListener('input', function(e) { VMasker(e.target).maskPattern(maskHandler(e.target.value)); });
    }
</script>
</body>
</html>
