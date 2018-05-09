<?php

require_once dirname(__FILE__)."/Config.php";

abstract class PDORepository
{
    private static $conn;

    private static function connection(){

        try {

            $conn = new PDO("mysql:dbname=".Config::getDatabase().";host=".Config::getHost(),
                Config::getUser(), Config::getPassword(),
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));

            if(!$conn){
                throw new Exception('could not connect to database');
            }
            return $conn;

        } catch (Exception $e) {
            echo "Excepción capturada: ",  $e->getMessage(), PHP_EOL;
            echo "Por favor contáctese con el administrador.";
            exit();
        }
    }

    protected static function getConnection() {
        if ( ! self::$conn) {
            self::$conn = self::connection();
        }
        return self::$conn;
    }

    protected static function executeQuery($sql, $args=array()) {
        $conn = self::getConnection();
        $stmt = $conn->prepare($sql);
        count($args) > 0 ? $stmt->execute($args) : $stmt->execute();
        return $stmt;
    }
}