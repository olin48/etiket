<script>
    (function($) {
        <?php foreach ($mobpertandingan as $mp) { ?>
                "use strict";
            $('#tanggal_tanding_<?= $mp['id'] ?>').datepicker({
                format: 'yyyy-mm-dd'
            });
        <?php } ?>
    })(jQuery);

    (function($) {
        <?php foreach ($mobpertandingan as $mp) { ?>
                "use strict";
            $('#toggle-btn-<?= $mp['id'] ?>').click(function(e) {
                e.stopPropagation();
                $('#waktu_tanding_<?= $mp['id'] ?>').clockface('toggle');
            });
        <?php } ?>
    })(jQuery);
</script>

</body>

</html>