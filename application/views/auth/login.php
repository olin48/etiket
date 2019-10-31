<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!--   <meta content="IE=edge" http-equiv="X-UA-Compatible"> -->
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="" name="description">
    <meta content="" name="author">
    <link href="ico/favicon.ico" rel="shortcut icon">

    <title>Cannavaro Web Admin</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.css'); ?>">
    <!-- Bootstrap theme -->
    <!--  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-theme.min.css'); ?>"> -->

    <!-- Custom styles for this template -->

    <link rel="stylesheet" href="<?= base_url('assets/css/login.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/theme.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/dripicon.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/typicons.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/font-awesome.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/responsive.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/js/tip/tooltipster.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/js/vegas/jquery.vegas.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/js/number-progress-bar/number-pb.css'); ?>">
    <!-- pace loader -->
    <script src="<?= base_url('assets/js/pace/pace.js'); ?>"></script>
    <link href="<?= base_url('assets/js/pace/themes/orange/pace-theme-flash.css'); ?>" rel="stylesheet" />


</head>

<body>

    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>

    <div class="container-fluid ">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <!-- Comtainer -->
                <div class="paper-wrap bevel tlbr">
                    <div id="paper-top">
                        <div class="row">
                            <div class="col-lg-12 no-pad">
                                <!--     -->
                                <a class="navbar-brand logo-text" href="#">Pakansari E-Tiket</a>
                            </div>
                        </div>
                    </div>

                    <!-- CONTENT -->
                    <div style="min-height:150px;" class="wrap-fluid" id="paper-bg">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="account-box">

                                    <?= $this->session->flashdata('message'); ?>
                                    <form role="form" method="post" action="<?= base_url('auth'); ?>">
                                        <div class="form-group">
                                            <a href="#" class="pull-right label-forgot">Forgot email?</a>
                                            <label>Username or email</label>
                                            <input type="text" id="email" name="email" class="form-control" value="<?= set_value('email'); ?>">
                                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <a href="#" class="pull-right label-forgot">Forgot password?</a>
                                            <label>Password</label>
                                            <input type="password" id="password" name="password" class="form-control" value="<?= set_value('password'); ?>">
                                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class=" checkbox pull-left">
                                            <label>
                                                <input type="checkbox">Remember me</label>
                                        </div>
                                        <button class="btn btn btn-primary pull-right" type="submit">
                                            Log In
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / FOOTER -->
                <!-- Container -->
            </div>
        </div>
    </div>
    <!-- 
    ================================================== -->
    <!-- Main jQuery Plugins -->
    <script type='text/javascript' src="<?= base_url('assets/js/jquery.js'); ?>"></script>
    <script type='text/javascript' src='<?= base_url('assets/js/vegas/jquery.vegas.js'); ?>'></script>
    <script type='text/javascript' src='<?= base_url('assets/js/image-background.js'); ?>'></script>
    <script type="text/javascript" src="<?= base_url('assets/js/jquery.tabSlideOut.v1.3.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/bg-changer.js'); ?>"></script>

</body>

</html>