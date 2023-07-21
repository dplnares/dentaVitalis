<?php

require_once "../controller/pacientes.controller.php";
require_once "../model/pacientes.model.php";

class AjaxPacientes
{
  //  Editar Socio
  public $codPaciente;
  public function ajaxEditarPaciente()
  {
    $codPaciente = $this->codPaciente;
    $respuesta = ControllerPacientes::ctrMostrarDatosEditar($codPaciente);
    echo json_encode($respuesta);
  }
}

//  Editar socio
if(isset($_POST["codPaciente"])){
	$editarSocio = new AjaxPacientes();
	$editarSocio -> codPaciente = $_POST["codPaciente"];
	$editarSocio -> ajaxEditarPaciente();
}
