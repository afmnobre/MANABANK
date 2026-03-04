<?php
// Correção para o servidor remoto: Sobe 3 níveis para encontrar a pasta /config
require_once dirname(__DIR__, 3) . '/config/config.php';

// Definimos o caminho dinâmico dos assets baseado na variável $base do config
$baseAssetUrl = $base . 'public';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= $baseAssetUrl ?>/css/recibo.css">
    <style>
        /* Ajustes básicos para garantir que o recibo caiba no iframe/impressão */
        body { background: white; color: black; font-family: 'Courier New', Courier, monospace; margin: 0; padding: 10px; }
        .recibo { width: 100%; max-width: 300px; margin: 0 auto; }
        .logo img { max-width: 150px; height: auto; margin-bottom: 10px; }
        h2, h3 { margin: 5px 0; text-align: center; text-transform: uppercase; }
        .small { font-size: 10px; text-align: center; }
        hr { border: none; border-top: 1px dashed #000; margin: 10px 0; }
        .t-left { text-align: left; }
        .t-right { text-align: right; }
        .total { font-weight: bold; font-size: 1.2rem; }
        .status { font-weight: bold; text-align: center; border: 1px solid #000; padding: 5px; }
        .recibo-itens { width: 100%; border-collapse: collapse; }
        .cut { border-top: 2px dotted #000; margin: 40px 0; position: relative; }
        .cut::after { content: '✂️'; position: absolute; top: -12px; left: 10px; background: white; padding: 0 5px; }
        @media print { .cut { display: none; } body { padding: 0; } }
    </style>
</head>
<body>

<div class="recibo">
    <div class="logo" style="text-align:center;">
        <?php if (!empty($loja['logo'])): ?>
            <img src="<?= $baseAssetUrl ?>/storage/uploads/lojas/<?= htmlspecialchars($loja['id_loja'] ?? '') ?>/<?= htmlspecialchars($loja['logo'] ?? '') ?>"
                 alt="<?= htmlspecialchars($loja['nome_loja'] ?? '') ?>">
        <?php endif; ?>
    </div>

    <h2><?= htmlspecialchars($loja['nome_loja'] ?? '') ?></h2>
    <p class="small">CNPJ: <?= htmlspecialchars($loja['cnpj'] ?? '') ?></p>

    <hr>
    <h3>RECIBO</h3>
    <p class="small">
        Pedido Nº <?= htmlspecialchars($pedido['id_pedido'] ?? '') ?><br>
        <?= !empty($pedido['data_pedido']) ? date('d/m/Y H:i', strtotime($pedido['data_pedido'])) : '' ?>
    </p>

    <hr>
    <div class="status">
        <?= !empty($pedido['pedido_pago']) && $pedido['pedido_pago'] ? '✔️ PAGO' : '❌ NÃO PAGO' ?>
    </div>

    <hr>
    <p class="t-left">
        Cliente: <strong><?= htmlspecialchars($pedido['cliente_nome'] ?? 'Consumidor') ?></strong>
    </p>

    <hr>
	<?php if (!empty($itens)): ?>
		<table class="recibo-itens" style="font-size:11px; width: 100%;">
			<thead>
				<tr style="border-bottom: 1px solid #000;">
					<th class="t-left">Produto</th>
					<th style="text-align:center;">Qtd</th>
					<th class="t-right">Total</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$somaItens = 0;
				foreach ($itens as $item):
					// p.nome e p.emoji vêm da sua query na Model
					$nomeExibicao = ($item['emoji'] ?? '') . ' ' . ($item['nome'] ?? 'Item s/ nome');
					$subtotal = ($item['quantidade'] ?? 0) * ($item['valor_unitario'] ?? 0);
					$somaItens += $subtotal;
				?>
					<tr>
						<td class="t-left"><?= htmlspecialchars($nomeExibicao) ?></td>
						<td style="text-align:center;"><?= (int)($item['quantidade'] ?? 0) ?></td>
						<td class="t-right"><?= number_format($subtotal, 2, ',', '.') ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>

    <?php if (!empty($pedido['valor_variado']) && $pedido['valor_variado'] > 0): ?>
        <hr>
        <p class="t-left">
            Variado: R$ <?= number_format($pedido['valor_variado'], 2, ',', '.') ?><br>
            <?php if (!empty($pedido['observacao_variado'])): ?>
                <small>Obs: <?= htmlspecialchars($pedido['observacao_variado']) ?></small>
            <?php endif; ?>
        </p>
    <?php endif; ?>

    <hr>
    <table style="width: 100%;">
        <tr>
            <td class="t-left total">TOTAL</td>
            <td class="t-right total">
                R$ <?= number_format(($somaItens ?? 0) + ($pedido['valor_variado'] ?? 0), 2, ',', '.') ?>
            </td>
        </tr>
    </table>

    <hr>
    <p class="small">Obrigado pela preferência!<br>Boa sorte nos torneios 🎴</p>
</div>

<hr class="cut">

<div class="recibo">
    <div class="logo" style="text-align:center;">
        <?php if (!empty($loja['logo'])): ?>
            <img src="<?= $baseAssetUrl ?>/storage/uploads/lojas/<?= htmlspecialchars($loja['id_loja'] ?? '') ?>/<?= htmlspecialchars($loja['logo'] ?? '') ?>"
                 style="max-height: 50px;">
        <?php endif; ?>
    </div>
    <h3>VIA DA LOJA</h3>
    <p class="small">Pedido: <?= htmlspecialchars($pedido['id_pedido'] ?? '') ?></p>
    <p class="t-left">Cliente: <strong><?= htmlspecialchars($pedido['cliente_nome'] ?? '') ?></strong></p>
    <p class="total t-right">TOTAL: R$ <?= number_format(($somaItens ?? 0) + ($pedido['valor_variado'] ?? 0), 2, ',', '.') ?></p>
</div>

</body>
</html>
