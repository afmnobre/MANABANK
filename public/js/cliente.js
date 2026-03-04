document.addEventListener("DOMContentLoaded", function() {
    const telefoneInput = document.getElementById("telefone");
    const statusLabel = document.getElementById("statusCliente");

    // Função para aplicar máscara de telefone (Fixo ou Celular)
    function aplicarMascara(valor) {
        if (!valor) return "";
        let v = valor.replace(/\D/g, "");
        if (v.length > 11) v = v.substring(0, 11);

        if (v.length <= 10) {
            // Telefone fixo: (XX) XXXX-XXXX
            v = v.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, "($1) $2-$3");
        } else {
            // Celular: (XX) XXXXX-XXXX
            v = v.replace(/^(\d{2})(\d{5})(\d{0,4}).*/, "($1) $2-$3");
        }

        return v;
    }

    if (telefoneInput) {
        // Aplica máscara inicial ao carregar (para edição)
        telefoneInput.value = aplicarMascara(telefoneInput.value);

        // Aplica máscara enquanto o usuário digita
        telefoneInput.addEventListener("input", function() {
            telefoneInput.value = aplicarMascara(telefoneInput.value);
        });

        // Dispara a verificação quando o usuário sai do campo (blur)
        telefoneInput.addEventListener("blur", function() {
            const telefone = telefoneInput.value.replace(/\D/g, "");

            if (telefone.length < 10) return; // Só dispara se tiver tamanho mínimo

            console.log("Disparando verificação para:", telefone);

            // USANDO A URL DINÂMICA DEFINIDA NO HEADER
            // window.AppConfig.baseUrl já contém o caminho completo (ex: /MANABANK/public/)
            const urlVerificacao = window.AppConfig.baseUrl + "cliente/verificarTelefone?telefone=" + telefone;

            fetch(urlVerificacao)
                .then(res => {
                    if (!res.ok) {
                        throw new Error("Erro HTTP: " + res.status);
                    }
                    return res.json();
                })
                .then(data => {
                    console.log("Resposta do servidor:", data);

                    const inputNome = document.querySelector("input[name='nome']");
                    const inputEmail = document.querySelector("input[name='email']");

                    if (data.encontrado) {
                        // Preenche os campos se o cliente já existir
                        if (inputNome) inputNome.value = data.nome || '';
                        if (inputEmail) inputEmail.value = data.email || '';

                        statusLabel.textContent = "⚠️ Cliente já cadastrado - VINCULE E SALVE";
                        statusLabel.style.color = "yellow";
                        statusLabel.style.fontWeight = "bold";
                    } else {
                        // Se for novo, limpa apenas o status (mantém o que o usuário digitou)
                        statusLabel.textContent = "✅ Novo cliente";
                        statusLabel.style.color = "lightgreen";
                        statusLabel.style.fontWeight = "normal";
                    }
                })
                .catch(err => {
                    console.error("Erro na requisição AJAX:", err);
                    statusLabel.textContent = "❌ Erro ao validar telefone";
                    statusLabel.style.color = "red";
                });
        });
    }

    // Aplica máscara em todos os telefones da listagem (tabela index)
    document.querySelectorAll(".telefone-coluna").forEach(function(el) {
        if (el.textContent) {
            el.textContent = aplicarMascara(el.textContent);
        }
    });
});
