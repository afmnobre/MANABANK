/**
 * Arquivo: pedidos.js
 * Versão: Completa, Corrigida e Blindada
 */

// ===============================
// VARIÁVEIS GLOBAIS
// ===============================
if (typeof window.BASE_URL === 'undefined') {
    window.BASE_URL = '/';
}

window.totalPedido = 0;
window.clienteAtual = null;

// ===============================
// INICIALIZAÇÃO
// ===============================
document.addEventListener('DOMContentLoaded', function () {
    // Inicializa funções essenciais
    if (typeof window.initPesquisaCliente === 'function') window.initPesquisaCliente();
    if (typeof window.calcularTotalRecebido === 'function') window.calcularTotalRecebido();

    // Evento para inputs na tabela principal (Cálculo em tempo real)
    document.addEventListener('input', function (e) {
        if (e.target.classList.contains('input-item') || e.target.classList.contains('input-variado')) {
            const idCliente = e.target.dataset.cliente;
            if (idCliente) window.atualizarTotalLinha(idCliente);
        }

        // Lógica de Rateio no Modal
        if (e.target.classList.contains('pagamento-valor')) {
            window.atualizarRestante();
        }
    });

    // Evento de Change para Rateio
    document.addEventListener('change', function (e) {
        if (!e.target.classList.contains('pagamento-check')) return;

        const selecionados = Array.from(document.querySelectorAll('.pagamento-check:checked'));

        if (!e.target.checked) {
            const campo = document.querySelector(`.pagamento-valor[data-id="${e.target.dataset.id}"]`);
            if (campo) campo.value = "0.00";
        }

        if (selecionados.length > 0) {
            const valorDividido = window.totalPedido / selecionados.length;
            let somaDistribuida = 0;

            selecionados.forEach((chk, index) => {
                const campo = document.querySelector(`.pagamento-valor[data-id="${chk.dataset.id}"]`);
                if (!campo) return;

                if (index === selecionados.length - 1) {
                    campo.value = (window.totalPedido - somaDistribuida).toFixed(2);
                } else {
                    campo.value = valorDividido.toFixed(2);
                    somaDistribuida += parseFloat(valorDividido.toFixed(2));
                }
            });
        }
        window.atualizarRestante();
    });

    // Delegação de Clique (Botão Distribuir e outros)
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('distribuir-btn')) {
            const id = e.target.dataset.id;
            let somaOutros = 0;
            document.querySelectorAll('.pagamento-valor').forEach(el => {
                if (el.dataset.id !== id) somaOutros += parseFloat(el.value) || 0;
            });
            const campoAlvo = document.querySelector(`.pagamento-valor[data-id="${id}"]`);
            const checkAlvo = document.querySelector(`.pagamento-check[data-id="${id}"]`);

            if (campoAlvo) {
                campoAlvo.value = Math.max(0, window.totalPedido - somaOutros).toFixed(2);
                if (checkAlvo) checkAlvo.checked = true;
                window.atualizarRestante();
            }
        }
    });

    // Monitora estoque (Foco na saída do campo - Blur)
    // O uso de 'true' no final habilita o capture, necessário para o evento blur
    document.addEventListener('blur', function (e) {
        if (e.target.classList.contains('input-item')) {
            const input = e.target;
            const controla = input.dataset.controla === "1";
            const estoque = parseInt(input.dataset.estoque) || 0;
            const quantidade = parseInt(input.value) || 0;
            const nomeProd = input.dataset.nome;

            if (controla && quantidade > estoque) {
                const msgEstoque = document.getElementById('msgEstoque');
                if (msgEstoque) msgEstoque.innerHTML = `O produto <strong>${nomeProd}</strong> não possui estoque suficiente.`;

                if (document.getElementById('estoqueDisponivel'))
                    document.getElementById('estoqueDisponivel').textContent = estoque;
                if (document.getElementById('estoqueTentativa'))
                    document.getElementById('estoqueTentativa').textContent = quantidade;

                const modalEstoqueEl = document.getElementById('modalEstoque');
                if (modalEstoqueEl) {
                    const modalEstoque = bootstrap.Modal.getOrCreateInstance(modalEstoqueEl);
                    modalEstoque.show();
                }

                input.value = estoque;
                if (input.dataset.cliente) window.atualizarTotalLinha(input.dataset.cliente);
                input.classList.add('is-invalid');
                setTimeout(() => input.classList.remove('is-invalid'), 3000);
            }
        }
    }, true);

    // Para o BOTÃO VERDE (Refatorado para ser mais agressivo na captura)
    const btnSalvarVerde = document.querySelector('button[form="formPedidos"]');
    const formPedidos = document.getElementById('formPedidos');

    function sincronizarFiltrosVerde() {
        const container = document.getElementById('cardgamesSelecionados');
        if (container) {
            container.innerHTML = ''; // Limpa a div
            const selecionados = document.querySelectorAll('.magic-check:checked');
            console.log("Sincronizando filtros para o botão verde:", selecionados.length); // Debug
            selecionados.forEach(cb => {
                let h = document.createElement('input');
                h.type = 'hidden';
                h.name = 'cardgamesSelecionados[]';
                h.value = cb.value;
                container.appendChild(h);
            });
        }
    }

    if (btnSalvarVerde) {
        // Intercepta o clique direto no botão
        btnSalvarVerde.addEventListener('click', sincronizarFiltrosVerde);
    }

    if (formPedidos) {
        // Intercepta o envio do formulário (por garantia)
        formPedidos.addEventListener('submit', sincronizarFiltrosVerde);
    }
});

// ===============================
// CALENDARIO
// ===============================
window.initCalendario = function(datasPendentes, dataSelecionada) {
    if (typeof flatpickr === 'function') {
        flatpickr("#dataPedido", {
            locale: "pt",
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "d/m/Y",
            defaultDate: dataSelecionada,
            onDayCreate: function (dObj, dStr, fp, dayElem) {
                // Ajuste para pegar a data local correta (YYYY-MM-DD)
                const date = dayElem.dateObj;
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                const dataFormatada = `${year}-${month}-${day}`;

                if (datasPendentes && datasPendentes.includes(dataFormatada)) {
                    dayElem.classList.add("has-pedido");
                    dayElem.style.backgroundColor = "#ff4d4d"; // Vermelho ManaBank
                    dayElem.style.color = "white";
                    dayElem.style.borderRadius = "50%";
                    dayElem.title = "Há pedidos não pagos";
                }
            },
            onChange: function (selectedDates, dateStr) {
                if(dateStr) {
                    window.location = '?data=' + dateStr;
                }
            }
        });
    }
}

// ===============================
// FUNÇÕES DO MODAL PAGAMENTO
// ===============================
window.abrirModalPagamento = function (idPedido, idCliente, valorTotal, checkboxEl) {
    if (!checkboxEl.checked) return;

    // Pegamos o valor puro do dataset do TD de total para evitar confusão com R$ ou vírgulas
    const tdTotal = document.getElementById('total_' + idCliente);
    const total = parseFloat(tdTotal.dataset.total) || 0;

    if (total <= 0) {
        alert("Este pedido não possui valor para pagamento.");
        checkboxEl.checked = false;
        return;
    }

    window.totalPedido = total;

    const labelTotal = document.getElementById('totalPedidoLabel') || document.getElementById('totalPedido');
    if (labelTotal) labelTotal.textContent = total.toFixed(2);

    const labelRestante = document.getElementById('valorRestante');
    if (labelRestante) labelRestante.textContent = total.toFixed(2);

    const inputIdPedido = document.getElementById('modal_id_pedido');
    const inputIdCliente = document.getElementById('modal_id_cliente');
    if (inputIdPedido) inputIdPedido.value = idPedido;
    if (inputIdCliente) inputIdCliente.value = idCliente;

    const form = document.getElementById('formPagamento');
    if (form) {
        // Limpar clones anteriores
        form.querySelectorAll('.clonado, .filtro-clonado').forEach(el => el.remove());

        // --- PERSISTÊNCIA DO FILTRO (Ajustado para o seu Controller) ---
        // Buscamos os cardgames marcados (pela classe magic-check que você usou no HTML)
        const selecionados = document.querySelectorAll('.magic-check:checked');

        selecionados.forEach(cb => {
            let h = document.createElement('input');
            h.type = 'hidden';
            h.className = 'filtro-clonado';
            // MUDANÇA AQUI: O nome deve ser cardgamesSelecionados[] para o Controller capturar
            h.name = 'cardgamesSelecionados[]';
            h.value = cb.value;
            form.appendChild(h);
        });

        // Clonagem de itens/observação
        if (typeof window.clonarDadosParaModal === 'function') {
            window.clonarDadosParaModal(idCliente, form);
        }
    }

    // Resetar campos de valor do modal
    document.querySelectorAll('.pagamento-valor').forEach(el => el.value = "0.00");
    document.querySelectorAll('.pagamento-check').forEach(el => el.checked = false);

    const modalEl = document.getElementById('modalPagamento');
    if (modalEl) {
        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        modal.show();
    }
};

// Executa o filtro visual ao carregar a página
document.addEventListener('DOMContentLoaded', function() {
    if (typeof window.filtrarClientes === 'function') {
        window.filtrarClientes();
    }
});

/**
 * GARANTIA DE PERSISTÊNCIA VISUAL
 * Executa o filtro assim que a página termina de carregar,
 * baseando-se nos checkboxes que o PHP marcou como 'checked'.
 */
document.addEventListener('DOMContentLoaded', function() {
    if (typeof window.filtrarClientes === 'function') {
        window.filtrarClientes();
    }
});

window.atualizarRestante = function() {
    let soma = 0;
    document.querySelectorAll('.pagamento-valor').forEach(el => {
        soma += parseFloat(el.value) || 0;
    });
    const restante = window.totalPedido - soma;
    const label = document.getElementById('valorRestante');
    if (label) {
        label.textContent = restante.toFixed(2);
        label.style.color = Math.abs(restante) < 0.01 ? '#28a745' : '#ffc107';
    }
}

window.clonarDadosParaModal = function(idCliente, form) {
    if (!form) return; // Segurança básica

    // 1. Clonar valor Variado
    const v = document.querySelector(`input[name="variado[${idCliente}]"]`);
    if (v) {
        let h = document.createElement('input');
        h.type = 'hidden';
        h.className = 'clonado';
        h.name = `variado[${idCliente}]`;
        h.value = v.value;
        form.appendChild(h);
    }

    // 2. Clonar Observação (Aqui é onde costuma dar o erro document.getElementById)
    const o = document.getElementById(`observacao_variado_${idCliente}`);
    if (o) {
        let h = document.createElement('input');
        h.type = 'hidden';
        h.className = 'clonado';
        h.name = `observacao_variado[${idCliente}]`;
        h.value = o.value;
        form.appendChild(h);
    }

    // 3. Clonar Itens (Quantidade > 0)
    const itens = document.querySelectorAll(`input[name^="itens[${idCliente}]"]`);
    if (itens.length > 0) {
        itens.forEach(el => {
            let qtd = parseInt(el.value) || 0;
            if (qtd > 0) {
                let h = document.createElement('input');
                h.type = 'hidden';
                h.className = 'clonado';
                h.name = el.name;
                h.value = el.value;
                form.appendChild(h);
            }
        });
    }
}

window.salvarPagamento = function() {
    const labelRestante = document.getElementById('valorRestante');
    const restante = parseFloat(labelRestante ? labelRestante.textContent : 0);
    if (Math.abs(restante) > 0.01) {
        alert("O valor distribuído não corresponde ao total!");
        return;
    }
    const form = document.getElementById('formPagamento');
    if (form) form.submit();
}

// ===============================
// CÁLCULOS E PESQUISA
// ===============================
window.atualizarTotalLinha = function(idCliente) {
    let total = 0;
    document.querySelectorAll(`input[data-cliente="${idCliente}"].input-item`).forEach(el => {
        total += (parseInt(el.value) || 0) * (parseFloat(el.dataset.preco) || 0);
    });
    const inputV = document.querySelector(`input[name="variado[${idCliente}]"]`);
    if (inputV) {
        // CORREÇÃO JS: Remove todos os pontos e troca a vírgula por ponto para o cálculo
        let valor = inputV.value.replace(/\./g, '').replace(',', '.');
        total += parseFloat(valor) || 0;
    }
    const tdTotal = document.getElementById('total_' + idCliente);
    if (tdTotal) {
        tdTotal.innerText = 'R$ ' + total.toLocaleString('pt-br', { minimumFractionDigits: 2 });
        tdTotal.dataset.total = total.toFixed(2);
    }
    window.calcularTotalRecebido();
}

window.calcularTotalRecebido = function() {
    let totalDia = 0;
    document.querySelectorAll('input.check-pago:checked').forEach(checkbox => {
        const tr = checkbox.closest('tr');
        if (tr) {
            const tdTotal = tr.querySelector('td[id^="total_"]');
            if (tdTotal) totalDia += parseFloat(tdTotal.dataset.total) || 0;
        }
    });
    const label = document.getElementById('totalRecebido');
    if (label) label.textContent = "R$ " + totalDia.toLocaleString('pt-br', { minimumFractionDigits: 2 });
}

window.initPesquisaCliente = function() {
    const input = document.getElementById('pesquisaCliente');
    if (!input) return;
    input.addEventListener('input', function () {
        const filtro = this.value.toLowerCase();
        document.querySelectorAll('#formPedidos table tbody tr').forEach(row => {
            const nome = row.querySelector('td')?.innerText.toLowerCase() || '';
            row.style.display = nome.includes(filtro) ? '' : 'none';
        });
    });
}

window.filtrarClientes = function() {
    const selecionados = Array.from(document.querySelectorAll('input[name="cardgames[]"]:checked')).map(cb => cb.value);
    const linhas = document.querySelectorAll('#formPedidos tbody tr');
    linhas.forEach(linha => {
        if (selecionados.length === 0) { linha.style.display = ''; return; }
        const lista = (linha.getAttribute('data-cardgames') || '').split(',');
        linha.style.display = selecionados.some(id => lista.includes(id)) ? '' : 'none';
    });
}

// ===============================
// RECIBO E VARIADO
// ===============================
window.abrirPopupVariado = function(idCliente) {
    window.clienteAtual = idCliente;
    const inputId = document.getElementById('variado_cliente_id');
    const areaDesc = document.getElementById('descricaoVariado');
    const inputOrigem = document.getElementById('observacao_variado_' + idCliente);

    if (inputId) inputId.value = idCliente;
    if (areaDesc && inputOrigem) areaDesc.value = inputOrigem.value;

    const modalEl = document.getElementById('popupVariado');
    if (modalEl) {
        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        modal.show();
    }
}

window.salvarDescricaoVariado = function() {
    const id = document.getElementById('variado_cliente_id').value;
    const inputOrigem = document.getElementById('observacao_variado_' + id);
    const areaDesc = document.getElementById('descricaoVariado');

    if (inputOrigem && areaDesc) inputOrigem.value = areaDesc.value;

    const modalEl = document.getElementById('popupVariado');
    if (modalEl) {
        const modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();
    }
}

/**
 * Abre o recibo usando a BASE_URL definida no header.php
 */
window.abrirRecibo = function(id) {
    const iframe = document.getElementById('iframeRecibo');

    // Usamos window.BASE_URL que já existe no seu header.php
    // O método no Controller é 'recibo'
    if (iframe) {
        iframe.src = window.BASE_URL + 'pedido/recibo/' + id;
    }

    const modalEl = document.getElementById('modalRecibo');
    if (modalEl) {
        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        modal.show();
    }
}

/**
 * Imprime o conteúdo do recibo
 */
window.imprimirRecibo = function() {
    const f = document.getElementById('iframeRecibo');
    if (f && f.contentWindow) {
        f.contentWindow.focus();
        f.contentWindow.print();
    }
}

window.verificarEstoqueDisponivel = function(input) {
    const controla = parseInt(input.getAttribute('data-controla'));

    // Se não controla estoque, não faz nada
    if (controla !== 1) return;

    const estoqueDisponivel = parseInt(input.getAttribute('data-estoque'));
    const quantidadeTentada = parseInt(input.value);
    const nomeProduto = input.getAttribute('data-nome');

    if (quantidadeTentada > estoqueDisponivel) {
        // Preenche as informações no modalEstoque
        const msgEstoque = document.getElementById('msgEstoque');
        const dispLabel = document.getElementById('estoqueDisponivel');
        const tentLabel = document.getElementById('estoqueTentativa');

        if (msgEstoque) msgEstoque.innerHTML = `O item <strong>${nomeProduto}</strong> não possui saldo suficiente no estoque.`;
        if (dispLabel) dispLabel.innerText = estoqueDisponivel;
        if (tentLabel) tentLabel.innerText = quantidadeTentada;

        // Dispara o modal do Bootstrap
        const modalElement = document.getElementById('modalEstoque');
        if (modalElement) {
            const modalEstoque = new bootstrap.Modal(modalElement);
            modalEstoque.show();
        }

        // Reseta o campo para evitar erro de processamento no PHP
        input.value = 0;

        // Recalcula o total da linha (também via window)
        const idCliente = input.getAttribute('data-cliente');
        if (typeof window.atualizarTotalLinha === "function") {
            window.atualizarTotalLinha(idCliente);
        }
    }
};

