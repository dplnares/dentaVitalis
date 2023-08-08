<?php
require_once "conexion.php";

class ModelPagos
{
  //  Mostrar todos los pagos realizados
  public static function mdlMostrarTodosLosPagos($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_pago.IdPago, tba_pago.IdPaciente, tba_pago.IdTipoPago, tba_pago.TotalPago, tba_pago.FechaPago, tba_tipodepago.DescripcionTipo, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.DNIPaciente FROM $tabla INNER JOIN tba_tipodepago ON tba_pago.IdTipoPago = tba_tipodepago.IdTipoPago INNER JOIN tba_paciente ON tba_pago.IdPaciente = tba_paciente.IdPaciente ORDER BY IdPago DESC");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Mostrar metodos de pago
  public static function mdlMostrarTiposDePago($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_tipodepago.IdTipoPago, tba_tipodepago.DescripcionTipo FROM $tabla");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Eliminar un pago
  public static function mdlEliminarPago($tabla, $codPago)
  {
    $statement = Conexion::conn()->prepare("DELETE FROM $tabla WHERE IdPago = $codPago");
    if ($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Ingresar un nuevo pago
  public static function mdlIngresarNuevoPago($tabla, $datosCreate)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdPaciente, IdTipoPago, TotalPago, FechaPago, FechaCreacion, FechaActualizacion) VALUES(:IdPaciente, :IdTipoPago, :TotalPago, :FechaPago, :FechaCreacion, :FechaActualizacion)");
    $statement -> bindParam(":IdPaciente", $datosCreate["IdPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":IdTipoPago", $datosCreate["IdTipoPago"], PDO::PARAM_STR);
    $statement -> bindParam(":TotalPago", $datosCreate["TotalPago"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaPago", $datosCreate["FechaPago"], PDO::PARAM_STR);
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

  //  Mostrar los datos del pago a editar
  public static function mdlMostrarDatosEditar($tabla, $codPagoEditar)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_pago.IdPago, tba_pago.IdPaciente, tba_pago.IdTipoPago, tba_pago.TotalPago, tba_pago.FechaPago, tba_tipodepago.DescripcionTipo, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.DNIPaciente FROM $tabla INNER JOIN tba_tipodepago ON tba_pago.IdTipoPago = tba_tipodepago.IdTipoPago INNER JOIN tba_paciente ON tba_pago.IdPaciente = tba_paciente.IdPaciente WHERE tba_pago.IdPago = $codPagoEditar");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Editar un pago
  public static function mdlUpdatePago($tabla, $datosUpdate)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET IdPaciente=:IdPaciente, IdTipoPago=:IdTipoPago, TotalPago=:TotalPago, FechaPago=:FechaPago, FechaActualizacion=:FechaActualizacion WHERE IdPago=:IdPago");
    $statement -> bindParam(":IdPaciente", $datosUpdate["IdPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":IdTipoPago", $datosUpdate["IdTipoPago"], PDO::PARAM_STR);
    $statement -> bindParam(":TotalPago", $datosUpdate["TotalPago"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaPago", $datosUpdate["FechaPago"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualizacion", $datosUpdate["FechaActualizacion"], PDO::PARAM_STR);
    $statement -> bindParam(":IdPago", $datosUpdate["IdPago"], PDO::PARAM_STR);
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