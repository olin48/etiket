<script>
    (function($) {
        "use strict";
        CKEDITOR.replace('isi_download');
        // Berita
        <?php foreach ($download as $d) { ?>
            CKEDITOR.replace('isi_download_<?= $d['id'] ?>');
        <?php } ?>
    })(jQuery);
</script>

</body>

</html>