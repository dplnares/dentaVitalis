<?php

require_once "../controller/costos.controller.php";
require_once "../model/costos.model.php";

class AjaxCostos
{
  //  Editar Centro Costos
  public $codCentroCosto;
  public function ajaxEditarCentro()
  {
    $codCentroCosto = $this->codCentroCosto;
    $respuesta = ControllerCostos::ctrMostrarDatosEditar($codCentroCosto);
    echo json_encode($respuesta);
  }
}

//  Editar Centro Costos
if(isset($_POST["codCentroCosto"])){
	$editarCentroCostos = new AjaxCostos();
	$editarCentroCostos -> codCentroCosto = $_POST["codCentroCosto"];
	$editarCentroCostos -> ajaxEditarCentro();
}
