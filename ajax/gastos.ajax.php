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

  public $codGastoFijo;
  public function ajaxAgregarGastoFijo()
  {
    $codGastoFijo = $this->codGastoFijo;
    $respuesta = ControllerGastos::ctrAgregarGastoFijo($codGastoFijo);
    echo json_encode($respuesta);
  }
}

//  Editar usuario
if(isset($_POST["codGasto"])){
	$editarGasto = new AjaxGastos();
	$editarGasto -> codGasto = $_POST["codGasto"];
	$editarGasto -> ajaxEditarGasto();
}

//  Agregar Gasto a guia de nuevo gasto fijo
if(isset($_POST["codGastoFijo"])){
	$agregarGastoFijo = new AjaxGastos();
	$agregarGastoFijo -> codGastoFijo = $_POST["codGastoFijo"];
	$agregarGastoFijo -> ajaxAgregarGastoFijo();
}