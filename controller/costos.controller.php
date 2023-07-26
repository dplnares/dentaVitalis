<?php

class ControllerCostos
{
  //  Mostrar todos los movimientos de gastos que se hicieron
  public static function ctrMostrarCostosFijos($codTipoCosto)
  {
    $tabla = "tba_costo";
    $listaCostos = ModelCostos::mdlMostrarAllCostosFijos($tabla, $codTipoCosto);
    return $listaCostos;
  }

  //  Mostrar todos los costos variables
  public static function ctrMostrarCostosVariables($codTipoCosto)
  {
    $tabla = "tba_costo";
    $listaCostos = ModelCostos::mdlMostrarAllCostosVariables($tabla,$codTipoCosto);
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
        "SubTotalCosto" => $_POST["nuevoSubTotalGasto"],
        "IGVCosto" => $_POST["nuevoImpuestoGasto"],
        "TotalCosto" => $_POST["nuevoTotalGasto"],
        "UsuarioCreado" => $_SESSION["idUsuario"],
        "UsuarioActualiza" => $_SESSION["idUsuario"],
        "FechaCreacion" => date("Y-m-d\TH:i:sP"),
        "FechaActualizacion" => date("Y-m-d\TH:i:sP"),
      );

      $respuestaCabecera = ModelCostos::mdlIngresarCostoFijo($tablaCabecera, $datosCabecera);
      $idUltimoCosto = ModelCostos::mdlObtenerUltimoID($tablaCabecera);

      //  Ingresar el detalle del costo luego de ingresar la cabecera
      if($respuestaCabecera == "ok")
      {
        //  Obtener todos los recursos registrados que se llenaron en el formulario para añadirlos al detalle
        $listaGastos = json_decode($_POST["listarGastos"], true);

        foreach($listaGastos as $value)
        {
          $datosDetalle = array(
            "IdCosto" => $idUltimoCosto["Id"],
            "IdGasto" => $value["CodGasto"],
            "ObservacionGasto" => $value["Observacion"],
            "PrecioGasto" => $value["PrecioGasto"],
          );
          $respuestaDetalle = ModelCostos::mdlIngresarDetalleCosto($tablaDetalle, $datosDetalle);
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

  //  Crear un nuevo costo variable
  public static function ctrCrearNuevoCostoVariable()
  {
    if(isset($_POST["numeroDocumentoGastoVariable"]))
		{
      //  Ingresar primero la cabecera del costo
      $tablaCabecera = "tba_costo";
      $tablaDetalle = "tba_detallecosto";

      $datosCabecera = array(
        "NombreProveedor" => $_POST["nombreProveedorGastoVariable"],
        "IdTipoCosto" => "2",
        "NumeroDocumento" => $_POST["numeroDocumentoGastoVariable"],
        "FechaCosto" => $_POST["fechaIngresoGastoVariable"],
        "SubTotalCosto" => $_POST["nuevoSubTotalGasto"],
        "IGVCosto" => $_POST["nuevoImpuestoGasto"],
        "TotalCosto" => $_POST["nuevoTotalGasto"],
        "UsuarioCreado" => $_SESSION["idUsuario"],
        "UsuarioActualiza" => $_SESSION["idUsuario"],
        "FechaCreacion" => date("Y-m-d\TH:i:sP"),
        "FechaActualizacion" => date("Y-m-d\TH:i:sP"),
      );

      $respuestaCabecera = ModelCostos::mdlIngresarCostoVariable($tablaCabecera, $datosCabecera);
      $idUltimoCosto = ModelCostos::mdlObtenerUltimoID($tablaCabecera);

      //  Ingresar el detalle del costo luego de ingresar la cabecera
      if($respuestaCabecera == "ok")
      {
        //  Obtener todos los recursos registrados que se llenaron en el formulario para añadirlos al detalle
        $listaGastos = json_decode($_POST["listarGastos"], true);

        foreach($listaGastos as $value)
        {
          $datosDetalle = array(
            "IdCosto" => $idUltimoCosto["Id"],
            "IdGasto" => $value["CodGasto"],
            "ObservacionGasto" => $value["Observacion"],
            "PrecioGasto" => $value["PrecioGasto"],
          );
          $respuestaDetalle = ModelCostos::mdlIngresarDetalleCosto($tablaDetalle, $datosDetalle);
        }
        if($respuestaDetalle == "ok")
        {
          echo '
            <script>
              Swal.fire({
                icon: "success",
                title: "Correcto",
                text: "Costo Variable registrado Correctamente!",
              }).then(function(result){
                if(result.value){
                  window.location = "index.php?ruta=costosvariables";
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
                  window.location = "index.php?ruta=costosvariables";
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
                  window.location = "index.php?ruta=costosvariables";
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

  //  Obtener los datos de la cabecera del costo fijo para editarlos
  public static function ctrObtenerCabaceraGV($codCosto)
  {
    $tabla = "tba_costo";
    $datosCabecera = ModelCostos::mdlObtenerCabeceraGV($tabla, $codCosto);
    return $datosCabecera;
  }

  //  Obtener el listado de costos de un costo fijo
  public static function ctrObtenerDetalleGF($codCosto)
  {
    $tabla = "tba_detallecosto";
    $listaDetalle = ModelCostos::mdlObtenerDetalleGF($tabla, $codCosto);
    return $listaDetalle;
  }

  //  Editar costo fijo
  public static function ctrEditaroCostoFijo()
  {
    if(isset($_POST["listarGastos"]))
		{
      $tablaCabecera = "tba_costo";
      $tablaDetalle = "tba_detallecosto";
      $codCosto = $_POST["codCosto"];
      $listaDetalle = json_decode($_POST["listarGastos"], true);

      //  Recoge la lista de la vista editar, si no se modificó ningún dato del detalle, enviará un null, por lo cual si es null, no será necesario eliminar y luego agregar un nuevo detalle. En caso si tenga datos la lista, se eliminara la lista existente y creará un nuevo detalle
      if($listaDetalle != null)
      {
        $eliminarDetalle = ModelCostos::mdlEliminarDetalleCosto($tablaDetalle, $codCosto);
      }
      else
      {
        $eliminarDetalle = "error";
        $respuestaDetalle = "ok";
      }

      if($eliminarDetalle == "ok")
      {
        foreach($listaDetalle as $value)
        {
          $datosDetalle = array(
            "IdCosto" => $codCosto,
            "IdGasto" => $value["CodGasto"],
            "ObservacionGasto" => $value["Observacion"],
            "PrecioGasto" => $value["PrecioGasto"],
          );
          $respuestaDetalle = ModelCostos::mdlIngresarDetalleCosto($tablaDetalle, $datosDetalle);
        }
      }
        
      if($respuestaDetalle == "ok")
      {
        $datosCabecera = array(
          "IdCosto" => $codCosto,
          "IdSocio" => $_POST["editarSocioGastoFijo"],
          "NumeroDocumento" => $_POST["editarNumeroDocumentoGastoFijo"],
          "FechaCosto" => $_POST["editarFechaIngresoGastoFijo"],
          "SubTotalCosto" => $_POST["nuevoSubTotalGasto"],
          "IGVCosto" => $_POST["nuevoImpuestoGasto"],
          "TotalCosto" => $_POST["nuevoTotalGasto"],
          "UsuarioActualiza" => $_SESSION["idUsuario"],
          "FechaActualizacion" => date("Y-m-d\TH:i:sP"),
        );

        $respuestaCabecera = ModelCostos::mdlEditarCabeceraCostoFijo($tablaCabecera, $datosCabecera);
        if($respuestaCabecera == "ok")
        {
          echo '
          <script>
            Swal.fire({
              icon: "success",
              title: "Correcto",
              text: "Costo Fijo editado Correctamente!",
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
                text: "¡Error al editar la cabecera del costo!",
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
              text: "¡Error al editar el detalle del costo!",
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

  //  Editar costo variable
  public static function ctrEditaroCostoVariable()
  {
    if(isset($_POST["listarGastos"]))
		{
      $tablaCabecera = "tba_costo";
      $tablaDetalle = "tba_detallecosto";
      $codCosto = $_POST["codCosto"];
      $listaDetalle = json_decode($_POST["listarGastos"], true);

      //  Recoge la lista de la vista editar, si no se modificó ningún dato del detalle, enviará un null, por lo cual si es null, no será necesario eliminar y luego agregar un nuevo detalle. En caso si tenga datos la lista, se eliminara la lista existente y creará un nuevo detalle
      if($listaDetalle != null)
      {
        $eliminarDetalle = ModelCostos::mdlEliminarDetalleCosto($tablaDetalle, $codCosto);
      }
      else
      {
        $eliminarDetalle = "error";
        $respuestaDetalle = "ok";
      }

      if($eliminarDetalle == "ok")
      {
        foreach($listaDetalle as $value)
        {
          $datosDetalle = array(
            "IdCosto" => $codCosto,
            "IdGasto" => $value["CodGasto"],
            "ObservacionGasto" => $value["Observacion"],
            "PrecioGasto" => $value["PrecioGasto"],
          );
          $respuestaDetalle = ModelCostos::mdlIngresarDetalleCosto($tablaDetalle, $datosDetalle);
        }
      }
        
      if($respuestaDetalle == "ok")
      {
        $datosCabecera = array(
          "IdCosto" => $codCosto,
          "NombreProveedor" => $_POST["editarNombreProveedorGastoVariable"],
          "NumeroDocumento" => $_POST["editarNumeroDocumentoGastoVariable"],
          "FechaCosto" => $_POST["editarFechaIngresoGastoVariable"],
          "SubTotalCosto" => $_POST["nuevoSubTotalGasto"],
          "IGVCosto" => $_POST["nuevoImpuestoGasto"],
          "TotalCosto" => $_POST["nuevoTotalGasto"],
          "UsuarioActualiza" => $_SESSION["idUsuario"],
          "FechaActualizacion" => date("Y-m-d\TH:i:sP"),
        );

        $respuestaCabecera = ModelCostos::mdlEditarCabeceraCostoVariable($tablaCabecera, $datosCabecera);
        if($respuestaCabecera == "ok")
        {
          echo '
          <script>
            Swal.fire({
              icon: "success",
              title: "Correcto",
              text: "Costo Fijo editado Correctamente!",
            }).then(function(result){
              if(result.value){
                window.location = "index.php?ruta=costosvariables";
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
                text: "¡Error al editar la cabecera del costo!",
              }).then(function(result){
                if(result.value){
                  window.location = "index.php?ruta=costosvariables";
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
              text: "¡Error al editar el detalle del costo!",
            }).then(function(result){
              if(result.value){
                window.location = "index.php?ruta=costosvariables";
              }
            });
          </script>
        ';
      }

    }
  }

}