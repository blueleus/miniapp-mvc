<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Crear usuarios</h4>
      </div>
      <div class="modal-body">


        <form action="<?php echo Helper::getUrl("contratos", "crear", array()); ?>" method="post" enctype="multipart/form-data">

          <div class="form-group row">
            <label for="numero_contrato" class="col-sm-2 col-form-label">Numero de contrato:</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="numero_contrato" value="">
                <span id="mj_numero_contrato"></span>
            </div>
          </div>

          <div class="form-group row">
            <label for="objeto_contrato" class="col-sm-2 col-form-label">Objeto del contrato:</label>
            <div class="col-sm-10">
              <input class="form-control" type="text" name="objeto_contrato" value="">
              <span id="mj_objeto_contrato"></span>
            </div>
          </div>

          <div class="form-group row">
            <label for="presupuesto" class="col-sm-2 col-form-label">Presupuesto:</label>
            <div class="col-sm-10">
              <input class="form-control" type="text" name="presupuesto" value="">
              <span id="mj_presupuesto"></span>
            </div>
          </div>

          <div class="form-group row">
            <label for="fecha_estimada_finalizacion" class="col-sm-2 col-form-label">Fecha estimada de finalizacion:</label>
            <div class="col-sm-10">
              <input class="form-control" type="date" name="fecha_estimada_finalizacion" value="">
              <span id="mj_fecha_estimada_fin"></span>
            </div>
          </div>

          <div class="form-group row">
              <label for="tipo_contrato" class="col-sm-2 col-form-label">Tipo de contrato:</label>
              <div class="col-sm-10">
                  <?php
                  echo "<select class='form-control' name='tipo_contrato[]' multiple>";
                  foreach ($tipoContratos as $value) {
                      echo "<option value='".$value->getId()."'>".$value->getNombre()."</option>";
                  }
                  echo "</select>";
                  ?>
                  <span id="mj_tipo_contratos"></span>
              </div>
          </div>

          <div class="form-group row">
              <label for="secretaria" class="col-sm-2 col-form-label">Secretaria:</label>
              <div class="col-sm-10">
                  <?php
                  echo "<select class='form-control' name='secretaria'>";
                  foreach ($secretarias as $value) {
                      echo "<option value='".$value->getId()."'>".$value->getNombre()."</option>";
                  }
                  echo "</select>";
                  ?>
                  <span id="mj_secretaria"></span>
              </div>
          </div>

        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save">Save</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $( document ).ready(function() {
        $('#save').on('click', function () {
            realizaCreacion();
        });
    });

    function mostrarMensajes(mensajes) {
        $.each(mensajes,function(key,input){
            $("#mj_" + key).text(input);
        });
    }

    function realizaCreacion() {
            var data = new FormData();

            var other_data = $('form').serializeArray();
            $.each(other_data,function(key,input){
                data.append(input.name,input.value);
            });

            $.ajax({
                data:  data,
                url:   'http://localhost/nexura/index.php?mod=contratos&fun=crear',
                type:  'post',
                dataType: 'json',
                contentType:false,
                processData:false,
                cache:false,
                beforeSend: function () {
                    console.log("Procesando, espere por favor...");
                },
                success:  function (response) {
                    console.log(response);
                    if (typeof(response.status) != "undefined"
                        && response.status === false) {
                        mostrarMensajes(response.mensaje);
                    }
                }
            });
    }
</script>