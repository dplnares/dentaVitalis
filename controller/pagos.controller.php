<?php

class ControllerPagos
{
  //  Mostrar todo los pagos realizados hasta el momento
  public static function ctrMostrarTodosLosPagos()
  {
    $tabla = "tba_pago";
    $listaPagos = ModelPagos::mdlMostrarTodosLosPagos($tabla);
    return $listaPagos;
  }

  //  Mostrar los tipos de pagos
  public static function ctrMostrarTiposPago()
  {
    $tabla = "tba_tipodepago";
    $listaTiposPago = ModelPagos::mdlMostrarTiposDePago($tabla);
    return $listaTiposPago;
  }

  //  Generar un nuevo pago
  public static function ctrGenerarNuevoPago($datosCreate)
  {
    $tabla = "tba_pago";
    $respuesta = ModelPagos::mdlIngresarNuevoPago($tabla, $datosCreate);
    return $respuesta;
  }

  //  Eliminar un pago
  public static function ctrEliminarPago()
  {
    if (isset($_GET["codPago"]))
    {
      $tabla = "tba_pago";
      $codPago = $_GET["codPago"];
      $respuesta = ModelPagos::mdlEliminarPago($tabla, $codPago);
      if($respuesta == "ok")
      {
        echo '
        <script>
          Swal.fire({
            icon: "success",
            title: "Correcto",
            text: "Pago Eliminado Correctamente!",
          }).then(function(result){
						if(result.value){
							window.location = "historialPagos";
						}
					});
        </script>';
      }
    }
  }

  //  Mostrar los datos para editar un pago
  public static function ctrMostrarDatosEditar($codPagoEditar)
  {
    $tabla = "tba_pago";
    $datosEditar = ModelPagos::mdlMostrarDatosEditar($tabla, $codPagoEditar);
    return $datosEditar;
  }
  
  //  Editar Pago
  public static function ctrEditarPago()
  {
    if(isset($_POST["codPacienteEditado"]))
    {
      $tabla = "tba_pago";
      $datosUpdate = array(
        "IdPaciente" =>  $_POST["codPacienteEditado"],
        "IdTipoPago" => $_POST["editarTipoPago"],
        "TotalPago" => $_POST["editarMontoPago"],
        "FechaPago" => $_POST["editarFechaPago"],
        "FechaActualizacion"=>date("Y-m-d\TH:i:sP"),
        "IdPago" => $_POST["codPagoEdit"],
      );

      $respuesta = ModelPagos::mdlUpdatePago($tabla, $datosUpdate);
      if($respuesta == "ok")
      {
        echo '
        <script>
          Swal.fire({
            icon: "success",
            title: "Correcto",
            text: "Pago Editado Correctamente!",
          }).then(function(result){
            if(result.value){
              window.location = "historialPagos";
            }
          });
        </script>';
      }
      else
      {
        echo '
        <script>
          Swal.fire({
            icon: "error",
            title: "Error",
            text: "¡Error al intentar editar el Pago!",
          }).then(function(result){
            if(result.value){
              window.location = "historialPagos";
            }
          });
        </script>';
      }
    }
  }
}