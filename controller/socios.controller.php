<?php

class ControllerSocios
{
  //  Mostrar todos los socios creados
  public static function ctrMostrarSocios()
  {
    $tabla = "tba_socio";
    $listaSocios = ModelSocios::mdlMostrarSocios($tabla);
    return $listaSocios;
  }

  //  Mostrar los tipos de socio
  public static function ctrMostrarTiposSocio()
  {
    $tabla =  "tba_tiposocio";
    $listaTiposSocio = ModelSocios::mdlMostrarTiposSocio($tabla);
    return $listaTiposSocio;
  }

  //  Mostrar los tipos de identificacion
  public static function ctrMostrarTiposIdentificacion()
  {
    $tabla = "tba_tipoidentificacion";
    $listaTiposIdentificacion = ModelSocios::mdlMostrarTiposIdentificacion($tabla);
    return $listaTiposIdentificacion;
  }

  //  Mostrar los datos para editar un socio
  public static function ctrMostrarDatosEditar($codSocio)
  {
    $tabla = "tba_socio";
    $datosSocio = ModelSocios::mdlMostrarDatosEditar($tabla, $codSocio);
    return $datosSocio;
  }

  //  Crear un nuevo socio
  public static function ctrCrearSocio()
  {
    if(isset($_POST["nombreSocio"]))
    {
      $tabla = "tba_socio";
      $datosCreate = array(
        "NombreSocio" => $_POST["nombreSocio"],
        "IdTipoSocio" => $_POST["tipoSocio"],
        "IdTipoIdentificacion" => $_POST["tipoIdentificacion"],
        "Identificacion" => $_POST["numeroIdentificacion"],
        "FechaCreacion"=>date("Y-m-d\TH:i:sP"),
        "FechaActualizacion"=>date("Y-m-d\TH:i:sP"),
      );

      $respuesta = ModelSocios::mdlCrearSocio($tabla, $datosCreate);
      if($respuesta == "ok")
      {
        echo '
        <script>
          Swal.fire({
            icon: "success",
            title: "Correcto",
            text: "Socio ingresado Correctamente!",
          }).then(function(result){
					  if(result.value){
							window.location = "socios";
						}
					});
        </script>';
      }	
    }
  }

  //  Eliminar un socio
  public static function ctrEditarSocio()
  {
    if(isset($_POST["editarNombreSocio"]))
    {
      $tabla = "tba_socio";
      $datosUpdate = array(
        "IdSocio" =>  $_POST["codSocio"],
        "NombreSocio" => $_POST["editarNombreSocio"],
        "IdTipoSocio" => $_POST["editarTipoSocio"],
        "IdTipoIdentificacion" => $_POST["editarTipoIdentificacion"],
        "Identificacion" => $_POST["editarNumeroIdentificacion"],
        "FechaActualizacion"=>date("Y-m-d\TH:i:sP"),
      );

      $respuesta = ModelSocios::mdlUpdateSocio($tabla, $datosUpdate);
      if($respuesta == "ok")
      {
        echo '
        <script>
          Swal.fire({
            icon: "success",
            title: "Correcto",
            text: "Socio editado Correctamente!",
          }).then(function(result){
            if(result.value){
              window.location = "socios";
            }
          });
        </script>';
      }
    }
  }

  //  Eliminar Socio
  public static function ctrEliminarSocio()
  {
    if (isset($_GET["codSocio"]))
    {
      $tabla = "tba_socio";
      $codSocio = $_GET["codSocio"];
      $respuesta = ModelSocios::mdlEliminarSocio($tabla, $codSocio);
      if($respuesta == "ok")
      {
        echo '
        <script>
          Swal.fire({
            icon: "success",
            title: "Correcto",
            text: "Socio eliminado Correctamente!",
          }).then(function(result){
						if(result.value){
							window.location = "socios";
						}
					});
        </script>';
      }
    }
  }

}