<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento Confirmado - ManaBank</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #0d1117; color: white; height: 100vh; display: flex; align-items: center; }
        .card-sucesso { background-color: #161b22; border: 1px solid #30363d; border-radius: 1rem; padding: 2rem; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        .icon-check { font-size: 5rem; color: #238636; }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card-sucesso">
                <i class="bi bi-check-circle-fill icon-check"></i>
                <h2 class="fw-bold mt-3">Pagamento Recebido!</h2>
                <p class="text-white-50">Obrigado por renovar com o ManaBank. Seu contrato está sendo atualizado automaticamente em nosso sistema.</p>

                <hr class="border-secondary my-4">

                <div class="d-grid gap-2">
                    <a href="https://makers-providing-suppose-avenue.trycloudflare.com/MANABANK/home" class="btn btn-primary btn-lg fw-bold">
                        VOLTAR PARA O PAINEL
                    </a>
                </div>
                <small class="text-white-50 d-block mt-3">
                    ID da Transação: <?= $_GET['payment_id'] ?? 'N/A' ?>
                </small>
            </div>
        </div>
    </div>
</div>

</body>
</html>
