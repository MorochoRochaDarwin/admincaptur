<?php include_once 'base.php' ?>

<?php startblock('titulo') ?>Establecimiento <?php echo $est->nombre_establecimiento ?><?php endblock() ?>


<?php startblock('css') ?>
    <link rel="stylesheet" href="/assets/css/cropper.css">
    <style>
        #form-new [class*='col-'] {
            margin-bottom: 15px;
        }

    </style>
<?php endblock() ?>


<?php startblock('contenido') ?>

    <div class="container-fluid" style="background-color: white; padding: 10px;">
        <div class="row">

            <h2 style="text-align: center; margin-top: 0;">
                Establecimiento <?php echo $est->nombre_establecimiento ?></h2>
            <form id="form-new" action="<?php echo base_url('ajax/edit-establecimiento') ?>" method="post">


                <div class="row" style="padding: 0;">

                    <div class="col-sm-6" style="">
                        <div class="col-xs-8">
                            <input id="input-nombre" required type="text" class="form-control" name="nombre"
                                   placeholder="Nombre establecimiento o sitio (OBLIGATORIO)"
                                   value="<?php echo $est->nombre_establecimiento ?>"/>
                        </div>
                        <div class="col-xs-4">
                            <select class="form-control" name="tipo" id="select-tipo">
                                <option value="turismo">Turismo</option>
                                <option value="alojamiento">Alojamiento</option>
                                <option value="gastronomia">Gastronomia</option>
                            </select>
                        </div>
                        <div class="col-xs-12">
                            <label for="input-google">Direccion establecimiento *</label>
                            <input id="input-direccion" type="text" class="form-control"
                                   placeholder="" value="<?php echo $est->direccion ?>">
                        </div>
                        <div class="col-xs-8" style="padding-right: 0; padding-left: 0;">
                            <div class="col-xs-6">
                                <label for="input-latitud">Latitud *</label>
                                <input id="input-latitud" type="text" class="form-control"
                                       value="<?php echo $est->latitud ?>">
                            </div>
                            <div class="col-xs-6">
                                <label for="input-longuitud">Longitud *</label>
                                <input id="input-longuitud" type="text" class="form-control"
                                       value="<?php echo $est->longitud ?>">
                            </div>
                        </div>


                        <div class="col-xs-4">
                            <label>Imagen *</label><br>
                            <button href="#modallogo" data-toggle="modal" type="button"
                                    class="btn btn-default">
                                <i class="fa fa-image"></i> PORTADA
                            </button>
                        </div>


                        <div class="col-xs-12">
                            <label for="input-web">Pagina Web</label>
                            <input id="input-web" type="url" class="form-control"
                                   placeholder="http://paginaweb.com" value="<?php echo $est->pagina_web ?>">
                        </div>


                        <div class="col-xs-12">
                            <label for="input-facebook"> url facebook</label>
                            <input id="input-facebook" name="url-facebook" type="url" class="form-control"
                                   placeholder="https://facebook.com/paginaweb" value="<?php echo $est->facebook ?>">
                        </div>

                        <div class="col-xs-12">
                            <label for="input-youtube"> url youtube</label>
                            <input id="input-youtube" name="url-youtube" type="url" class="form-control"
                                   placeholder="https://youtube.com/paginaweb" value="<?php echo $est->youtube ?>">
                        </div>


                        <div class="col-xs-12">
                            <label for="input-twitter"> url twitter</label>
                            <input id="input-twitter" name="url-twitter" type="url" class="form-control"
                                   placeholder="https://twitter.com/paginaweb" value="<?php echo $est->twitter ?>">
                        </div>

                        <div class="col-xs-12">
                            <label for="input-google"> url google</label>
                            <input id="input-google" name="url-google" type="url" class="form-control"
                                   placeholder="https://google.com/paginaweb">
                        </div>

                        <div class="col-xs-12">
                            <p>NOTA: los campos con * son obligatorios</p>
                        </div>


                    </div>

                    <div class="col-sm-6">

                        <div class="col-md-12">
                     <textarea required name="description" id="editor" cols="30"><?php echo $est->descripcion ?></textarea>
                            <br><img id="gif-new" hidden src="/assets/img/loading2.gif" alt="" width="100"><br>


                            <div class="text-right">
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

                        </div>
                    </div>


                </div>


            </form>

        </div>

    </div>


    <div class="modal fade" id="modallogo" tabindex="-1" role="dialog" aria-labelledby="label1">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="padding: 0; padding-top: 5px;">
                <div class="modal-body" style="margin-top: 0px; padding-top: 20px;">
                    <div style="max-height: 400px;">
                        <img id="image"

                            <?php if ($est->imagen_portada) { ?>
                                src="<?php echo  base_url($est->imagen_portada ) ?>"
                            <?php } else { ?>
                                src="/img/uceMod.png"
                            <?php } ?>
                             class="img-circle img-responsive">

                    </div>

                    <div class="clearfix"></div>
                    <small>Cuando terminte de recortar la imagen clic en guardar</small>
                </div>
                <div class="modal-footer docs-buttons" style="padding-top: 0; margin-top: 0;">


                    <label class="btn btn-primary btn-upload" for="inputImage"
                           title="Upload image file">
                        <input type="file" class="sr-only" id="inputImage">
                        <span class="docs-tooltip" data-toggle="tooltip" title="Import image with Blob URLs">
              <span class="icon-upload"></span>
            </span>
                    </label>

                    <div class="btn-group">


                        <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1"
                                title="Zoom In">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, 0.1)">
              <span class="icon-zoom-in"></span>
            </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1"
                                title="Zoom Out">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, -0.1)">
              <span class="icon-zoom-out"></span>
            </span>
                        </button>
                    </div>
                    <button id="getDataURL" type="button" class="btn btn-primary"><i class="fa fa-check"></i> Guardar
                    </button>

                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i>
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
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

            $('#modallogo').on('shown.bs.modal', function () {
                $image.cropper({
                    aspectRatio: 4 / 4,
                    autoCropArea: 0.8,
                    built: function () {
                        $image.cropper('setCanvasData', canvasData);
                        $image.cropper('setCropBoxData', cropBoxData);
                    }
                });
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

                $('#modallogo').modal('hide');

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
                {name: 'styles', items: ['Styles', 'Format']}
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
                fd.append('id', <?php echo $est->establecimiento_id ?>);
                fd.append('nombre', $('#input-nombre').val());
                fd.append('portada', img64);
                fd.append('tipo', $('#select-tipo').val());
                fd.append('facebook', $('#input-facebook').val());
                fd.append('youtube', $('#input-youtube').val());
                fd.append('google', $('#input-google').val());
                fd.append('twitter', $('#input-twitter').val());
                fd.append('lat', $('#input-latitud').val());
                fd.append('lng', $('#input-longuitud').val());
                fd.append('web', $('#input-web').val());
                fd.append('addr', $('#input-direccion').val());

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

                        if (result !== -1) {
                            toastr["success"]("establecimiento actualizado");

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