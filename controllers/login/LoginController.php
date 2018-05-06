<?php

require_once dirname(__FILE__)."/../../models/UsuariosModel.php";

/**
* LoginController
*/
class LoginController
{
    private function verificarPassword($usuario, $password)
    {
        return md5($password) == $usuario->getPassword();
    }

    private function checkLogin($email, $password)
    {
        $usuario = UsuariosModel::findForEmail($email);

        if ( !$usuario ) { return false; }
        if ( !$this->verificarPassword($usuario, $password) ) { return false; }

        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $usuario->getEmail();
        $_SESSION['start'] = time();
        $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);

        return true;
    }

    public function login()
    {
        $metodo = $_SERVER['REQUEST_METHOD'];

        switch ($metodo) {
            case 'GET':
                Helper::getView("login", "loginView");
                break;

            case 'POST':
                $datos = $this->validarDatos();

                if ($datos["result"]) {
                    $isOk = $this->checkLogin($datos["email"], $datos["password"]);
                    if ($isOk) {
                        header("Location: ".Helper::getUrl("usuarios", "listar", array()));
                    }
                    else {
                        $datos["mensaje"] = "Email o Password estan incorrectos. Volver a Intentarlo.";
                    }
                }

                $mensaje = isset($datos["mensaje"]) ? $datos["mensaje"] : "";
                Helper::getView("login", "loginView", array(
                    "datos" => $datos,
                    "mensaje" => $mensaje
                ));

                break;

            default:
                # code...
                break;
        }
    }

    public function singout()
    {
        session_start();
        unset ($_SESSION['loggedin']);
        unset ($_SESSION['username']);
        unset ($_SESSION['start']);
        unset ($_SESSION['expire']);
        session_destroy();

        header("Location: ".Helper::getUrl("login", "login", array()));
    }

    private function validarDatos()
    {
        $datos = array(
            "result" => true,
            "mensaje" => ""
        );

        $email = isset($_POST["email"])? trim($_POST["email"]) : "";
        $password = isset($_POST["password"])? trim($_POST["password"]) : "";

        if ( !$email || !$password )
        {
            $datos["result"] = false;
            $datos["mensaje"] .= "Los datos email, password son requeridos.<br><br>";
        }

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $datos["result"] = false;
            $datos["mensaje"] .= "Direccion de email incorrecta. <br><br>";
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

        $datos["email"] = $email;
        $datos["password"] = $password;
        file_put_contents("nexura.log", date('c') .' --> '
            . print_r($datos, true) . PHP_EOL, FILE_APPEND | LOCK_EX);

        return $datos;
    }
}