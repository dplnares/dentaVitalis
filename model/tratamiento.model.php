<?php
require_once "conexion.php";

class ModelTratamiento
{
  //  Crear un nuevo tratamiento
  public static function mdlCrearTratamiento($tabla, $datosCreateTratamiento)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdHistoriaClinica, IdPaciente, UsuarioCreado, UsuarioActualiza, FechaCreacion, FechaActualizacion) VALUES(:IdHistoriaClinica, :IdPaciente, :UsuarioCreado, :UsuarioActualiza, :FechaCreacion, :FechaActualizacion)");
    $statement -> bindParam(":IdHistoriaClinica", $datosCreateTratamiento["IdHistoriaClinica"], PDO::PARAM_STR);
    $statement -> bindParam(":IdPaciente", $datosCreateTratamiento["IdPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioCreado", $datosCreateTratamiento["UsuarioCreado"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioActualiza", $datosCreateTratamiento["UsuarioActualiza"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaCreacion", $datosCreateTratamiento["FechaCreacion"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualizacion", $datosCreateTratamiento["FechaActualizacion"], PDO::PARAM_STR);

    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Obtener el ultimo tratamiento
  public static function mdlObtenerUltimoTratamiento($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT MAX(IdTratamiento) as Id FROM $tabla");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Obtener el tratamiento de un paciente
  public static function mdlObtenerIdTratamiento($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_tratamiento.IdTratamiento FROM $tabla WHERE tba_tratamiento.IdPaciente = $codPaciente");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Crear el detalle del tratamiento
  public static function mdlCrearDetalleTratamiento($tabla, $datosDetalleTratamiento)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdTratamiento, IdProcedimiento, EstadoTratamiento, PrecioProcedimiento, UsuarioCreado, UsuarioActualizado, FechaCreado, FechaActualiza) VALUES(:IdTratamiento, :IdProcedimiento, :EstadoTratamiento, :PrecioProcedimiento, :UsuarioCreado, :UsuarioActualizado, :FechaCreado, :FechaActualiza)");
    $statement -> bindParam(":IdTratamiento", $datosDetalleTratamiento["IdTratamiento"], PDO::PARAM_STR);
    $statement -> bindParam(":IdProcedimiento", $datosDetalleTratamiento["IdProcedimiento"], PDO::PARAM_STR);
    $statement -> bindParam(":EstadoTratamiento", $datosDetalleTratamiento["EstadoTratamiento"], PDO::PARAM_STR);
    $statement -> bindParam(":PrecioProcedimiento", $datosDetalleTratamiento["PrecioProcedimiento"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioCreado", $datosDetalleTratamiento["UsuarioCreado"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioActualizado", $datosDetalleTratamiento["UsuarioActualizado"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaCreado", $datosDetalleTratamiento["FechaCreado"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualiza", $datosDetalleTratamiento["FechaActualiza"], PDO::PARAM_STR);

    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Actualizar el total del tratamiento
  public static function mdlUpadatePrecioTratamiento($tabla, $codTratamiento, $totalTratamiento)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET TotalTratamiento=:TotalTratamiento WHERE IdTratamiento=:IdTratamiento");
    $statement -> bindParam(":TotalTratamiento", $totalTratamiento, PDO::PARAM_STR);
    $statement -> bindParam(":IdTratamiento", $codTratamiento, PDO::PARAM_STR);
    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Mostrar el total del tratamiento
  public static function mdlMostrarTotalTratamiento($tabla, $codTratamiento)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_tratamiento.TotalTratamiento FROM $tabla WHERE tba_tratamiento.IdTratamiento = $codTratamiento");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  mostrar detalle del tratamiento por la historia clinica
  public static function mdlMostrarDetalleTratamiento($tabla, $codHistoria)
  {
    $statement = Conexion::conn()->prepare("SELECT
    tba_procedimiento.NombreProcedimiento, 
    tba_detalletratamiento.PrecioProcedimiento, 
    tba_detalletratamiento.ObservacionProcedimiento, 
    tba_procedimiento.IdProcedimiento
  FROM
    $tabla
    INNER JOIN
    tba_tratamiento
    ON 
      tba_detalletratamiento.IdTratamiento = tba_tratamiento.IdTratamiento
    INNER JOIN
    tba_historiaclinica
    ON 
      tba_tratamiento.IdHistoriaClinica = tba_historiaclinica.IdHistoriaClinica
    INNER JOIN
    tba_procedimiento
    ON 
      tba_detalletratamiento.IdProcedimiento = tba_procedimiento.IdProcedimiento
  WHERE
    tba_historiaclinica.IdHistoriaClinica = $codHistoria");
    $statement -> execute();
    return $statement -> fetchAll();
  }
}