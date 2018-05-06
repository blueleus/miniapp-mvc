<?php

define("PATH_CONTROLLERS", dirname(__FILE__)."/controllers/");

/**
* Controlador Frontal
*/
class Server
{
    public function router()
    {
        if ( !isset($_REQUEST["mod"]) || !isset($_REQUEST["fun"]) ) {
            echo "No se ha especificado el modulo (mod) y la accion (fun) en la solicitud.";
            return;
        }

        $modulo = $_REQUEST['mod'];
        $accion = $_REQUEST['fun'];
        $nombreClase = ucwords($modulo)."Controller";
        $pathClase = PATH_CONTROLLERS."/".$modulo."/".$nombreClase.".php";

        if ( !file_exists($pathClase)) {
            echo "No se puede dar respuesta a la solicitud entrante.";
            return;
        }

        require_once($pathClase);

        $resource = new $nombreClase();
        if (method_exists($resource, $accion)) {
            include __DIR__."/views/header.php";
            $resource->$accion();
            include __DIR__."/views/footer.php";
        }
    }
}

$server = new Server();
$server->router();