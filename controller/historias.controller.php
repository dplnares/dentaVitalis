<?php

class ControllerHistorias
{
  //  Mostrar todas las historias
  public static function ctrMostrarAllHistorias()
  {
    $tabla = "tba_historiaclinica";
    $listaHistorias = ModelHistorias::mdlMostrarAllHistorias($tabla);
    return $listaHistorias;
  }

  //  Crear nueva historia clínica
  public static function ctrCrearNuevaHistoria()
  {
    if(isset($_POST["nombrePaciente"]))
    {
      //  Primero, se actualizará los datos del paciente, luego la historia y detalle de la historia y por último se creará el tratamiento y detalle de tratamiento.
      $tablaHistoria = "tba_historiaclinica";
      $tablaDetalleHistoria = "tba_detallehistoriaclinica";
      
      //  Actualizar los datos del paciente
      $datosUpdatePaciente = array(
        "IdPaciente" => $_POST["nombrePaciente"],
        "DNIPaciente" => $_POST["numeroDNI"],
        "SexoPaciente" => $_POST["sexoPaciente"],
        "EdadPaciente" => $_POST["edadPaciente"],
        "FechaNacimiento" => $_POST["fechaNacimiento"],
        "CelularPaciente" => $_POST["celularPaciente"],
        "DomicilioPaciente" => $_POST["domicilioPaciente"],
        "LugarProcedencia" => $_POST["lugarProcedencia"],
        "LugarNacimiento" => $_POST["lugarNacimiento"],
        "GradoInstruccion" => $_POST["gradoInstruccion"],
        "RazaPaciente" => $_POST["razaPaciente"],
        "OcupacionPaciente" => $_POST["ocupacionPaciente"],
        "ReligionPaciente" => $_POST["religionPaciente"],
        "EstadoCivil" => $_POST["estadoCivil"],
        "NumeroContactoPaciente" => $_POST["numeroContacto"],
        "NombreContactoPaciente" => $_POST["personaContacto"],
        "UsuarioActualiza" => $_SESSION["idUsuario"],
        "FechaActualizacion" => date("Y-m-d\TH:i:sP"),
      );
      $respuestaPaciente = ControllerPacientes::ctrUpdateDatosPaciente($datosUpdatePaciente);

      //  Se creará la historia luego de que los datos del paciente fueron actualizados
      if($respuestaPaciente == "ok")
      {
        $datosCreateHistoria = array(
          "IdPaciente" => $_POST["nombrePaciente"],
          //  Solo el doctor creará la historia clínica con su usuario, o puede crearla otra persona????
          "IdSocio" => $_SESSION["idUsuario"],
          "AlergiasEncontradas" => $_POST["riesgoAlergia"],
          "DatosInformante" => $_POST["datosInformante"],
          "MotivoConsulta" => $_POST["motivoConsulta"],
          "TiempoEnfermedad" => $_POST["tiempoEnfermedad"],
          "SignosSintomas" => $_POST["signosySintomas"],
          "RelatoCronologico" => $_POST["relatoCronologico"],
          "FuncionesBiologicas" => $_POST["funcionesBiologicas"],
          "AntecedentesFamiliares" => $_POST["antecedentesFamiliares"],
          "AntecedentesPersonales" => $_POST["antecedentesPersonales"],
          "UsuarioCreado" => $_SESSION["idUsuario"],
          "UsuarioActualizado" => $_SESSION["idUsuario"],
          "FechaCreado" => date("Y-m-d\TH:i:sP"),
          "FechaActualiza" => date("Y-m-d\TH:i:sP"),
        );
        //  Se ingresa los datos de la cabecera de la historia clínica.
        $respuestaHistoria = ModelHistorias::mdlCrearHistoriaClinica($tablaHistoria, $datosCreateHistoria);

        //  Luego de crear los datos, se genera un plan de tratamiento para el paciente vacío.
        
      }
      else
      {
        echo '
          <script>
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "Error al actualizar los datos del paciente!",
            }).then(function(result){
              if(result.value){
                window.location = "historiaClinica";
              }
            });
          </script>';
      }

    }
  }


  //  Eliminar historia clinica
  public static function ctrEliminarHistoria()
  {
    
  }
}