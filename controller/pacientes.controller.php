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
        "FechaCreacion"=>date("Y-m-d\TH:i:sP"),
        "FechaActualizacion"=>date("Y-m-d\TH:i:sP"),
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
        "FechaActualizacion"=>date("Y-m-d\TH:i:sP"),
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

  //  Mostrar los pacientes para la historia clínica
  public static function ctrMostrarPacientesHistoria()
  {
    $tabla = "tba_paciente";
    $listaPacientes = ModelPacientes::mdlMostrarPacientesHistoria($tabla);
    return $listaPacientes;
  }

  //  Devolver los datos de un paciente para llenar datos de la historia
  public static function ctrMostrarDatosUnPaciente($codPaciente)
  {
    $tabla = "tba_paciente";
    $datosPaciente = ModelPacientes::mdlMostrarDatosPacienteHistoria($tabla, $codPaciente);
    return $datosPaciente;
  }

  //  Update datos del paciente en la historia clínica
  public static function ctrUpdateDatosPaciente($datosUpdatePaciente)
  {
    $tabla = "tba_paciente";
    $respuesta = ModelPacientes::mdlUpdateDatospaciente($tabla, $datosUpdatePaciente);
    return $respuesta;
  }

  //  Mostrar datos del paciente para la historia clínica
  public static function ctrMostrarDatosHistoria($codPaciente)
  {
    $tabla = "tba_paciente";
    $datosPaciente = ModelPacientes::mdlMostrarDatosHistoria($tabla, $codPaciente);
    return $datosPaciente;
  }

  //  Editar los datos del en la vista de editar
  public static function ctrUpdateDatosPacienteEditar($datosUpdatePaciente)
  {
    $tabla = "tba_paciente";
    $respuesta = ModelPacientes::mdlUpdateDatosPacienteEditar($tabla, $datosUpdatePaciente);
    return $respuesta;
  }

  //  Mostrar datos generales del paciente
  public static function ctrMostrarDatosTratamiento($codPaciente)
  {
    $tabla = "tba_paciente";
    $datosPaciente = ModelPacientes::mdlMostrarDatosTratamiento($tabla, $codPaciente);
    return $datosPaciente;
  }

  //  Buscar paciente por DNI
  public static function ctrBuscarPacienteDNI($numeroDNI)
  {
    $tabla = "tba_paciente";
    $datosPaciente = ModelPacientes::mdlBuscarPacienteDNI($tabla, $numeroDNI);
    return $datosPaciente;
  }

  //  Mostrar los datos del paciente en visualiar pagos
  public static function ctrMostrarDatosBasicos($codPaciente)
  {
    $tabla = "tba_paciente";
    $datosPaciente = ModelPacientes::mdlMostrarDatosBasicos($tabla, $codPaciente);
    return $datosPaciente;
  }

  //  Mostrar datos para imprimir historia clinica
  public static function ctrObtenerDatosHistoriaPdf($codHistoria)
  {
    $tabla = "tba_paciente";
    $datosHistoria = ModelPacientes::mdlObtenerDatosHistoriaPdf($tabla, $codHistoria);
    return $datosHistoria;
  }
}