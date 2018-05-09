<div class="container">
    <div class="row">
        <div class="col-12 col-md-12">
            <h4><?php echo isset($mensaje) ? $mensaje : ""; ?></h4>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th class='hidden-xs'>C&eacute;dula</th>
                        <th class='hidden-xs hidden-sm'>Estado</th>
                        <th>Fecha de Creacion</th>
                        <th class='hidden-xs hidden-sm'>Imagen</th>
                    </tr>
                    <?php
                    if (isset($dato)) {
                        echo "<tr>";
                        echo "<td>".$dato->getNombre()."</td>";
                        echo "<td>".$dato->getEmail()."</td>";
                        echo "<td class='hidden-xs'>".$dato->getCedula()."</td>";
                        echo "<td class='hidden-xs hidden-sm'>".$dato->getEstado()."</td>";
                        echo "<td>".$dato->getFechaCreacion()."</td>";
                        if (file_exists(dirname(__FILE__)."/../../web/upload/".$dato->getEmail().".jpg")) {
                            echo "<td class='hidden-xs hidden-sm'><img src='web/upload/".$dato->getEmail().".jpg' border='1' width='100' height='100'></td>";
                        }
                        else {
                            echo "<td></td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <br>
            <div>
                <a href="<?php echo Helper::getUrl("usuarios", "listar", array()); ?>">Volver a la lista.</a>
            </div>

        </div>
    </div>
</div>