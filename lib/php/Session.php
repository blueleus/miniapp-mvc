<?php

/*
    Use the static method getInstance to get the object.
*/

class Session
{
    /**
    *    (Re)starts the session.
    *
    **/
    public static function startSession()
    {
        if ( self::is_session_started() === FALSE ) { return session_start(); }
    }

    /**
    *    Destroys the current session.
    *
    *    @return    bool    TRUE is session has been deleted, else FALSE.
    **/
    public static function destroy()
    {
        if ( self::is_session_started() === TRUE ) {
            unset ($_SESSION['loggedin']);
            unset ($_SESSION['username']);
            unset ($_SESSION['start']);
            unset ($_SESSION['expire']);
            session_destroy();
        }
        return;
    }

    public static function initializeSession($usuario)
    {
        self::startSession();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $usuario->getEmail();
        $_SESSION['start'] = time();
        $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
        return;
    }

    /**
    * @return bool
    */
    public static function is_session_started()
    {
        if ( php_sapi_name() !== 'cli' ) {
            if ( version_compare(phpversion(), '5.4.0', '>=') ) {
                return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
            } else {
                return session_id() === '' ? FALSE : TRUE;
            }
        }
        return FALSE;
    }
}