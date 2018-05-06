<?php
include_once dirname(__FILE__)."/../../lib/php/Helper.php";

session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo "<nav class='navbar navbar-dark bg-primary'>";
    echo "<a class='navbar-brand my-2 my-lg-0' href='".Helper::getUrl("login", "singout", array())."''>Cerrar sesi&oacute;n</a>";
    echo "</nav>";
} else {
    echo "Esta pagina es solo para usuarios registrados.<br>";
    echo "<br><a href='".Helper::getUrl("login", "login", array())."'>Login</a>";
    echo "<br><br><a href='".Helper::getUrl("usuarios", "crear", array())."'>Registrarme</a>";

    exit;
}

$now = time();

if($now > $_SESSION['expire']) {

    unset ($_SESSION['loggedin']);
    unset ($_SESSION['username']);
    unset ($_SESSION['start']);
    unset ($_SESSION['expire']);
    session_destroy();

    echo "Su sesion a terminado,
    <a href='".Helper::getUrl("login", "login", array())."'>Necesita Hacer Login</a>";
    exit;
}

?>