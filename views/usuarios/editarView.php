<?php include_once Helper::getPathView("login", "checkView"); ?>

<div class="container">
    <div class="row">
        <div class="col-4 col-md-4">

            <h6><?php echo isset($mensaje) ? $mensaje : ""; ?></h6>

            <form action="<?php echo Helper::getUrl("usuarios", "editar", array("id" => $id)); ?>" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="nombre">Nombre:</label><br>
                    <input class="form-control" type="text" name="nombre" value="<?php echo isset($datos['nombre'])? $datos['nombre'] : ""; ?>">
                </div>

                <div class="form-group">
                    <label for="email">Email:</label><br>
                    <input class="form-control" type="text" name="email" value="<?php echo isset($datos['email'])? $datos['email'] : ""; ?>">
                </div>

                <div class="form-group">
                    <label for="cedula">C&eacute;dula:</label><br>
                    <input class="form-control" type="text" name="cedula" value="<?php echo isset($datos['cedula'])? $datos['cedula'] : ""; ?>">
                </div>

                <div class="form-group">
                    <label for="estado">Estado:</label><br>
                    <input class="form-control" type="text" name="estado" value="<?php echo isset($datos['estado'])? $datos['estado'] : ""; ?>">
                </div>

                <div class="form-group">
                    <label for="password">Password:</label><br>
                    <input class="form-control" type="password" name="password" value="<?php echo isset($datos['password'])? $datos['password'] : ""; ?>">
                </div>

                <div class="form-group">
                    <label for="roles">Roles:</label><br>
                    <?php
                    echo "<select class='form-control' name='roles[]' multiple>";
                    foreach ($roles as $value) {
                        $selected = "";
                        if (in_array($value->getId(), $idsRolesUsuario)) {
                            $selected = "selected";
                        }
                        echo "<option value='".$value->getId()."' ".$selected.">".$value->getNombre()."</option>";
                    }
                    echo "</select>";
                    ?>
                </div>

                <div class="form-group">
                    <label for="imagen">Imagen de perfil:</label><br>
                    <input type="file" name="imagen" value="">
                </div>

                <input class="btn btn-primary" type="submit" value="Guardar">
            </form>
            <br>
            <div>
                <a href="<?php echo Helper::getUrl("usuarios", "listar", array()); ?>">Volver a la lista.</a>
            </div>
        </div>
    </div>
</div>
