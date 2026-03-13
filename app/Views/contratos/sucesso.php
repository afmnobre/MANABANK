<div class="text-center">
    <div id="status-processando">
        <div class="spinner-border text-primary" role="status"></div>
        <h3 class="mt-3">Confirmando seu pagamento...</h3>
        <p>Estamos atualizando seu acesso, um momento.</p>
    </div>

    <div id="status-sucesso" style="display: none;">
        <div class="alert alert-success">
            <h3>🎉 Tudo pronto!</h3>
            <p>Seu plano foi renovado com sucesso e o sistema já está liberado.</p>
            <a href="/MANABANK/dashboard" class="btn btn-success">Ir para o Painel</a>
        </div>
    </div>
</div>

<script>
function verificar() {
    // Usamos o caminho completo para não ter erro de rota dinâmica
    const endpoint = window.location.origin + '/MANABANK/Contrato/verificarStatus';

    console.log("Checando status em: " + endpoint);

    fetch(endpoint, { cache: "no-store" }) // Evita que o navegador cacheie o "false"
        .then(response => {
            if (!response.ok) throw new Error("Erro na rede");
            return response.json();
        })
        .then(data => {
            console.log("Resposta recebida:", data);

            // Verificação flexível (aceita true booleano ou "true" string)
            if (data.ativo == true || data.ativo == "true") {
                console.log("Contrato ativo! Liberando tela...");
                document.getElementById('status-processando').style.display = 'none';
                document.getElementById('status-sucesso').style.display = 'block';
            } else {
                // Se ainda for falso, tenta de novo em 3 segundos
                setTimeout(verificar, 3000);
            }
        })
        .catch(err => {
            console.error("Erro no polling:", err);
            setTimeout(verificar, 5000); // Se der erro de conexão, tenta em 5s
        });
}

// Inicia a verificação assim que a página carregar
window.onload = verificar;
</script>
