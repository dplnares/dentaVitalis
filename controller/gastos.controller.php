<?php

class ControllerGastos
{
  //  Mostrar todos los gostos
  public static function ctrMostrarGastos()
  {
    $tabla = "tba_gasto";
    $listaGastos = ModelGastos::mdlMostrarGastos($tabla);
    return $listaGastos;
  }

  //  Mostrar los tipos de gastos
  public static function ctrMostrarTiposGastos()
  {
    $tabla = "tba_tipogasto";
    $listaTiposDetalles = ModelGastos::mdlMostrarTiposGastos($tabla);
    return $listaTiposDetalles;
  }

  //  Obtener los datos para editar
  public static function ctrMostrarDatosEditar($codGasto)
  {
    $tabla = "tba_gasto";
    $datosGasto = ModelGastos::mdlMostrarDatosEditar($tabla, $codGasto);
    return $datosGasto;
  }

  //  Crear un nuevo gasto
  public static function ctrCrearGasto()
  {
    if(isset($_POST["nombreGasto"]))
    {
      $tabla = "tba_gasto";
      $datosCreate = array(
        "NombreGasto" => $_POST["nombreGasto"],
        "IdTipoGasto" => $_POST["tipoGasto"],
        "FechaCreacion"=>date("Y-m-d"),
        "FechaActualizacion"=>date("Y-m-d"),
      );

      $respuesta = ModelGastos::mdlCrearGasto($tabla, $datosCreate);
      if($respuesta == "ok")
      {
        echo '
        <script>
          Swal.fire({
            icon: "success",
            title: "Correcto",
            text: "Gasto ingresado Correctamente!",
          }).then(function(result){
					  if(result.value){
							window.location = "gastos";
						}
					});
        </script>';
      }	
    }
  }

  //  Editar un gasto
  public static function ctrEditarGasto()
  {
    if(isset($_POST["editarNombreGasto"]))
    {
      $tabla = "tba_gasto";
      $datosUpdate = array(
        "IdTipoGasto" =>  $_POST["editarTipoGasto"],
        "NombreGasto" => $_POST["editarNombreGasto"],
        "IdGasto" => $_POST["codGasto"],
        "FechaActualizacion"=>date("Y-m-d"),
      );

      $respuesta = ModelGastos::mdlUpdateGasto($tabla, $datosUpdate);
      if($respuesta == "ok")
      {
        echo '
        <script>
          Swal.fire({
            icon: "success",
            title: "Correcto",
            text: "Gasto editado Correctamente!",
          }).then(function(result){
            if(result.value){
              window.location = "gastos";
            }
          });
        </script>';
      }
    }
  }

  //  Eliminar un gasto
  public static function ctrEliminarGasto()
  {
    if (isset($_GET["codGasto"]))
    {
      $tabla = "tba_gasto";
      $codGasto = $_GET["codGasto"];
      $respuesta = ModelGastos::mdlEliminarGasto($tabla, $codGasto);
      if($respuesta == "ok")
      {
        echo '
        <script>
          Swal.fire({
            icon: "success",
            title: "Correcto",
            text: "Gasto eliminado Correctamente!",
          }).then(function(result){
						if(result.value){
							window.location = "gastos";
						}
					});
        </script>';
      }
    }
  }
}