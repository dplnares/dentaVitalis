<?php

require_once "../controller/pagos.controller.php";
require_once "../model/pagos.model.php";
require_once "../controller/tratamiento.controller.php";
require_once "../model/tratamiento.model.php";

class AjaxPagos
{
  //  Agregar nuevo pago
  public $codPaciente;
  public $tipoPago;
  public $montoDePago;
  public $fechaPago;

  public function ajaxAgregarNuevoPago()
  {
    $codPaciente = $this->codPaciente;
    $tipoPago = $this->tipoPago;
    $montoDePago = $this->montoDePago;
    $fechaPago = $this->fechaPago;
    $datosCreate = array(
      "IdPaciente" => $codPaciente,
      "IdTipoPago" => $tipoPago,
      "TotalPago" => $montoDePago,
      "FechaPago" => $fechaPago,
      "FechaCreacion" => date("Y-m-d\TH:i:sP"),
      "FechaActualizacion" => date("Y-m-d\TH:i:sP"),
    );
    $respuesta = ControllerPagos::ctrGenerarNuevoPago($datosCreate);

    echo json_encode($respuesta);
  }

  //  Mostrar datos para editar un pago
  public $codPagoEditar;
  public function ajaxEditarPago()
  {
    $codPagoEditar = $this->codPagoEditar;
    $respuesta = ControllerPagos::ctrMostrarDatosEditar($codPagoEditar);
    echo json_encode($respuesta);
  }
}

//  Agregar nuevo pago
if(isset($_POST["codPaciente"])){
	$agregarPago = new AjaxPagos();
	$agregarPago -> codPaciente = $_POST["codPaciente"];
  $agregarPago -> tipoPago = $_POST["tipoPago"];
  $agregarPago -> montoDePago = $_POST["montoDePago"];
  $agregarPago -> fechaPago = $_POST["fechaPago"];
	$agregarPago -> ajaxAgregarNuevoPago();
}

//  Mostrar los datos para editar un pago
if(isset($_POST["codPagoEditar"])){
  $editarPago = new AjaxPagos();
  $editarPago -> codPagoEditar = $_POST["codPagoEditar"];
  $editarPago -> ajaxEditarPago();
}

