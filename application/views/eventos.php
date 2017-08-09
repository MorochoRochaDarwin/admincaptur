<?php include_once 'base.php' ?>

<?php startblock('titulo') ?>Eventos <?php echo $canton->nombre ?><?php endblock() ?>


<?php startblock('css') ?>
    <link rel="stylesheet" href="/libs/misc/datatables/datatables.min.css">
    <link rel="stylesheet" href="/assets/css/cropper.css">
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
    <h2 style="text-align: center; margin-top: 0;">Eventos <?php echo $canton->nombre ?></h2>
    <div class="container-fluid" style="background-color: white; padding: 10px;">
        <table id="data-table" class="display" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>direccion</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Editar/Eliminar</th>
            </tr>
            </thead>

            <tfoot>
            <tr>
                <th><input style="max-width: 60px;" type="text"></th>
                <th><input type="text"></th>
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
        <div class="modal-dialog modal-lg" role="document" style="margin-top: 10px;">
            <div class="modal-content">
                <form id="form-new" action="<?php echo base_url('ajax/nuevo-evento') ?>" method="post">

                    <div class="modal-body" style="background-color: #fff;">
                        <div class="row">

                            <h3 style="text-align: center; margin-top: 0;">NUEVO EVENTO</h3>


                            <div class="row" style="padding: 0;">


                                <div class="col-md-6" style="padding: 0;">
                                    <div class="col-md-12">
                                        <input id="input-nombre" required type="text" class="form-control" name="nombre"
                                               placeholder="Nombre o titulo del evento o anuncio (OBLIGATORIO)"/>
                                    </div>


                                    <div class="clearfix"></div>

                                    <div class="col-md-6">
                                        <label for="input-fecha"> Fecha(s) *: </label>
                                        <input id="input-fecha" name="url-twitter" type="text" class="form-control"
                                               placeholder="18 SEPTIEMBRE - 12 AGOSTO">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="input-hora">Hora(s):</label>
                                        <input id="input-hora" type="text" class="form-control"
                                               placeholder="13H00 - 20H00">
                                    </div>

                                    <div class="col-md-12">
                                        <label for="input-hora">Dirección *:</label>
                                        <input id="input-direccion" type="text" class="form-control"
                                               placeholder="dirección del evento">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div style="max-height: 400px;">
                                        <img id="image"
                                             src="/img/uceMod.png"
                                             class="img-circle img-responsive">

                                    </div>

                                    <div class="clearfix"></div>
                                    <small>Cuando terminte de recortar la imagen clic en guardar</small>

                                    <div class="docs-buttons">
                                        <label class="btn btn-primary btn-upload" for="inputImage"
                                               title="Upload image file">
                                            <input type="file" class="sr-only" id="inputImage">
                                            <span class="docs-tooltip" data-toggle="tooltip"
                                                  title="Import image with Blob URLs">
              <span class="icon-upload"></span>
            </span>
                                        </label>

                                        <div class="btn-group">


                                            <button type="button" class="btn btn-primary" data-method="zoom"
                                                    data-option="0.1"
                                                    title="Zoom In">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, 0.1)">
              <span class="icon-zoom-in"></span>
            </span>
                                            </button>
                                            <button type="button" class="btn btn-primary" data-method="zoom"
                                                    data-option="-0.1"
                                                    title="Zoom Out">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, -0.1)">
              <span class="icon-zoom-out"></span>
            </span>
                                            </button>
                                        </div>
                                        <button id="getDataURL" type="button" class="btn btn-primary"><i
                                                    class="fa fa-check"></i> Guardar
                                        </button>
                                    </div>
                                </div>




                                <div class="col-md-12">
                                     <textarea class="form-control" required id="input-cdescripcion" cols="30"
                                               placeholder="descripción corta (OBLIGATORIO para la aplicación movil)"
                                               style=" height: 30px;"></textarea>
                                    <br>
                                    <textarea required name="description" id="editor" cols="30">
                    </textarea>


                                </div>
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
    <script src="/assets/js/cropper.js"></script>

    <script>
        var img64;
        var table;
        var editor;

        $(function () {


            var $image = $('#image');
            var cropBoxData;
            var canvasData;


            $image.cropper({
                aspectRatio: 4 / 4,
                autoCropArea: 0.8,
                built: function () {
                    $image.cropper('setCanvasData', canvasData);
                    $image.cropper('setCropBoxData', cropBoxData);
                }
            });


            $('#modallogo').on('shown.bs.modal', function () {
            }).on('hidden.bs.modal', function () {
                cropBoxData = $image.cropper('getCropBoxData');
                canvasData = $image.cropper('getCanvasData');
                //$image.cropper('destroy');
            });

            var dataURLView = $("#dataURLView");
            $("#getDataURL").click(function () {

                // $canvas.toBlob($image.cropper('getCroppedCanvas'),"image/jpeg", 0.95);
                // alert($image.cropper('getCroppedCanvas').toDataURL());

                //img64 = $image.cropper('getCroppedCanvas').toDataURL();
                img64 = $image.cropper('getCroppedCanvas', {width: 300, height: 300}).toDataURL();
                toastr["info"]("imagen seleccionada");

            });


            // Import image
            var $inputImage = $('#inputImage');
            var URL = window.URL || window.webkitURL;
            var blobURL;

            if (URL) {
                $inputImage.change(function () {


                    var files = this.files;
                    var file;

                    if (!$image.data('cropper')) {
                        return;
                    }

                    if (files && files.length) {
                        file = files[0];

                        if (/^image\/\w+$/.test(file.type)) {
                            blobURL = URL.createObjectURL(file);
                            $image.one('built.cropper', function () {

                                // Revoke when load complete
                                URL.revokeObjectURL(blobURL);
                            }).cropper('reset').cropper('replace', blobURL);
                            $inputImage.val('');
                        } else {
                            window.alert('Please choose an image file.');
                        }
                    }


                });
            } else {
                $inputImage.prop('disabled', true).parent().addClass('disabled');
            }

            $('.docs-buttons').on('click', '[data-method]', function () {
                var $this = $(this);
                var data = $this.data();
                var $target;
                var result;

                if ($this.prop('disabled') || $this.hasClass('disabled')) {
                    return;
                }

                if ($image.data('cropper') && data.method) {
                    data = $.extend({}, data); // Clone a new one

                    if (typeof data.target !== 'undefined') {
                        $target = $(data.target);

                        if (typeof data.option === 'undefined') {
                            try {
                                data.option = JSON.parse($target.val());
                            } catch (e) {
                                console.log(e.message);
                            }
                        }
                    }

                    if (data.method === 'rotate') {
                        $image.cropper('clear');
                    }

                    result = $image.cropper(data.method, data.option, data.secondOption);

                    if (data.method === 'rotate') {
                        $image.cropper('crop');
                    }

                    switch (data.method) {
                        case 'scaleX':
                        case 'scaleY':
                            $(this).data('option', -data.option);
                            break;

                    }


                }
            });


            var config = {

                height: 300,

            };

            config.toolbar = [
                {name: 'document', items: ['Source']},
                {name: 'clipboard', items: ['Undo', 'Redo']},
                {name: 'editing', items: ['Scayt']},
                {name: 'links', items: ['Link', 'Unlink', 'Anchor']},
                {name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar']},
                {name: 'tools', items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']},
                {
                    name: 'basicstyles',
                    items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']
                },
                {
                    name: 'paragraph',
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
                },
                {name: 'styles', items: ['Styles', 'Format', 'Maximize']}
            ];


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


            editor = CKEDITOR.replace('editor', config);


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
                    "bProcessing": true,
                    "bServerSide": true,
                    "url": "<?php echo base_url('ajax/eventos')?>",
                    "data": {
                        "cantonId": <?php echo $canton->cantonid ?>
                    },
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

                var fd = new FormData();//datos del formulario
                fd.append('cantonId', <?php echo $canton->cantonid ?>);
                fd.append('nombre', $('#input-nombre').val());
                fd.append('img64', img64);
                fd.append('fecha', $('#input-fecha').val());
                fd.append('hora', $('#input-hora').val());
                fd.append('direccion', $('#input-direccion').val());
                fd.append('cdescripcion', $('#input-cdescripcion').val());
                var html = editor.getData();
                fd.append('descripcion', html);

                $('#gif-new').show();

                $.ajax({
                    url: $('#form-new').attr('action'),
                    type: 'post',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (result) {
                        $('#gif-new').hide();
                        $('#modal-new').modal('hide');

                        if (result != -1) {
                            toastr["success"]("evento creado");
                            $('#form-new').trigger('reset');
                            editor.setData('');
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
                                url: '<?php echo base_url('ajax/eliminar-evento') ?>',
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