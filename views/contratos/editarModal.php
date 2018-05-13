<!-- Modal -->
<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalEditLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalEditLabel">Editar contrato</h4>
            </div>
            <div class="modal-body">

                <div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Info</a></li>
                        <li role="presentation"><a href="#filesUpload" aria-controls="filesUpload" role="tab" data-toggle="tab">Files Upload</a></li>
                    </ul>
                    <br>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">

                            <form id="formEdit" action="" method="post">

                                <input type="hidden" name="id" id="id-contrato" value="">

                                <div class="form-group row">
                                    <label for="numero_contrato" class="col-sm-2 col-form-label">Numero de contrato:</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="numero_contrato" id="edit_numero_contrato" value="">
                                        <span class="mj_numero_contrato"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="objeto_contrato" class="col-sm-2 col-form-label">Objeto del contrato:</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="objeto_contrato" id="edit_objeto_contrato" value="">
                                        <span class="mj_objeto_contrato"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="presupuesto" class="col-sm-2 col-form-label">Presupuesto:</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="presupuesto" id="edit_presupuesto" value="">
                                        <span class="mj_presupuesto"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fecha_estimada_finalizacion" class="col-sm-2 col-form-label">Fecha estimada de finalizacion:</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="date" name="fecha_estimada_finalizacion" id="edit_fecha_estimada_finalizacion" value="">
                                        <span class="mj_fecha_estimada_fin"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tipo_contrato" class="col-sm-2 col-form-label">Tipo de contrato:</label>
                                    <div class="col-sm-10">
                                        <?php
                                        echo "<select class='form-control' name='tipo_contrato[]' id='edit_tipo_contratos' multiple>";
                                        foreach ($tipoContratos as $value) {
                                            echo "<option value='" . $value->getId() . "'>" . $value->getNombre() . "</option>";
                                        }
                                        echo "</select>";
                                        ?>
                                        <span class="mj_tipo_contrato"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="secretaria" class="col-sm-2 col-form-label">Secretaria:</label>
                                    <div class="col-sm-10">
                                        <?php
                                        echo "<select class='form-control' name='secretaria' id='edit_secretaria_id'>";
                                        foreach ($secretarias as $value) {
                                            echo "<option value='" . $value->getId() . "'>" . $value->getNombre() . "</option>";
                                        }
                                        echo "</select>";
                                        ?>
                                        <span class="mj_secretaria"></span>
                                    </div>
                                </div>

                            </form>


                        </div>

                        <div role="tabpanel" class="tab-pane" id="filesUpload">

                            <form id="formUpload" method="POST" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <div class="col-sm-5">
                                        <input type="text" name="descripFile0" class="form-control" value="" placeholder="Descripcion"/>
                                        <span class="mj_descripFile0"></span>
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="file" name="file0" value="">
                                        <span class="mj_file0"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-5">
                                        <input type="text" name="descripFile1" class="form-control" value="" placeholder="Descripcion"/>
                                        <span class="mj_descripFile1"></span>
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="file" name="file1" value="">
                                        <span class="mj_file1"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-5">
                                        <input type="text" name="descripFile2" class="form-control" value="" placeholder="Descripcion"/>
                                        <span class="mj_descripFile2"></span>
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="file" name="file2" value="">
                                        <span class="mj_file2"></span>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table" id="files_table">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Descripcion</th>
                                            <th>Archivo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_edit">Save</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        $("#contratos_table").on("click", "tbody .bt-edit-row", function () {
            var value = $(this).val();
            var info = getInfoContrato(value);
            cargarArchivosContrato(value);

            if (typeof (info) != "undefined" && info != null) {
                console.log(info);
                $("#id-contrato").val(value);
                $.each(info, function (index, val) {
                    $("#edit_" + index).val(val);
                });

                $.each(info.tipo_contratos, function (index, val) {
                    $("#edit_tipo_contratos option[value='" + val.id + "']").prop("selected", true);
                });

                var fecha_finalizacion = info.fecha_estimada_finalizacion.split(" ");
                $("#edit_fecha_estimada_finalizacion").val(fecha_finalizacion[0]);

                $('#myModalEdit').modal('show');
            }
        });

        $('#save_edit').on('click', function () {
            realizaEdicion();
        });
    });

    function getInfoContrato(id) {

        var dataResult;

        try {
            $.ajax({
                data: {"id": id},
                url: 'http://localhost/nexura/index.php?mod=contratos&fun=consultarPorId',
                type: 'GET',
                dataType: 'json',
                async: false,
                beforeSend: function () {
                    console.log("Procesando, espere por favor...");
                },
                success: function (response) {
                    if (response.status) {
                        dataResult = response.data;
                    }
                }
            });

            return dataResult;
        } catch (ex) {
            alert("ERROR: Ocurrio un error " + ex);
        }
    }

    function limpiarMensajes() {
        $('.mj_numero_contrato').text("");
        $('.mj_objeto_contrato').text("");
        $('.mj_presupuesto').text("");
        $('.mj_secretaria').text("");
        $('.mj_fecha_estimada_fin').text("");
        $('.mj_tipo_contrato').text("");
    }

    function ocultarModalEdit() {
        $('#myModalEdit').modal('hide');
        $("#formEdit")[0].reset();
        location.reload();
    }

    function realizaEdicion() {
        var data = new FormData();

        // Data files
        $('input[type=file]').each(function (i, file) {
            if (file.files.length > 0) {
                data.append('file-' + i, file.files[0]);
                console.log('file-' + i);
                //console.log(file.files[0]);
            }
        });

        // Data description files
        var other_data = $('#formUpload').serializeArray();
        $.each(other_data, function (key, input) {
            data.append(input.name, input.value);
        });

        // Data info
        var other_data = $('#formEdit').serializeArray();
        $.each(other_data, function (key, input) {
            data.append(input.name, input.value);
        });

        $.ajax({
            data: data,
            url: 'http://localhost/nexura/index.php?mod=contratos&fun=editar',
            type: 'post',
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
                console.log("Procesando, espere por favor...");
            },
            success: function (response) {
                console.log(response);
                if (typeof (response.status) != "undefined"
                        && response.status === false) {
                    mostrarMensajes(response.mensaje);
                } else {
                    ocultarModalEdit();
                    limpiarMensajes();
                }
            }
        });
    }

    function cargarArchivosContrato(contrato_id) {

        $.ajax({
            data: {"id": contrato_id},
            url: 'http://localhost/nexura/index.php?mod=contratos&fun=findArchivosContrato',
            type: 'GET',
            dataType: 'json',
            beforeSend: function () {
                console.log("Procesando, espere por favor...");
            },
            success: function (response) {
                var data = response.data;
                if (data) {
                    $("#files_table tbody").html(data);
                } else {
                    $("#files_table tbody").html("");
                }
            },
            fail: function (err) {
                alert(err);
            }
        });
    }
</script>