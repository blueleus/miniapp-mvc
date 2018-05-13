<div class="container">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <h4><?php echo isset($mensaje) ? $mensaje : ""; ?></h4>
            <form action="<?php echo Helper::getUrl("usuarios", "crear", array()); ?>" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="nombre" class="col-sm-2 col-form-label">Nombre:</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="nombre" value="<?php echo isset($datos['nombre']) ? $datos['nombre'] : ""; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="email" value="<?php echo isset($datos['email']) ? $datos['email'] : ""; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="cedula" class="col-sm-2 col-form-label">C&eacute;dula:</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="cedula" value="<?php echo isset($datos['cedula']) ? $datos['cedula'] : ""; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="estado" class="col-sm-2 col-form-label">Estado:</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="estado" value="<?php echo isset($datos['estado']) ? $datos['estado'] : ""; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password:</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="password" name="password" value="<?php echo isset($datos['password']) ? $datos['password'] : ""; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="roles" class="col-sm-2 col-form-label">Roles:</label>
                    <div class="col-sm-10">
                        <?php
                        echo "<select class='form-control' name='roles[]' multiple>";
                        foreach ($roles as $value) {
                            echo "<option value='" . $value->getId() . "'>" . $value->getNombre() . "</option>";
                        }
                        echo "</select>";
                        ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="imagen" class="col-sm-2 col-form-label">Imagen de perfil:</label>
                    <div class="col-sm-10">
                        <input type="file" name="imagen" value="<?php echo isset($datos['imagen']) ? $datos['imagen'] : ""; ?>">
                    </div>
                </div>

                <input class="btn btn-primary btn-lg btn-block" type="submit" value="Crear">
            </form>
            <br>
            <div>
                <?php
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    echo "<a href='" . Helper::getUrl("usuarios", "listar", array()) . "'>Volver a la lista.</a>";
                } else {
                    echo "<a href='" . Helper::getUrl("login", "login", array()) . "'>Volver al login.</a>";
                }
                ?>
            </div>
        </div>
    </div>
</div>