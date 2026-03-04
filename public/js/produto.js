document.addEventListener('DOMContentLoaded', function() {

    // 1. LÓGICA DO SELETOR DE EMOJI (Picmo)
    const trigger = document.querySelector('#emoji-trigger');
    const input = document.querySelector('#emoji');
    const container = document.querySelector('#picker-container');

    if (trigger && input && container) {
        // Inicializa o picker
        const picker = picmo.createPicker({
            rootElement: container,
            theme: 'dark',
            showSearch: true
        });

        container.style.display = 'none';

        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            container.style.display =
                container.style.display === 'none' ? 'block' : 'none';
        });

        picker.addEventListener('emoji:select', (selection) => {
            input.value = selection.emoji;
            container.style.display = 'none';
        });

        document.addEventListener('click', (e) => {
            if (!container.contains(e.target) && e.target !== trigger) {
                container.style.display = 'none';
            }
        });
    }

    // 2. LÓGICA DE REORDENAÇÃO (SortableJS)
    const el = document.getElementById('sortable-produtos');
    if (el) {
        Sortable.create(el, {
            animation: 150,
            // REMOVIDO: handle: '.bi-grip-vertical' -> Agora a linha toda volta a ser arrastável
            ghostClass: 'table-active',
            chosenClass: 'sortable-chosen',
            onEnd: function() {
                // Atualiza os números da coluna "Ordem Atual" visualmente
                document.querySelectorAll('.show-ordem').forEach((span, index) => {
                    span.innerText = index + 1;
                });
            }
        });
    }
});
