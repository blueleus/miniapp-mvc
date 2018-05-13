<?php

/**
 * 
 */
class SecretariasModel extends PDORepository {

    private $id;
    private $nombre;

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public static function findAll() {
        $sql = "SELECT * FROM secretarias";
        $stmt = parent::executeQuery($sql, array());
        $r = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = array();

        foreach ($r as $row) {
            $newObj = new SecretariasModel();
            $newObj->setId($row["id"]);
            $newObj->setNombre($row["nombre"]);
            array_push($result, $newObj);
        }

        return $result;
    }
}
