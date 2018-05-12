<?php


require_once dirname(__FILE__)."/../../models/contratos/ContratosModel.php";
require_once dirname(__FILE__)."/../../models/contratos/SecretariasModel.php";
require_once dirname(__FILE__)."/../../models/contratos/TipoContratosModel.php";

/**
* Controlador Contratos
*/
class ContratosController
{
    public function crear()
    {
        $metodo = $_SERVER['REQUEST_METHOD'];
        $result = array();

        switch ($metodo) {
            case 'POST':
                // Crear contrato
                $datos = $this->validarDatos();

                if ($datos["result"]) {
                    $msmodel = new ContratosModel();
					$msmodel->setNumeroContrato($datos["numero_contrato"]);
					$msmodel->setObjetoContrato($datos["objeto_contrato"]);
					$msmodel->setPresupuesto($datos["presupuesto"]);
					$msmodel->setFechaEstimadaFinalizacion($datos["fecha_estimada_fin"]);
                    $msmodel->insert();
                    $msmodel->setSecretaria($datos["secretaria"]);
                    $msmodel->setTipoContratos($datos["tipo_contratos"]);
                    $mensaje = "Registro creado !.";

                    $result["status"] = true;
                }
                else {
                    $result["status"] = false;
                    $mensaje = isset($datos["mensaje"]) ? $datos["mensaje"] : "";
                }

                $result["mensaje"] = isset($mensaje)? $mensaje : "";

                header('Content-type: application/json; charset=utf-8');
                echo json_encode($result);
                exit();

                break;

            default:
                # code...
                break;
        }
    }

    public function editar()
    {
        $metodo = $_SERVER['REQUEST_METHOD'];
        $result = array();

        if ( ! isset($_REQUEST["id"]) ) {
            $result["status"] = false;
            $result["mensaje"] = "No se ha especificado el ID.";
        }

        $id = $_REQUEST["id"];
        $msmodel = ContratosModel::find($id);
        if (!$msmodel) {
            $result["status"] = false;
            $result["mensaje"] = "Contrato con ID = ". $id . " no encontrado.";
        }

        switch ($metodo) {
            case 'POST':
                // Crear contrato
                $datos = $this->validarDatos();

                file_put_contents("nexura.log", date('c') .' --> '
                    . print_r($datos, true) . PHP_EOL, FILE_APPEND | LOCK_EX);

                if ($datos["result"]) {
					$msmodel->setNumeroContrato($datos["numero_contrato"]);
					$msmodel->setObjetoContrato($datos["objeto_contrato"]);
					$msmodel->setPresupuesto($datos["presupuesto"]);
					$msmodel->setFechaEstimadaFinalizacion($datos["fecha_estimada_fin"]);
                    $msmodel->update();
					$msmodel->setSecretaria($datos["secretaria"]);
                    $msmodel->setTipoContratos($datos["tipo_contratos"]);
                    $mensaje = "Registro actualizado !.";

                    $result["status"] = true;
                }
                else {
                    $result["status"] = false;
                    $mensaje = isset($datos["mensaje"]) ? $datos["mensaje"] : "";
                }

                $result["mensaje"] = isset($mensaje)? $mensaje : "";

                header('Content-type: application/json; charset=utf-8');
                echo json_encode($result);
                exit();

                break;

            default:
                # code...
                break;
        }
    }

    /**
     * Accion ver.
     */
    public function buscar()
    {
        $datosAux = array();
        $datosAux["result"] = true;

        if ( ! isset($_REQUEST["id"]) ) {
            $datosAux["result"] = false;
            $datosAux["mensaje"] = "No se ha especificado el ID.";
        }

        $id = $_REQUEST["id"];
        $msmodel = ContratosModel::find($id);
        if (!$msmodel) {
            $datosAux["result"] = false;
            $datosAux["mensaje"] = "Contrato con ID = ". $id . " no encontrado.";
        }

        if ($datosAux["result"]) {
            $dato = $msmodel;
        }
        else {
            $mensaje = isset($datosAux["mensaje"]) ? $datosAux["mensaje"] : "";
        }

        return Helper::getView("contratos", "verView", array(
            "dato" => $dato,
            "mensaje" => isset($mensaje)? $mensaje : "",
        ));
    }

    /**
     * Accion eliminar.
     */
    public function eliminar()
    {
        $datosAux = array();
        $datosAux["result"] = true;
        $datosAux["mensaje"] = "";

        if ( ! isset($_REQUEST["id"]) ) {
            $datosAux["result"] = false;
            $datosAux["mensaje"] .= "No se ha especificado el ID.";
        }

        $id = $_REQUEST["id"];
        $msmodel = ContratosModel::find($id);
        if (!$msmodel) {
            $datosAux["result"] = false;
            $datosAux["mensaje"] .= "Usuario con ID = ". $id . " no encontrado.";
        }

        if ($datosAux["result"]) {
            $msmodel->delete();
        }
        else {
            $mensaje = isset($datosAux["mensaje"]) ? $datosAux["mensaje"] : "";
        }

        header("Location: ".Helper::getUrl("contratos", "listar", array()));
        exit();
    }

    public function eliminarSelected()
    {
        $result = array();
        $result["status"] = true;
        $result["mensaje"] = "";

        if ( ! isset($_REQUEST["ids"]) ) {
            $result["status"] = false;
            $result["mensaje"] .= "No se han especificado IDs.";
        }

        $ids = json_decode($_REQUEST["ids"]);
        $objs = array();
        foreach ($ids as $id) {
            $msmodel = ContratosModel::find($id);
            if (!$msmodel) {
                $result["status"] = false;
                $result["mensaje"] .= "Contrato con ID = ". $id . " no encontrado.";
                break;
            }
            $objs[] = $msmodel;
        }

        if ($result["status"]) {
            foreach ($objs as  $obj) {
                $obj->delete();
            }
        }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($result);
        exit();
    }

    /**
     * Accion listar
     */
    public function listar()
    {
        $secretarias = SecretariasModel::findAll();
        $tipoContratos = TipoContratosModel::findAll();
        return Helper::getView("contratos", "listarView", array(
            "secretarias" => $secretarias,
            "tipoContratos" => $tipoContratos
        ));
    }

    public function listar_paginado()
    {
        $pagina = isset($_REQUEST["pagina"])? $_REQUEST["pagina"] : 1;

        if (isset($_REQUEST["search"])) {
            $datos = ContratosModel::findAllPaginated($pagina, true, $_REQUEST["search"]);
        }
        else {
            $datos = ContratosModel::findAllPaginated($pagina, true);
        }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($datos);
        exit();
    }

    public function informacion_paginado()
    {
        $datos = ContratosModel::getInformacionPaginado();

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($datos);
        exit();
    }

    public function consultarPorId()
    {
        $result = array();
        $result["status"] = true;

        if ( ! isset($_REQUEST["id"]) ) {
            $result["status"] = false;
            $result["mensaje"] = "No se ha especificado el ID.";
        }

        $id = $_REQUEST["id"];
        $msmodel = ContratosModel::ajaxFind($id);
        if (!$msmodel) {
            $result["status"] = false;
            $result["mensaje"] = "Contrato con ID = ". $id . " no encontrado.";
        }

        if ($result["status"]) {
            $result["data"] = $msmodel;
        }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($result);
        exit();
    }

    public function reportes()
    {
        return Helper::getView("contratos", "reportesView", array());
    }

    public function conteoContratosPorSecretaria()
    {
        $datos = ContratosModel::countContratosPorSecreataria();

        file_put_contents("nexura.log", date('c') .' --> '
            . print_r($datos, true) . PHP_EOL, FILE_APPEND | LOCK_EX);

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($datos);
        exit();
    }

    /**
     * Valida los datos de entrada antes de crear o actualizar informacion
     * en la base de datos.
     * @return [array] [datos enviados por el form]
     */
    public function validarDatos()
    {
        //file_put_contents("nexura.log", date('c') .' --> '
        //    . print_r($_POST, true) . PHP_EOL, FILE_APPEND | LOCK_EX);

        $datos = array(
            "result" => true,
            "mensaje" => ""
        );

        $numero_contrato = isset($_POST["numero_contrato"])? trim($_POST["numero_contrato"]) : "";
        $objeto_contrato = isset($_POST["objeto_contrato"])? trim($_POST["objeto_contrato"]) : "";
        $presupuesto = isset($_POST["presupuesto"])? trim($_POST["presupuesto"]) : "";
        $fecha_estimada_fin = isset($_POST["fecha_estimada_finalizacion"])? $_POST["fecha_estimada_finalizacion"] : "";
        $tipo_contratos = isset($_POST["tipo_contrato"])? $_POST["tipo_contrato"] : array();
        $secretaria = isset($_POST["secretaria"])? $_POST["secretaria"] : "";

        if ( !$numero_contrato)
        {
            $datos["result"] = false;
            $datos["mensaje"]["numero_contrato"] = "numero_contrato es requerido.";
        }

        if (!$objeto_contrato)
        {
            $datos["result"] = false;
            $datos["mensaje"]["objeto_contrato"] = "objeto_contrato es requerido.";
        }

        if (!$presupuesto)
        {
            $datos["result"] = false;
            $datos["mensaje"]["presupuesto"] = "presupuesto es requerido.";
        }

        if (!$fecha_estimada_fin)
        {
            $datos["result"] = false;
            $datos["mensaje"]["fecha_estimada_fin"] = "fecha_estimada_fin es requerido.";
        }

        if (empty($tipo_contratos))
        {
            $datos["result"] = false;
            $datos["mensaje"]["tipo_contratos"] = "tipo_contratos es requerido.";
        }

        if (!$secretaria)
        {
            $datos["result"] = false;
            $datos["mensaje"]["secretaria"] = "secretaria es requerido.";
        }

        if (! preg_match("/^[0-9]+[-]{1}[A-Za-z]+[-]{1}[0-9]+/", $numero_contrato)) {
            $datos["result"] = false;
            $datos["mensaje"]["numero_contrato"] = "El numero_contrato debe cumplir el siguiente formato: 06943-GA-2018";
        }

        if (! preg_match("/^[A-Za-z\s]+/", $objeto_contrato)) {
            $datos["result"] = false;
            $datos["mensaje"]["objeto_contrato"] = "El objeto_contrato deben ser caracteres alfabeticos";
        }

        if (! preg_match("/^[0-9]+/", $presupuesto)) {
            $datos["result"] = false;
            $datos["mensaje"]["presupuesto"] = "El presupuesto debe ser un valor entero, Ej: 10000 para 10 mil pesos.";
        }

        $datos["numero_contrato"] = $numero_contrato;
        $datos["objeto_contrato"] = $objeto_contrato;
        $datos["presupuesto"] = $presupuesto;
        $datos["fecha_estimada_fin"] = $fecha_estimada_fin;
        $datos["tipo_contratos"] = $tipo_contratos;
        $datos["secretaria"] = $secretaria;

        /*file_put_contents("nexura.log", date('c') .' --> '
            . print_r($datos, true) . PHP_EOL, FILE_APPEND | LOCK_EX);*/

        return $datos;
    }

    /**
     * Accion test
     * @return [] [para pruebas]
     */
    public function test()
    {
        /*$u = SecretariasModel::findAll();
        var_dump($u);*/

        /*$u = TipoContratosModel::findAll();
        var_dump($u);*/

        /*$u = ContratosModel::find(8);
        //print_r($u->getSecretaria());
        print_r($u->getTipoContratos());*/

        /*$u =  ContratosModel::ajaxFind(20);
        print_r($u);*/

        $datos = ContratosModel::countContratosPorSecreataria();
        print_r($datos);
    }
}