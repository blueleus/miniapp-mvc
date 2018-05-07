<?php

require_once dirname(__FILE__)."/Config.php";

abstract class PDORepository
{
    private static $conn;

    private static function connection(){
         $conn = new PDO("mysql:dbname=".Config::getDatabase().";host=".Config::getHost(),
            Config::getUser(), Config::getPassword(),
            array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
        if(!$conn){
            throw new Exception('could not connect to database');
        }
        return $conn;
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