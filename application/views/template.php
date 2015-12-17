<?php
$seccion = strtoupper($this->uri->segment(1, "DASHBOARD"));
?>
<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Google Transit UI</title>
        <meta name="description" content="">
        <meta name="author" content="Rodrigo Alejandro Sevilla Blanco">
        <meta name="robots" content="index, follow">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- jQuery Visualize Styles -->
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>resources/css/plugins/jquery.visualize.css">

        <!-- jQuery jGrowl Styles -->
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>resources/css/plugins/jquery.jgrowl.css">

        <!-- jQuery FullCalendar Styles -->
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>resources/css/plugins/jquery.fullcalendar.css">

        <!-- CSS styles -->
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>resources/css/huraga-green.css">

        <!-- Fav and touch icons -->
        <link rel="shortcut icon" href="<?= base_url(); ?>resources/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= base_url(); ?>resources/img/icons/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= base_url(); ?>resources/img/icons/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?= base_url(); ?>resources/img/icons/apple-touch-icon-57-precomposed.png">

        <!-- JS Libs -->
        <script src="<?= base_url(); ?>resources/js/libs/jquery.js"></script>
        <script src="<?= base_url(); ?>resources/js/libs/jquery-ui-1.10.2.custom.min.js"></script>

        <script src="<?= base_url(); ?>resources/js/libs/modernizr.js"></script>
        <script src="<?= base_url(); ?>resources/js/libs/selectivizr.js"></script>

        <script>
            $(document).ready(function () {
                // Escondemos el infoAlert
                setTimeout(function () {
                    $("#infoAlert").slideUp('slow');
                }, 4000);

                // Tooltips
                $('[title]').tooltip({
                    placement: 'top'
                });

                // Tabs
                $('.demoTabs a').click(function (e) {
                    e.preventDefault();
                    $(this).tab('show');
                    $('.fullcalendar, .full-calendar-gcal').fullCalendar('render'); // Refresh jQuery FullCalendar for hidden tabs
                })

            });
        </script>

    </head>
    <body>

        <!-- Full height wrapper -->
        <div id="wrapper">

            <!-- Main page header -->
            <header id="header" class="container">

                <!-- Alternative navigation -->
                <nav>
                    <ul>
                        <li>
                            <form class="nav-search">
                                <input type="text" placeholder="Search&hellip;">
                            </form>
                        </li>
                        <li>
                            <div class="btn-group">
                                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                    Configuration
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="401.html"><span class="awe-flag"></span> Error page 401</a></li>
                                    <li><a href="403.html"><span class="awe-flag"></span> Error page 403</a></li>
                                    <li><a href="404.html"><span class="awe-flag"></span> Error page 404</a></li>
                                    <li><a href="500.html"><span class="awe-flag"></span> Error page 500</a></li>
                                    <li><a href="503.html"><span class="awe-flag"></span> Error page 503</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="#">Logout</a></li>
                    </ul>
                </nav>
                <!-- /Alternative navigation -->

                <!-- Main page logo -->
                <h1><a href="index.php" class="brand">GoogleTransitUI</a></h1>

                <!-- Main page headline -->
                <p>Una hermosa interfaz minimalista para crear nuestras rutas de transporte</p>


            </header>
            <!-- /Main page header -->

            <!-- Main page container -->
            <section class="container" role="main">

                <!-- Left (navigation) side -->
                <div class="navigation-block">

                    <!-- User profile -->
                    <section class="user-profile">
                        <figure>
                            <img alt="John Pixel avatar" src="data:image/png;base64,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"/>
                            <figcaption>
                                <strong><a href="#" class="">John Pixel</a></strong>
                                <em>marketing manager</em>
                                <ul>
                                    <li><a class="btn btn-primary btn-flat" href="#" title="Account settings">settings</a></li>
                                    <li><a class="btn btn-primary btn-flat" href="#" title="Message inbox">inbox</a></li>
                                </ul>
                            </figcaption>
                        </figure>
                    </section>
                    <!-- /User profile -->

                    <!-- Sample left search bar -->
                    <form class="side-search">
                        <input type="text" placeholder="To search type and hit enter">
                    </form>
                    <!-- /Sample left search bar -->

                    <!-- Responsive navbar button -->
                    <div class="navbar">
                        <a class="btn btn-navbar btn-block btn-large" data-toggle="collapse" data-target=".nav-collapse"><span class="awe-home"></span> Dashboard</a>
                    </div>
                    <!-- /Responsive navbar button -->

                    <!-- Main navigation -->
                    <nav class="main-navigation nav-collapse collapse" role="navigation">
                        <ul>
                            <li <?= $seccion == 'DASHBOARD' ? 'class="current"' : ''; ?>><a href="<?= base_url(); ?>" class="no-submenu"><span class="awe-home"></span>Inicio</a></li>
                            <li <?= $seccion == 'AGENCIAS' ? 'class="current"' : ''; ?>><a href="<?= base_url() ?>Agencias" class="no-submenu"><span class="awe-tasks"></span>Agencias</a></li>
                        </ul>
                    </nav>
                    <!-- /Main navigation -->
                </div>
                <!-- Left (navigation) side -->

                <!-- Right (content) side -->
                <div class="content-block" role="main">

                    <!-- Breadcrumb -->
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a> <span class="divider">/</span></li>
                        <li><a href="#">Huraga template</a> <span class="divider">/</span></li>
                        <li class="active">Dashboard</li>
                    </ul>
                    <!-- /Breadcrumb -->

                    <!-- Page header -->
                    <article class="page-header">
                        <?php
                        $info = $this->session->flashdata("informacion");
                        if ($info !== NULL) {
                            echo '<div id="infoAlert" class="alert alert-' . $info['state'] . '" alert-dismissible><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $info['message'] . '</div>';
                        }
                        echo $this->template;
                        ?>
                    </article>
                    <!-- /Page header -->

                </div>
                <!-- /Right (content) side -->

            </section>
            <!-- /Main page container -->

            <!-- Sticky footer push -->
            <div id="push"></div>

        </div>
        <!-- /Full height wrapper -->

        <!-- Main page footer -->
        <footer id="footer" class="container">
            <p>Diseño de plantilla hecho con amor en <a href="http://twitter.github.com/bootstrap/">Twitter Bootstrap</a> por <a href="http://www.walkingpixels.com">Walking Pixels</a>.</p>
            <ul>
                <li><a href="#" class="">Soporte</a></li>
                <li><a href="#" class="">Documentation</a></li>
                <li><a href="#" class="">API</a></li>
            </ul>
            <a href="#top" class="btn btn-primary btn-flat pull-right">Arriba &uarr;</a>
        </footer>
        <!-- /Main page footer -->

        <!-- Scripts -->
        <script src="<?= base_url(); ?>resources/js/navigation.js"></script>
        <script src="<?= base_url(); ?>resources/js/bootstrap/bootstrap.min.js"></script>        

        <!-- Slim scroll -->
        <script type="text/javascript" src="<?= base_url(); ?>resources/js/plugins/slimScroll/jquery.slimscroll.js"></script>
        <script>
            $(document).ready(function () {
                $('#slimScroll1').slimScroll({
                    height: '250px'
                });

            });
        </script>

    </body>
</html>
