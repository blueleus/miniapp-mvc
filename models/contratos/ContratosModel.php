<?php

require_once dirname(__FILE__) . "/../../lib/config/PDORepository.php";
require_once dirname(__FILE__) . "/../../lib/php/Helper.php";

/**
 *
 */
class ContratosModel extends PDORepository {

    private $id;
    private $numeroContrato;
    private $objetoContrato;
    private $presupuesto;
    private $fechaEstimadaFinalizacion;
    private $fechaPublicacion;

    const TAMANO_PAGINA = 5;

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setNumeroContrato($numeroContrato) {
        $this->numeroContrato = $numeroContrato;
    }

    public function getNumeroContrato() {
        return $this->numeroContrato;
    }

    public function setObjetoContrato($objetoContrato) {
        $this->objetoContrato = $objetoContrato;
    }

    public function getObjetoContrato() {
        return $this->objetoContrato;
    }

    public function setPresupuesto($presupuesto) {
        $this->presupuesto = $presupuesto;
    }

    public function getPresupuesto() {
        return $this->presupuesto;
    }

    public function setFechaEstimadaFinalizacion($fechaEstimadaFinalizacion) {
        $this->fechaEstimadaFinalizacion = $fechaEstimadaFinalizacion;
    }

    public function getFechaEstimadaFinalizacion() {
        return $this->fechaEstimadaFinalizacion;
    }

    public function setFechaPublicacion($fechaPublicacion) {
        $this->fechaPublicacion = $fechaPublicacion;
    }

    public function getFechaPublicacion() {
        return $this->fechaPublicacion;
    }

    public function setTipoContratos($idsTipos) {
        if (!$idsTipos || !is_array($idsTipos)) {
            return false;
        }
        if (count($idsTipos) < 1) {
            return false;
        }

        $oldIdsTipos = array_column($this->getTipoContratos(), "id");

        foreach ($idsTipos as $id_tipo) {
            if (!in_array($id_tipo, $oldIdsTipos)) {
                $sql = "INSERT INTO contratos_tipos_contratos (contrato_id, tipo_contrato_id)
                VALUES (:contrato_id, :tipo_contrato_id)";
                $args = array(
                    ":contrato_id" => $this->id,
                    ":tipo_contrato_id" => $id_tipo
                );
                $stmt = $this->executeQuery($sql, $args);
            }
        }

        foreach ($oldIdsTipos as $id_tipo) {
            if (!in_array($id_tipo, $idsTipos)) {
                $sql = "DELETE FROM contratos_tipos_contratos
                WHERE tipo_contrato_id=:tipo_contrato_id AND contrato_id=:contrato_id";
                $args = array(
                    ":tipo_contrato_id" => $id_tipo,
                    ":contrato_id" => $this->id
                );
                $stmt = $this->executeQuery($sql, $args);
            }
        }

        return true;
    }

    public function getTipoContratos() {
        $sql = "SELECT tc.id as id, tc.nombre as nombre FROM contratos_tipos_contratos as t, tipo_contratos as tc
        WHERE t.contrato_id=:id AND t.tipo_contrato_id = tc.id";
        $args = array(
            ":id" => $this->id
        );
        $stmt = parent::executeQuery($sql, $args);
        $r = $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : array();
        return $r;
    }

    public function setSecretaria($idSecretaria) {
        if (!$this->id) {
            //echo "No se tiene referencia al ID del objeto a actulizar.";
            $mj = "No se tiene referencia al ID del objeto a actulizar.";

            file_put_contents("nexura.log", date('c') . ' --> '
                    . print_r($mj, true) . PHP_EOL, FILE_APPEND | LOCK_EX);
            throw new Exception($mj);
        }

        $sql = "UPDATE contratos SET secretaria_id=:secretaria_id WHERE id=:id";
        $args = array(
            ":id" => $this->id,
            ":secretaria_id" => $idSecretaria
        );
        $stmt = $this->executeQuery($sql, $args);

        return !$stmt ? false : true;
    }

    public function getSecretaria() {
        $sql = "SELECT s.id as id, s.nombre as nombre FROM contratos as c, secretarias as s
        WHERE c.id=:id AND s.id = c.secretaria_id";
        $args = array(
            ":id" => $this->id
        );
        $stmt = parent::executeQuery($sql, $args);
        $r = $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : array();
        return $r;
    }

    /**
     * Insertar una fila con la informacion de un contrato.
     * @return [boolean] [true o false]
     */
    public function insert() {
        $sql = "INSERT INTO contratos (numero_contrato, objeto_contrato, presupuesto, fecha_estimada_finalizacion)
        VALUES (:numero_contrato, :objeto_contrato, :presupuesto, :fecha_estimada_finalizacion)";
        $args = array(
            ":numero_contrato" => $this->numeroContrato,
            ":objeto_contrato" => $this->objetoContrato,
            ":presupuesto" => $this->presupuesto,
            ":fecha_estimada_finalizacion" => $this->fechaEstimadaFinalizacion,
        );
        $stmt = $this->executeQuery($sql, $args);

        if ($stmt) {
            $this->id = $this->getConnection()->lastInsertId();
        }

        return !$stmt ? false : true;
    }

    /**
     * Actualiza los datos de un contratos.
     * @return [boolean] [true o false]
     */
    public function update() {
        if (!$this->id) {
            //echo "No se tiene referencia al ID del objeto a actulizar.";
            throw new Exception("No se tiene referencia al ID del objeto a actulizar.");
        }

        $sql = "UPDATE contratos SET numero_contrato=:numero_contrato, objeto_contrato=:objeto_contrato, presupuesto=:presupuesto, fecha_estimada_finalizacion=:fecha_estimada_finalizacion WHERE id=:id";
        $args = array(
            ":id" => $this->id,
            ":numero_contrato" => $this->numeroContrato,
            ":objeto_contrato" => $this->objetoContrato,
            ":presupuesto" => $this->presupuesto,
            ":fecha_estimada_finalizacion" => $this->fechaEstimadaFinalizacion,
        );
        $stmt = $this->executeQuery($sql, $args);

        return !$stmt ? false : true;
    }

    /**
     * Eliminar un contrato por su ID.
     * @return [boolean] [true o false]
     */
    public function delete() {
        $sql = "DELETE FROM archivos WHERE contrato_id=:contrato_id";
        $args = array(
            ":contrato_id" => $this->id
        );
        $stmt = $this->executeQuery($sql, $args);

        $sql = "DELETE FROM contratos_tipos_contratos WHERE contrato_id=:contrato_id";
        $args = array(
            ":contrato_id" => $this->id
        );
        $stmt = $this->executeQuery($sql, $args);

        $sql = "DELETE FROM contratos WHERE id=:id";
        $args = array(
            ":id" => $this->id
        );
        $stmt = $this->executeQuery($sql, $args);

        return !$stmt ? false : true;
    }

    /**
     * Buscar un contratos por su ID.
     * @param  [integer] $id [ID del contratos a consultar]
     * @return [ContratosModel]     [contratos encontrado.]
     */
    public static function find($id) {
        $sql = "SELECT * FROM contratos WHERE id=:id";
        $args = array(
            ":id" => $id
        );
        $stmt = parent::executeQuery($sql, $args);
        $r = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($r && count($r) > 0) {
            $newObj = new ContratosModel();
            $newObj->setId($r[0]["id"]);
            $newObj->setNumeroContrato($r[0]["numero_contrato"]);
            $newObj->setObjetoContrato($r[0]["objeto_contrato"]);
            $newObj->setPresupuesto($r[0]["presupuesto"]);
            $newObj->setFechaEstimadaFinalizacion($r[0]["fecha_estimada_finalizacion"]);
            $newObj->setFechaPublicacion($r[0]["fecha_publicacion"]);
            $newObj->setSecretaria($r[0]["secretaria_id"]);
            return $newObj;
        }

        return null;
    }

    public static function ajaxFind($id) {
        $sql = "SELECT * FROM contratos WHERE id=:id";
        $args = array(
            ":id" => $id
        );
        $stmt = parent::executeQuery($sql, $args);
        $r = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($r && count($r) > 0) {
            $sql = "SELECT s.id as id, s.nombre as nombre FROM contratos as c, secretarias as s
            WHERE c.id=:id AND s.id = c.secretaria_id";
            $args = array(
                ":id" => $id
            );
            $stmt = parent::executeQuery($sql, $args);
            $res = $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : array();
            $r[0]["secretaria"] = $res[0];

            $sql = "SELECT tc.id as id, tc.nombre as nombre FROM contratos_tipos_contratos as t, tipo_contratos as tc
            WHERE t.contrato_id=:id AND t.tipo_contrato_id = tc.id";
            $args = array(
                ":id" => $id
            );
            $stmt = parent::executeQuery($sql, $args);
            $r[0]["tipo_contratos"] = $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : array();

            return $r[0];
        }

        return null;
    }

    /**
     * Retorna paginados todos los contratos creados en el sistema.
     * @param  [int] $pagina [numero de pagina]
     * @return [array]       [array de objetos]
     */
    public static function findAllPaginated($pagina, $arTable, $search) {
        $sql = "SELECT COUNT(*) as total_registros FROM contratos";
        $stmt = parent::executeQuery($sql, array());
        $r = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $num_total_registros = $r[0]["total_registros"];

        if (!$pagina) {
            $inicio = 0;
            $pagina = 1;
        } else {
            $inicio = ($pagina - 1) * self::TAMANO_PAGINA;
        }
        //calculo el total de paginas
        $total_paginas = ceil($num_total_registros / self::TAMANO_PAGINA);

        $sql = "SELECT id, numero_contrato, objeto_contrato, presupuesto, fecha_estimada_finalizacion, fecha_publicacion, secretaria_id FROM contratos";

        if ($search) {
            $sql .= " WHERE numero_contrato LIKE '%" . $search . "%'";
            $sql .= " OR objeto_contrato LIKE '%" . $search . "%'";
            $sql .= " OR presupuesto LIKE '%" . $search . "%'";
            $sql .= " OR fecha_estimada_finalizacion LIKE '%" . $search . "%'";
            $sql .= " OR fecha_publicacion LIKE '%" . $search . "%'";
        }

        $sql .= " ORDER BY fecha_publicacion DESC LIMIT " . $inicio . "," . self::TAMANO_PAGINA;

        $stmt = parent::executeQuery($sql, array());
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($arTable) {
            $data = self::armarTable($pagina, $rs);
        } else {
            $data = $rs;
        }

        $result = array(
            "pagina" => $pagina,
            "total_paginas" => $total_paginas,
            "num_total_registros" => $num_total_registros,
            "data" => $data
        );

        return $result;
    }

    public static function armarTable($pagina_actual, $data) {
        $tableHtml = "";
        foreach ($data as $key => $value) {
            $idx = ($key + 1) + ($pagina_actual - 1) * self::TAMANO_PAGINA;
            $tableHtml .= "<tr>";
            $tableHtml .= "<td>" . $idx . "</td>";
            $tableHtml .= "<td><input type='checkbox' class='micheckbox' value='" . $value["id"] . "'></td>";
            $tableHtml .= "<td>" . $value["numero_contrato"] . "</td>";
            $tableHtml .= "<td>" . $value["objeto_contrato"] . "</td>";
            $tableHtml .= "<td>" . $value["presupuesto"] . "</td>";
            $tableHtml .= "<td>" . $value["fecha_estimada_finalizacion"] . "</td>";
            $tableHtml .= "<td>" . $value["fecha_publicacion"] . "</td>";

            $tableHtml .= "<td><button type='button' class='btn btn-warning bt-edit-row btn-xs' value='" . $value["id"] . "'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> <span class='hidden-xs'>Editar.</button></td>";

            $tableHtml .= "<td><a class='btn btn-danger btn-xs' href='http://localhost/nexura/index.php?mod=contratos&fun=eliminar&id=" . $value["id"] . "'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span> <span class='hidden-xs'>Eliminar.</span></a></td>";

            $tableHtml .= "<td><a class='btn btn-info btn-xs' href='http://localhost/nexura/index.php?mod=contratos&fun=buscar&id=" . $value["id"] . "'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> <span class='hidden-xs'>Ver.</span></a></td>";

            $tableHtml .= "</tr>";
        }

        return $tableHtml;
    }

    public static function getInformacionPaginado() {
        $sql = "SELECT COUNT(*) as total_registros FROM contratos";
        $stmt = parent::executeQuery($sql, array());
        $r = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $num_total_registros = $r[0]["total_registros"];

        //calculo el total de pÃ¡ginas
        $total_paginas = ceil($num_total_registros / self::TAMANO_PAGINA);

        $result = array(
            "total_paginas" => $total_paginas,
            "num_total_registros" => $num_total_registros
        );

        return $result;
    }

    public static function countContratosPorSecreataria() {
        $sql = "SELECT s.id, s.nombre, COUNT(*) as total FROM contratos as c, secretarias as s WHERE c.secretaria_id = s.id GROUP BY s.nombre";
        $stmt = parent::executeQuery($sql, array());
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}
