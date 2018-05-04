<?php

require_once dirname(__FILE__)."/../config/Config.php";

/**
*   Helper para la conexion a la base de datos.
*/
class HelperDB
{
    private $connection;

    public function __construct() {
        $this->connection = $this->getConnection();
    }

    private function getConnection(){
        $conn = new PDO("mysql:dbname=".Config::getDatabase().";host=".Config::getHost(),
            Config::getUser(), Config::getPassword(),
            array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
        if(!$conn){
            throw new Exception('could not connect to database');
        }
        return $conn;
    }

    public function executeQuery($sql, $args=array()) {
        $stmt = $this->connection->prepare($sql);
        count($args) > 0 ? $stmt->execute($args) : $stmt->execute();
        return $stmt;
    }
}