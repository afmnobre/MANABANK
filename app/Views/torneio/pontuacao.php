<?php
// Como é carregada via viewRaw, incluímos o config para ter acesso ao $base
require_once 'app/config/config.php';

// Ajustamos o caminho dos assets baseado na raiz do sistema
$baseAssetUrl = $base . 'public';

// Evita erro de índice caso o tipo_torneio não venha na URL
$tipoTorneio = $_GET['tipo_torneio'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pontuação - Rodada <?= $numero_rodada ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        .table-dark { --bs-table-bg: #1a1a1a; }
        .pos-1 { color: #ffd700; font-weight: bold; } /* Ouro */
        .pos-2 { color: #c0c0c0; font-weight: bold; } /* Prata */
        .pos-3 { color: #cd7f32; font-weight: bold; } /* Bronze */
    </style>
</head>
<body class="bg-dark text-light">

<div class="container-fluid py-4 text-center">

    <?php if (!empty($loja['logo'])): ?>
        <img src="<?= $baseAssetUrl ?>/storage/uploads/lojas/<?= $loja['id_loja'] ?>/<?= htmlspecialchars($loja['logo']) ?>"
             alt="Logo da Loja" class="mb-4" style="max-height:80px;">
    <?php endif; ?>

    <h3 class="mb-4">
        <i class="fas fa-list-ol me-2 text-warning"></i>
        Classificação - Rodada <?= $numero_rodada ?>
    </h3>

    <?php if (!empty($classificacao)): ?>
        <table class="table table-dark table-striped table-bordered w-auto mx-auto align-middle text-center shadow-lg">
            <thead class="table-secondary text-dark">
                <tr>
                    <th width="100">Posição</th>
                    <th width="300">Jogador</th>
                    <?php if (str_starts_with($tipoTorneio, 'suico')): ?>
                        <th width="100">Pontos</th>
                        <th width="150">Buchholz (BH)</th>
                    <?php else: ?>
                        <th width="100">Vitórias</th>
                        <th width="100">Derrotas</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $posicao = 1; ?>
                <?php foreach ($classificacao as $linha): ?>
                    <tr>
                        <td class="pos-<?= $posicao ?>">
                            <?= $posicao === 1 ? ' <i class="fas fa-crown"></i> ' : '' ?>
                            <?= $posicao++ ?>º
                        </td>
                        <td class="text-start ps-4">
                            <?= htmlspecialchars($linha['nome']) ?>
                            <?php if (!empty($linha['bye']) && $linha['bye'] === true): ?>
                                <span class="badge bg-secondary ms-2">BYE</span>
                            <?php endif; ?>
                        </td>
                        <?php if (str_starts_with($tipoTorneio, 'suico')): ?>
                            <td class="fw-bold text-success"><?= $linha['pontos'] ?></td>
                            <td class="text-info"><?= $linha['forca_oponentes'] ?></td>
                        <?php else: ?>
                            <td class="text-success"><?= $linha['vitorias'] ?></td>
                            <td class="text-danger"><?= $linha['derrotas'] ?></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-warning d-inline-block px-5">
            <i class="fas fa-exclamation-triangle me-2"></i>
            Não foi possível calcular a pontuação desta rodada.
        </div>
    <?php endif; ?>
</div>

</body>
</html>
