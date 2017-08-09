<?php require_once 'ti.php' ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Admin, Dashboard, Bootstrap"/>
    <link rel="shortcut icon" sizes="196x196" href="/assets/images/logo.png">
    <title><?php startblock('titulo') ?><?php endblock() ?></title>

    <link rel="stylesheet" href="/libs/bower/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css">
    <!-- build:css ../assets/css/app.min.css -->
    <link rel="stylesheet" href="/libs/bower/animate.css/animate.min.css">
    <link rel="stylesheet" href="/libs/bower/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="/libs/bower/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/core.css">
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="stylesheet" href="/assets/css/toastr.css">
    <link rel="stylesheet" href="/assets/fontello/css/fontello.css">
    <link rel="stylesheet" href="/assets/datatables/css/dataTables.bootstrap.css">
    <link rel="stylesheet" href="/assets/datatables/css/jquery.dataTables.css">
    <link rel="stylesheet" href="/assets/datatables/extensions/Buttons/css/buttons.bootstrap.css">
    <link rel="stylesheet" href="/assets/datatables/extensions/Buttons/css/buttons.dataTables.css">
    <link rel="stylesheet" href="/assets/jquery-confirm/css/jquery-confirm.css">






    <?php startblock('css') ?>

    <?php endblock() ?>

    <!-- endbuild -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
    <script src="/libs/bower/breakpoints.js/dist/breakpoints.min.js"></script>
    <script>
        Breakpsoints();
    </script>
</head>

<body class="menubar-left menubar-unfold menubar-light theme-primary">
<!--============= start main area -->

<!-- APP NAVBAR ==========-->
<nav id="app-navbar" class="navbar navbar-inverse navbar-fixed-top primary">

    <!-- navbar header -->
    <div class="navbar-header">
        <button type="button" id="menubar-toggle-btn"
                class="navbar-toggle visible-xs-inline-block navbar-toggle-left hamburger hamburger--collapse js-hamburger">
            <span class="sr-only">Toggle navigation</span>
            <span class="hamburger-box"><span class="hamburger-inner"></span></span>
        </button>

        <button type="button" class="navbar-toggle navbar-toggle-right collapsed" data-toggle="collapse"
                data-target="#app-navbar-collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="zmdi zmdi-hc-lg zmdi-more"></span>
        </button>

        <button type="button" class="navbar-toggle navbar-toggle-right collapsed" data-toggle="collapse"
                data-target="#navbar-search" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="zmdi zmdi-hc-lg zmdi-search"></span>
        </button>

        <a href="/" class="navbar-brand">
            <span class="brand-icon"></span>
            <span class="brand-name">CAPTUR TUNGURAHUA</span>
        </a>
    </div><!-- .navbar-header -->

    <div class="navbar-container container-fluid">
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="nav navbar-toolbar navbar-toolbar-left navbar-left">
                <li class="hidden-float hidden-menubar-top">
                    <a href="javascript:void(0)" role="button" id="menubar-fold-btn"
                       class="hamburger hamburger--arrowalt is-active js-hamburger">
                        <span class="hamburger-box"><span class="hamburger-inner"></span></span>
                    </a>
                </li>
                <li>
                    <h5 class="page-title hidden-menubar-top hidden-float">Dashboard</h5>
                </li>
            </ul>

            <ul class="nav navbar-toolbar navbar-toolbar-right navbar-right">


                <li class="dropdown">
                    <a href="<?php echo base_url('password')?>"><i class="zmdi zmdi-hc-lg zmdi-key"></i></a>
                </li>

                <li class="dropdown">
                    <a href="<?php echo  base_url('logout')?>" class="side-panel-toggle" data-toggle="class" data-target="#side-panel"
                       data-class="open" role="button"><i class="zmdi zmdi-hc-lg zmdi-power-off"></i></a>
                </li>


            </ul>
        </div>
    </div><!-- navbar-container -->
</nav>
<!--========== END app navbar -->

<!-- APP ASIDE ==========-->
<aside id="menubar" class="menubar light">


    <div class="menubar-scroll">
        <div class="menubar-scroll-inner">
            <ul class="app-menu">


                <li>
                    <a href="<?php echo base_url('home') ?>">
                        <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
                        <span class="menu-text">Cantones</span>
                    </a>
                </li>


                <li class="has-submenu">
                    <a href="javascript:void(0)" class="submenu-toggle">
                        <i class="menu-icon zmdi zmdi-puzzle-piece zmdi-hc-lg"></i>
                        <span class="menu-text">Eventos</span>
                        <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                    </a>
                    <ul class="submenu">
                        <li><a href="<?php echo  base_url('canton/1/eventos')?>"><span class="menu-text">Ambato</span></a></li>
                        <li><a href="<?php echo  base_url('canton/2/eventos')?>"><span class="menu-text">Baños</span></a></li>
                        <li><a href="<?php echo  base_url('canton/3/eventos')?>"><span class="menu-text">Cevallos</span></a></li>
                        <li><a href="<?php echo  base_url('canton/4/eventos')?>"><span class="menu-text">Mocha</span></a></li>
                        <li><a href="<?php echo  base_url('canton/5/eventos')?>"><span class="menu-text">Patate</span></a></li>
                        <li><a href="<?php echo  base_url('canton/6/eventos')?>"><span class="menu-text">Pelileo</span></a></li>
                        <li><a href="<?php echo  base_url('canton/7/eventos')?>"><span class="menu-text">Pillaro</span></a></li>
                        <li><a href="<?php echo  base_url('canton/8/eventos')?>"><span class="menu-text">Quero</span></a></li>
                        <li><a href="<?php echo  base_url('canton/9/eventos')?>"><span class="menu-text">Tisaleo</span></a></li>
                    </ul>
                </li>


                <li class="has-submenu">
                    <a href="javascript:void(0)" class="submenu-toggle">
                        <i class="menu-icon zmdi zmdi-map zmdi-hc-lg"></i>
                        <span class="menu-text">Establecimientos</span>
                        <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                    </a>
                    <ul class="submenu">
                        <li><a href="<?php echo  base_url('canton/1/establecimientos')?>"><span class="menu-text">Ambato</span></a></li>
                        <li><a href="<?php echo  base_url('canton/2/establecimientos')?>"><span class="menu-text">Baños</span></a></li>
                        <li><a href="<?php echo  base_url('canton/3/establecimientos')?>"><span class="menu-text">Cevallos</span></a></li>
                        <li><a href="<?php echo  base_url('canton/4/establecimientos')?>"><span class="menu-text">Mocha</span></a></li>
                        <li><a href="<?php echo  base_url('canton/5/establecimientos')?>"><span class="menu-text">Patate</span></a></li>
                        <li><a href="<?php echo  base_url('canton/6/establecimientos')?>"><span class="menu-text">Pelileo</span></a></li>
                        <li><a href="<?php echo  base_url('canton/7/establecimientos')?>"><span class="menu-text">Pillaro</span></a></li>
                        <li><a href="<?php echo  base_url('canton/8/establecimientos')?>"><span class="menu-text">Quero</span></a></li>
                        <li><a href="<?php echo  base_url('canton/9/establecimientos')?>"><span class="menu-text">Tisaleo</span></a></li>
                    </ul>
                </li>


                <li class="">
                    <a href="<?php echo  base_url('radares')?>">
                        <i class="menu-icon zmdi zmdi-car zmdi-hc-lg"></i>
                        <span class="menu-text">Radares</span>
                    </a>
                </li>



            </ul><!-- .app-menu -->
        </div><!-- .menubar-scroll-inner -->
    </div><!-- .menubar-scroll -->
</aside>
<!--========== END app aside -->

<!-- navbar search -->
<div id="navbar-search" class="navbar-search collapse">
    <div class="navbar-search-inner">
        <form action="#">
            <span class="search-icon"><i class="fa fa-search"></i></span>
            <input class="search-field" type="search" placeholder="search..."/>
        </form>
        <button type="button" class="search-close" data-toggle="collapse" data-target="#navbar-search"
                aria-expanded="false">
            <i class="fa fa-close"></i>
        </button>
    </div>
    <div class="navbar-search-backdrop" data-toggle="collapse" data-target="#navbar-search" aria-expanded="false"></div>
</div><!-- .navbar-search -->

<!-- APP MAIN ==========-->
<main id="app-main" class="app-main">
    <div class="wrap">
        <section class="app-content">

            <?php startblock('contenido') ?>
            <?php endblock() ?>


        </section><!-- #dash-content -->
    </div><!-- .wrap -->
    <!-- APP FOOTER -->
    <div class="wrap p-t-0">
        <footer class="app-footer">
            <div class="clearfix">
                <ul class="footer-menu pull-right">
                    <li><a target="_blank" href="http://www.uce.edu.ec/">Universidad Central del Ecuador</a></li>
                    <li><a target="_blank" href="javascript:void(0)">Ingenieria en Computacion Grafica</a></li>
                    <li><a target="_blank" href="javascript:void(0)">Ingenieria Informatica</a></li>
                </ul>
                <div class="copyright pull-left">Copyright 2017 &copy; <a target="_blank" href="http://darwindeveloper.com">DarwinDeveloper</a></div>
            </div>
        </footer>
    </div>
    <!-- /#app-footer -->
</main>
<!--========== END app main -->

<!-- APP CUSTOMIZER -->
<div id="app-customizer" class="app-customizer">
    <a href="javascript:void(0)"
       class="app-customizer-toggle theme-color"
       data-toggle="class"
       data-class="open"
       data-active="false"
       data-target="#app-customizer">
        <i class="fa fa-gear"></i>
    </a>
    <div class="customizer-tabs">
        <!-- tabs list -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#menubar-customizer" aria-controls="menubar-customizer"
                                                      role="tab" data-toggle="tab">Menubar</a></li>
            <li role="presentation"><a href="#navbar-customizer" aria-controls="navbar-customizer" role="tab"
                                       data-toggle="tab">Navbar</a></li>
        </ul><!-- .nav-tabs -->

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane in active fade" id="menubar-customizer">
                <div class="hidden-menubar-top hidden-float">
                    <div class="m-b-0">
                        <label for="menubar-fold-switch">Mini Menubar</label>
                        <div class="pull-right">
                            <input id="menubar-fold-switch" type="checkbox" data-switchery data-size="small"/>
                        </div>
                    </div>
                    <hr class="m-h-md">
                </div>
                <div class="radio radio-default m-b-md">
                    <input type="radio" id="menubar-light-theme" name="menubar-theme" data-toggle="menubar-theme"
                           data-theme="light">
                    <label for="menubar-light-theme">Claro</label>
                </div>

                <div class="radio radio-inverse m-b-md">
                    <input type="radio" id="menubar-dark-theme" name="menubar-theme" data-toggle="menubar-theme"
                           data-theme="dark">
                    <label for="menubar-dark-theme">Oscuro</label>
                </div>
            </div><!-- .tab-pane -->
            <div role="tabpanel" class="tab-pane fade" id="navbar-customizer">
                <!-- This Section is populated Automatically By javascript -->
            </div><!-- .tab-pane -->
        </div>
    </div><!-- .customizer-taps -->

</div><!-- #app-customizer -->


<!-- build:js ../assets/js/core.min.js -->
<script src="/libs/bower/jquery/dist/jquery.js"></script>
<script src="/libs/bower/jquery-ui/jquery-ui.min.js"></script>
<script src="/libs/bower/jQuery-Storage-API/jquery.storageapi.min.js"></script>
<script src="/libs/bower/bootstrap-sass/assets/javascripts/bootstrap.js"></script>
<script src="/libs/bower/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="/libs/bower/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
<script src="/libs/bower/PACE/pace.min.js"></script>
<!-- endbuild -->

<!-- build:js ../assets/js/app.min.js -->
<script src="/assets/js/library.js"></script>
<script src="/assets/js/plugins.js"></script>
<script src="/assets/js/toastr.js"></script>
<script src="/assets/jquery-confirm/js/jquery-confirm.js"></script>
<script src="/assets/js/app.js"></script>
<!-- endbuild -->
<script src="/libs/bower/moment/moment.js"></script>
<script src="/libs/bower/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="/assets/js/fullcalendar.js"></script>


<script src="/assets/ckeditor/ckeditor.js"></script>
<script src="/assets/datatables/js/dataTables.bootstrap.js"></script>
<script src="/assets/datatables/extensions/Buttons/js/buttons.bootstrap.js"></script>
<script src="/assets/datatables/extensions/Buttons/js/buttons.html5.js"></script>
<script src="/assets/datatables/extensions/Buttons/js/buttons.print.js"></script>

<?php startblock('scripts') ?>
<?php endblock() ?>

</body>
</html>