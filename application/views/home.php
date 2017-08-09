<?php include_once 'base.php' ?>

<?php startblock('titulo') ?>Cantones<?php endblock() ?>

<?php startblock('css') ?>
<style>
    #main-cantones [class*='col-'] {
        margin-bottom: 15px;
    }

    #main-cantones [class*='col-']:hover .bg-primary {
        background-color: #00838F;
    }

</style>
<?php endblock() ?>


<?php startblock('contenido') ?>


<div id="main-cantones" class="row">
    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
        <a href="<?php echo base_url('canton/1') ?>" class="">
            <div class="clearfix">
                <img src="/img/c_ambato.png" alt="" style="width: 100%;">
            </div>
            <footer class="widget-footer bg-primary" style="position: relative; z-index: 1; text-align: center;">
                <b style="font-size: 21px;">AMBATO</b>
            </footer>
        </a><!-- .widget -->
    </div>

    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
        <a href="<?php echo base_url('canton/2') ?>" class="">
            <div class="clearfix">
                <img src="/img/c_banios.png" alt="" style="width: 100%;">
            </div>
            <footer class="widget-footer bg-primary" style="position: relative; z-index: 1; text-align: center;">
                <b style="font-size: 21px;">BAÑOS</b>
            </footer>
        </a><!-- .widget -->
    </div>

    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
        <a href="<?php echo base_url('canton/3') ?>" class="">
            <div class="clearfix">
                <img src="/img/c_cevallos.png" alt="" style="width: 100%;">
            </div>
            <footer class="widget-footer bg-primary" style="position: relative; z-index: 1; text-align: center;">
                <b style="font-size: 21px;">CEVALLOS</b>
            </footer>
        </a><!-- .widget -->
    </div>

    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
        <a href="<?php echo base_url('canton/4') ?>" class="">
            <div class="clearfix">
                <img src="/img/c_mocha.png" alt="" style="width: 100%;">
            </div>
            <footer class="widget-footer bg-primary" style="position: relative; z-index: 1; text-align: center;">
                <b style="font-size: 21px;">MOCHA</b>
            </footer>
        </a><!-- .widget -->
    </div>


    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
        <a href="<?php echo base_url('canton/5') ?>" class="">
            <div class="clearfix">
                <img src="/img/c_papate.png" alt="" style="width: 100%;">
            </div>
            <footer class="widget-footer bg-primary" style="position: relative; z-index: 1; text-align: center;">
                <b style="font-size: 21px;">PATATE</b>
            </footer>
        </a><!-- .widget -->
    </div>


    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
        <a href="<?php echo base_url('canton/6') ?>" class="">
            <div class="clearfix">
                <img src="/img/c_pelileo.png" alt="" style="width: 100%;">
            </div>
            <footer class="widget-footer bg-primary" style="position: relative; z-index: 1; text-align: center;">
                <b style="font-size: 21px;">PELILEO</b>
            </footer>
        </a><!-- .widget -->
    </div>


    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
        <a href="<?php echo base_url('canton/7') ?>" class="">
            <div class="clearfix">
                <img src="/img/c_pillaro.png" alt="" style="width: 100%;">
            </div>
            <footer class="widget-footer bg-primary" style="position: relative; z-index: 1; text-align: center;">
                <b style="font-size: 21px;">PILLARO</b>
            </footer>
        </a><!-- .widget -->
    </div>


    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
        <a href="<?php echo base_url('canton/8') ?>" class="">
            <div class="clearfix">
                <img src="/img/c_quero.png" alt="" style="width: 100%;">
            </div>
            <footer class="widget-footer bg-primary" style="position: relative; z-index: 1; text-align: center;">
                <b style="font-size: 21px;">QUERO</b>
            </footer>
        </a><!-- .widget -->
    </div>


    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
        <a href="<?php echo base_url('canton/9') ?>" class="">
            <div class="clearfix">
                <img src="/img/c_tisaleo.png" alt="" style="width: 100%;">
            </div>
            <footer class="widget-footer bg-primary" style="position: relative; z-index: 1; text-align: center;">
                <b style="font-size: 21px;">TISALEO</b>
            </footer>
        </a><!-- .widget -->
    </div>


</div>
<?php endblock() ?>
