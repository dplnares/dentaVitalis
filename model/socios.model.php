<?php

require_once "conexion.php";

class ModelSocios
{
  //  Mostrar todos los socios
  public static function mdlMostrarSocios($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_socio.IdSocio, tba_socio.NombreSocio, tba_socio.IdTipoIdentificacion, tba_socio.Identificacion, tba_socio.FechaCreacion, tba_tipoidentificacion.NombreTipoIdentificacion FROM $tabla INNER JOIN tba_tipoidentificacion ON tba_socio.IdTipoIdentificacion = tba_tipoidentificacion.IdTipoIdentificacion ORDER BY IdSocio ASC");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Mostrar los tipos de identificacion
  public static function mdlMostrarTiposIdentificacion($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_tipoidentificacion.IdTipoIdentificacion, tba_tipoidentificacion.NombreTipoIdentificacion FROM $tabla");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Crear un nuevo socio
  public static function mdlCrearSocio($tabla, $datosCreate)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (NombreSocio, IdTipoIdentificacion, Identificacion, FechaCreacion, FechaActualizacion) VALUES(:NombreSocio, :IdTipoIdentificacion, :Identificacion, :FechaCreacion, :FechaActualizacion)");
    $statement -> bindParam(":NombreSocio", $datosCreate["NombreSocio"], PDO::PARAM_STR);
    $statement -> bindParam(":IdTipoIdentificacion", $datosCreate["IdTipoIdentificacion"], PDO::PARAM_STR);
    $statement -> bindParam(":Identificacion", $datosCreate["Identificacion"], PDO::PARAM_STR);
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

  //  Mostrar los datos para editar a un socio
  public static function mdlMostrarDatosEditar($tabla, $codSocio)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_socio.IdSocio, tba_socio.NombreSocio, tba_socio.IdTipoIdentificacion, tba_socio.Identificacion, tba_tipoidentificacion.NombreTipoIdentificacion FROM $tabla INNER JOIN tba_tipoidentificacion ON tba_socio.IdTipoIdentificacion = tba_tipoidentificacion.IdTipoIdentificacion WHERE tba_socio.IdSocio = $codSocio");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Editar un socio
  public static function mdlUpdateSocio($tabla, $datosUpdate)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET NombreSocio=:NombreSocio, IdTipoIdentificacion=:IdTipoIdentificacion, Identificacion=:Identificacion, FechaActualizacion=:FechaActualizacion WHERE IdSocio=:IdSocio");
    $statement -> bindParam(":NombreSocio", $datosUpdate["NombreSocio"], PDO::PARAM_STR);
    $statement -> bindParam(":IdTipoIdentificacion", $datosUpdate["IdTipoIdentificacion"], PDO::PARAM_STR);
    $statement -> bindParam(":Identificacion", $datosUpdate["Identificacion"], PDO::PARAM_STR);
    $statement -> bindParam(":IdSocio", $datosUpdate["IdSocio"], PDO::PARAM_STR);
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

  //  Eliminar un socio
  public static function mdlEliminarSocio($tabla, $codSocio)
  {
    $statement = Conexion::conn()->prepare("DELETE FROM $tabla WHERE IdSocio = $codSocio");
    if ($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }
}