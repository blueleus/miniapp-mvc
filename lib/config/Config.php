<?php

/**
* Configuracion de la base de datos.
*/
class Config
{
	private static $host = 'localhost';
	private static $user = 'root';
	private static $password = 'root';
	private static $database = 'nexura';

	public static function getHost(){
		return Config::$host;
	}

	public static function getUser(){
		return Config::$user;
	}

	public static function getPassword(){
		return Config::$password;
	}

	public static function getDatabase(){
		return Config::$database;
	}

	public static function getPermission() {
		return array(
			"login" => array(
				"usuarios" => array("editar", "buscar", "eliminar", "listar"),
				"roles" => array("crear", "editar", "buscar", "eliminar", "listar")
			)
		);
	}
}