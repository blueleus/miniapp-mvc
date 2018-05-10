<!-- Modal -->
<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalEditLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalEditLabel">Modal title</h4>
      </div>
      <div class="modal-body">


        <form action="<?php echo Helper::getUrl("contratos", "crear", array()); ?>" method="post" enctype="multipart/form-data">
          <div class="form-group row">
            <label for="numero_contrato_edit" class="col-sm-2 col-form-label">Numero de contrato:</label>
            <div class="col-sm-10">
              <input class="form-control" type="text" name="numero_contrato_edit" value="<?php echo isset($datos['numero_contrato_edit'])? $datos['numero_contrato_edit'] : ""; ?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="objeto_contrato_edit" class="col-sm-2 col-form-label">Objeto del contrato:</label>
            <div class="col-sm-10">
              <input class="form-control" type="text" name="objeto_contrato_edit" value="<?php echo isset($datos['objeto_contrato_edit'])? $datos['objeto_contrato_edit'] : ""; ?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="presupuesto_edit" class="col-sm-2 col-form-label">Presupuesto:</label>
            <div class="col-sm-10">
              <input class="form-control" type="text" name="presupuesto_edit" value="<?php echo isset($datos['presupuesto_edit'])? $datos['presupuesto_edit'] : ""; ?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="fecha_estimada_finalizacion_edit" class="col-sm-2 col-form-label">Fecha estimada de finalizacion:</label>
            <div class="col-sm-10">
              <input class="form-control" type="date" name="fecha_estimada_finalizacion_edit" value="<?php echo isset($datos['fecha_estimada_finalizacion_edit'])? $datos['fecha_estimada_finalizacion_edit'] : ""; ?>">
            </div>
          </div>

          <div class="form-group row">
              <label for="tipo_contrato_edit" class="col-sm-2 col-form-label">Tipo de contrato:</label>
              <div class="col-sm-10">
                  <?php
                  echo "<select class='form-control' name='tipo_contrato_edit[]' multiple>";
                  foreach ($tipoContratos as $value) {
                      echo "<option value='".$value->getId()."'>".$value->getNombre()."</option>";
                  }
                  echo "</select>";
                  ?>
              </div>
          </div>

          <div class="form-group row">
              <label for="secretaria_edit" class="col-sm-2 col-form-label">Secretaria:</label>
              <div class="col-sm-10">
                  <?php
                  echo "<select class='form-control' name='secretaria_edit'>";
                  foreach ($secretarias as $value) {
                      echo "<option value='".$value->getId()."'>".$value->getNombre()."</option>";
                  }
                  echo "</select>";
                  ?>
              </div>
          </div>

          <div class="form-group row">
              <label for="archivo1" class="col-sm-2 col-form-label">Archivo 1:</label>
              <div class="col-sm-10">
                  <input type="file" name="archivo1" value="<?php echo isset($datos['archivo1'])? $datos['archivo1'] : ""; ?>">
              </div>
          </div>          

          <div class="form-group row">
              <label for="archivo2" class="col-sm-2 col-form-label">Archivo 2:</label>
              <div class="col-sm-10">
                  <input type="file" name="archivo2" value="<?php echo isset($datos['archivo2'])? $datos['archivo2'] : ""; ?>">
              </div>
          </div>          

          <div class="form-group row">
              <label for="archivo3" class="col-sm-2 col-form-label">Archivo 3:</label>
              <div class="col-sm-10">
                  <input type="file" name="archivo3" value="<?php echo isset($datos['archivo3'])? $datos['archivo3'] : ""; ?>">
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