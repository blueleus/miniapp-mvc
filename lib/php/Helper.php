<?php

/**
*   Helper para la conexion a la base de datos.
*/
class Helper
{
	public static function getUrl($mod, $fun, $args) {
		$url = "http://localhost/nexura/index.php?mod=".$mod."&fun=".$fun;
		foreach ($args as $key => $value) {
			$url .= "&".$key."=".$value;
		}
		return $url;
	}

    public static function encriptar($value)
    {
        return md5($value);
    }

    public static function getPathView($mod, $view)
    {
        //return $_SERVER['DOCUMENT_ROOT']."/nexura/views/".$mod."/".$view.".php";
        return __DIR__."/../../views/".$mod."/".$view.".php";
    }

    public static function getPathUpload()
    {
        //return $_SERVER['DOCUMENT_ROOT']."/nexura/web/upload/";
        return __DIR__."/../../web/upload/";
    }

    public static function getView($mod, $view, $args=array())
    {
        foreach ($args as $key => $value) {
            $$key = $value;
        }
        return include __DIR__."/../../views/template.php";
    }
}