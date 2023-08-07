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

  //  Eliminar un pago
  public static function ctrEliminarPago()
  {
    if (isset($_GET["codPago"]))
    {
      $tabla = "tba_pago";
      $codPago = $_GET["codPago"];
      $respuesta = ModelPacientes::mdlEliminarPaciente($tabla, $codPago);
      if($respuesta == "ok")
      {
        echo '
        <script>
          Swal.fire({
            icon: "success",
            title: "Correcto",
            text: "Paciente eliminado Correctamente!",
          }).then(function(result){
						if(result.value){
							window.location = "pacientes";
						}
					});
        </script>';
      }
    }
  }
}