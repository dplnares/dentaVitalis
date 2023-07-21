<?php

class ControllerPacientes
{
  //  Mostrar todos los pacientes
  public static function ctrMostrarPacientes()
  {
    $tabla = "tba_paciente";
    $listaPacientes = ModelPacientes::mdlMostrarPacientes($tabla);
    return $listaPacientes;
  }

  //  Mostrar los datos de un paciente para editar
  public static function ctrMostrarDatosEditar($codPaciente)
  {
    $tabla = "tba_paciente";
    $datosPaciente = ModelPacientes::mdlMostrarDatosEditar($tabla, $codPaciente);
    return $datosPaciente;
  }

  //  Crear un nuevo paciente
  public static function ctrCrearPaciente()
  {
    if(isset($_POST["nombrePaciente"]))
    {
      $tabla = "tba_paciente";
      $datosCreate = array(
        "NombrePaciente" => $_POST["nombrePaciente"],
        "ApellidoPaciente" => $_POST["apellidoPaciente"],
        "DNIPaciente" => $_POST["celularPaciente"],
        "CelularPaciente" => $_POST["numeroDNI"],
        "UsuarioCreado"=>$_SESSION["idUsuario"],
        "UsuarioActualiza"=>$_SESSION["idUsuario"],
        "FechaCreacion"=>date("Y-m-d"),
        "FechaActualizacion"=>date("Y-m-d"),
      );

      $respuesta = ModelPacientes::mdlCrearPaciente($tabla, $datosCreate);
      if($respuesta == "ok")
      {
        echo '
        <script>
          Swal.fire({
            icon: "success",
            title: "Correcto",
            text: "Paciente ingresado Correctamente!",
          }).then(function(result){
					  if(result.value){
							window.location = "pacientes";
						}
					});
        </script>';
      }	
    }
  }

  //  Editar un paciente
  public static function ctrEditarPaciente()
  {
    if(isset($_POST["editarNombrePaciente"]))
    {
      $tabla = "tba_paciente";
      $datosUpdate = array(
        "NombrePaciente" =>  $_POST["editarNombrePaciente"],
        "ApellidoPaciente" => $_POST["editarApellidoPaciente"],
        "DNIPaciente" => $_POST["editarDNIPaciente"],
        "CelularPaciente" => $_POST["editarCelularPaciente"],
        "IdPaciente" => $_POST["codPaciente"],
        "FechaActualizacion"=>date("Y-m-d"),
      );

      $respuesta = ModelPacientes::mdlUpdatePaciente($tabla, $datosUpdate);
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
              window.location = "pacientes";
            }
          });
        </script>';
      }
    }
  }

  //  Eliminar un paciente
  public static function ctrEliminarPaciente()
  {
    if (isset($_GET["codPaciente"]))
    {
      $tabla = "tba_paciente";
      $codPaciente = $_GET["codPaciente"];
      $respuesta = ModelPacientes::mdlEliminarPaciente($tabla, $codPaciente);
      if($respuesta == "ok")
      {
        echo '
        <script>
          Swal.fire({
            icon: "success",
            title: "Correcto",
            text: "Paciente eliminado Correctamente!",
          }).then(function(result){
						if(result.value){
							window.location = "pacientes";
						}
					});
        </script>';
      }
    }
  }
}