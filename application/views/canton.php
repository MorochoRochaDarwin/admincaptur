<?php include_once 'base.php' ?>

<?php startblock('css') ?>
    <link rel="stylesheet" href="/assets/css/cropper.css">

<?php endblock() ?>


<?php startblock('contenido') ?>

    <div class="container" style="background-color: white;">

        <h2 style="text-transform: uppercase; text-align: center; font-weight: bold;">
            Canton <?php echo $canton->nombre ?></h2>

        <form id="form-update" action="<?php echo base_url('ajax/update-canton') ?>" method="post">
            <input type="number" id="canton-id" value="<?php echo $canton->cantonid ?>" hidden>
            <div class="row">
                <div class="col-md-12">
                    <textarea class="form-control" name="description" id="canton-descripcion"
                              cols="30"><?php echo $canton->descripcion ?></textarea>
                </div>

                <div class="col-md-12 text-right"><br>
                    <button type="submit" class="btn btn-primary"><i class=" fa fa-check"></i> ACTUALIZAR</button>
                </div>
                <div class="clearfix"></div>
                <br>


            </div>
        </form>

        <h2 style="text-transform: uppercase; text-align: center; font-weight: bold;">
            Portadas <?php echo $canton->nombre ?></h2>
        <div class="col-md-12 text-right"><br>
            <button data-toggle="modal" href="#modallogo" type="button" class="btn btn-primary"><i
                        class=" fa fa-plus"></i> AGREGAR PORTADA
            </button>
        </div>
        <div class="clearfix"></div>
        <br>


        <div class="row">
            <?php foreach ($portadas as $p) { ?>
                <div class="col-lg-4 col-md-6" style="position:  relative;">
                    <button onclick="eliminar(<?php echo $p->id ?>)" class="btn btn-danger"
                            style="position: absolute; z-index: 2; right: 4px; top: 2px;">ELIMINAR
                    </button>

                    <img src="<?php echo base_url($p->url) ?>" alt="" style="width: 100%;">

                </div>
            <?php } ?>
        </div>

    </div>


    <div id="modal-upload" class="modal">
        <div class="modal-body text-center" style="background-color: #fff;">
            <h3>Publicando....</h3>
            <img src="/assets/img/loading2.gif" alt="" width="100">
        </div>
    </div>


    <div class="modal fade" id="modallogo" tabindex="-1" role="dialog" aria-labelledby="label1">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="padding: 0; padding-top: 5px;">
                <div class="modal-body" style="margin-top: 0px; padding-top: 20px;">
                    <div style="max-height: 400px;">
                        <img id="image"
                             src="/img/uceMod.png"
                             class="img-circle img-responsive">

                    </div>

                    <div class="clearfix"></div>
                    <small>Cuando terminte de recortar la imagen clic en guardar</small>
                </div>
                <div class="modal-footer docs-buttons" style="padding-top: 0; margin-top: 0;">
                    <img id="gif" hidden src="/assets/img/loading2.gif" alt="" width="100">
                    <br>
                    <div class="clearfix"></div>

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
        var editor;
        var img64;
        $(function () {


            var $image = $('#image');
            var cropBoxData;
            var canvasData;

            $('#modallogo').on('shown.bs.modal', function () {
                $image.cropper({
                    aspectRatio: 7 / 5,
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

                img64 = $image.cropper('getCroppedCanvas').toDataURL();
                //img64 = $image.cropper('getCroppedCanvas', {width: 452, height: 323}).toDataURL();

                var fd = new FormData();
                fd.append('cantonId', $('#canton-id').val());
                fd.append('img64', img64);

                $('#gif').show();
                $.ajax({
                    url: '<?php echo base_url('ajax/nueva-portada')?>',
                    type: 'post',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (result) {
                        if ($.trim(result) === 'exito') {
                            window.location.reload();
                        } else {
                            alert(result);
                        }
                    }, error: function (error) {
                        console.log(error);
                    }
                });


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
                height: 356
            };

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


            $('#form-update').submit(function () {
                $('#modal-upload').modal('show');

                var fd = new FormData();
                fd.append('id', $('#canton-id').val());
                fd.append('html', $('#canton-descripcion').val());
                $.ajax({
                    url: $('#form-update').attr('action'),
                    type: 'post',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#modal-upload').modal('hide');
                        running = false;
                        if (data !== -1) {
                            toastr["success"]("canton actualizado");
                        } else {
                            alert("No se pudo guardar la informacion");
                        }
                    }
                });

                return false;
            });


        });


        function toast(type, msg) {
            toastr[type](msg);
        }


        function eliminar(id) {
            $.confirm({
                title: 'Confirmación Requerida',
                content: 'Eliminar Portada?',
                buttons: {

                    buttonA: {
                        text: 'ELIMINAR',
                        action: function () {
                            $.ajax({
                                url: '<?php echo base_url('ajax/eliminar-portada') ?>',
                                type: 'post',
                                data: 'id=' + id,
                                success: function (result) {
                                    if ($.trim(result) === 'exito') {
                                        window.location.reload();
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