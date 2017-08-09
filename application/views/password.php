<?php include_once 'base.php' ?>


<?php startblock('contenido') ?>

    <div class="container" style="background-color: white;">

        <h2 style="text-transform: uppercase; text-align: center; font-weight: bold;">
            Cambiar contraseña</h2>

        <form id="form-pass" action="" method="post">


            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <label for="">Contraseña actual</label>
                    <input type="password" class="form-control" required name="pass">
                    <br>
                    <label for="">Nueva Contraseña</label>
                    <input type="password" class="form-control" required name="npass">
                    <br>
                    <label for="">Verificación Nueva Contraseña</label>
                    <input type="password" class="form-control" required name="vnpass">
                    <br>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> GUARDAR CAMBIOS
                        </button>
                    </div>
                </div>

            </div>
        </form>
        <div class="clearfix"></div>
        <br>
    </div>


<?php endblock() ?>


<?php startblock('scripts') ?>
    <script>
        $(function () {
            $('#form-pass').submit(function () {

                $.ajax({
                    url:'<?php echo base_url('ajax/password-change') ?>',
                    type:'post',
                    data:$('#form-pass').serialize(),
                    success:function (result) {
                        if(result==1){
                            alert("Contraseña cambiada");
                        }else{
                            alert(result);
                        }
                    }
                });

                return false;
            });
        });
    </script>
<?php endblock() ?>