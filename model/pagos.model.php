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
}