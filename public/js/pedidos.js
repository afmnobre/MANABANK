// ===============================
// VARIÁVEIS GLOBAIS
// ===============================
let totalPedido = 0;
let clienteAtual = null;

// ===============================
// INICIALIZAÇÃO
// ===============================
document.addEventListener('DOMContentLoaded', function () {
    initPesquisaCliente();
    calcularTotalRecebido();

    // Evento para inputs na tabela principal
    document.querySelectorAll('.input-item, .input-variado').forEach(input => {
        input.addEventListener('input', function () {
            const idCliente = this.dataset.cliente;
            if (idCliente) atualizarTotalLinha(idCliente);
        });
    });

    // 🔹 LÓGICA DE RATEIO NO MODAL (DELEGAÇÃO DE EVENTOS)

    // 1. Quando o usuário digita um valor manualmente
    document.addEventListener('input', function (e) {
        if (e.target.classList.contains('pagamento-valor')) {
            atualizarRestante();
        }
    });

    // 2. Quando o usuário marca/desmarca uma checkbox de pagamento
    document.addEventListener('change', function (e) {
        if (!e.target.classList.contains('pagamento-check')) return;

        const selecionados = Array.from(document.querySelectorAll('.pagamento-check:checked'));

        // Se desmarcou, zera o campo de valor correspondente
        if (!e.target.checked) {
            const campo = document.querySelector(`.pagamento-valor[data-id="${e.target.dataset.id}"]`);
            if (campo) campo.value = "0.00";
        }

        // Se houver selecionados, divide o total igualmente entre eles
        if (selecionados.length > 0) {
            const valorDividido = totalPedido / selecionados.length;
            let somaDistribuida = 0;

            selecionados.forEach((chk, index) => {
                const campo = document.querySelector(`.pagamento-valor[data-id="${chk.dataset.id}"]`);
                if (!campo) return;

                if (index === selecionados.length - 1) {
                    // O último fica com a diferença para evitar erros de centavos (0.01)
                    campo.value = (totalPedido - somaDistribuida).toFixed(2);
                } else {
                    campo.value = valorDividido.toFixed(2);
                    somaDistribuida += parseFloat(valorDividido.toFixed(2));
                }
            });
        }
        atualizarRestante();
    });

    // 3. Botão "Distribuir Restante" (se houver no seu HTML)
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
                campoAlvo.value = Math.max(0, totalPedido - somaOutros).toFixed(2);
                if (checkAlvo) checkAlvo.checked = true;
                atualizarRestante();
            }
        }
    });

    filtrarClientes();
});

// ===============================
//  CALENDARIO
// ===============================
function initCalendario(datasPendentes, dataSelecionada) {
    flatpickr("#dataPedido", {
        locale: "pt",
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d/m/Y",
        defaultDate: dataSelecionada,
        onDayCreate: function (dObj, dStr, fp, dayElem) {
            const data = dayElem.dateObj.toISOString().split('T')[0];
            if (datasPendentes.includes(data)) {
                dayElem.classList.add("has-pedido");
                dayElem.title = "Pedido não pago";
            }
        },
        onChange: function (selectedDates, dateStr) {
            window.location = '?data=' + dateStr;
        }
    });
}

// ===============================
// FUNÇÕES DO MODAL PAGAMENTO
// ===============================
window.abrirModalPagamento = function (idPedido, idCliente, valorTotal, checkboxEl) {
    if (!checkboxEl.checked) return;

    const total = parseFloat(valorTotal) || 0;
    if (total <= 0) {
        alert("Este pedido não possui valor para pagamento.");
        checkboxEl.checked = false;
        return;
    }

    totalPedido = total;
    document.getElementById('totalPedido').textContent = total.toFixed(2);
    document.getElementById('valorRestante').textContent = total.toFixed(2);
    document.getElementById('modal_id_pedido').value = idPedido;
    document.getElementById('modal_id_cliente').value = idCliente;

    const form = document.getElementById('formPagamento');
    form.querySelectorAll('.clonado').forEach(el => el.remove());

    // Clonagem (para o Controller salvar os itens junto com o pagamento)
    clonarDadosParaModal(idCliente, form);

    // Reset campos
    document.querySelectorAll('.pagamento-valor').forEach(el => el.value = "0.00");
    document.querySelectorAll('.pagamento-check').forEach(el => el.checked = false);

    const modal = new bootstrap.Modal(document.getElementById('modalPagamento'));
    modal.show();
};

function atualizarRestante() {
    let soma = 0;
    document.querySelectorAll('.pagamento-valor').forEach(el => {
        soma += parseFloat(el.value) || 0;
    });
    const restante = totalPedido - soma;
    const label = document.getElementById('valorRestante');
    if (label) {
        label.textContent = restante.toFixed(2);
        label.style.color = Math.abs(restante) < 0.01 ? '#28a745' : '#ffc107';
    }
}

function clonarDadosParaModal(idCliente, form) {
    // Variado
    const v = document.querySelector(`input[name="variado[${idCliente}]"]`);
    if (v) {
        let h = document.createElement('input'); h.type = 'hidden'; h.className = 'clonado';
        h.name = `variado[${idCliente}]`; h.value = v.value; form.appendChild(h);
    }
    // Obs
    const o = document.getElementById(`observacao_variado_${idCliente}`);
    if (o) {
        let h = document.createElement('input'); h.type = 'hidden'; h.className = 'clonado';
        h.name = `observacao_variado[${idCliente}]`; h.value = o.value; form.appendChild(h);
    }
    // Itens
    document.querySelectorAll(`input[name^="itens[${idCliente}]"]`).forEach(el => {
        if (parseInt(el.value) > 0) {
            let h = document.createElement('input'); h.type = 'hidden'; h.className = 'clonado';
            h.name = el.name; h.value = el.value; form.appendChild(h);
        }
    });
}

function salvarPagamento() {
    const restante = parseFloat(document.getElementById('valorRestante').textContent);
    if (Math.abs(restante) > 0.01) {
        alert("O valor distribuído (R$ " + (totalPedido - restante).toFixed(2) + ") não corresponde ao total (R$ " + totalPedido.toFixed(2) + ")!");
        return;
    }
    document.getElementById('formPagamento').submit();
}

// ===============================
// DEMAIS FUNÇÕES (CÁLCULOS, PESQUISA, RECIBO)
// ===============================
function atualizarTotalLinha(idCliente) {
    let total = 0;
    document.querySelectorAll(`input[data-cliente="${idCliente}"].input-item`).forEach(el => {
        total += (parseInt(el.value) || 0) * (parseFloat(el.dataset.preco) || 0);
    });
    const inputV = document.querySelector(`input[name="variado[${idCliente}]"]`);
    if (inputV) {
        let valor = inputV.value.replace(/\./g, '').replace(',', '.');
        total += parseFloat(valor) || 0;
    }
    const tdTotal = document.getElementById('total_' + idCliente);
    if (tdTotal) {
        tdTotal.innerText = 'R$ ' + total.toLocaleString('pt-br', { minimumFractionDigits: 2 });
        tdTotal.dataset.total = total.toFixed(2);
    }
    calcularTotalRecebido();
}

// Monitora a saída do campo (blur) para validar o estoque com Modal
document.addEventListener('blur', function (e) {
    if (e.target.classList.contains('input-item')) {
        const input = e.target;
        const controla = input.dataset.controla === "1";
        const estoque = parseInt(input.dataset.estoque) || 0;
        const quantidade = parseInt(input.value) || 0;
        const nomeProd = input.dataset.nome;

        if (controla && quantidade > estoque) {
            // Preenche os dados no Modal
            document.getElementById('msgEstoque').innerHTML = `O produto <strong>${nomeProd}</strong> não possui estoque suficiente.`;
            document.getElementById('estoqueDisponivel').textContent = estoque;
            document.getElementById('estoqueTentativa').textContent = quantidade;

            // Abre o Modal do Bootstrap
            const modalEstoque = new bootstrap.Modal(document.getElementById('modalEstoque'));
            modalEstoque.show();

            // Reseta o valor para o máximo permitido
            input.value = estoque;

            // Recalcula o total da linha e do dia
            if (input.dataset.cliente) {
                atualizarTotalLinha(input.dataset.cliente);
            }

            // Feedback visual no campo
            input.classList.add('is-invalid');
            setTimeout(() => input.classList.remove('is-invalid'), 3000);
        }
    }
}, true);

function calcularTotalRecebido() {
    let totalDia = 0;
    document.querySelectorAll('input.check-pago:checked').forEach(checkbox => {
        const tdTotal = checkbox.closest('tr').querySelector('td[id^="total_"]');
        if (tdTotal) totalDia += parseFloat(tdTotal.dataset.total) || 0;
    });
    const label = document.getElementById('totalRecebido');
    if (label) label.textContent = "R$ " + totalDia.toLocaleString('pt-br', { minimumFractionDigits: 2 });
}

function initPesquisaCliente() {
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

function filtrarClientes() {
    const selecionados = Array.from(document.querySelectorAll('input[name="cardgames[]"]:checked')).map(cb => cb.value);
    const linhas = document.querySelectorAll('#formPedidos tbody tr');
    linhas.forEach(linha => {
        if (selecionados.length === 0) { linha.style.display = ''; return; }
        const lista = (linha.getAttribute('data-cardgames') || '').split(',');
        linha.style.display = selecionados.some(id => lista.includes(id)) ? '' : 'none';
    });
}

function abrirPopupVariado(idCliente) {
    clienteAtual = idCliente;
    document.getElementById('variado_cliente_id').value = idCliente;
    document.getElementById('descricaoVariado').value = document.getElementById('observacao_variado_' + idCliente).value;
    new bootstrap.Modal(document.getElementById('popupVariado')).show();
}

function salvarDescricaoVariado() {
    const id = document.getElementById('variado_cliente_id').value;
    document.getElementById('observacao_variado_' + id).value = document.getElementById('descricaoVariado').value;
    bootstrap.Modal.getInstance(document.getElementById('popupVariado')).hide();
}

function desmarcarPago() {
    const idCli = document.getElementById('modal_id_cliente').value;
    const check = document.querySelector(`input[name="pago[${idCli}]"]`);
    if (check) check.checked = false;
}

function abrirRecibo(id) {
    document.getElementById('iframeRecibo').src = '/pedido/recibo/' + id;
    new bootstrap.Modal(document.getElementById('modalRecibo')).show();
}

function imprimirRecibo() {
    const f = document.getElementById('iframeRecibo');
    f.contentWindow.focus(); f.contentWindow.print();
}
