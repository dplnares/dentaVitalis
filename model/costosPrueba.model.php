<?php

require_once "conexion.php";

class ModelCostosPrueba
{
  //  Mostrar todos los movimientos de creados en costos fijos
  public static function mdlMostrarAllCostosFijos($tabla, $codTipoCosto)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_costo.IdCosto, tba_costo.IdTipoCosto, tba_costo.IdSocio, tba_costo.NumeroDocumento, tba_costo.FechaCosto, tba_costo.TotalCosto, tba_socio.NombreSocio FROM $tabla INNER JOIN tba_socio ON tba_costo.IdSocio = tba_socio.IdSocio WHERE tba_costo.IdTipoCosto = $codTipoCosto ORDER BY IdCosto ASC");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Mostrar todos los movimientos de creados en costos variables
  public static function mdlMostrarAllCostosVariables($tabla, $codTipoCosto)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_costo.IdCosto, tba_costo.IdTipoCosto, tba_costo.NumeroDocumento, tba_costo.FechaCosto, tba_costo.TotalCosto, tba_costo.NombreProveedor FROM $tabla WHERE tba_costo.IdTipoCosto = $codTipoCosto ORDER BY IdCosto ASC");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Ingresar un nuevo costo fijo
  public static function mdlIngresarCostoFijo($tabla, $datosCabecera)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdSocio, IdTipoCosto, NumeroDocumento, FechaCosto, SubTotalCosto, IGVCosto, TotalCosto, UsuarioCreado, UsuarioActualiza, FechaCreacion, FechaActualizacion) VALUES(:IdSocio, :IdTipoCosto, :NumeroDocumento, :FechaCosto, :SubTotalCosto, :IGVCosto, :TotalCosto, :UsuarioCreado, :UsuarioActualiza, :FechaCreacion, :FechaActualizacion)");
    $statement -> bindParam(":IdSocio", $datosCabecera["IdSocio"], PDO::PARAM_STR);
    $statement -> bindParam(":IdTipoCosto", $datosCabecera["IdTipoCosto"], PDO::PARAM_STR);
    $statement -> bindParam(":NumeroDocumento", $datosCabecera["NumeroDocumento"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaCosto", $datosCabecera["FechaCosto"], PDO::PARAM_STR);
    $statement -> bindParam(":SubTotalCosto", $datosCabecera["SubTotalCosto"], PDO::PARAM_STR);
    $statement -> bindParam(":IGVCosto", $datosCabecera["IGVCosto"], PDO::PARAM_STR);
    $statement -> bindParam(":TotalCosto", $datosCabecera["TotalCosto"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioCreado", $datosCabecera["UsuarioCreado"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioActualiza", $datosCabecera["UsuarioActualiza"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaCreacion", $datosCabecera["FechaCreacion"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualizacion", $datosCabecera["FechaActualizacion"], PDO::PARAM_STR);

    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  
  //  Ingresar un nuevo costo fijo
  public static function mdlIngresarCostoVariable($tabla, $datosCabecera)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (NombreProveedor, IdTipoCosto, NumeroDocumento, FechaCosto, SubTotalCosto, IGVCosto, TotalCosto, UsuarioCreado, UsuarioActualiza, FechaCreacion, FechaActualizacion) VALUES(:NombreProveedor, :IdTipoCosto, :NumeroDocumento, :FechaCosto, :SubTotalCosto, :IGVCosto, :TotalCosto, :UsuarioCreado, :UsuarioActualiza, :FechaCreacion, :FechaActualizacion)");
    $statement -> bindParam(":NombreProveedor", $datosCabecera["NombreProveedor"], PDO::PARAM_STR);
    $statement -> bindParam(":IdTipoCosto", $datosCabecera["IdTipoCosto"], PDO::PARAM_STR);
    $statement -> bindParam(":NumeroDocumento", $datosCabecera["NumeroDocumento"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaCosto", $datosCabecera["FechaCosto"], PDO::PARAM_STR);
    $statement -> bindParam(":SubTotalCosto", $datosCabecera["SubTotalCosto"], PDO::PARAM_STR);
    $statement -> bindParam(":IGVCosto", $datosCabecera["IGVCosto"], PDO::PARAM_STR);
    $statement -> bindParam(":TotalCosto", $datosCabecera["TotalCosto"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioCreado", $datosCabecera["UsuarioCreado"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioActualiza", $datosCabecera["UsuarioActualiza"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaCreacion", $datosCabecera["FechaCreacion"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualizacion", $datosCabecera["FechaActualizacion"], PDO::PARAM_STR);

    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Obtener el último id de costo creado
  public static function mdlObtenerUltimoID($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT MAX(IdCosto) as Id FROM $tabla");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Agregar el detalle de un costo
  public static function mdlIngresarDetalleCosto($tabla, $datosDetalle)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdCosto, IdGasto, ObservacionGasto, PrecioGasto) VALUES(:IdCosto, :IdGasto, :ObservacionGasto, :PrecioGasto)");
    $statement -> bindParam(":IdCosto", $datosDetalle["IdCosto"], PDO::PARAM_STR);
    $statement -> bindParam(":IdGasto", $datosDetalle["IdGasto"], PDO::PARAM_STR);
    $statement -> bindParam(":ObservacionGasto", $datosDetalle["ObservacionGasto"], PDO::PARAM_STR);
    $statement -> bindParam(":PrecioGasto", $datosDetalle["PrecioGasto"], PDO::PARAM_STR);

    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Eliminar cabecera del costo
  public static function mdlEliminarDetalleCosto($tabla, $codCosto)
  {
    $statement = Conexion::conn()->prepare("DELETE FROM $tabla WHERE IdCosto = $codCosto");
    if ($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Eliminar el detalle del costo
  public static function mdlEliminarCabeceraCosto($tabla, $codCosto)
  {
    $statement = Conexion::conn()->prepare("DELETE FROM $tabla WHERE IdCosto = $codCosto");
    if ($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Obtener los datos de la cabecera para editarlos
  public static function mdlObtenerCabeceraGF($tabla, $codCosto)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_costo.IdCosto, tba_costo.IdSocio, tba_costo.NumeroDocumento, tba_costo.FechaCosto, tba_costo.TotalCosto, tba_costo.IGVCosto, tba_costo.SubTotalCosto, tba_socio.NombreSocio FROM $tabla INNER JOIN tba_socio ON tba_costo.IdSocio = tba_socio.IdSocio WHERE tba_costo.IdCosto = $codCosto");
    $statement -> execute();
    return $statement -> fetch();
  }
  
  //  Obtener los datos de la cabecera para editarlos
  public static function mdlObtenerCabeceraGV($tabla, $codCosto)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_costo.IdCosto, tba_costo.NombreProveedor, tba_costo.NumeroDocumento, tba_costo.FechaCosto, tba_costo.TotalCosto, tba_costo.IGVCosto, tba_costo.SubTotalCosto FROM $tabla WHERE tba_costo.IdCosto = $codCosto");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Obtener el detalle de un costo fijo
  public static function mdlObtenerDetalleGF($tabla, $codCosto)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_detallecosto.IdDetalleCosto, tba_detallecosto.IdGasto, tba_detallecosto.ObservacionGasto, tba_detallecosto.PrecioGasto, tba_gasto.NombreGasto FROM $tabla INNER JOIN tba_gasto ON tba_detallecosto.IdGasto = tba_gasto.IdGasto WHERE tba_detallecosto.IdCosto = $codCosto");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Editar la cabecera del costo fijo
  public static function mdlEditarCabeceraCostoFijo($tabla, $datosCabecera)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET IdSocio=:IdSocio, NumeroDocumento=:NumeroDocumento, FechaCosto=:FechaCosto, SubTotalCosto=:SubTotalCosto, IGVCosto=:IGVCosto, TotalCosto=:TotalCosto, UsuarioActualiza=:UsuarioActualiza, FechaActualizacion=:FechaActualizacion WHERE tba_costo.IdCosto=:IdCosto");
    $statement -> bindParam(":IdSocio", $datosCabecera["IdSocio"], PDO::PARAM_STR);
    $statement -> bindParam(":NumeroDocumento", $datosCabecera["NumeroDocumento"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaCosto", $datosCabecera["FechaCosto"], PDO::PARAM_STR);
    $statement -> bindParam(":SubTotalCosto", $datosCabecera["SubTotalCosto"], PDO::PARAM_STR);
    $statement -> bindParam(":IGVCosto", $datosCabecera["IGVCosto"], PDO::PARAM_STR);
    $statement -> bindParam(":TotalCosto", $datosCabecera["TotalCosto"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioActualiza", $datosCabecera["UsuarioActualiza"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualizacion", $datosCabecera["FechaActualizacion"], PDO::PARAM_STR);
    $statement -> bindParam(":IdCosto", $datosCabecera["IdCosto"], PDO::PARAM_STR);

    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Editar la cabecera del costo variable
  public static function mdlEditarCabeceraCostoVariable($tabla, $datosCabecera)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET NombreProveedor=:NombreProveedor, NumeroDocumento=:NumeroDocumento, FechaCosto=:FechaCosto, SubTotalCosto=:SubTotalCosto, IGVCosto=:IGVCosto, TotalCosto=:TotalCosto, UsuarioActualiza=:UsuarioActualiza, FechaActualizacion=:FechaActualizacion WHERE tba_costo.IdCosto=:IdCosto");
    $statement -> bindParam(":NombreProveedor", $datosCabecera["NombreProveedor"], PDO::PARAM_STR);
    $statement -> bindParam(":NumeroDocumento", $datosCabecera["NumeroDocumento"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaCosto", $datosCabecera["FechaCosto"], PDO::PARAM_STR);
    $statement -> bindParam(":SubTotalCosto", $datosCabecera["SubTotalCosto"], PDO::PARAM_STR);
    $statement -> bindParam(":IGVCosto", $datosCabecera["IGVCosto"], PDO::PARAM_STR);
    $statement -> bindParam(":TotalCosto", $datosCabecera["TotalCosto"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioActualiza", $datosCabecera["UsuarioActualiza"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualizacion", $datosCabecera["FechaActualizacion"], PDO::PARAM_STR);
    $statement -> bindParam(":IdCosto", $datosCabecera["IdCosto"], PDO::PARAM_STR);

    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

}