<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Login | Huraga Bootstrap Admin Template</title>
        <meta name="description" content="">
        <meta name="author" content="Walking Pixels | www.walkingpixels.com">
        <meta name="robots" content="index, follow">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSS styles -->
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>resources/css/huraga-red.css">

        <!-- Fav and touch icons -->
        <link rel="shortcut icon" href="favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= base_url(); ?>resources/img/icons/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= base_url(); ?>resources/img/icons/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?= base_url(); ?>resources/img/icons/apple-touch-icon-57-precomposed.png">

        <!-- JS Libs -->
        <script src="<?= base_url(); ?>resources/js/libs/jquery.js"></script>
        <script src="<?= base_url(); ?>resources/js/libs/modernizr.js"></script>
        <script src="<?= base_url(); ?>resources/js/libs/selectivizr.js"></script>

    </head>
    <body>

        <!-- Main page container -->
        <section class="container login" role="main">

            <h1><a href="login.php" class="brand">Huraga</a></h1>

            <div class="data-block">
                <div class="data-container">

                    <form method="post" action="index.php" novalidate>
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label" for="login">Username</label>
                                <div class="controls">
                                    <input id="icon" type="text" placeholder="Tu nombre de usuario" name="login" required data-validation-required-message="Debes ingresar tu nombre de usuario">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="password">Contraseña</label>
                                <div class="controls">
                                    <input id="password" type="password" placeholder="Contraseña" name="password" required data-validation-required-message="Debes ingresar tu contraseña.">
                                    <label class="checkbox">
                                        <input id="optionsCheckbox" type="checkbox" value="option1"> Recordarme
                                    </label>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button class="btn btn-block btn-large btn-inverse btn-alt" type="submit"><span class="awe-signin"></span> Iniciar sesión</button>
                            </div>
                        </fieldset>
                    </form>

                </div>
            </div>

            <ul class="login-footer">
                <li><a href="#"><small>Olvidé mi contraseña</small></a></li>
            </ul>

        </section>
        <!-- /Main page container -->

    </body>

    <!-- Scripts -->
    <!-- Bootstrap validation -->
    <script src="<?= base_url(); ?>resources/js/plugins/bootstrapValidation/jqBootstrapValidation.min.js"></script>
    <script>
        $(document).ready(function () {
            $("input").jqBootstrapValidation({
                submitSuccess: function ($form, event) {
                    //$.post();
                    window.location = '<?= base_url(); ?>index.php';
                    event.preventDefault();
                }
            });
        });
    </script>
</html>
