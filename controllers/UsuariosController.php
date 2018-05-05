<?php


require_once dirname(__FILE__)."/../models/UsuariosModel.php";

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
                // Despliega la vista crear usuario
                include dirname(__FILE__)."/../views/usuarios/crearView.php";
                break;
            case 'POST':
                // Crear usuario
                $datos = $this->validarDatos();
                if ($datos["result"]) {
                    $msmodel = new UsuariosModel();
                    $msmodel->setNombre($datos["nombre"]); 
                    $msmodel->setEmail($datos["email"]);
                    $msmodel->setCedula($datos["cedula"]); 
                    $msmodel->setEstado($datos["estado"]); 
                    $msmodel->setPassword($datos["password"]);
                    $msmodel->insert();
                    $mensaje = "Registro creado !.";
                }
                else {
                    $mensaje = isset($datos["mensaje"]) ? $datos["mensaje"] : "";
                }

                include dirname(__FILE__)."/../views/usuarios/crearView.php";
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

    public function validarDatos()
    {
        $datos = array();

        $nombre = $_POST["nombre"]; 
        $email = $_POST["email"];
        $cedula = $_POST["cedula"]; 
        $estado = $_POST["estado"]; 
        $password = $_POST["password"];
        $imagen = isset($_POST["file"])? $_POST["file"] : "";

        if ( !$nombre  || $email || $cedula || $password  || $imagen)
        {
            $datos["result"] = false;
            $datos["mensaje"] = "Los datos nombre, email, cedula, password, imagen son requeridos.";
            return $datos;
        } 

        if (! preg_match("/^[a-zA-Z]+/", $nombre)) {
            $datos["result"] = false;
            $datos["mensaje"] = "Sólo se permiten letras como nombre de usuario <br>";
        } 

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $datos["result"] = false;
            $datos["mensaje"] = "Direccion de email incorrecta. <br>";
            return $datos;
        }

        if (! preg_match("/^[1-9]{1}[0-9]{,20}/", $nombre)) {
            $datos["result"] = false;
            $datos["mensaje"] = "La cedula es de solo numeros. <br>";
            return $datos;
        }

        $options = array(
        'options' => array(
                          'min_range' => 0,
                          'max_range' => 1,
                          )
        );
        if (filter_var($estado, FILTER_VALIDATE_INT, $options) !== FALSE) {
            $datos["result"] = false;
            $datos["mensaje"] = "El estado debe ser 0 o 1. <br>";
            return $datos;
        }                     

        $datos["result"] = true; 
        $datos["nombre"] = $nombre; 
        $datos["email"] = $email; 
        $datos["cedula"] = $cedula; 
        $datos["estado"] = $estado; 
        $datos["password"] = $password; 
        $datos["file"] = $imagen;

        return $datos;
    }

    public function test()
    {
        $msmodel = UsuariosModel::find(1);
        $msmodel->delete();
        var_dump($msmodel);
    }
}