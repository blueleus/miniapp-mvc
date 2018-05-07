<?php

require_once dirname(__FILE__)."/../lib/config/PDORepository.php";
require_once dirname(__FILE__)."/../lib/php/Helper.php";

/**
*
*/
class UsuariosModel extends PDORepository
{
	private $id;
	private $nombre;
	private $email;
	private $cedula;
	private $estado;
    private $password;
	private $fechaCreacion;

    const TAMANO_PAGINA = 10;

	/*public function test()
	{
        $stmt = $this->executeQuery("SELECT * FROM roles");
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //$result = $db->executeQuery("INSERT INTO roles (nombre) VALUE (?)", array('ADMIN'));
        //echo $stmt->rowCount() . " records UPDATED successfully";
        var_dump($resultado);
	}*/

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setNombre($nombre)
	{
		$this->nombre = $nombre;
	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setCedula($cedula)
	{
		$this->cedula = $cedula;
	}

	public function getCedula()
	{
		return $this->cedula;
	}

	public function setEstado($estado)
	{
		$this->estado = $estado;
	}

	public function getEstado()
	{
		return $this->estado;
	}

	public function setPassword($password)
	{
		$this->password = $password;
	}

	public function getPassword()
	{
		return $this->password;
	}

    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Fija los roles para un usuario
     * @param [array] $idsRoles [IDs roles -> array(id_1, id_2, ...)]
     */
    public function setRoles($idsRoles)
    {
        if ( !$idsRoles || !is_array($idsRoles) ) { return false; }
        if ( count($idsRoles) < 1 ) { return false; }

		$oldIdsRoles = array_column ( $this->getRoles(), "id");

        foreach ($idsRoles as $id_rol) {
            if ( ! in_array($id_rol, $oldIdsRoles)) {
                $sql = "INSERT INTO roles_usuarios (rol_id, usuario_id)
                VALUES (:rol_id, :usuario_id)";
                $args = array(
                    ":rol_id" => $id_rol,
                    ":usuario_id" => $this->id
                );
                $stmt = $this->executeQuery($sql, $args);
            }
        }

        foreach ($oldIdsRoles as $id_rol) {
            if ( ! in_array($id_rol, $idsRoles)) {
    			$sql = "DELETE FROM roles_usuarios
                WHERE rol_id=:rol_id AND usuario_id=:usuario_id";
    			$args = array(
    				":rol_id" => $id_rol,
    				":usuario_id" => $this->id
    			);
    			$stmt = $this->executeQuery($sql, $args);
            }
    	}

		return true;
    }

    /**
     * Retorna todos los roles del usuario.
     * @return [array] [roles -> array(id => nombre)]
     */
    public function getRoles()
    {
		$sql = "SELECT r.id as id, r.nombre as nombre FROM roles_usuarios as rs, roles as r
        WHERE rs.usuario_id=:id AND rs.rol_id = r.id";
		$args = array(
			":id" => $this->id
		);
		$stmt = parent::executeQuery($sql, $args);
		$r = $stmt? $stmt->fetchAll(PDO::FETCH_ASSOC) : array();
		return $r;
    }

    /**
     * Insertar una fila con la informacion de un usuario.
     * @return [boolean] [true o false]
     */
	public function insert()
	{
		$sql = "INSERT INTO usuarios (nombre, email, cedula, estado, password)
        VALUES (:nombre, :email, :cedula, :estado, :password)";
		$args = array(
			":nombre" => $this->nombre,
			":email" => $this->email,
			":cedula" => $this->cedula,
			":estado" => $this->estado,
			":password" => Helper::encriptar($this->password)
		);
		$stmt = $this->executeQuery($sql, $args);

		// $sql = "SELECT MAX(id) as id FROM usuarios";
		// $stmtAux = $this->executeQuery($sql, array());
		// $r = $stmtAux->fetchAll(PDO::FETCH_ASSOC);

		// if ($stmt){ $this->id = $r[0]["id"]; }

        if ($stmt) {
            $this->id = $this->getConnection()->lastInsertId();
        }

		return !$stmt ? false : true;
	}

    /**
     * Actualiza los datos de un usuario.
     * @return [boolean] [true o false]
     */
	public function update()
	{
		if ( ! $this->id ) {
			//echo "No se tiene referencia al ID del objeto a actulizar.";
			throw new Exception("No se tiene referencia al ID del objeto a actulizar.");
		}

		$sql = "UPDATE usuarios SET nombre=:nombre, email=:email, cedula=:cedula,
        estado=:estado, password=:password WHERE id=:id";
		$args = array(
			":id" => $this->id,
			":nombre" => $this->nombre,
			":email" => $this->email,
			":cedula" => $this->cedula,
			":estado" => $this->estado,
			":password" => Helper::encriptar($this->password)
		);
		$stmt = $this->executeQuery($sql, $args);

        return !$stmt ? false : true;
	}

    /**
     * Eliminar un usuario por su ID.
     * @return [boolean] [true o false]
     */
	public function delete()
	{
		$sql = "DELETE FROM roles_usuarios WHERE usuario_id=:usuario_id";
		$args = array(
			":usuario_id" => $this->id
		);
		$stmt = $this->executeQuery($sql, $args);

		$sql = "DELETE FROM usuarios WHERE id=:id";
		$args = array(
			":id" => $this->id
		);
		$stmt = $this->executeQuery($sql, $args);

		return !$stmt ? false : true;
	}

    /**
     * Buscar un usuario por su ID.
     * @param  [integer] $id [ID del usuario a consultar]
     * @return [UsuariosModel]     [usuario encontrado.]
     */
	public static function find($id)
	{
		$sql = "SELECT * FROM usuarios WHERE id=:id";
		$args = array(
			":id" => $id
		);
		$stmt = parent::executeQuery($sql, $args);
		$r = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($r && count($r) > 0) {
    		$newObj = new UsuariosModel();
    		$newObj->setId($r[0]["id"]);
    		$newObj->setNombre($r[0]["nombre"]);
    		$newObj->setEmail($r[0]["email"]);
    		$newObj->setCedula($r[0]["cedula"]);
    		$newObj->setEstado($r[0]["estado"]);
            $newObj->setPassword($r[0]["password"]);
    		$newObj->setFechaCreacion($r[0]["fecha_creacion"]);
            return $newObj;
        }

		return null;
	}

    /**
     * Consulta todos los usuarios creados en el sistema.
     * @return [array] [array de objetos UsuariosModel.]
     */
	public static function findAll()
	{
		$sql = "SELECT * FROM usuarios";
		$stmt = parent::executeQuery($sql, array());
		$r = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$result = array();

		foreach ($r as $row) {
			$newObj = new UsuariosModel();
			$newObj->setId($row["id"]);
			$newObj->setNombre($row["nombre"]);
			$newObj->setEmail($row["email"]);
			$newObj->setCedula($row["cedula"]);
			$newObj->setEstado($row["estado"]);
            $newObj->setPassword($row["password"]);
			$newObj->setFechaCreacion($row["fecha_creacion"]);
			array_push($result, $newObj);
		}

		return $result;
	}

    /**
     * Buscar un usuario por su email.
     * @param  [string] $email [email del usuario a consultar]
     * @return [UsuariosModel]     [usuario encontrado.]
     */
    public static function findForEmail($email)
    {
        $sql = "SELECT * FROM usuarios WHERE email=:email";
        $args = array(
            ":email" => $email
        );
        $stmt = parent::executeQuery($sql, $args);
        $r = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($r && count($r) > 0) {
            $newObj = new UsuariosModel();
            $newObj->setId($r[0]["id"]);
            $newObj->setNombre($r[0]["nombre"]);
            $newObj->setEmail($r[0]["email"]);
            $newObj->setCedula($r[0]["cedula"]);
            $newObj->setEstado($r[0]["estado"]);
            $newObj->setPassword($r[0]["password"]);
            $newObj->setFechaCreacion($r[0]["fecha_creacion"]);
            return $newObj;
        }

        return null;
    }

    /**
     * Retorna paginados todos los usurios creados en el sistema.
     * @param  [int] $pagina [numero de pagina]
     * @return [array]       [array de objetos]
     */
    public static function findAllPaginated($pagina)
    {
        $sql = "SELECT COUNT(*) as total_registros FROM usuarios";
        $stmt = parent::executeQuery($sql, array());
        $r = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $num_total_registros = $r[0]["total_registros"];

        //examino la página a mostrar y el inicio del registro a mostrar
        if (!$pagina) {
           $inicio = 0;
           $pagina = 1;
        }
        else {
           $inicio = ($pagina - 1) * self::TAMANO_PAGINA;
        }
        //calculo el total de páginas
        $total_paginas = ceil($num_total_registros / self::TAMANO_PAGINA);

        $sql = "SELECT id, nombre, email, cedula, estado, fecha_creacion FROM usuarios LIMIT ".$inicio."," . self::TAMANO_PAGINA;
        $stmt = parent::executeQuery($sql, array());
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = array(
            "pagina" => $pagina,
            "total_paginas" => $total_paginas,
            "num_total_registros" => $num_total_registros,
            "data" => $rs
        );

        return $result;
    }

    public static function getInformacionPaginado()
    {
        $sql = "SELECT COUNT(*) as total_registros FROM usuarios";
        $stmt = parent::executeQuery($sql, array());
        $r = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $num_total_registros = $r[0]["total_registros"];

        //calculo el total de páginas
        $total_paginas = ceil($num_total_registros / self::TAMANO_PAGINA);

        $result = array(
            "total_paginas" => $total_paginas,
            "num_total_registros" => $num_total_registros
        );

        return $result;        
    }

    public static function countActAndInact()
    {
        $sql = "SELECT estado, COUNT(*) as total FROM usuarios GROUP BY estado";
        $stmt = parent::executeQuery($sql, array());
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}