<div class="container">
    <div class="row">
        <div class="col-12 col-md-12">
            <h4><?php echo isset($mensaje) ? $mensaje : ""; ?></h4>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Numero de contrato</th>
                        <th class='hidden-xs'>Objeto del contrato</th>
                        <th>Presupuesto</th>
                        <th class='hidden-xs hidden-sm'>Fecha estimada fin</th>
                        <th class='hidden-xs hidden-sm'>Fecha publicacion</th>
                    </tr>
                    <?php
                    if (isset($dato)) {
                        echo "<tr>";
                        echo "<td>" . $dato->getNumeroContrato() . "</td>";
                        echo "<td>" . $dato->getObjetoContrato() . "</td>";
                        echo "<td class='hidden-xs'>" . $dato->getPresupuesto() . "</td>";
                        echo "<td class='hidden-xs hidden-sm'>" . $dato->getFechaEstimadaFinalizacion() . "</td>";
                        echo "<td>" . $dato->getFechaPublicacion() . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <br>
            <div>
                <a href="<?php echo Helper::getUrl("contratos", "listar", array()); ?>">Volver a la lista.</a>
            </div>

        </div>
    </div>
</div>