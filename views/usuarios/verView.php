<?php include_once Helper::getPathView("login", "checkView"); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ver usuario</title>
    <link rel="stylesheet" href="">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

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
</body>
</html>