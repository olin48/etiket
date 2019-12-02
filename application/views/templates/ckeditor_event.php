<script>
    (function($) {
        "use strict";
        CKEDITOR.replace('isi_event');
        // Tiket Event
        <?php foreach ($mobevent as $me) { ?>
            CKEDITOR.replace('isi_event_<?= $me['id'] ?>');
        <?php } ?>
    })(jQuery);

    (function($) {
        <?php foreach ($mobevent as $me) { ?>
                "use strict";
            $('#start_event_<?= $me['id'] ?>').datepicker({
                format: 'yyyy-mm-dd'
            });
            $('#end_event_<?= $me['id'] ?>').datepicker({
                format: 'yyyy-mm-dd'
            });
            $('#tanggal_event_<?= $me['id'] ?>').datepicker({
                format: 'yyyy-mm-dd'
            });
            $('#waktu_event_<?= $me['id'] ?>').clockface({
                format: 'HH:mm',
                trigger: 'manual'
            });
        <?php } ?>
    })(jQuery);

    (function($) {
        <?php foreach ($mobevent as $me) { ?>
                "use strict";
            $('#toggle-btn_<?= $me['id'] ?>').click(function(e) {
                e.stopPropagation();
                $('#waktu_event_<?= $me['id'] ?>').clockface('toggle');
            });
        <?php } ?>
    })(jQuery);
</script>

</body>

</html>