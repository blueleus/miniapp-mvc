<?php

require_once dirname(__FILE__)."/../../models/UsuariosModel.php";
require_once dirname(__FILE__)."/../../models/RolesModel.php";

/**
* Controlador Usuarios
*/
class UsuariosController
{
    /**
     * Accion crear.
     */
    public function crear()
    {
        $metodo = $_SERVER['REQUEST_METHOD'];
        $roles = RolesModel::findAll();

        switch ($metodo) {
            case 'GET':
                // Despliega la vista crear usuario
                // include dirname(__FILE__)."/../views/usuarios/crearView.php";
                return Helper::getView("usuarios", "crearView", array(
                    "roles" => $roles
                ));
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
                    $msmodel->setRoles($datos["roles"]);
                    $mensaje = "Registro creado !.";
                    $datos = array();
                }
                else {
                    $mensaje = isset($datos["mensaje"]) ? $datos["mensaje"] : "";
                }

                //include dirname(__FILE__)."/../views/usuarios/crearView.php";
                return Helper::getView("usuarios", "crearView", array(
                    "roles" => $roles,
                    "datos" => $datos,
                    "mensaje" => isset($mensaje)? $mensaje : ""
                ));
                break;

            default:
                # code...
                break;
        }
    }

    /**
     * Accion editar.
     */
    public function editar()
    {
        $metodo = $_SERVER['REQUEST_METHOD'];
        $datos = array(
            "result" => true,
            "mensaje" => ""
        );

        if ( ! isset($_REQUEST["id"]) ) {
            $datos["result"] = false;
            $datos["mensaje"] .= "No se ha especificado el ID.";
        }

        $id = $_REQUEST["id"];
        $msmodel = UsuariosModel::find($id);
        if (!$msmodel) {
            $datos["result"] = false;
            $datos["mensaje"] .= "Usuario con ID = ". $id . " no encontrado.";
        }

        $roles = RolesModel::findAll();

        $registros = $msmodel->getRoles();
        $idsRolesUsuario = array_column($registros, "id");

        switch ($metodo) {
            case 'GET':
                // Despliega la vista editar usuario

                if ($datos["result"]) {
                    $datos["nombre"] = $msmodel->getNombre();
                    $datos["email"] = $msmodel->getEmail();
                    $datos["cedula"] = $msmodel->getCedula();
                    $datos["estado"] = $msmodel->getEstado();
                }
                else {
                    $mensaje = isset($datos["mensaje"]) ? $datos["mensaje"] : "";
                }

                //include dirname(__FILE__)."/../views/usuarios/editarView.php";
                //include Helper::getPathView("usuarios", "editarView");
                return Helper::getView("usuarios", "editarView", array(
                    "id" => $id,
                    "roles" => $roles,
                    "datos" => $datos,
                    "idsRolesUsuario" => isset($idsRolesUsuario)? $idsRolesUsuario : array(),
                    "mensaje" => isset($mensaje)? $mensaje : ""
                ));
                break;

            case 'POST':
                // Crear usuario
                $datos = $this->validarDatos();
                if ($datos["result"]) {
                    $msmodel->setNombre($datos["nombre"]);
                    $msmodel->setEmail($datos["email"]);
                    $msmodel->setCedula($datos["cedula"]);
                    $msmodel->setEstado($datos["estado"]);
                    $msmodel->setPassword($datos["password"]);
                    $msmodel->update();
                    $msmodel->setRoles($datos["roles"]);
                    $mensaje = "Registro actualizado !.";
                }
                else {
                    $mensaje = isset($datos["mensaje"]) ? $datos["mensaje"] : "";
                }

                //include dirname(__FILE__)."/../views/usuarios/editarView.php";
                //include Helper::getPathView("usuarios", "editarView");
                return Helper::getView("usuarios", "editarView", array(
                    "id" => $id,
                    "roles" => $roles,
                    "datos" => $datos,
                    "idsRolesUsuario" => isset($idsRolesUsuario)? $idsRolesUsuario : array(),
                    "mensaje" => isset($mensaje)? $mensaje : ""                 
                ));
                break;

            default:
                # code...
                break;
        }
    }

    /**
     * Accion ver.
     */
    public function buscar()
    {
        $datosAux = array();
        $datosAux["result"] = true;

        if ( ! isset($_REQUEST["id"]) ) {
            $datosAux["result"] = false;
            $datosAux["mensaje"] = "No se ha especificado el ID.";
        }

        $id = $_REQUEST["id"];
        $msmodel = UsuariosModel::find($id);
        if (!$msmodel) {
            $datosAux["result"] = false;
            $datosAux["mensaje"] = "Usuario con ID = ". $id . " no encontrado.";
        }

        if ($datosAux["result"]) {
            $dato = UsuariosModel::find($id);
        }
        else {
            $mensaje = isset($datosAux["mensaje"]) ? $datosAux["mensaje"] : "";
        }

        //include dirname(__FILE__)."/../views/usuarios/verView.php";
        //include Helper::getPathView("usuarios", "verView");
        return Helper::getView("usuarios", "verView", array(
            "dato" => $dato,
            "mensaje" => isset($mensaje)? $mensaje : "",
        ));
    }

    /**
     * Accion eliminar
     */
    public function eliminar()
    {
        $datosAux = array();
        $datosAux["result"] = true;
        $datosAux["mensaje"] = "";

        if ( ! isset($_REQUEST["id"]) ) {
            $datosAux["result"] = false;
            $datosAux["mensaje"] .= "No se ha especificado el ID.";
        }

        $id = $_REQUEST["id"];
        $msmodel = UsuariosModel::find($id);
        if (!$msmodel) {
            $datosAux["result"] = false;
            $datosAux["mensaje"] .= "Usuario con ID = ". $id . " no encontrado.";
        }

        if ($datosAux["result"]) {
            $msmodel->delete();
        }
        else {
            $mensaje = isset($datosAux["mensaje"]) ? $datosAux["mensaje"] : "";
        }

        header("Location: ".Helper::getUrl("usuarios", "listar", array()));
        exit();
    }

    /**
     * Accion listar
     */
    public function listar()
    {
        $datos = UsuariosModel::findAll();
        //include dirname(__FILE__)."/../views/usuarios/listarView.php";
        return Helper::getView("usuarios", "listarView", array(
            "datos" => $datos
        ));
    }

    public function reportes()
    {
        //include dirname(__FILE__)."/../views/usuarios/listarView.php";
        return Helper::getView("usuarios", "reportesView", array());
    }

    public function listar_paginado()
    {
        $pagina = isset($_REQUEST["pagina"])? $_REQUEST["pagina"] : 1;
        $datos = UsuariosModel::findAllPaginated($pagina);

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($datos);
        exit();
    }

    public function conteo_activo_inactivos()
    {
        $datos = UsuariosModel::countActAndInact();

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($datos);
        exit();
    }

    public function informacion_paginado()
    {
        $datos = UsuariosModel::getInformacionPaginado();

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($datos);
        exit();
    }

    /**
     * Valida los datos de entrada antes de crear o actualizar informacion
     * en la base de datos.
     * @return [array] [datos enviados por el form]
     */
    public function validarDatos()
    {
        $datos = array(
            "result" => true,
            "mensaje" => ""
        );

        $nombre = isset($_POST["nombre"])? trim($_POST["nombre"]) : "";
        $email = isset($_POST["email"])? trim($_POST["email"]) : "";
        $cedula = isset($_POST["cedula"])? trim($_POST["cedula"]) : "";
        $estado = isset($_POST["estado"])? $_POST["estado"] : "";
        $password = isset($_POST["password"])? trim($_POST["password"]) : "";
        $imagen = isset($_FILES["imagen"])? $_FILES["imagen"]["tmp_name"] : "";
        $roles = isset($_POST["roles"])? $_POST["roles"] : "";

        if ( !$nombre  || !$email || !$cedula || !$password )
        {
            $datos["result"] = false;
            $datos["mensaje"] .= "Los datos nombre, email, cedula, password son requeridos.<br><br>";
        }

        if (! preg_match("/^[a-zA-Z]+/", $nombre)) {
            $datos["result"] = false;
            $datos["mensaje"] .= "Sólo se permiten letras como nombre de usuario <br><br>";
        }

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $datos["result"] = false;
            $datos["mensaje"] .= "Direccion de email incorrecta. <br><br>";
        }

        if (! preg_match("/^[1-9]{1}[0-9]{5,20}/", $cedula)) {
            $datos["result"] = false;
            $datos["mensaje"] .= "La cedula es de solo numeros. <br><br>";
        }

        if ( $estado != 0 && $estado != 1) {
            $datos["result"] = false;
            $datos["mensaje"] .= "El estado debe ser 0 o 1. <br><br>";
        }

        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);

        if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
            $datos["result"] = false;
            $datos["mensaje"] .= "La contraseña debe tener al entre 8 y 16 caracteres, <br>"
            ."al menos un dígito, al menos una minúscula y al menos una mayúscula. <br>"
            ." NO puede tener otros símbolos. <br><br>";
        }

        if ((is_array($roles) && count($roles) < 1) || !$roles)  {
            $datos["result"] = false;
            $datos["mensaje"] .= "Se debe seleccionar al menos un rol. <br>";
        }

        if($imagen && $_FILES['imagen']['type'] != "image/jpg" && $_FILES['imagen']['type'] != "image/jpeg"){
            $datos["result"] = false;
            $datos["mensaje"] .= "El archivo a subir debe ser image/jpg. <br>";
        }

        $datos["nombre"] = $nombre;
        $datos["email"] = $email;
        $datos["cedula"] = $cedula;
        $datos["estado"] = $estado;
        $datos["password"] = $password;
        $datos["imagen"] = $imagen;
        $datos["roles"] = $roles;

        if ( $datos["result"] && $imagen) {
            $archivador = Helper::getPathUpload().$email.".jpg";
            if (!move_uploaded_file($imagen, $archivador)) {
                $datos["result"] = false;
                $datos["mensaje"] = "Ocurrio un error al subir la imagen. No pudo guardarse.";
            }
        }

        file_put_contents("nexura.log", date('c') .' --> '
            . print_r($datos, true) . PHP_EOL, FILE_APPEND | LOCK_EX);

        return $datos;
    }

    /**
     * Accion test
     * @return [] [para pruebas]
     */
    public function test()
    {
        /*$msmodel = UsuariosModel::find(1);
        $msmodel->delete();
        var_dump($msmodel);*/

        /*$u = UsuariosModel::find(1);
        $datos = $u->getRoles();
        var_dump($datos);*/

        /*$u = UsuariosModel::findAll();
        var_dump($u);*/

        //echo Helper::getPathView("usuarios", "verView");
        //var_dump(UsuariosModel::countActAndInact());
    }
}