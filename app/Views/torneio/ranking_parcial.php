<?php
// Correção do caminho: Sobe 3 níveis para chegar na raiz e encontrar a pasta /config
require_once dirname(__DIR__, 3) . '/config/config.php';

// Ajustamos o caminho dos assets baseado na raiz do sistema ($base)
$baseAssetUrl = $base . 'public';

$nomeTorneio = isset($dadosTorneio['nome_torneio']) ? htmlspecialchars($dadosTorneio['nome_torneio']) : 'Torneio';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Classificação Parcial - <?= $nomeTorneio ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        .table-dark { --bs-table-bg: #1a1a1a; }
        .pos-top { color: #ffca28; font-weight: bold; }
        .text-bye { color: #0dcaf0 !important; font-style: italic; font-weight: bold; }
        .table-hover tbody tr:hover { background-color: rgba(255, 255, 255, 0.05); }
        .bg-darker { background-color: #111 !important; }
    </style>
</head>
<body class="bg-dark text-light">

<div class="container-fluid py-4 text-center">

    <?php if (!empty($loja['logo'])): ?>
        <img src="<?= $baseAssetUrl ?>/storage/uploads/lojas/<?= $loja['id_loja'] ?>/<?= htmlspecialchars($loja['logo']) ?>"
             alt="Logo da Loja" class="mb-4" style="max-height:80px;">
    <?php endif; ?>

    <h3 class="mb-1 text-uppercase fw-bold" style="letter-spacing: 1px;">Classificação Parcial</h3>
    <h5 class="text-secondary mb-3"><?= $nomeTorneio ?></h5>

    <div class="badge bg-primary mb-4 p-2 px-3" style="font-size: 1rem;">
        Rodada Atual: <?= $numero_rodada_texto ?>
    </div>

    <?php if (!empty($classificacao)): ?>
        <div class="table-responsive px-md-5">
            <table class="table table-dark table-striped table-bordered align-middle text-center shadow-lg mx-auto w-auto">
                <thead class="table-secondary text-dark">
                    <tr>
                        <th width="80">Pos</th>
                        <th width="250">Jogador</th>
                        <th title="Vitórias">V</th>
                        <th title="Derrotas">D</th>
                        <th title="Empates">E</th>
                        <th title="BYE">B</th>
                        <th title="Pontos">Pts</th>
                        <th title="Buchholz (Força dos Oponentes)">BH</th>
                        <th title="Vitórias por 2x0">2x0</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $pos = 1; foreach ($classificacao as $r): ?>
                        <tr>
                            <td class="<?= $pos <= 3 ? 'pos-top' : '' ?>">
                                <?= $pos === 1 ? '🏆 ' : '' ?><?= $pos++ ?>º
                            </td>
                            <td class="text-start ps-3 fw-bold">
                                <?= htmlspecialchars($r['nome']) ?>
                            </td>
                            <td class="text-success"><?= $r['vitorias'] ?></td>
                            <td class="text-danger"><?= $r['derrotas'] ?></td>
                            <td class="text-warning"><?= $r['empates'] ?></td>
                            <td class="<?= (int)$r['bye'] > 0 ? 'text-bye' : 'text-info' ?>">
                                <?= $r['bye'] ?>
                            </td>
                            <td class="bg-darker"><strong><?= $r['pontos'] ?></strong></td>
                            <td class="small text-secondary"><?= $r['forca_oponentes'] ?></td>
                            <td class="small"><?= $r['vitorias_2x0'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-warning d-inline-block px-5">
            <i class="fas fa-exclamation-triangle me-2"></i>
            Não foi possível calcular a classificação parcial.
        </div>
    <?php endif; ?>

    <div class="mt-4 d-print-none">
        <button onclick="window.location.reload()" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-sync-alt me-1"></i> Atualizar
        </button>
    </div>
</div>

</body>
</html>
