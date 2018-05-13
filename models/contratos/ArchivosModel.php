<?php

/**
 * Description of ArchivosModel
 *
 * @author Andres Orejuela
 */
class ArchivosModel extends PDORepository {

    private $id;
    private $nombre;
    private $descripcion;
    private $tamano;
    private $mime_type;
    private $fecha_publicacion;
    private $contrato_id;
    private $url;

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

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setTamano($tamano) {
        $this->tamano = $tamano;
    }

    public function getTamano() {
        return $this->tamano;
    }

    public function setMimeType($mime_type) {
        $this->mime_type = $mime_type;
    }

    public function getMimeType() {
        return $this->mime_type;
    }

    public function setFechaPublicacion($fecha_publicacion) {
        $this->fecha_publicacion = $fecha_publicacion;
    }

    public function getFechaPublicacion() {
        return $this->fecha_publicacion;
    }

    public function setContratoId($contrato_id) {
        $this->contrato_id = $contrato_id;
    }

    public function getContratoId() {
        return $this->contrato_id;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getUrl() {
        return $this->url;
    }

    public function insert() {
        $sql = "INSERT INTO archivos (nombre_archivo, descripcion, tamano, mime_type, contrato_id, url)
        VALUES (:nombre_archivo, :descripcion, :tamano, :mime_type, :contrato_id, :url)";
        $args = array(
            ":nombre_archivo" => $this->nombre,
            ":descripcion" => $this->descripcion,
            ":tamano" => $this->tamano,
            ":mime_type" => $this->mime_type,
            ":contrato_id" => $this->contrato_id,
            ":url" => $this->url
        );
        $stmt = $this->executeQuery($sql, $args);

        if ($stmt) {
            $this->id = $this->getConnection()->lastInsertId();
        }

        return !$stmt ? false : true;
    }

    public static function findAllForContrato($contrato_id) {
        $sql = "SELECT * FROM archivos WHERE contrato_id=:contrato_id";
        $stmt = parent::executeQuery($sql, array(
                    "contrato_id" => $contrato_id
        ));
        $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = self::armarTableResult($r);
        return $result;
    }

    private static function armarTableResult($result) {
        $tableHtml = "";
        foreach ($result as $key => $value) {
            $tableHtml .= "<tr>";
            $tableHtml .= "<td>" . $value["nombre_archivo"] . "</td>";
            $tableHtml .= "<td>" . $value["descripcion"] . "</td>";

            $tableHtml .= "<td><a href='http://localhost/nexura/web/upload/".$value["url"]."' download>Download</a></td>";

            $tableHtml .= "</tr>";
        }

        return $tableHtml;
    }

}
