<?php

require_once "../controller/procedimientos.controller.php";
require_once "../model/procedimientos.model.php";

class AjaxProcedimientos
{
  //  Editar Procedimiento
  public $codProcedimiento;
  public function ajaxEditarProcedimiento()
  {
    $codProcedimiento = $this->codProcedimiento;
    $respuesta = ControllerProcedimientos::ctrMostrarDatosEditar($codProcedimiento);
    echo json_encode($respuesta);
  }
}

//  Editar Procedimiento
if(isset($_POST["codProcedimiento"])){
	$editarSocio = new AjaxProcedimientos();
	$editarSocio -> codProcedimiento = $_POST["codProcedimiento"];
	$editarSocio -> ajaxEditarProcedimiento();
}
