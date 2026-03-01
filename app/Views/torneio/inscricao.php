<?php $baseAssetUrl = 'http://tcgbalcao.local/public'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Inscrição - <?= htmlspecialchars($torneio['nome_torneio'] ?? 'Torneio') ?></title>
  <!-- Bootstrap via CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome via CDN -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="d-flex flex-column justify-content-center align-items-center vh-100 text-center">

  <!-- Logo da loja -->
  <?php if (!empty($loja['logo'])): ?>
    <img src="<?= $baseAssetUrl ?>/storage/uploads/lojas/<?= $loja['id_loja'] ?>/<?= htmlspecialchars($loja['logo']) ?>"
         alt="Logo da Loja" class="mb-4" style="max-height:80px;">
  <?php endif; ?>

  <!-- Tabela com dados do torneio -->
  <table class="table table-dark table-bordered w-auto mb-4">
    <tr>
      <th>🏆 Torneio</th>
      <td><?= htmlspecialchars($torneio['nome_torneio'] ?? 'N/A') ?></td>
    </tr>
    <tr>
      <th>📅 Data</th>
      <td><?= !empty($torneio['data_criacao']) ? date('d/m/Y H:i', strtotime($torneio['data_criacao'])) : 'N/A' ?></td>
    </tr>
    <tr>
      <th>🎴 Cardgame</th>
      <td><?= htmlspecialchars($torneio['cardgame'] ?? 'N/A') ?></td>
    </tr>
  </table>

  <!-- Container de feedback -->
  <div id="feedback" class="w-75"></div>

  <!-- Formulário de inscrição -->
  <form id="formInscricao" method="POST" action="/inscricao/confirmar" class="w-75">
    <input type="hidden" name="id_torneio" value="<?= htmlspecialchars($torneio['id_torneio'] ?? '') ?>">
    <div class="mb-3 w-100">
      <label for="celular" class="form-label">Digite seu celular cadastrado:</label>
      <input type="text" name="celular" id="celular" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success w-100">✅ Confirmar participação</button>
  </form>
</div>

<!-- jQuery + Mask Plugin -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script>
  $(document).ready(function(){
    // Máscara de celular
    $('#celular').mask('(00) 00000-0000');

    // Intercepta envio do formulário
    $('#formInscricao').on('submit', function(e){
      e.preventDefault();

      const form = $(this);
      const feedback = $('#feedback');

      $.post(form.attr('action'), form.serialize(), function(data){
        console.log("Resposta recebida:", data);

if (data.status === 'success') {
  form.hide();
  feedback.html(`
    <div class="alert alert-success text-center">
      <h3>🎉 Inscrito com sucesso!</h3>
      <p>Você está confirmado no torneio <strong><?= htmlspecialchars($torneio['nome_torneio']) ?></strong>.</p>
    </div>
  `);

  // Se foi aberto como popup, avisa a janela principal
  if (window.opener && !window.opener.closed) {
    window.opener.$(document).trigger('inscricaoConfirmada');
  }
}
         else {
          feedback.html(`
            <div class="alert alert-danger text-center">
              ❌ ${data.message}
            </div>
          `);
        }
      }, 'json'); // força jQuery a interpretar como JSON
    });
  });
</script>
<script>
  // Função para atualizar lista via AJAX
  function atualizarParticipantes() {
    $.get('/torneio/listarAjax/<?= $torneio['id_torneio'] ?>', function(html){
      $('#listaParticipantes').html(html);
    });
  }

  // Escuta o evento disparado pelo inscricao.php
  $(document).on('inscricaoConfirmada', function(){
    atualizarParticipantes();
  });

  // Opcional: atualização periódica a cada 10 segundos
  setInterval(atualizarParticipantes, 10000);
</script>

</body>
</html>

