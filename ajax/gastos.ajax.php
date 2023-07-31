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

  public $codGastoAgregar;
  public function ajaxAgregarGasto()
  {
    $codGastoAgregar = $this->codGastoAgregar;
    $respuesta = ControllerGastos::ctrAgregarGasto($codGastoAgregar);
    echo json_encode($respuesta);
  }

  //  Modal para mostrar los gastos por un centro de costos
  public $codCCostosModal;
  public function ajaxMostrarGastosPorCentro()
  {
    $codCCostosModal = $this->codCCostosModal;
    $listaGastos = ControllerGastos::ctrNostrarGastosCentro($codCCostosModal);
    echo json_encode($listaGastos);
    /*foreach($listaGastos as $key => $value)
    {
      $contenidoModal = ('
          <tr>
          <td>'.($key + 1).'</td>
          <td>'.$value["NombreGasto"].'</td>
          <td>
            <div class="btn-group">
              <button class="btn btn-primary btnAgregarGasto recuperarBoton" codGasto="'.$value["IdGasto"].'">Agregar</button> 
            </div>
          </td>
        </tr>
      ');
    }
    echo $contenidoModal;*/
  }
}

//  Editar usuario
if(isset($_POST["codGasto"])){
	$editarGasto = new AjaxGastos();
	$editarGasto -> codGasto = $_POST["codGasto"];
	$editarGasto -> ajaxEditarGasto();
}

//  Agregar Gasto a guia de nuevo gasto
if(isset($_POST["codGastoAgregar"])){
	$agregarGastoFijo = new AjaxGastos();
	$agregarGastoFijo -> codGastoAgregar = $_POST["codGastoAgregar"];
	$agregarGastoFijo -> ajaxAgregarGasto();
}

//  Mostrar los gastos por el centro de costos
if(isset($_POST["codCCostosModal"])){
	$mostrarModalCentro = new AjaxGastos();
	$mostrarModalCentro -> codCCostosModal = $_POST["codCCostosModal"];
	$mostrarModalCentro -> ajaxMostrarGastosPorCentro();
}