	document.addEventListener('DOMContentLoaded', function() {

		const trigger = document.querySelector('#emoji-trigger');
		const input = document.querySelector('#emoji');
		const container = document.querySelector('#picker-container');

		// Só inicializa se todos existirem
		if (trigger && input && container) {

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

	});

	const el = document.getElementById('sortable-produtos');
	if (el) {
		Sortable.create(el, {
			animation: 150,
			ghostClass: 'table-active',
			chosenClass: 'sortable-chosen',
			onEnd: function() {
				document.querySelectorAll('.show-ordem').forEach((span, index) => {
					span.innerText = index + 1;
				});
			}
		});
	}

