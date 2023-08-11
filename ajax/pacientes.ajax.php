<?php

require_once "../controller/pacientes.controller.php";
require_once "../model/pacientes.model.php";
require_once "../controller/historias.controller.php";
require_once "../model/historias.model.php";

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

  //  Devolver los datos del paciente parar mostrar en el formulario de la historia
  public $codPacienteHistoria;
  public function ajaxMostrarDatosPaciente()
  {
    $codPacienteHistoria = $this->codPacienteHistoria;
    $respuesta = ControllerPacientes::ctrMostrarDatosUnPaciente($codPacienteHistoria);
    echo json_encode($respuesta);
  }

  //  Buscar al paciente por el número del DNI
  public $numeroDNI;
  public function ajaxBuscarDNI()
  {
    $numeroDNI = $this->numeroDNI;
    $respuesta = ControllerPacientes::ctrBuscarPacienteDNI($numeroDNI);
    echo json_encode($respuesta);
  }

  public $numeroDNIBuscar;
  public function ajaxBuscarPacienteDNI()
  {
    $numeroDNIBuscar = $this->numeroDNIBuscar;
    $respuesta = ControllerPacientes::ctrVerificarNumeroDNI($numeroDNIBuscar);
    echo json_encode($respuesta);
  }
}

//  Editar socio
if(isset($_POST["codPaciente"])){
	$editarSocio = new AjaxPacientes();
	$editarSocio -> codPaciente = $_POST["codPaciente"];
	$editarSocio -> ajaxEditarPaciente();
}

//  Mostrar datos paciente
if(isset($_POST["codPacienteHistoria"])){
	$mostrarDatos = new AjaxPacientes();
	$mostrarDatos -> codPacienteHistoria = $_POST["codPacienteHistoria"];
	$mostrarDatos -> ajaxMostrarDatosPaciente();
}

//  Buscar al paciente por el número del DNI
if(isset($_POST["numeroDNI"])){
	$mostrarDatos = new AjaxPacientes();
	$mostrarDatos -> numeroDNI = $_POST["numeroDNI"];
	$mostrarDatos -> ajaxBuscarDNI();
}

//  Buscar al paciente por el número del DNI para crear una nueva historia
if(isset($_POST["numeroDNIBuscar"])){
	$verificarDNI = new AjaxPacientes();
	$verificarDNI -> numeroDNIBuscar = $_POST["numeroDNIBuscar"];
	$verificarDNI -> ajaxBuscarPacienteDNI();
}