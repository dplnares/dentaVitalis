<?php

require_once "conexion.php";

class ModelCostos
{
  //  Mostrar todos los centros de costos
  public static function mdlMostrarCentrosCostos($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_centrocostos.IdCentroCostos, tba_centrocostos.DescripcionCentro, tba_centrocostos.FechaCreacion FROM $tabla ORDER BY IdCentroCostos ASC");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Crear un nuevo centro de costos
  public static function mdlCrearCentroCostos($tabla, $datosCreate)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (DescripcionCentro, FechaCreacion, FechaActualizacion) VALUES(:DescripcionCentro, :FechaCreacion, :FechaActualizacion)");
    $statement -> bindParam(":DescripcionCentro", $datosCreate["DescripcionCentro"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaCreacion", $datosCreate["FechaCreacion"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualizacion", $datosCreate["FechaActualizacion"], PDO::PARAM_STR);

    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Editar un centro de costos
  public static function mdlEditarCentroCostos($tabla, $datosUpdate)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET DescripcionCentro=:DescripcionCentro, FechaActualizacion=:FechaActualizacion WHERE IdCentroCostos=:IdCentroCostos");
    $statement -> bindParam(":DescripcionCentro", $datosUpdate["DescripcionCentro"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualizacion", $datosUpdate["FechaActualizacion"], PDO::PARAM_STR);
    $statement -> bindParam(":IdCentroCostos", $datosUpdate["IdPaciente"], PDO::PARAM_STR);
    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Eliminar un centro de costos
  public static function mdlEliminarCentroCostos($tabla, $codCentro)
  {
    $statement = Conexion::conn()->prepare("DELETE FROM $tabla WHERE IdCentroCostos = $codCentro");
    if ($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Mostrar los datos a editar
  public static function mdlMostrarDatosEditar($tabla, $codCentroCosto)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_centrocostos.IdCentroCostos, tba_centrocostos.DescripcionCentro FROM $tabla WHERE tba_centrocostos.IdCentroCostos = $codCentroCosto");
    $statement -> execute();
    return $statement -> fetch();
  }
}
