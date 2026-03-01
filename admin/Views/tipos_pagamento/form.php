<div class="container mt-4">

    <h3><?= isset($tipo) ? "Editar Tipo de Pagamento" : "Novo Tipo de Pagamento" ?></h3>

    <div class="card shadow mt-3">
        <div class="card-body">

			<form action="/admin/tipopagamento/update/<?= $tipo['id_pagamento'] ?>" method="POST" enctype="multipart/form-data">
				<div class="mb-3">
					<label class="form-label">Nome</label>
					<input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($tipo['nome'] ?? '') ?>" required>
				</div>

				<div class="mb-3">
					<label class="form-label">Imagem</label>
					<input type="file" name="imagem" class="form-control">
					<?php if(!empty($tipo['imagem'])): ?>
						<img src="/public/storage/uploads/tipos_pagamento/<?= $tipo['id_pagamento'] ?>/<?= $tipo['imagem'] ?>" alt="Imagem" style="height:40px;">
					<?php endif; ?>
				</div>

				<button class="btn btn-primary">Salvar</button>
			</form>


        </div>
    </div>

</div>

