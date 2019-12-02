<script>
    (function($) {
        <?php foreach ($kapasitas as $k) { ?>
            var jenisTiket = $('#jenis_tiket_<?= $k['id']; ?>').val();
            if (jenisTiket == "") {
                $('#id_tiket_event_<?= $k['id'] ?>').hide();
                $('#id_tiket_pertandingan_<?= $k['id'] ?>').show();
                $('#id_tiket_pertandingan_<?= $k['id'] ?>').prop('disabled', true);
            } else if (jenisTiket == "TIKETEVN") {
                $('#id_tiket_event_<?= $k['id'] ?>').show();
                $('#id_tiket_pertandingan_<?= $k['id'] ?>').hide();
            } else if (jenisTiket == "TIKETPTN") {
                $('#id_tiket_pertandingan_<?= $k['id'] ?>').show();
                $('#id_tiket_pertandingan_<?= $k['id'] ?>').prop('disabled', false);
                $('#id_tiket_event_<?= $k['id'] ?>').hide();
            }

            $('#jenis_tiket_<?= $k['id']; ?>').change(function() {
                var jnsTiket = $(this).children("option:selected").val();
                if (jnsTiket == "") {
                    $('#id_tiket_event_<?= $k['id']; ?>').hide();
                    $('#id_tiket_pertandingan_<?= $k['id']; ?>').show();
                    $('#id_tiket_pertandingan_<?= $k['id']; ?>').prop('disabled', true);
                } else if (jnsTiket == "TIKETEVN") {
                    $('#id_tiket_event_<?= $k['id']; ?>').show();
                    $('#id_tiket_pertandingan_<?= $k['id']; ?>').hide();
                } else if (jnsTiket == "TIKETPTN") {
                    $('#id_tiket_pertandingan_<?= $k['id']; ?>').show();
                    $('#id_tiket_pertandingan_<?= $k['id']; ?>').prop('disabled', false);
                    $('#id_tiket_event_<?= $k['id']; ?>').hide();
                }
            });
        <?php } ?>
    })(jQuery);
</script>

</body>

</html>