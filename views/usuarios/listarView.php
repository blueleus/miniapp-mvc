<?php include_once Helper::getPathView("login", "checkView"); ?>

<div class="container">
    <div class="row">
        <div class="col-12 col-md-12">
            <h1><?php echo isset($mensaje) ? $mensaje : ""; ?></h1>
            <div class="container_options">
                <a class="btn btn-primary" href="<?php echo Helper::getUrl("usuarios", "crear", array()); ?>">Crear usuario.</a>
            </div>
            <br>
            <div class="container_table">
                <table>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>C&eacute;dula</th>
                        <th>Estado</th>
                        <th>Imagen</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php
                    if (isset($datos)) {
                        foreach ($datos as $value) {
                            echo "<tr>";
                            echo "<td>".$value->getNombre()."</td>";
                            echo "<td>".$value->getEmail()."</td>";
                            echo "<td>".$value->getCedula()."</td>";
                            echo "<td>".$value->getEstado()."</td>";
                            if (file_exists(dirname(__FILE__)."/../../web/upload/".$value->getEmail().".jpg")) {
                                echo "<td><img src='web/upload/".$value->getEmail().".jpg' border='1' width='100' height='100'></td>";
                            }
                            else {
                                echo "<td></td>";
                            }
                            echo "<td>";
                            echo "<a class='btn btn-secondary' href='".Helper::getUrl("usuarios", "editar", array("id" => $value->getId()))."'>Editar.</a><br>";
                            echo "</td>";
                            echo "<td>";
                            echo "<a class='btn btn-danger' href='".Helper::getUrl("usuarios", "eliminar", array("id" => $value->getId()))."'>Eliminar</a><br>";
                            echo "</td>";
                            echo "<td>";
                            echo "<a class='btn btn-info' href='".Helper::getUrl("usuarios", "buscar", array("id" => $value->getId()))."'>Ver</a><br>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>