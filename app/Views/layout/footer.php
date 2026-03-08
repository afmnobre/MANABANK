</div> <footer class="text-light text-center fixed-bottom shadow-sm"
        style="background-color: <?= htmlspecialchars($corTema ?: '#111') ?> !important;
               border-top: 1px solid rgba(255,255,255,0.1);
               line-height: 1;
               padding: 4px 0;">
   <div class="container-fluid">
      <div style="margin-bottom: 2px;">
         <img src="<?= htmlspecialchars($logoPath) ?>" alt="Favicon" style="height: 12px; width: auto;">
      </div>
      <small style="font-size: 9px; opacity: 0.8;">
          © <?= date('Y') ?> - <?= htmlspecialchars($nomeLoja) ?>
      </small>
   </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<!-- (Excell export) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<!-- html2canvas (render to canvas) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<!-- Flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pt.js"></script>

<!--Emojis-->
<script src="https://cdn.jsdelivr.net/npm/picmo@latest/dist/umd/index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@picmo/renderer-fontawesome@latest/dist/umd/index.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!--Arrasta e Solta Pedidos-->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<!-- Chart.js (gráficos) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?= $base ?>public/js/pedidos.js"></script>
<script src="<?= $base ?>public/js/cliente.js"></script>
    <script src="<?= $base ?>public/js/produto.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    if (typeof initCalendario === 'function') {
        initCalendario(
            <?= isset($datasPendentes) ? json_encode($datasPendentes) : 'null' ?>,
            "<?= isset($dataSelecionada) ? $dataSelecionada : '' ?>"
        );
    }
});
</script>
</body>
</html>
