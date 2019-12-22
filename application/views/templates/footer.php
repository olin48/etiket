<!-- FOOTER -->
<div id="footer">
    <div class="devider-footer-left"></div>
    <div class="time">
        <p id="spanDate"></p>
        <p id="clock"></p>
    </div>
    <div class="copyright">Copyright &copy; 2019 <a href="http://ndesaintheme.com/">Pakansari</a> Made with <i class="fontello-heart-filled text-red"></i>
    </div>
    <div class="devider-footer"></div>
    <ul>
        <li><i class="fa fa-facebook-square"></i>
        </li>
        <li><i class="fa fa-twitter-square"></i>
        </li>
        <li><i class="fa fa-instagram"></i>
        </li>
    </ul>
</div>
<!-- / FOOTER -->
</div>
<!-- Container -->


<!-- 
    ================================================== -->
<!-- Main jQuery Plugins -->
<script type='text/javascript' src="<?= base_url('assets/js/jquery.js'); ?>"></script>

<script type='text/javascript' src='<?= base_url('assets/js/bootstrap.js'); ?>'></script>
<script type='text/javascript' src='<?= base_url('assets/js/date.js'); ?>'></script>
<script type='text/javascript' src='<?= base_url('assets/js/slimscroll/jquery.slimscroll.js'); ?>'></script>
<script type='text/javascript' src='<?= base_url('assets/js/jquery.nicescroll.min.js'); ?>'></script>
<script type='text/javascript' src='<?= base_url('assets/js/sliding-menu.js'); ?>'></script>
<script type='text/javascript' src='<?= base_url('assets/js/scriptbreaker-multiple-accordion-1.js'); ?>'></script>
<script type='text/javascript' src='<?= base_url('assets/js/tip/jquery.tooltipster.minx.js'); ?>'></script>
<script type='text/javascript' src="<?= base_url('assets/js/donut-chart/jquery.drawDoughnutChart.js'); ?>"></script>
<script type='text/javascript' src="<?= base_url('assets/js/tab/jquery.newsTicker.js'); ?>"></script>
<script type='text/javascript' src="<?= base_url('assets/js/tab/app.ticker.js'); ?>"></script>
<script type='text/javascript' src='<?= base_url('assets/js/app.js'); ?>'></script>

<script src="<?= base_url('assets/js/datatables/jquery.dataTables.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/datatables/dataTables.bootstrap.js'); ?>" type="text/javascript"></script>

<script type='text/javascript' src='<?= base_url('assets/js/vegas.js'); ?>'></script>


<script type='text/javascript' src="<?= base_url('assets/js/number-progress-bar/jquery.velocity.min.js'); ?>'); ?>"></script>
<script type='text/javascript' src="<?= base_url('assets/js/number-progress-bar/number-pb.js'); ?>"></script>
<script src="<?= base_url('assets/js/loader/loader.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/loader/demo.js'); ?>" type="text/javascript"></script>
<script type="text/javascript" src="<?= base_url('assets/js/skycons/skycons.js'); ?>"></script>

<script src="<?= base_url('assets/js/textEditor/dist/wysihtml5-0.4.0pre.js'); ?>"></script>
<script src="<?= base_url('assets/js/textEditor/lib/js/wysihtml5-0.3.0.js'); ?>"></script>
<script src="<?= base_url('assets/js/textEditor/src/bootstrap3-wysihtml5.js'); ?>"></script>

<script type="text/javascript" src="<?= base_url('assets/js/timepicker/bootstrap-timepicker.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/datepicker/bootstrap-datepicker.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/datepicker/clockface.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/datepicker/bootstrap-datetimepicker.js'); ?>"></script>

<!-- TAB SLIDER -->

<script src="<?= base_url('assets/js/chartist/chartist.min.js'); ?>"></script>

<script>
    (function($) {
        $('#id_tiket_event').hide();
        $('#id_tiket_pertandingan').prop('disabled', true);
        $('#jenis_tiket').change(function() {
            var jnsTiket = $(this).children("option:selected").val();
            if (jnsTiket == "") {
                $('#id_tiket_event').hide();
                $('#id_tiket_pertandingan').show();
                $('#id_tiket_pertandingan').prop('disabled', true);
            } else if (jnsTiket == "TIKETEVN") {
                $('#id_tiket_event').show();
                $('#id_tiket_pertandingan').hide();
            } else if (jnsTiket == "TIKETPTN") {
                $('#id_tiket_pertandingan').show();
                $('#id_tiket_pertandingan').prop('disabled', false);
                $('#id_tiket_event').hide();
            }
        });
    })(jQuery);

    (function($) {
        "use strict";
        $('#start_event').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('#end_event').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('#tanggal_event').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('#waktu_event').clockface({
            format: 'HH:mm',
            trigger: 'manual'
        });
    })(jQuery);

    (function($) {
        "use strict";
        $('#toggle-btn').click(function(e) {
            e.stopPropagation();
            $('#waktu_event').clockface('toggle');
        });
    })(jQuery);

    (function($) {
        "use strict";
        $('#tanggal_tanding').datepicker({
            format: 'yyyy-mm-dd'
        });
    })(jQuery);

    (function($) {
        "use strict";
        $('#toggle-btn').click(function(e) {
            e.stopPropagation();
            $('#waktu_tanding').clockface('toggle');
        });
    })(jQuery);
    //Weather Icons
    (function($) {
        "use strict";
        var icons = new Skycons({
                "stroke": 0.08,
                "color": "Gray",
                "cloudColor": "#65C3DF",
                "sunColor": "#0090d9",
                "moonColor": "DodgerBlue",
                "rainColor": "RoyalBlue",
                "snowColor": "LightGray",
                "windColor": "LightSteelBlue",
                "fogColor": "#65C3DF"
            }),
            list = [
                "clear-day", "clear-night", "partly-cloudy-day",
                "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                "fog"
            ],
            i;

        for (i = list.length; i--;)
            icons.set(list[i], list[i]);
        icons.play();
    })(jQuery);

    (function($) {
        $('#dataMobAdmins').dataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
        $('#dataBerita').dataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
        $('#dataMenu').dataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
        $('#dataSubmenu').dataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
        $('#dataDownload').dataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
    })(jQuery);

    //Animation Slider
    $(function() {
        function randomPercentage() {
            return Math.floor(Math.random() * 100);
        }

        function randomInterval() {
            var min = Math.floor(Math.random() * 30);
            var max = min + (Math.floor(Math.random() * 40) + 70);
            return [min, max];
        }

        function randomStep() {
            return Math.floor(Math.random() * 10) + 5;
        }

        // setup
        var $basic = $('#basic');
        var interval = randomInterval();
        var basicBar = $basic.find('.number-pb').NumberProgressBar({
            style: 'basic',
            min: interval[0],
            max: interval[1]
        })
        $basic.find('.title span').text('[Min: ' + interval[0] + ', Max: ' + interval[1] + ']');

        var percentageBar = $('#percentage .number-pb').NumberProgressBar({
            style: 'percentage'
        })

        var $step = $('#step');
        var maxStep = randomStep()
        var stepBar = $('#step .number-pb').NumberProgressBar({
            style: 'step',
            max: maxStep
        })
        $step.find('.title span').text('[Max step: ' + maxStep + ']');

        // loop
        var basicLoop = function() {
            basicBar.reach(undefined, {
                complete: percentageLoop
            });
        }

        var percentageLoop = function() {
            percentageBar.reach(undefined, {
                complete: stepLoop
            });
        }

        var stepLoop = function() {
            stepBar.reach(undefined, {
                complete: basicLoop
            });
        }

        // start
        basicLoop();
    });
</script>