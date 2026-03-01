// ===============================
// VARIÁVEIS GLOBAIS
// ===============================
let totalPedido = 0;
let clienteAtual = null;


// ===============================
// CALENDÁRIO
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
// PESQUISA CLIENTE
// ===============================
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


// ===============================
// POPUP VARIADO
// ===============================
function abrirPopupVariado(idCliente) {
    clienteAtual = idCliente;

    const campoHidden = document.getElementById('observacao_variado_' + idCliente);
    document.getElementById('descricaoVariado').value = campoHidden.value;

    new bootstrap.Modal(document.getElementById('popupVariado')).show();
}

function salvarDescricaoVariado() {
    if (clienteAtual) {
        const campoHidden = document.getElementById('observacao_variado_' + clienteAtual);
        campoHidden.value = document.getElementById('descricaoVariado').value;
    }

    bootstrap.Modal.getInstance(document.getElementById('popupVariado')).hide();
}


// ===============================
// RECIBO
// ===============================
function abrirRecibo(idPedido) {
    const iframe = document.getElementById('iframeRecibo');
    iframe.src = '/pedido/recibo/' + idPedido;

    new bootstrap.Modal(document.getElementById('modalRecibo')).show();
}

function fecharRecibo() {
    const iframe = document.getElementById('iframeRecibo');
    iframe.src = '';

    const modal = bootstrap.Modal.getInstance(document.getElementById('modalRecibo'));
    if (modal) modal.hide();
}

function imprimirRecibo() {
    const iframe = document.getElementById('iframeRecibo');
    iframe.contentWindow.focus();
    iframe.contentWindow.print();
}


// ===============================
// CÁLCULOS
// ===============================
function calcularTotal(clienteId) {
    let total = 0;

    document.querySelectorAll(`input[data-cliente="${clienteId}"][type="number"]`)
        .forEach(input => {
            const qtd = parseFloat(input.value) || 0;
            const preco = parseFloat(input.dataset.preco) || 0;
            total += qtd * preco;
        });

    const variadoInput = document.querySelector(`input[name="variado[${clienteId}]"]`);
    if (variadoInput) {
        let valor = variadoInput.value.replace(/\./g, '').replace(',', '.');
        total += parseFloat(valor) || 0;
    }

    const totalLabel = document.getElementById(`total_${clienteId}`);
    if (totalLabel) {
        totalLabel.textContent = "R$ " + total.toFixed(2).replace('.', ',');
        totalLabel.dataset.total = total.toFixed(2);
    }

    calcularTotalRecebido();
}

function calcularTotalRecebido() {
    let totalDia = 0;

    document.querySelectorAll('td[id^="total_"]').forEach(td => {
        const clienteId = td.id.replace('total_', '');
        const checkbox = document.querySelector(`input[name="pago[${clienteId}]"]`);

        if (checkbox && checkbox.checked) {
            let valor = td.textContent.replace('R$', '').trim();
            valor = valor.replace(/\./g, '').replace(',', '.');
            totalDia += parseFloat(valor) || 0;
        }
    });

    const totalRecebido = document.getElementById('totalRecebido');
    if (totalRecebido) {
        totalRecebido.textContent = "R$ " + totalDia.toFixed(2).replace('.', ',');
    }
}


// ===============================
// MODAL PAGAMENTO
// ===============================
window.abrirModalPagamento = function (idPedido, idCliente, valorTotal, checkboxEl) {

    const total = parseFloat(valorTotal) || 0;

    if (total <= 0) {
        alert("Este pedido não possui valor para rateio de pagamento.");
        if (checkboxEl) checkboxEl.checked = false;
        return;
    }

    totalPedido = total;

    document.getElementById('totalPedido').textContent = totalPedido.toFixed(2);
    document.getElementById('valorRestante').textContent = totalPedido.toFixed(2);

    document.getElementById('modal_id_pedido').value = idPedido;
    document.getElementById('modal_id_cliente').value = idCliente;

    const form = document.getElementById('formPagamento');

    form.querySelectorAll('input[name^="variado"], input[name^="observacao_variado"], input[name^="itens"]')
        .forEach(el => el.remove());

    // RESET CAMPOS
    document.querySelectorAll('.pagamento-valor')
        .forEach(el => el.value = "0.00");

    document.querySelectorAll('.pagamento-check')
        .forEach(el => el.checked = false);

    // Seleciona automaticamente o PRIMEIRO método como padrão
    const primeiroCheck = document.querySelector('.pagamento-check');
    if (primeiroCheck) {
        primeiroCheck.checked = true;
        const campo = document.querySelector(`.pagamento-valor[data-id="${primeiroCheck.dataset.id}"]`);
        if (campo) campo.value = totalPedido.toFixed(2);
    }

    new bootstrap.Modal(document.getElementById('modalPagamento')).show();
};


function atualizarRestante() {
    let soma = 0;

    document.querySelectorAll('.pagamento-valor')
        .forEach(el => soma += parseFloat(el.value) || 0);

    const restante = totalPedido - soma;

    document.getElementById('valorRestante').textContent = restante.toFixed(2);
}


// ===============================
// SALVAR PAGAMENTO
// ===============================
function salvarPagamento() {

    const form = document.getElementById('formPagamento');

    // 🔹 Remove antigos hidden para não duplicar
    form.querySelectorAll('.hidden-cardgame').forEach(e => e.remove());

    // 🔹 Pega os cardgames atualmente marcados
    const selecionados = document.querySelectorAll('input[name="cardgames[]"]:checked');

    selecionados.forEach(cb => {
        const hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = 'cardgamesSelecionados[]';
        hidden.value = cb.value;
        hidden.classList.add('hidden-cardgame');
        form.appendChild(hidden);
    });

    form.submit();
}



// ===============================
// ALERTA VARIADO
// ===============================
function mostrarAlertaVariado(callback) {
    const alertBox = document.getElementById('alertVariado');
    alertBox.style.display = 'block';

    setTimeout(() => {
        alertBox.style.display = 'none';
        if (typeof callback === 'function') callback();
    }, 3000);
}

// ===============================
// FILTRAR CARDGAME
// ===============================
function filtrarClientes() {
    const selecionados = Array.from(
        document.querySelectorAll('input[name="cardgames[]"]:checked')
    ).map(cb => cb.value);
    const linhas = document.querySelectorAll('#formPedidos tbody tr');
    if (selecionados.length === 0) {
        linhas.forEach(linha => linha.style.display = '');
        return;
    }
    linhas.forEach(function (linha) {
        const cardgamesLinha = linha.getAttribute('data-cardgames');
        if (!cardgamesLinha) {
            linha.style.display = 'none';
            return;
        }
        const listaLinha = cardgamesLinha.split(',');
        const corresponde = selecionados.some(id =>
            listaLinha.includes(id)
        );
        linha.style.display = corresponde ? '' : 'none';
    });
}

function atualizarHiddenCardgames() {
    const container = document.getElementById('cardgamesSelecionados');
    container.innerHTML = '';
    const selecionados = document.querySelectorAll(
        'input[name="cardgames[]"]:checked'
    );
    selecionados.forEach(cb => {
        const hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = 'cardgames[]';
        hidden.value = cb.value;
        container.appendChild(hidden);
    });
}

// ===============================
// EVENTOS GLOBAIS (UNIFICADO)
// ===============================
document.addEventListener('DOMContentLoaded', function () {
    // ===============================
    // INICIALIZAÇÕES
    // ===============================
    initPesquisaCliente();
    // 🔥 Inicializa total recebido ao carregar a página
    calcularTotalRecebido();

    //Mantem o Filtro por Cardgames
    const form = document.getElementById('formPedidos');
    if (form) {
        form.addEventListener('submit', function() {
            atualizarHiddenCardgames();
        });
    }

    // ===============================
    // INPUTS DE QUANTIDADE E VARIADO
    // ===============================
    document.querySelectorAll('input[type="number"], input[name^="variado"]')
        .forEach(function (input) {
            input.addEventListener('input', function () {
                if (this.dataset.cliente) {
                    calcularTotal(this.dataset.cliente);
                }
            });
            input.addEventListener('blur', function () {
                if (!this.name.startsWith('variado')) return;
                let valor = this.value.replace(/\./g, '').replace(',', '.');
                let num = parseFloat(valor) || 0;
                if (num > 0) {
                    mostrarAlertaVariado(() => {
                        abrirPopupVariado(this.dataset.cliente);
                    });
                }
            });
        });
    // ===============================
    // RATEIO MODAL PAGAMENTO
    // ===============================
    document.addEventListener('input', function (e) {
        if (!e.target.classList.contains('pagamento-valor')) return;
        atualizarRestante();
    });
    document.addEventListener('change', function (e) {
        if (!e.target.classList.contains('pagamento-check')) return;
        const selecionados = Array.from(
            document.querySelectorAll('.pagamento-check:checked')
        );
        if (!e.target.checked) {
            const campo = document.querySelector(
                `.pagamento-valor[data-id="${e.target.dataset.id}"]`
            );
            if (campo) campo.value = "0.00";
        }
        if (selecionados.length > 0) {
            const valorDividido = totalPedido / selecionados.length;
            let soma = 0;
            selecionados.forEach(function (chk, index) {
                const campo = document.querySelector(
                    `.pagamento-valor[data-id="${chk.dataset.id}"]`
                );
                if (!campo) return;
                if (index === selecionados.length - 1) {
                    campo.value = (totalPedido - soma).toFixed(2);
                } else {
                    campo.value = valorDividido.toFixed(2);
                    soma += valorDividido;
                }
            });
        }
        atualizarRestante();
    });
    filtrarClientes();
});

