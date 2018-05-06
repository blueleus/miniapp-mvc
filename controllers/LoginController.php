<?php

require_once dirname(__FILE__)."/../models/UsuariosModel.php";

/**
* LoginController
*/
class LoginController
{
    public function checkLogin()
    {
        /*if (password_verify($password, $row['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['start'] = time();
            $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);

            echo "Bienvenido! " . $_SESSION['username'];
            echo "<br><br><a href=panel-control.php>Panel de Control</a>";

            } else {
            echo "Username o Password estan incorrectos.";

            echo "<br><a href='login.html'>Volver a Intentarlo</a>";
        }*/
    }
}