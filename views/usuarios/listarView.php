<?php include_once dirname(__FILE__)."/../../lib/php/Helper.php" ?>
<?php include_once Helper::getPathView("login", "checkView"); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lista de usuarios</title>
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
</body>
</html>