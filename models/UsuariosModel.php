<?php

require_once dirname(__FILE__)."/../lib/config/PDORepository.php";

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

	public function insert()
	{
		$sql = "INSERT INTO usuarios (nombre, email, cedula, estado, password) VALUES (:nombre, :email, :cedula, :estado, :password)";
		$args = array(
			":nombre" => $this->nombre, 
			":email" => $this->email, 
			":cedula" => $this->cedula, 
			":estado" => $this->estado, 
			":password" => $this->password
		);
		$stmt = $this->executeQuery($sql, $args);

		return !$stmt ? false : true;
	}

	public function update()
	{
		if ( ! $this->id ) {
			echo "No se tiene referencia del id del objeto a actulizar.";
			return false;
		} 

		$sql = "UPDATE usuarios SET nombre=:nombre, email=:email, cedula=:cedula, estado=:estado, password=:password WHERE id=:id";
		$args = array(
			":id" => $this->id,
			":nombre" => $this->nombre, 
			":email" => $this->email, 
			":cedula" => $this->cedula, 
			":estado" => $this->estado, 
			":password" => $this->password
		);
		$stmt = $this->executeQuery($sql, $args);

		return !$stmt ? false : true;
	}

	public function delete()
	{
		$sql = "DELETE FROM usuarios WHERE id=:id";
		$args = array(
			":id" => $this->id
		);
		$stmt = $this->executeQuery($sql, $args);

		return !$stmt ? false : true;		
	}

	public static function find($id)
	{
		$sql = "SELECT * FROM usuarios WHERE id=:id";
		$args = array(
			":id" => $id
		);
		$stmt = parent::executeQuery($sql, $args);
		$r = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$newObj = new UsuariosModel();
		$newObj->setId($r[0]["id"]);
		$newObj->setNombre($r[0]["nombre"]); 
		$newObj->setEmail($r[0]["email"]);
		$newObj->setCedula($r[0]["cedula"]); 
		$newObj->setEstado($r[0]["estado"]); 
		$newObj->setPassword($r[0]["password"]);
		return $newObj;
	}

	public static function findAll()
	{
		$sql = "SELECT * FROM usuarios";
		$stmt = $this->executeQuery($sql, array());
		$r = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$result = array();

		foreach ($row as $r) {
			$newObj = new UsuariosModel();
			$newObj->setId($r[0]["id"]);
			$newObj->setNombre($r[0]["nombre"]); 
			$newObj->setEmail($r[0]["email"]);
			$newObj->setCedula($r[0]["cedula"]); 
			$newObj->setEstado($r[0]["estado"]); 
			$newObj->setPassword($r[0]["password"]);
			array_push($result, $newObj);
		}

		return $result;		
	}
}