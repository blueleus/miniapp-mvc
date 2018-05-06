<?php
include_once dirname(__FILE__)."/../../lib/php/Helper.php";

session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

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