<?

class ControllerMovimientos
{
  //  Mostrar todos los movimientos de gastos que se hicieron
  public static function ctrMostrarAllGastos()
  {
    $tabla = "tba_movimiento";
    $listaGastos = ModelMovimientos::mdlMostrarAllGastos($tabla);
    return $listaGastos;
  }
}