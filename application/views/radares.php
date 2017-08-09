<?php include_once 'base.php' ?>

<?php startblock('titulo') ?>Radares Tungurahua<?php endblock() ?>


<?php startblock('css') ?>
    <link rel="stylesheet" href="/libs/misc/datatables/datatables.min.css">
    <style>
        #data-table, #data-table thead tr th, #data-table tfoot tr th {
            text-align: center;
        }

        #data-table tfoot {
            display: table-header-group;
        }

        #form-new [class*='col-'] {
            margin-bottom: 15px;
        }

    </style>
<?php endblock() ?>


<?php startblock('contenido') ?>
    <h2 style="text-align: center; margin-top: 0;">Radares Tungurahua</h2>
    <div class="container-fluid" style="background-color: white; padding: 10px;">
        <table id="data-table" class="display" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Latitud</th>
                <th>Longitud</th>
                <th>Addr</th>
                <th>Eliminar</th>
            </tr>
            </thead>

            <tfoot>
            <tr>
                <th><input style="max-width: 60px;" type="text"></th>
                <th><input type="text"></th>
                <th><input type="text"></th>
                <th><input type="text"></th>
                <th></th>


            </tr>
            </tfoot>
        </table>

        <hr>

        <button type="button" data-toggle="modal" href="#modal-new" class="btn btn-primary">NUEVO EVENTO
        </button>


    </div>


    <div id="modal-new" class="modal fade">
        <div class="modal-dialog" role="document" style="margin-top: 10px;">
            <div class="modal-content">
                <form id="form-new" action="<?php echo base_url('ajax/nuevo-radar') ?>" method="post">

                    <div class="modal-body" style="background-color: #fff;">
                        <div class="row">

                            <h3 style="text-align: center; margin-top: 0;">NUEVO RADAR</h3>
                            <div class="col-xs-12">
                                <label for="">Dirección o detalle</label>
                                <input type="text" class="form-control" placeholder="Direccion o detalle" required name="addr">
                            </div>
                            <div class="col-sm-6">
                                <label for="">Latitud</label>
                                <input type="text" class="form-control" placeholder="Latitud" required name="lat">

                            </div>
                            <div class="col-sm-6">
                                <label for="">longitud</label>
                                <input type="text" class="form-control" placeholder="Longitud" required name="lng">
                            </div>


                            <img id="gif-new" hidden src="/assets/img/loading2.gif" alt="" width="100">
                        </div>
                    </div>

                    <div class="modal-footer text-right">
                        <br>
                        <button class="btn btn-primary" type="submit"><i
                                class="fa fa-check"></i> GUARDAR
                        </button>

                        <button type="reset" class="btn btn-warning"><i class="fa fa-refresh"></i>
                            RESET
                        </button>


                        <button class="btn btn-danger" type="button" data-dismiss="modal"><i
                                class="fa fa-close"></i> CANCELAR
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>


<?php endblock() ?>

<?php startblock('scripts') ?>
    <script src="/libs/misc/datatables/datatables.min.js"></script>

    <script>

        var table;

        $(function () {

            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-bottom-left",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "100",
                "hideDuration": "100",
                "timeOut": "1000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };




            table = $('#data-table').DataTable({
                dom: 'Bfrtip',

                buttons: [
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }
                ],
                "bLengthChange": false,
                "ajax": {
                    "aLengthMenu": [25],
                    "sPaginationType": "full_numbers",
                    "url": "<?php echo base_url('ajax/radares')?>",
                    "type": "POST"
                },
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
            });
            // Apply the search
            table.columns().every(function () {
                var that = this;

                $('input,select', this.footer()).on('keyup change', function () {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            });


            //formularios
            $('#form-new').submit(function () {



                $('#gif-new').show();

                $.ajax({
                    url: $('#form-new').attr('action'),
                    type: 'post',
                    data: $('#form-new').serialize(),
                    success: function (result) {
                        $('#gif-new').hide();
                        $('#modal-new').modal('hide');

                        if (result != -1) {
                            toastr["success"]("evento creado");
                            $('#form-new').trigger('reset');

                            update();
                        } else {
                            alert("No se pudo crear el dato");
                        }

                    }
                });


                return false;
            });


        });


        function update() {
            table.ajax.reload();
        }


        function toast(type, msg) {
            toastr[type](msg);
        }


        function eliminar(id) {
            $.confirm({
                title: 'Confirmación Requerida',
                content: 'Eliminar evento?',
                buttons: {

                    buttonA: {
                        text: 'ELIMINAR',
                        action: function () {
                            $.ajax({
                                url: '<?php echo base_url('ajax/eliminar-radar') ?>',
                                type: 'post',
                                data: 'id=' + id,
                                success: function (result) {
                                    if ($.trim(result) === 'exito') {
                                        toastr["success"]("evento eliminado");
                                        update();
                                    } else {
                                        alert(result);
                                    }
                                }
                            })
                        }
                    },
                    buttonB: {
                        text: 'CANCELAR',
                        action: function () {

                        }
                    }

                }
            });
        }

    </script>
<?php endblock() ?>