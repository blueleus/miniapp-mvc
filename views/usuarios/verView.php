<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ver usuario</title>
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
    </style>
</head>
<body>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Cedula</th>
            <th>Estado</th>
            <th>Password</th>
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
            echo "<td>".$dato->getPassword()."</td>";
            echo "<td>".$dato->getFechaCreacion()."</td>";
            echo "<td></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <br><br>
    <div>
        <a href="<?php echo Helper::getUrl("usuarios", "listar", array()); ?>">Volver a la lista.</a>
    </div>
</body>
</html>