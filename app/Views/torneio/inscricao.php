<?php
// Correção para o servidor remoto: Sobe 3 níveis para encontrar a pasta /config na raiz
require_once dirname(__DIR__, 3) . '/config/config.php';

// Definimos o caminho dos assets com base na URL do sistema
$baseAssetUrl = $base . 'public';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscrição - <?= htmlspecialchars($torneio['nome_torneio'] ?? 'Torneio') ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <style>
    body { background-color: #1a1a1a; }
    .container-inscricao { max-width: 450px; width: 90%; }
    .card-info { border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05); }
    #celular { font-size: 1.2rem; text-align: center; letter-spacing: 1px; }
  </style>
</head>
<body class="bg-dark text-light">

<div class="container-inscricao d-flex flex-column justify-content-center align-items-center vh-100 text-center mx-auto">

  <?php if (!empty($loja['logo'])): ?>
    <img src="<?= $baseAssetUrl ?>/storage/uploads/lojas/<?= $loja['id_loja'] ?>/<?= htmlspecialchars($loja['logo']) ?>"
         alt="Logo da Loja" class="mb-4" style="max-height:80px;">
  <?php endif; ?>

  <div class="card card-info p-3 mb-4 w-100 rounded-3 shadow">
    <h4 class="text-uppercase fw-bold text-warning mb-3">Inscrição no Evento</h4>
    <table class="table table-dark table-sm table-borderless mb-0 text-start">
      <tr>
        <th width="100">🏆 Torneio:</th>
        <td><?= htmlspecialchars($torneio['nome_torneio'] ?? 'N/A') ?></td>
      </tr>
      <tr>
        <th>📅 Data:</th>
        <td><?= !empty($torneio['data_evento']) ? date('d/m/Y', strtotime($torneio['data_evento'])) : ( !empty($torneio['data_criacao']) ? date('d/m/Y', strtotime($torneio['data_criacao'])) : 'N/A' ) ?></td>
      </tr>
      <tr>
        <th>🎴 Jogo:</th>
        <td><?= htmlspecialchars($torneio['cardgame'] ?? 'N/A') ?></td>
      </tr>
    </table>
  </div>

  <div id="feedback" class="w-100"></div>

  <form id="formInscricao" method="POST" action="<?= $base ?>inscricao/confirmar" class="w-100">
    <input type="hidden" name="id_torneio" value="<?= htmlspecialchars($torneio['id_torneio'] ?? '') ?>">
    <div class="mb-4">
      <label for="celular" class="form-label fw-bold">Informe seu celular cadastrado:</label>
      <input type="text" name="celular" id="celular" class="form-control form-control-lg bg-dark text-light border-secondary"
             placeholder="(00) 00000-0000" autofocus required>
      <div class="form-text text-secondary mt-2">Você deve estar previamente cadastrado na loja.</div>
    </div>
    <button type="submit" id="btnSubmit" class="btn btn-success btn-lg w-100 shadow">
        <i class="fas fa-check-circle me-1"></i> Confirmar Participação
    </button>
  </form>
</div>

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
      const btn = $('#btnSubmit');

      // Bloqueia o botão para evitar cliques duplos
      btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processando...');

      $.post(form.attr('action'), form.serialize(), function(data){
        if (data.status === 'success') {
          form.hide();
          feedback.html(`
            <div class="alert alert-success text-center py-4 shadow">
              <i class="fas fa-check-circle fa-3x mb-3"></i>
              <h3>🎉 Tudo pronto, ${data.nome}!</h3>
              <p class="mb-0">Sua participação no torneio foi confirmada.</p>
            </div>
          `);

          // Notifica a janela pai se existir (caso seja popup)
          if (window.opener && !window.opener.closed) {
            try {
               window.opener.$(window.opener.document).trigger('inscricaoConfirmada');
            } catch(e) { console.log("Opener offline."); }
          }
        } else {
          btn.prop('disabled', false).html('<i class="fas fa-check-circle me-1"></i> Confirmar Participação');
          feedback.html(`
            <div class="alert alert-danger text-center shadow">
              <i class="fas fa-exclamation-triangle me-2"></i> ${data.message}
            </div>
          `);
        }
      }, 'json').fail(function() {
          btn.prop('disabled', false).html('<i class="fas fa-check-circle me-1"></i> Confirmar Participação');
          feedback.html('<div class="alert alert-danger text-center">❌ Erro de conexão com o servidor.</div>');
      });
    });
  });
</script>

</body>
</html>
