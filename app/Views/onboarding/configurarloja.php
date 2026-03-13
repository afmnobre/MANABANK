<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>MANABANK | Configuração Inicial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #0d1117; color: #fff; font-family: 'Inter', sans-serif; }
        .setup-card { background: #161b22; border: 1px solid #30363d; border-radius: 16px; padding: 40px; }
        .form-control { background: #0d1117; border: 1px solid #30363d; color: #fff; }
        .form-control:focus { background: #0d1117; color: #fff; border-color: #00d4ff; box-shadow: none; }
        .btn-mana { background-color: #00d4ff; color: #000; font-weight: 700; border: none; }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="setup-card shadow-lg">
                <h2 class="text-cyan mb-4"><i class="bi bi-rocket-takeoff me-2"></i> Quase lá! Configure seu acesso</h2>

                <form action="<?= BASE_URL ?>landing/finalizar" method="POST">
                    <input type="hidden" name="referencia" value="<?= $ref ?>">
                    <input type="hidden" name="plano_slug" value="<?= $plano_slug ?>">

                    <h5 class="mb-3 text-white-50">Dados da Loja</h5>
                    <div class="row g-3 mb-4">
                        <div class="col-md-8">
                            <label>Nome da Loja</label>
                            <input type="text" name="nome_loja" class="form-control" placeholder="Ex: Mana Vortex TCG" required>
                        </div>
                        <div class="col-md-4">
                            <label>CNPJ (Opcional)</label>
                            <input type="text" name="cnpj" class="form-control" placeholder="00.000.000/0000-00">
                        </div>
                    </div>

                    <h5 class="mb-3 text-white-50">Dados do Gerente (Acesso Administrativo)</h5>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label>Nome Completo</label>
                            <input type="text" name="nome_gerente" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>E-mail de Login</label>
                            <input type="email" name="email_gerente" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Senha</label>
                            <input type="password" name="senha_gerente" class="form-control" required>
                        </div>
                    </div>

                    <h5 class="mb-3 text-white-50">Atendentes (Opcional)</h5>
                    <div id="atendentes-container">
                        <div class="input-group mb-2">
                            <input type="text" name="atendentes[]" class="form-control" placeholder="Nome do Atendente">
                            <button type="button" class="btn btn-outline-secondary" onclick="addAtendente()"><i class="bi bi-plus"></i></button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-mana w-100 py-3 mt-4 text-uppercase">Concluir e Acessar Painel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function addAtendente() {
        const div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = '<input type="text" name="atendentes[]" class="form-control" placeholder="Nome do Atendente"><button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()"><i class="bi bi-trash"></i></button>';
        document.getElementById('atendentes-container').appendChild(div);
    }
</script>
</body>
</html>
