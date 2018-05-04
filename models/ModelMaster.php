<?php

require_once dirname(__FILE__)."/../helpers/helperDB.php";

/**
*
*/
class ModelMaster
{
    private $table;

    public function insert($args)
    {
        $sql = "INSERT INTO $table ()";
    }

    public function update($args)
    {
        # code...
    }

    public function delete($id)
    {
        # code...
    }

    public function select($id)
    {
        # code...
    }

    public function selectAll()
    {
        # code...
    }
}