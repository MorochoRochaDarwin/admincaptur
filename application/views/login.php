<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Adinistracion Captur Tungurahua</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Admin, Dashboard, Bootstrap"/>
    <link rel="shortcut icon" sizes="196x196" href="/assets/images/logo.png">

    <link rel="stylesheet" href="/libs/bower/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="/libs/bower/animate.css/animate.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/core.css">
    <link rel="stylesheet" href="/assets/css/misc-pages.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
</head>
<body class="simple-page">
<div id="back-to-home">
    <a href="http://capturtungurahua.com" class="btn btn-outline btn-default"><i class="fa fa-home animated zoomIn"></i></a>
</div>

<div style="width: 100%; height: 100%; background-color: rgba(9,45,107,0.73); position: absolute; top: 0;"></div>

<div class="simple-page-wrap">
    <div class="simple-page-logo animated swing">
        <a href="http://capturtungurahua.com">
            <span><i class="fa fa-gg"></i></span>
            <span>CAPTUR TUNGURAHUA</span>
        </a>
    </div><!-- logo -->

    <h5><?php echo password_hash('admin', PASSWORD_DEFAULT) ?></h5>
    <div class="simple-page-form animated flipInY" id="login-form">
        <h4 class="form-title m-b-xl text-center">Ingresar al sistema</h4>


        <?php if ($error != null) { ?>
            <span class="alert alert-danger" style="width: 100%;">
                <?php echo $error ?>
             </span>
            <hr>
        <?php } ?>

        <form action="<?php echo base_url('verificar-login') ?>" method="post">
            <div class="form-group">
                <input required name="username" id="sign-in-email" type="text" class="form-control"
                       placeholder="Usuario">
            </div>

            <div class="form-group">
                <input required name="password" id="sign-in-password" type="password" class="form-control"
                       placeholder="Contraseña">
            </div>


            <input type="submit" class="btn btn-primary" value="INGRESAR">
        </form>
    </div><!-- #login-form -->

    <div class="simple-page-footer" style="position: relative; z-index: 3;">
        <p><a href="password-forget.html">OLVIDE MI CONTRASEÑA ?</a></p>
    </div><!-- .simple-page-footer -->


</div><!-- .simple-page-wrap -->
</body>
</html>