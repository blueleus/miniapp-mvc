<?php include_once dirname(__FILE__)."/../../lib/php/Helper.php" ?>
<?php include_once Helper::getPathView("login", "checkView"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Crear Usuarios</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>


</head>
<body>
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
</body>
</html>