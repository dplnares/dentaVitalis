<?php

class Conexion
{
  static public function conn()
  {
    $link = new PDO("mysql:host=localhost;dbname=db_dentavitalis","root","");
    //$link = new PDO("mysql:host=localhost;dbname=id21073291_db_dentavitalis","id21073291_root","Pokerface?8");
		$link->exec("set names utf8");
		return $link;
  }
}