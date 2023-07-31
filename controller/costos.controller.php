<?php

class ControllerCostos
{
  //  Mostrar los centros de costos
  public static function ctrMostrarCentrosCostos()
  {
    $tabla = "tba_centrocostos";
    $respuesta = ModelCostos::mdlMostrarCentrosCostos($tabla);
    return $respuesta;
  }

  //  crear un nuevo centro de costos
  public static function ctrCrearCentroCostos()
  {
    if(isset($_POST["nombreCentroCostos"]))
    {
      $tabla = "tba_centrocostos";
      $datosCreate = array(
        "DescripcionCentro" => $_POST["nombreCentroCostos"],
        "FechaCreacion" => date("Y-m-d\TH:i:sP"),
        "FechaActualizacion" => date("Y-m-d\TH:i:sP")
      );

      $respuestaCrear = ModelCostos::mdlCrearCentroCostos($tabla, $datosCreate);
      if($respuestaCrear == "ok")
      {
        echo '
        <script>
          Swal.fire({
            icon: "success",
            title: "Correcto",
            text: "¡Centro de costos creado Correctamente!",
          }).then(function(result){
						if(result.value){
							window.location = "centroCostos";
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
            text: "¡Error al crear un Centro de Costos!",
          }).then(function(result){
						if(result.value){
							window.location = "centroCostos";
						}
					});
        </script>';
      }
    }
  }

  //  Editar un centro de costos
  public static function ctrEditarCentroCostos()
  {
    if(isset($_POST["editarNombreCentro"]))
    {
      $tabla = "tba_centrocostos";
      $datosUpdate = array(
        "IdCentroCostos" => $_POST["codCentroCosto"],
        "DescripcionCentro" => $_POST["editarNombreCentro"],
        "FechaActualizacion" => date("Y-m-d\TH:i:sP")
      );

      $respuestaUpdate = ModelCostos::mdlEditarCentroCostos($tabla, $datosUpdate);
      if($respuestaUpdate == "ok")
      {
        echo '
        <script>
          Swal.fire({
            icon: "success",
            title: "Correcto",
            text: "¡Centro de costos editado Correctamente!",
          }).then(function(result){
						if(result.value){
							window.location = "centroCostos";
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
            text: "¡Error al editar un Centro de Costos!",
          }).then(function(result){
						if(result.value){
							window.location = "centroCostos";
						}
					});
        </script>';
      }
    }
  }

  //  Eliminar un centro de costos
  public static function ctrEliminarCentroCostos()
  {
    if(isset($_GET["codCentroCosto"]))
    {
      $tabla = "tba_centrocostos";
      $codCentro = $_GET["codCentroCosto"];
      $respuesta = ModelCostos::mdlEliminarCentroCostos($tabla, $codCentro);
      if($respuesta == "ok")
      {
        echo '
        <script>
          Swal.fire({
            icon: "success",
            title: "Correcto",
            text: "Socio eliminado Correctamente!",
          }).then(function(result){
						if(result.value){
							window.location = "centroCostos";
						}
					});
        </script>';
      }
    }
  }

  //  Mostrar los datos a editar en el modal
  public static function ctrMostrarDatosEditar($codCentroCosto)
  {
    $tabla = "tba_centrocostos";
    $respuesta = ModelCostos::mdlMostrarDatosEditar($tabla, $codCentroCosto);
    return $respuesta;
  }

  //  Mostrar todos los costos
  public static function ctrMostrarTodosCostos()
  {
    return [];
  }

  //  Crear un nuevo costo
  public static function ctrCrearNuevoCosto()
  {
    
  }
}