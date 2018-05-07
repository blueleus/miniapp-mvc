<?php

define("PATH_CONTROLLERS", dirname(__FILE__)."/controllers/");
require_once dirname(__FILE__)."/lib/php/Helper.php";
require_once dirname(__FILE__)."/lib/php/Session.php";

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

        $this->access($modulo, $accion);
    }

    public function access($modulo, $accion)
    {
        Session::startSession();

        if (Helper::isRestringida($modulo, $accion, "login")) {

            if (! $this->isLogueado()) {
                include __DIR__."/views/header.php";
                include __DIR__."/views/login/accessView.php";
                include __DIR__."/views/footer.php";
                return;
            }

            if ($this->timeExpiro()) {
                include __DIR__."/views/header.php";
                include __DIR__."/views/login/timeExpiroView.php";
                include __DIR__."/views/footer.php";
                return;
            }
        }

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

    private function isLogueado()
    {
        return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true;
    }

    public function timeExpiro()
    {
        $now = time();
        return isset($_SESSION['expire']) && $now > $_SESSION['expire'];
    }
}

$server = new Server();
$server->router();