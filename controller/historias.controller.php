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
      //  El flujo es el siguiente actualizarDatosPaciente -> Crear historia clinica -> Crear Tratamiento vacío -> Crear Detalle de la historia -> Crear detalle del tratamiento -> Actualizar el precio del tratamiento
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
        "UsuarioActualizado" => $_SESSION["idUsuario"],
        "FechaActualizacion" => date("Y-m-d\TH:i:sP"),
      );
      $respuestaPaciente = ControllerPacientes::ctrUpdateDatosPaciente($datosUpdatePaciente);

      //  Se creará la historia luego de que los datos del paciente fueron actualizados
      if($respuestaPaciente == "ok")
      {
        $datosCreateHistoria = array(
          "IdPaciente" => $_POST["nombrePaciente"],
          //  Solo el doctor creará la historia clínica con su usuario, o puede crearla otra persona???? -> ver si puedo poner ese valor en un campo extra para que pue cambiar de medico o no
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
        //  Luego de crear los datos, se genera un plan de tratamiento para el paciente vacío
        $respuestaHistoria = ModelHistorias::mdlCrearHistoriaClinica($tablaHistoria, $datosCreateHistoria);
        if($respuestaHistoria == "ok")
        {
          //  Obtener la ultima historia clinica creada y tener ese valor para crear un plan de tratamiento vacío
          $ultimaHistoria = ModelHistorias::mdlObtenerUltimaHistoria($tablaHistoria);
          $datosCreateTratamiento = array(
            "IdHistoriaClinica" => $ultimaHistoria["Id"],
            "IdPaciente" => $_POST["nombrePaciente"],
            "UsuarioCreado" => $_SESSION["idUsuario"],
            "UsuarioActualiza" => $_SESSION["idUsuario"],
            "FechaCreacion" => date("Y-m-d\TH:i:sP"),
            "FechaActualizacion" => date("Y-m-d\TH:i:sP"),
          );
          $respuestaTratamiento = ControllerTratamiento::ctrCrearTratamiento($datosCreateTratamiento);
          if($respuestaTratamiento == "ok")
          {
            //  Crear el detalle del tratamiento con el ultimo id de la historia vacia creada anteriormente para que pueda guardar su valor.
            $ultimoTratamiento = ControllerTratamiento::ctrObtenerUltimoTratamiento();
            $datosCreateDetalleHistoria = array(
              "IdHistoriaClinica" => $ultimaHistoria["Id"],
              "IdTratamiento" => $ultimoTratamiento["Id"],
              "PresionArterial" => $_POST["presionArterial"],
              "Pulso" => $_POST["pulsoPaciente"],
              "Temperatura" => $_POST["temperaturaPaciente"],
              "FrecuenciaCardiaca" => $_POST["frecuenciaCardiaca"],
              "FrecuenciaRespiratoria" => $_POST["frecuenciaRespiratoria"],
              "ExamenOdonto" => $_POST["examenOdontoEst"],
              "DiagnosticoPresuntivo" => $_POST["diagnostivoPresuntivo"],
              "DiagnosticoDefinitivo" => $_POST["diagnostivoDefinitivo"],
              "Pronostico" => $_POST["pronosticoHistoria"],
              "TratamientoPaciente" => $_POST["tratamientoHistoria"],
              "InformacionAlta" => $_POST["altaHistoria"],
              "UsuarioCreado" => $_SESSION["idUsuario"],
              "UsuarioActualizado" => $_SESSION["idUsuario"],
              "FechaCreado" => date("Y-m-d\TH:i:sP"),
              "FechaActualiza" => date("Y-m-d\TH:i:sP"),
            );
            $respuestaDetalleHistoria = ModelHistorias::mdlCrearDetalleHistoria($tablaDetalleHistoria, $datosCreateDetalleHistoria);
            //  Ahora puedo jalar los procedimientos que se agregaron al plan de tratamiento y los coloco en el tratamiento que cree previamente.
            if($respuestaDetalleHistoria == "ok")
            {
              //  Obtener el tratamiento de este paciente en específico
              $idTratamiento = ControllerTratamiento::ctrObtenerIdTratamiento($_POST["nombrePaciente"]);
              //  Obtener la lista de procedimientos que se agregaron 
              $listaProcedimientos = json_decode($_POST["listarProcedimientos"], true);
              foreach($listaProcedimientos as $value)
              {
                $datosDetalleTratamiento = array(
                  "IdTratamiento" => $idTratamiento["IdTratamiento"],
                  "IdProcedimiento" => $value["CodProcedimiento"],
                  "ObservacionProcedimiento" => $value["ObservacionProcedimiento"],
                  "EstadoTratamiento" => "1",
                  "PrecioProcedimiento" => $value["PrecioProcedimiento"],
                  "UsuarioCreado" => $_SESSION["idUsuario"],
                  "UsuarioActualizado" => $_SESSION["idUsuario"],
                  "FechaCreado" => date("Y-m-d\TH:i:sP"),
                  "FechaActualiza" => date("Y-m-d\TH:i:sP"),
                );
                $respuestaDetalleTratamiento = ControllerTratamiento::ctrCrearDetalleTratamiento($datosDetalleTratamiento);
              }
              if($respuestaDetalleTratamiento == "ok")
              {
                $totalTratamiento = $_POST["nuevoTotalTratamiento"];
                $respuestaUpdateTratamiento = ControllerTratamiento::ctrUpdatePrecioTratamiento($idTratamiento["IdTratamiento"] ,$totalTratamiento);
                if($respuestaUpdateTratamiento == "ok")
                {
                  echo '
                    <script>
                      Swal.fire({
                        icon: "success",
                        title: "Correcto",
                        text: "¡Historia Clínica creada correctamente!",
                      }).then(function(result){
                        if(result.value){
                          window.location = "historiaClinica";
                        }
                      });
                    </script>';
                }
                else
                {
                  echo '
                    <script>
                      Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "¡Error al actualizar la lista de tratamientos!",
                      }).then(function(result){
                        if(result.value){
                          window.location = "historiaClinica";
                        }
                      });
                    </script>';
                }
              }
              else
              {
                echo '
                  <script>
                    Swal.fire({
                      icon: "error",
                      title: "Error",
                      text: "¡Error al crear el detalle del tratamiento!",
                    }).then(function(result){
                      if(result.value){
                        window.location = "historiaClinica";
                      }
                    });
                  </script>';
              }
            }
            else
            {
              echo '
                <script>
                  Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "¡Error al crear el detalle de la historia!",
                  }).then(function(result){
                    if(result.value){
                      window.location = "historiaClinica";
                    }
                  });
                </script>';
            }
          }
          else
          {
            echo '
              <script>
                Swal.fire({
                  icon: "error",
                  title: "Error",
                  text: "¡Error al crear el plan de tratamiento vacío!",
                }).then(function(result){
                  if(result.value){
                    window.location = "historiaClinica";
                  }
                });
              </script>';
          }
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
  }

  //  Mostrar los datos de la historia de un paciente
  public static function ctrMostrarCabeceraHistoria($codHistoria)
  {
    $tabla = "tba_historiaclinica";
    $respuesta = ModelHistorias::mdlMostrarCabeceraHistoria($tabla, $codHistoria);
    return $respuesta;
  }

  //  Mostrar los datos del detalle de la historia
  public static function ctrMostrarDetalleHistoria($codHistoria)
  {
    $tabla = "tba_detallehistoriaclinica";
    $respuesta = ModelHistorias::mdlMostrarDetalleHistoria($tabla, $codHistoria);
    return $respuesta;
  }

  //  Editar Historia clínica
  public static function ctrEditarHistoria()
  {
    if(isset($_POST["nombrePaciente"]))
    {
      $tablaHistoria = "tba_historiaclinica";
      $tablaDetalleHistoria = "tba_detallehistoriaclinica";
      $codPaciente = $_GET["codPaciente"];
      $codHistoria = $_GET["codHistoria"];
      
      //  Actualizar los datos del paciente
      $datosUpdatePaciente = array(
        "IdPaciente" => $codPaciente,
        "SexoPaciente" => $_POST["editarSexoPaciente"],
        "EdadPaciente" => $_POST["editarEdadPaciente"],
        "FechaNacimiento" => $_POST["editarFechaNacimiento"],
        "CelularPaciente" => $_POST["editarCelular"],
        "DomicilioPaciente" => $_POST["editarDomicilio"],
        "LugarProcedencia" => $_POST["editarLugarProcedencia"],
        "LugarNacimiento" => $_POST["editarLugarNacimiento"],
        "GradoInstruccion" => $_POST["editarGradoInstruccion"],
        "RazaPaciente" => $_POST["editarRazaPaciente"],
        "OcupacionPaciente" => $_POST["editarOcupacionPaciente"],
        "ReligionPaciente" => $_POST["editarReligionPaciente"],
        "EstadoCivil" => $_POST["editarEstadoCivil"],
        "NumeroContactoPaciente" => $_POST["editarNumeroContacto"],
        "NombreContactoPaciente" => $_POST["editarPersonaContacto"],
        "UsuarioActualizado" => $_SESSION["idUsuario"],
        "FechaActualizacion" => date("Y-m-d\TH:i:sP"),
      );
      $respuestaPaciente = ControllerPacientes::ctrUpdateDatosPacienteEditar($datosUpdatePaciente);

      //  Actualiza los datos de la historia clinica
      if($respuestaPaciente == "ok")
      {
        $datosUpdateHistoria = array(
          "IdPaciente" => $codPaciente,
          "AlergiasEncontradas" => $_POST["editarRiesgoAlergia"],
          "DatosInformante" => $_POST["editarDatosInformante"],
          "MotivoConsulta" => $_POST["editarMotivoConsulta"],
          "TiempoEnfermedad" => $_POST["editarTiempoEnfermedad"],
          "SignosSintomas" => $_POST["editarSignosSintomas"],
          "RelatoCronologico" => $_POST["editarRelatoCronologico"],
          "FuncionesBiologicas" => $_POST["editarFuncionesBiologicas"],
          "AntecedentesFamiliares" => $_POST["editarAntecedentesFamiliares"],
          "AntecedentesPersonales" => $_POST["editarAntecedentesPersonales"],
          "UsuarioActualizado" => $_SESSION["idUsuario"],
          "FechaActualiza" => date("Y-m-d\TH:i:sP"),
        );
        $respuestaHistoria = ModelHistorias::mdlUpdateHistoriaClinica($tablaHistoria, $datosUpdateHistoria);

        //Actualizar el detalle de la historia clínica
        if($respuestaHistoria == "ok")
        {
          $datosUpdateDetalleHistoria = array(
            "IdHistoriaClinica" => $codHistoria,
            "PresionArterial" => $_POST["editarPresionArterial"],
            "Pulso" => $_POST["editarPulsoPaciente"],
            "Temperatura" => $_POST["editarTemperaturaPaciente"],
            "FrecuenciaCardiaca" => $_POST["editarFrecuenciaCardiaca"],
            "FrecuenciaRespiratoria" => $_POST["editarFrecuenciaRespiratoria"],
            "ExamenOdonto" => $_POST["editarExamenOdonto"],
            "DiagnosticoPresuntivo" => $_POST["editarDiagnosticoPresuntivo"],
            "DiagnosticoDefinitivo" => $_POST["editarDiagnosticoDefinitivo"],
            "Pronostico" => $_POST["editarPronosticoHistoria"],
            "TratamientoPaciente" => $_POST["editarTratamiento"],
            "InformacionAlta" => $_POST["editarAltaPaciente"],
            "UsuarioActualizado" => $_SESSION["idUsuario"],
            "FechaActualiza" => date("Y-m-d\TH:i:sP"),
          );
          $respuestaDetalleHistoria = ModelHistorias::mdlUpdateDetalleHistoria($tablaDetalleHistoria, $datosUpdateDetalleHistoria);

          //  Actualizar el total del tratamiento
          if($respuestaDetalleHistoria == "ok")
          {
            $totalTratamiento = $_POST["nuevoTotalTratamiento"];
            $idTratamiento = ControllerTratamiento::ctrObtenerIdTratamiento($codPaciente);
            $respuestaUpdateTratamiento = ControllerTratamiento::ctrUpdatePrecioTratamiento($idTratamiento["IdTratamiento"] ,$totalTratamiento);
            
            //  Actualizar el listado de los tratamientos
            if ($respuestaUpdateTratamiento == "ok")
            {
              //  Eliminar todos los procedimientos del tratamiento actual o que se mantengan estos -> Depende de como quieren que se maneje los pagos por el tratamiento, es decir si quieren que el paciente vaya cancelando por cada tratamiento y llevar el costo por cada procedimiento que se vaya haciendo o llevar el costo total por todo el tratamiento como una suma general.
              $listaProcedimientos = json_decode($_POST["listarProcedimientos"], true);
              if($listaProcedimientos != null)
              {
                $eliminarListaProcedimientos = ControllerTratamiento::ctrEliminarTodoDetalle($idTratamiento["IdTratamiento"]);
                if($eliminarListaProcedimientos == "ok")
                {
                  foreach($listaProcedimientos as $value)
                  {
                    $datosDetalleTratamiento = array(
                      "IdTratamiento" => $idTratamiento["IdTratamiento"],
                      "IdProcedimiento" => $value["CodProcedimiento"],
                      "ObservacionProcedimiento" => $value["ObservacionProcedimiento"],
                      "EstadoTratamiento" => "1",
                      "PrecioProcedimiento" => $value["PrecioProcedimiento"],
                      "UsuarioCreado" => $_SESSION["idUsuario"],
                      "UsuarioActualizado" => $_SESSION["idUsuario"],
                      "FechaCreado" => date("Y-m-d\TH:i:sP"),
                      "FechaActualiza" => date("Y-m-d\TH:i:sP"),
                    );
                    $respuestaDetalleTratamiento = ControllerTratamiento::ctrCrearDetalleTratamiento($datosDetalleTratamiento);
                  } 
                }
                else
                {
                  echo '
                  <script>
                    Swal.fire({
                      icon: "error",
                      title: "Error",
                      text: "¡Error al eliminar el detalle de los procedimientos!",
                    }).then(function(result){
                      if(result.value){
                        window.location = "historiaClinica";
                      }
                    });
                  </script>';
                }
              }
              else
              {
                $respuestaDetalleTratamiento = "ok";
              }
              if($respuestaDetalleTratamiento == "ok")
              {
                echo '
                  <script>
                    Swal.fire({
                      icon: "success",
                      title: "Correcto",
                      text: "¡Historia Clínica editada correctamente!",
                    }).then(function(result){
                      if(result.value){
                        window.location = "historiaClinica";
                      }
                    });
                  </script>';
              }
            }
            else
            {
              echo '
              <script>
                Swal.fire({
                  icon: "error",
                  title: "Error",
                  text: "¡Error al editar el total del procedimiento!",
                }).then(function(result){
                  if(result.value){
                    window.location = "historiaClinica";
                  }
                });
              </script>';
            }
          }
          else
          {
            echo '
              <script>
                Swal.fire({
                  icon: "error",
                  title: "Error",
                  text: "¡Error al editar el detalle de la historia clínica!",
                }).then(function(result){
                  if(result.value){
                    window.location = "historiaClinica";
                  }
                });
              </script>';
          }
        }
        else
        {
          echo '
            <script>
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "¡Error al editar la cabecera de la historia clínica!",
              }).then(function(result){
                if(result.value){
                  window.location = "historiaClinica";
                }
              });
            </script>';
        }
      }
      else
      {
        echo '
          <script>
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "¡Error al editar los datos del paciente!",
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