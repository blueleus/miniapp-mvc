<?php include_once dirname(__FILE__)."/../../lib/php/Helper.php" ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lista de usuarios</title>
    <link rel="stylesheet" href="">
    <style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }

    .container_table{
        width:50%;
    }

    .container_options {
        border: 1;
        border-style: solid;
        border-width: 1px;
        border-radius: 4px;
        width:50%;
        height: 50px;
    }
    </style>
</head>
<body>
    <h1><?php echo isset($mensaje) ? $mensaje : ""; ?></h1>
    <div class="container_options">
        <a href="<?php echo Helper::getUrl("usuarios", "crear", array()); ?>">Crear usuario.</a>
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
                    echo "<a href='".Helper::getUrl("usuarios", "editar", array("id" => $value->getId()))."'>Editar.</a><br>";
                    echo "</td>";
                    echo "<td>";
                    echo "<a href='".Helper::getUrl("usuarios", "eliminar", array("id" => $value->getId()))."'>Eliminar.</a><br>";
                    echo "</td>";
                    echo "<td>";
                    echo "<a href='".Helper::getUrl("usuarios", "buscar", array("id" => $value->getId()))."'>Ver.</a><br>";
                    echo "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
    </div>

</html>