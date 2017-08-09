<?php include_once 'base.php' ?>

<?php startblock('titulo') ?>Evento <?php echo $evento->evento_titulo ?><?php endblock() ?>


<?php startblock('css') ?>
    <link rel="stylesheet" href="/libs/misc/datatables/datatables.min.css">
    <link rel="stylesheet" href="/assets/css/cropper.css">
    <style>

        #form-new [class*='col-'] {
            margin-bottom: 15px;
        }

    </style>
<?php endblock() ?>


<?php startblock('contenido') ?>

    <div class="container-fluid" style="background-color: white; padding: 10px;">


        <form id="form-new" action="<?php echo base_url('ajax/edit-evento') ?>" method="post">

            <div class="modal-body" style="background-color: #fff;">
                <div class="row">

                    <h2 style="text-align: center; margin-top: 0;">Evento <?php echo $evento->titulo_evento ?></h2>


                    <div class="row" style="padding: 0;">


                        <div class="col-md-6" style="padding: 0;">
                            <div class="col-md-12">
                                <input id="input-nombre" required type="text" class="form-control" name="nombre"
                                       placeholder="Nombre o titulo del evento o anuncio (OBLIGATORIO)" value="<?php echo $evento->titulo_evento ?>"/>
                            </div>


                            <div class="clearfix"></div>

                            <div class="col-md-6">
                                <label for="input-fecha"> Fecha(s) *: </label>
                                <input id="input-fecha" name="url-twitter" type="text" class="form-control"
                                       placeholder="18 SEPTIEMBRE - 12 AGOSTO" value="<?php echo $evento->fecha_evento ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="input-hora">Hora(s):</label>
                                <input id="input-hora" type="text" class="form-control"
                                       placeholder="13H00 - 20H00" value="<?php echo $evento->hora_evento ?>">
                            </div>

                            <div class="col-md-12">
                                <label for="input-hora">Dirección *:</label>
                                <input id="input-direccion" type="text" class="form-control"
                                       placeholder="dirección del evento" value="<?php echo $evento->direccion ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div style="max-height: 400px;">
                                <img id="image"

                                    <?php if ($evento->imagen) { ?>
                                        src="<?php echo  base_url($evento->imagen ) ?>"
                                    <?php } else { ?>
                                        src="/img/uceMod.png"
                                    <?php } ?>


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
                                               style=" height: 30px;"><?php echo $evento->descripcion_corta ?></textarea>
                            <br>
                            <textarea required name="description" id="editor" cols="30"><?php echo $evento->descripcion ?></textarea>


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




<?php endblock() ?>

<?php startblock('scripts') ?>

    <script src="/assets/js/cropper.js"></script>

    <script>
        var img64;
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



            //formularios
            $('#form-new').submit(function () {

                var fd = new FormData();//datos del formulario
                fd.append('id', <?php echo $evento->evento_id ?>);
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
                            toastr["success"]("evento actualizado");
                            $('#form-new').trigger('reset');

                        } else {
                            alert("No se pudo actualizar el dato");
                        }

                    }
                });


                return false;
            });


        });





        function toast(type, msg) {
            toastr[type](msg);
        }



    </script>
<?php endblock() ?>