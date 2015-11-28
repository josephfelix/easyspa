<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="easySpa.Club - Espaço de beleza e bem-estar."/>
    <meta property="og:type" content="product"/>
    <meta property="og:url" content="http://easyspa.club/cliente/cadastro/<?= $id_afiliado ?>"/>
    <meta property="og:image" content="http://easyspa.club/assets/img/shareinstagram/INSTAGRAM10.jpg">
    <meta property="og:image" content="http://easyspa.club/assets/img/shareinstagram/INSTAGRAM13.jpg">
    <meta property="og:image" content="http://easyspa.club/assets/img/shareinstagram/INSTAGRAM11.jpg">
    <meta property="og:image" content="http://easyspa.club/assets/img/shareinstagram/INSTAGRAM15.jpg">
    <meta property="og:image" content="http://easyspa.club/assets/img/shareinstagram/INSTAGRAM8.jpg">
    <meta property="og:site_name" content="easySpa.Club - Espaço de beleza e bem-estar."/>
    <meta property="og:description"
          content="Seja um cliente do easySpa.club! O espaço de beleza e bem-estar que toda mulher merece."/>

    <title>easySpa - Cadastro comercial</title>

    <!-- Stylesheets -->
    <link href="<?= base_url() ?>assets/login/css/bootstrap.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/login/css/animation.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/login/css/orange.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/login/css/preview.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/login/css/authenty.css" rel="stylesheet">

    <!-- Font Awesome CDN -->
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<section class="authenty signup-wizard signin-main">
    <div class="section-content">
        <div class="container">
            <div class="form-wrap">
                <div class="form-header" style="margin-left:-15px;width:430px;">
                    <h1>Cadastro de clientes</h1>
                    <img src="<?= base_url() ?>assets/images/logo.png">
                </div>

                <div class="row">
                    <div class="page-container">
                        <strong>
                            Seu cadastro foi realizado com sucesso, aguarde e entre usando nosso aplicativo.
                        </strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- js library -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
<script src="<?= base_url() ?>assets/login/js/bootstrap.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js"></script>

<!-- authenty js -->
<!--	<script src="<?= base_url() ?>assets/login/js/authenty.js"></script>-->


<!-- preview scripts -->
<script>
    $(document).ready(function () {

        /*
         Fullscreen background
         */
        $.backstretch([
            "<?=base_url()?>assets/img/backgrounds/1.jpg"
            , "<?=base_url()?>assets/img/backgrounds/2.jpg"
            , "<?=base_url()?>assets/img/backgrounds/3.jpg"
        ], {duration: 3000, fade: 750});
    });
</script>
<script src="<?= base_url() ?>assets/login/js/jquery.icheck.min.js"></script>
<script src="<?= base_url() ?>assets/login/js/waypoints.min.js"></script>

<!-- authenty js -->
<script src="<?= base_url() ?>assets/login/js/authenty.js"></script>


<!-- preview scripts -->
<script>
    (function ($) {

        // get full window size
        $(window).on('load resize', function () {
            var w = $(window).width();
            var h = $(window).height();

            $('section').height(h);
        });


        // set focus on input
        var firstInput = $('section').find('input[type=text], input[type=email]').filter(':visible:first');

        if (firstInput != null) {
            firstInput.focus();
        }

        $('section').waypoint(function (direction) {
            var target = $(this).find('input[type=text], input[type=email]').filter(':visible:first');
            target.focus();
        }, {
            offset: 300
        }).waypoint(function (direction) {
            var target = $(this).find('input[type=text], input[type=email]').filter(':visible:first');
            target.focus();
        }, {
            offset: -400
        });


        // animation handler
        $('[data-animation-delay]').each(function () {
            var animationDelay = $(this).data("animation-delay");
            $(this).css({
                "-webkit-animation-delay": animationDelay,
                "-moz-animation-delay": animationDelay,
                "-o-animation-delay": animationDelay,
                "-ms-animation-delay": animationDelay,
                "animation-delay": animationDelay
            });
        });

        $('[data-animation]').waypoint(function (direction) {
            if (direction == "down") {
                $(this).addClass("animated " + $(this).data("animation"));
            }
        }, {
            offset: '90%'
        }).waypoint(function (direction) {
            if (direction == "up") {
                $(this).removeClass("animated " + $(this).data("animation"));
            }
        }, {
            offset: '100%'
        });

    })(jQuery);
</script>
</body>
</html>