<script>
    (function($) {
        "use strict";
        CKEDITOR.replace('isi');
        // Berita
        <?php foreach ($mobberita as $mb) { ?>
            CKEDITOR.replace('isi_<?= $mb['id'] ?>');
        <?php } ?>
    })(jQuery);
</script>

</body>

</html>