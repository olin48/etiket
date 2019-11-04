<script>
    (function($) {
        // APK Version
        <?php foreach ($version as $ver) { ?>
            CKEDITOR.replace('isi_version_<?= $ver['id'] ?>');
        <?php } ?>
    })(jQuery);
</script>

</body>

</html>