<?php

require_once dirname(__FILE__)."/../helpers/HelperDB.php";

/**
* Controlador Usuarios
*/
class UsuariosController
{
    public function crear()
    {
        $metodo = $_SERVER['REQUEST_METHOD'];

        switch ($metodo) {
            case 'GET':
                // Mostrar formulario
                break;
            case 'POST':
                // Crear usuario
                break;

            default:
                # code...
                break;
        }
    }

    public function editar()
    {
        $metodo = $_SERVER['REQUEST_METHOD'];

        switch ($metodo) {
            case 'GET':
                // Mostrar formulario
                break;
            case 'POST':
                // Crear usuario
                break;

            default:
                # code...
                break;
        }
    }

    public function buscar()
    {
        $metodo = $_SERVER['REQUEST_METHOD'];
        $id = $_GET["id"];
    }

    public function eliminar()
    {
        $metodo = $_SERVER['REQUEST_METHOD'];
        $id = $_GET["id"];
    }

    public function listar()
    {
        //Mostrar vista con todos los resultados
    }

    public function test()
    {
        $db = new HelperDB();
        $stmt = $db->executeQuery("SELECT * FROM roles");
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //$result = $db->executeQuery("INSERT INTO roles (nombre) VALUE (?)", array('ADMIN'));
        //echo $stmt->rowCount() . " records UPDATED successfully";
        var_dump($resultado);

        echo "Hola mundo";
    }
}