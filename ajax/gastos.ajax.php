<?php

require_once "../controller/gastos.controller.php";
require_once "../model/gastos.model.php";

class AjaxGastos
{
  //  Editar Usuario
  public $codGasto;
  public function ajaxEditarGasto()
  {
    $codGasto = $this->codGasto;
    $respuesta = ControllerGastos::ctrMostrarDatosEditar($codGasto);
    echo json_encode($respuesta);
  }
}

//  Editar usuario
if(isset($_POST["codGasto"])){
	$editarGasto = new AjaxGastos();
	$editarGasto -> codGasto = $_POST["codGasto"];
	$editarGasto -> ajaxEditarGasto();
}
