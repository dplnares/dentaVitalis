<?php

require_once "conexion.php";

class ModelGastos
{
  //  Mostrar todos los gastos creados
  public static function mdlMostrarGastos($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_gasto.IdGasto, tba_gasto.NombreGasto, tba_gasto.IdTipoGasto, tba_tipogasto.NombreTipoGasto FROM $tabla INNER JOIN tba_tipogasto ON tba_gasto.IdTipoGasto = tba_tipogasto.IdTipoGasto ORDER BY IdGasto ASC");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Mostrar los tipos de gastos
  public static function mdlMostrarTiposGastos($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_tipogasto.IdTipoGasto, tba_tipogasto.NombreTipoGasto FROM $tabla");
    $statement -> execute();
    return $statement -> fetchAll();
  }


  //  Crear un nuevo gasto
  public static function mdlCrearGasto($tabla, $datosCreate)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdTipoGasto, NombreGasto, FechaCreacion, FechaActualizacion) VALUES(:IdTipoGasto, :NombreGasto, :FechaCreacion, :FechaActualizacion)");
    $statement -> bindParam(":IdTipoGasto", $datosCreate["IdTipoGasto"], PDO::PARAM_STR);
    $statement -> bindParam(":NombreGasto", $datosCreate["NombreGasto"], PDO::PARAM_STR);
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

  //  Editar un gasto
  public static function mdlUpdateGasto($tabla, $datosUpdate)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET NombreGasto=:NombreGasto, IdTipoGasto=:IdTipoGasto, FechaActualizacion=:FechaActualizacion WHERE IdGasto=:IdGasto");
    $statement -> bindParam(":NombreGasto", $datosUpdate["NombreGasto"], PDO::PARAM_STR);
    $statement -> bindParam(":IdTipoGasto", $datosUpdate["IdTipoGasto"], PDO::PARAM_STR);
    $statement -> bindParam(":IdGasto", $datosUpdate["IdGasto"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualizacion", $datosUpdate["FechaActualizacion"], PDO::PARAM_STR);
    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Eliminar un gasto
  public static function mdlEliminarGasto($tabla, $codGasto)
  {
    $statement = Conexion::conn()->prepare("DELETE FROM $tabla WHERE IdGasto = $codGasto");
    if ($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Mostrar los datos para editar
  public static function mdlMostrarDatosEditar($tabla, $codGasto)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_gasto.IdGasto, tba_gasto.IdTipoGasto, tba_gasto.NombreGasto, tba_tipogasto.NombreTipoGasto FROM $tabla INNER JOIN tba_tipogasto ON tba_gasto.IdTipoGasto = tba_tipogasto.IdTipoGasto WHERE tba_gasto.IdGasto = $codGasto");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Mostrar los gastos por tipo de gasto
  public static function mdlMostrarGastosPorTipo($tabla, $tipoGasto)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_gasto.IdGasto, tba_gasto.NombreGasto FROM $tabla WHERE tba_gasto.IdTipoGasto = $tipoGasto");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Mostrar los datos de un gasto fijo
  public static function mdlDatosGastoFijo($tabla, $codGastoFijo)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_gasto.IdGasto, tba_gasto.IdTipoGasto, tba_gasto.NombreGasto FROM $tabla WHERE tba_gasto.IdGasto = $codGastoFijo");
    $statement -> execute();
    return $statement -> fetch();
  }
}