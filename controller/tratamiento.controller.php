<?php

class ControllerTratamiento
{
  //  Crear un nuevo tratamiento
  public static function ctrCrearTratamiento($datosCreateTratamiento)
  {
    $tabla = "tba_tratamiento";
    $respuesta = ModelTratamiento::mdlCrearTratamiento($tabla, $datosCreateTratamiento);
    return $respuesta;
  }

  //  Obtener el último tratamiento creado
  public static function ctrObtenerUltimoTratamiento()
  {
    $tabla = "tba_tratamiento";
    $respuesta = ModelTratamiento::mdlObtenerUltimoTratamiento($tabla);
    return $respuesta;
  }

  //  Obtener el tratamiento de un paciente en específico
  public static function ctrObtenerIdTratamiento($codPaciente)
  {
    $tabla = "tba_tratamiento";
    $respuesta = ModelTratamiento::mdlObtenerIdTratamiento($tabla, $codPaciente);
    return $respuesta;
  }

  //  Crear el detalle del tratamiento
  public static function ctrCrearDetalleTratamiento($datosDetalleTratamiento)
  {
    $tabla = "tba_detalletratamiento";
    $respuesta = ModelTratamiento::mdlCrearDetalleTratamiento($tabla, $datosDetalleTratamiento);
    return $respuesta;
  }

  //  Update del precio del tratamiento segun el los procedimientos
  public static function ctrUpdatePrecioTratamiento($codTratamiento, $totalTratamiento)
  {
    $tabla = "tba_tratamiento";
    $respuesta = ModelTratamiento::mdlUpadatePrecioTratamiento($tabla, $codTratamiento, $totalTratamiento);
    return $respuesta;
  }

  //  Mostrar el total del tratamiento actual por el codigo de tratamiento
  public static function ctrMostrarTotalTratamiento($codTratamiento)
  {
    $tabla = "tba_tratamiento";
    $respuesta = ModelTratamiento::mdlMostrarTotalTratamiento($tabla, $codTratamiento);
    return $respuesta;
  }
  
  //  Mostrar la lista de procedimientos de una historia
  public static function ctrMostrarDetalleTratamiento($codHistoria)
  {
    $tabla = "tba_detalletratamiento";
    $respuesta = ModelTratamiento::mdlMostrarDetalleTratamiento($tabla, $codHistoria);
    return $respuesta;
  }

  //  Mostrar la lista de procedimientos completa
  public static function ctrMostrarDetalleTratamientoCompleto($codHistoria)
  {
    $tabla = "tba_detalletratamiento";
    $respuesta = ModelTratamiento::mdlMostrarDetalleTratamientoCompleto($tabla, $codHistoria);
    return $respuesta;
  }

  //  Eliminar todo el detalle del tratamiento del tratamiento al editar el detalle de la historia clínica
  public static function ctrEliminarTodoDetalle($codTratamiento)
  {
    $tabla = "tba_detalletratamiento";
    $respuesta = ModelTratamiento::mdlEliminarTodoDetalle($tabla, $codTratamiento);
    return $respuesta;
  }

  //  Obtener el codigo del tratamiento
  public static function ctrObtenerCodigoTratamiento($codPaciente)
  {
    $tabla = "tba_tratamiento";
    $respuesta = ModelTratamiento::mdlObtenerCodTratamiento($tabla, $codPaciente);
    return $respuesta;
  }

  //  Editar el plan de tratamiento
  public static function ctrEditarPlanTratamiento()
  {
    if(isset($_POST["listarProcedimientos"]))
    {
      $listaProcedimientos = $_POST["listaProcedimientos"];
      $codPaciente = $_POST["codPaciente"];
      $idTratamiento = ControllerTratamiento::ctrObtenerIdTratamiento($codPaciente);

      if($listaProcedimientos != null)
      {
        //  Actualizamos el total del tratamiento y luego eliminamos los tratamientos actuales para volver a crearlos
        $updateTratamiento = ControllerTratamiento::ctrUpdatePrecioTratamiento($idTratamiento["IdTratamiento"], $_POST["nuevoTotalTratamiento"]);
        $eliminarListaProcedimientos = ControllerTratamiento::ctrEliminarTodoDetalle($idTratamiento["IdTratamiento"]);
        if($eliminarListaProcedimientos == "ok")
        {
          foreach($listaProcedimientos as $value)
          {
            $datosDetalleTratamiento = array(
              "IdTratamiento" => $idTratamiento["IdTratamiento"],
              "IdProcedimiento" => $value["CodProcedimiento"],
              "ObservacionProcedimiento" => $value["ObservacionProcedimiento"],
              "EstadoTratamiento" => "1",
              "PrecioProcedimiento" => $value["PrecioProcedimiento"],
              "UsuarioCreado" => $_SESSION["idUsuario"],
              "UsuarioActualizado" => $_SESSION["idUsuario"],
              "FechaCreado" => date("Y-m-d\TH:i:sP"),
              "FechaActualiza" => date("Y-m-d\TH:i:sP"),
            );
            $updateDetalleTratamiento = ControllerTratamiento::ctrCrearDetalleTratamiento($datosDetalleTratamiento);
          }
          
        }
      }
      else
      {

      }
    }
  }
}