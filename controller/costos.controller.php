<?php

class ControllerCostos
{
  //  Mostrar todos los movimientos de gastos que se hicieron
  public static function ctrMostrarCostosFijos()
  {
    $tabla = "tba_costo";
    $listaCostos = ModelCostos::mdlMostrarAllCostosFijos($tabla);
    return $listaCostos;
  }

  //  Crear un nuevo costo fijo
  public static function ctrCrearNuevoCostoFijo()
  {
    if(isset($_POST["numeroDocumentoGastoFijo"]))
		{
      //  Ingresar primero la cabecera del costo
      $tablaCabecera = "tba_costo";
      $tablaDetalle = "tba_detallecosto";

      $datosCabecera = array(
        "IdSocio" => $_POST["socioGastoFijo"],
        "IdTipoCosto" => "1",
        "NumeroDocumento" => $_POST["numeroDocumentoGastoFijo"],
        "FechaCosto" => $_POST["fechaIngresoGastoFijo"],
        "SubTotalCosto" => $_POST["nuevoSubTotalGastoFijo"],
        "IGVCosto" => $_POST["nuevoImpuestoGastoFijo"],
        "TotalCosto" => $_POST["nuevoTotalGastoFijo"],
        "UsuarioCreado" => $_SESSION["idUsuario"],
        "UsuarioActualiza" => $_SESSION["idUsuario"],
        "FechaCreacion" => date("Y-m-d\TH:i:sP"),
        "FechaActualizacion" => date("Y-m-d\TH:i:sP"),
      );

      $respuestaCabecera = ModelCostos::mdlIngresarCostoFijo($tablaCabecera, $datosCabecera);
      $idUltimoCosto = ModelCostos::mdlObtenerUltimoID($tablaCabecera);

      //  Ingresar el detalle del costo luego de ingresar la cabecera
      if($respuestaCabecera = "ok")
      {
        //  Obtener todos los recursos registrados que se llenaron en el formulario para añadirlos al detalle
        $listaGastos = json_decode($_POST["listarGastosFijos"], true);

        foreach($listaGastos as $value)
        {
          $datosDetalle = array(
            "IdCosto" => $idUltimoCosto["Id"],
            "IdGasto" => $value["CodGasto"],
            "ObservacionGasto" => $value["Observacion"],
            "PrecioGasto" => $value["PrecioGasto"],
          );

          $respuestaDetalle = ModelCostos::mdlIngresarDetalleCostoFijo($tablaDetalle, $datosDetalle);
        }
        if($respuestaDetalle == "ok")
        {
          echo '
            <script>
              Swal.fire({
                icon: "success",
                title: "Correcto",
                text: "Costo Fijo registrado Correctamente!",
              }).then(function(result){
                if(result.value){
                  window.location = "index.php?ruta=costosfijos";
                }
              });
            </script>
          ';
        }
        else
        {
          echo '
            <script>
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "¡Error al registrar el detalle del costo!",
              }).then(function(result){
                if(result.value){
                  window.location = "index.php?ruta=costosfijos";
                }
              });
            </script>
          ';
        }
      }
      else
      {
        echo '
            <script>
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "¡Error al registrar la cabecera del costo!",
              }).then(function(result){
                if(result.value){
                  window.location = "index.php?ruta=costosfijos";
                }
              });
            </script>
          ';
      }
    }
  }

  //  Eliminar un costo cualquiera, primero se elimina el detalle y luego la cabecera
  public static function ctrEliminarCosto()
  {
    if (isset($_GET["codCosto"]))
    {
      $tablaCabecera = "tba_costo";
      $tablaDetalle = "tba_detallecosto";
      $codCosto = $_GET["codCosto"];
      
      $respuestaDetalle = ModelCostos::mdlEliminarDetalleCosto($tablaDetalle, $codCosto);

      if($respuestaDetalle == "ok")
      {
        $respuestaCabecera = ModelCostos::mdlEliminarCabeceraCosto($tablaCabecera, $codCosto);
        if($respuestaCabecera == "ok")
        {
          echo '
          <script>
            Swal.fire({
              icon: "success",
              title: "Correcto",
              text: "Costo Fijo eliminado Correctamente!",
            }).then(function(result){
              if(result.value){
                window.location = "index.php?ruta=costosfijos";
              }
            });
          </script>
          ';
        }
        else
        {
          echo '
          <script>
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "¡Error al eliminar el detalle del costo!",
            }).then(function(result){
              if(result.value){
                window.location = "index.php?ruta=costosfijos";
              }
            });
          </script>
          ';
        }
      }
      else
      {
        echo '
            <script>
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "¡Error al eliminar la cabecera del costo!",
              }).then(function(result){
                if(result.value){
                  window.location = "index.php?ruta=costosfijos";
                }
              });
            </script>
          ';
      }
    }
  }

  //  Obtener los datos de la cabecera del costo fijo para editarlos
  public static function ctrObtenerCabaceraGF($codCosto)
  {
    $tabla = "tba_costo";
    $datosCabecera = ModelCostos::mdlObtenerCabeceraGF($tabla, $codCosto);
    return $datosCabecera;
  }
}