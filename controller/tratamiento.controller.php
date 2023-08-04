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

  //  Mostrar el total del tratamiento actual
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
}