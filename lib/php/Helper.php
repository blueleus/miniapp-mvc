<?php

/**
*   Helper para la conexion a la base de datos.
*/
class Helper
{
	public static function getUrl($mod, $fun, $args) {
		$url = "http://localhost/nexura/index.php?mod=".$mod."&fun=".$fun;
		foreach ($args as $key => $value) {
			$url .= $key."=".$value;
		}
		return $url;
	}
}