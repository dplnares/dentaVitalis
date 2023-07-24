<?

require_once "conexion.php";

class ModelMovimientos
{
  //  Mostrar todos los movimientos de creados
  public static function mdlMostrarAllGastos($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_movimiento.IdMovimiento, tba_movimiento.NombreGasto, tba_movimiento.IdTipoGasto, tba_tipogasto.NombreTipoGasto FROM $tabla INNER JOIN tba_tipogasto ON tba_movimiento.IdTipoGasto = tba_tipogasto.IdTipoGasto ORDER BY IdGasto ASC");
    $statement -> execute();
    return $statement -> fetchAll();
  }
}