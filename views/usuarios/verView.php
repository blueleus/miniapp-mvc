<?php include_once Helper::getPathView("login", "checkView"); ?>

<div class="container">
    <div class="row">
        <div class="col-12 col-md-12">
            <h1><?php echo isset($mensaje) ? $mensaje : ""; ?></h1>
            <table>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>C&eacute;dula</th>
                    <th>Estado</th>
                    <th>Fecha de Creacion</th>
                    <th>Imagen</th>
                </tr>
                <?php
                if (isset($dato)) {
                    echo "<tr>";
                    echo "<td>".$dato->getNombre()."</td>";
                    echo "<td>".$dato->getEmail()."</td>";
                    echo "<td>".$dato->getCedula()."</td>";
                    echo "<td>".$dato->getEstado()."</td>";
                    echo "<td>".$dato->getFechaCreacion()."</td>";
                    if (file_exists(dirname(__FILE__)."/../../web/upload/".$dato->getEmail().".jpg")) {
                        echo "<td><img src='web/upload/".$dato->getEmail().".jpg' border='1' width='100' height='100'></td>";
                    }
                    else {
                        echo "<td></td>";
                    }
                    echo "</tr>";
                }
                ?>
            </table>
            <br>
            <div>
                <a href="<?php echo Helper::getUrl("usuarios", "listar", array()); ?>">Volver a la lista.</a>
            </div>

        </div>
    </div>
</div>