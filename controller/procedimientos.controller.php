<?php

class ControllerProcedimientos
{
  //  Mostrar todos los procedimientos en el modulo de procedimientos
  public static function ctrMostrarProcedimientos()
  {
    $tabla = "tba_procedimiento";
    $listaProcedimientos = ModelProcedimientos::mdlMostrarProcedimientos($tabla);
    return $listaProcedimientos;
  }

  //  Mostrar los tipos de procedimiento
  public static function ctrMostrarTiposProcedimiento()
  {
    $tabla = "tba_tipoprocedimiento";
    $listaTiposProcedimientos = ModelProcedimientos::mdlMostrarTiposProcedimiento($tabla);
    return $listaTiposProcedimientos;
  }

  //  Crear un nuevo procedimiento
  public static function ctrCrearNuevoProcedimiento()
  {
    if(isset($_POST["nombreProcedimiento"]))
    {
      $tabla = "tba_procedimiento";
      $datosCreate = array(
        "NombreProcedimiento" => $_POST["nombreProcedimiento"],
        "IdTipoProcedimiento" => $_POST["tipoProcedimiento"],
        "PrecioPromedio" => $_POST["precioProcedimiento"],
        "FechaCreacion"=>date("Y-m-d"),
        "FechaActualizacion"=>date("Y-m-d"),
      );

      $respuesta = ModelProcedimientos::mdlCrearProcedimiento($tabla, $datosCreate);
      if($respuesta == "ok")
      {
        echo '
        <script>
          Swal.fire({
            icon: "success",
            title: "Correcto",
            text: "Procedimiento ingresado Correctamente!",
          }).then(function(result){
					  if(result.value){
							window.location = "procedimientos";
						}
					});
        </script>';
      }	
    }
  }

  //  Editar un procedimiento
  public static function ctrEditarProcedimiento()
  {
    if(isset($_POST["editarNombreProcedimiento"]))
    {
      $tabla = "tba_procedimiento";
      $datosUpdate = array(
        "NombreProcedimiento" =>  $_POST["editarNombreProcedimiento"],
        "IdTipoProcedimiento" => $_POST["editarTipoProcedimiento"],
        "PrecioPromedio" => $_POST["editarPrecioProcedimiento"],
        "IdProcedimiento" => $_POST["codProcedimiento"],
        "FechaActualizacion"=>date("Y-m-d"),
      );

      $respuesta = ModelProcedimientos::mdlUpdateProcedimiento($tabla, $datosUpdate);
      if($respuesta == "ok")
      {
        echo '
        <script>
          Swal.fire({
            icon: "success",
            title: "Correcto",
            text: "Procedimiento editado Correctamente!",
          }).then(function(result){
            if(result.value){
              window.location = "procedimientos";
            }
          });
        </script>';
      }
    }
  }

  //  Eliminar un procedimiento
  public static function ctrEliminarProcedimiento()
  {
    if (isset($_GET["codProcedimiento"]))
    {
      $tabla = "tba_procedimiento";
      $codProcedimiento = $_GET["codProcedimiento"];
      $respuesta = ModelProcedimientos::mdlEliminarProcedimiento($tabla, $codProcedimiento);
      if($respuesta == "ok")
      {
        echo '
        <script>
          Swal.fire({
            icon: "success",
            title: "Correcto",
            text: "Procedimiento eliminado Correctamente!",
          }).then(function(result){
						if(result.value){
							window.location = "procedimientos";
						}
					});
        </script>';
      }
    }
  }

  //  Mostrar datos para editar un procedimiento
  public static function ctrMostrarDatosEditar($codProcedimiento)
  {
    $tabla = "tba_procedimiento";
    $datosProcedimiento = ModelProcedimientos::mdlMostrarDatosEditar($tabla, $codProcedimiento);
    return $datosProcedimiento;
  }
}