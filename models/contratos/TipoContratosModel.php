<?php

/**
 * 
 */
class TipoContratosModel extends PDORepository {

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
        $sql = "SELECT * FROM tipo_contratos";
        $stmt = parent::executeQuery($sql, array());
        $r = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = array();

        foreach ($r as $row) {
            $newObj = new TipoContratosModel();
            $newObj->setId($row["id"]);
            $newObj->setNombre($row["nombre"]);
            array_push($result, $newObj);
        }

        return $result;
    }

}
