</div>
        </div>
        <div class="sb-sidenav-footer">
          <div class="small">Sesión iniciada como:</div>
          <?php echo $_SESSION["nombreUsuario"] ?>
        </div>
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main class="bg">
        <div class="container-fluid px-4">
          <h1 class="mt-4">
            <?php
              $datosPaciente = ControllerPacientes::ctrMostrarDatosHistoria($_GET["codPaciente"]);
              $datosCabecera = ControllerHistorias::ctrMostrarCabeceraHistoria($_GET["codHistoria"]);
              $datosDetalle = ControllerHistorias::ctrMostrarDetalleHistoria($_GET["codHistoria"]);
              $datosTratamiento = ControllerTratamiento::ctrMostrarTotalTratamiento($datosDetalle["IdTratamiento"]);
              if($_GET["codPaciente"] && $_GET["codHistoria"])
              {
                echo 'Editar Historia De : '.$datosPaciente["NombrePaciente"].' '.$datosPaciente["ApellidoPaciente"];
              }
              else
              {
                echo 'No hay datos de la historia clínica';
              }
            ?>  
          </h1>
        </div>

        <div class="container-fluid">
          <form role="form" method="post" class="row g-3 m-2 formularioHistoriaClinica">

            <!-- Datos Paciente -->
            <span class="border border-3 p-3">
              <div class="container row g-3">

                <h3>Datos Paciente</h3>
                <!-- Seleccionar al paciente -->
                <div class="form-group col-md-8">
                  <label for="nombrePaciente" class="form-label" style="font-weight: bold">Paciente:</label>
                  <input type="text" class="form-control" id="nombrePaciente" name="nombrePaciente" value="<?php echo $datosPaciente["NombrePaciente"].' '.$datosPaciente["ApellidoPaciente"]?>" readonly>
                </div>

                <!-- Numero de DNI -->
                <div class="col-md-4">
                  <label for="numeroDNI" class="form-label" style="font-weight: bold">DNI: </label>
                  <input type="text" class="form-control" id="numeroDNI" name="numeroDNI" value="<?php echo $datosPaciente["DNIPaciente"]?>" readonly>
                </div>

                <!-- Sexo -->
                <div class="col-md-3">
                  <label for="editarSexoPaciente" class="form-label" style="font-weight: bold">Sexo: </label>
                  <input type="text" class="form-control" id="editarSexoPaciente" name="editarSexoPaciente" value="<?php echo $datosPaciente["SexoPaciente"]?>">
                </div>
                
                <!-- Edad -->
                <div class="col-md-3">
                  <label for="editarEdadPaciente" class="form-label" style="font-weight: bold">Edad: </label>
                  <input type="text" class="form-control" id="editarEdadPaciente" name="editarEdadPaciente" value="<?php echo $datosPaciente["EdadPaciente"]?>">
                </div>

                <!-- Lugar de nacimiento -->
                <div class="col-md-3">
                  <label for="editarLugarNacimiento" class="form-label" style="font-weight: bold">Lugar nacimiento: </label>
                  <input type="text" class="form-control" id="editarLugarNacimiento" name="editarLugarNacimiento" value="<?php echo $datosPaciente["LugarNacimiento"]?>">
                </div>

                <!-- Grado de instruccion -->
                <div class="col-md-3">
                  <label for="editarGradoInstruccion" class="form-label" style="font-weight: bold">Grado de instrucción: </label>
                  <input type="text" class="form-control" id="editarGradoInstruccion" name="editarGradoInstruccion" value="<?php echo $datosPaciente["GradoInstruccion"]?>">
                </div>

                <!-- Ocupación -->
                <div class="col-md-3">
                  <label for="editarOcupacionPaciente" class="form-label" style="font-weight: bold">Ocupación: </label>
                  <input type="text" class="form-control" id="editarOcupacionPaciente" name="editarOcupacionPaciente" value="<?php echo $datosPaciente["OcupacionPaciente"]?>">
                </div>

                <!-- Fecha Nacimiento -->
                <div class="col-md-3">
                  <label for="editarFechaNacimiento" class="form-label" style="font-weight: bold">Fecha de Nacimiento: </label>
                  <input type="date" class="form-control" id="editarFechaNacimiento" name="editarFechaNacimiento" value="<?php echo $datosPaciente["FechaNacimiento"]?>">
                </div>

                <!-- Raza -->
                <div class="col-md-3">
                  <label for="editarRazaPaciente" class="form-label" style="font-weight: bold">Raza: </label>
                  <input type="text" class="form-control" id="editarRazaPaciente" name="editarRazaPaciente" value="<?php echo $datosPaciente["RazaPaciente"]?>">
                </div>

                <!-- Religión -->
                <div class="col-md-3">
                  <label for="editarReligionPaciente" class="form-label" style="font-weight: bold">Religion: </label>
                  <input type="text" class="form-control" id="editarReligionPaciente" name="editarReligionPaciente" value="<?php echo $datosPaciente["ReligionPaciente"]?>">
                </div>

                <!-- Estado Civil -->
                <div class="col-md-3">
                  <label for="editarEstadoCivil" class="form-label" style="font-weight: bold">Estado Civil: </label>
                  <input type="text" class="form-control" id="editarEstadoCivil" name="editarEstadoCivil" value="<?php echo $datosPaciente["EstadoCivil"]?>">
                </div>

                <!-- Lugar de procedencia -->
                <div class="col-md-3">
                  <label for="editarLugarProcedencia" class="form-label" style="font-weight: bold">Lugar de Procedencia: </label>
                  <input type="text" class="form-control" id="editarLugarProcedencia" name="editarLugarProcedencia" value="<?php echo $datosPaciente["LugarProcedencia"]?>">
                </div>

                <!-- Domicilio Actual -->
                <div class="col-md-3">
                  <label for="editarDomicilio" class="form-label" style="font-weight: bold">Domicilio Actual: </label>
                  <input type="text" class="form-control" id="editarDomicilio" name="editarDomicilio" value="<?php echo $datosPaciente["DomicilioPaciente"]?>">
                </div>

                <!-- Telefono Celular -->
                <div class="col-md-3">
                  <label for="editarCelular" class="form-label" style="font-weight: bold">Telefono / Celular: </label>
                  <input type="text" class="form-control" id="editarCelular" name="editarCelular" value="<?php echo $datosPaciente["CelularPaciente"]?>">
                </div>

                <!-- Persona Contacto Celular -->
                <div class="col-md-3">
                  <label for="editarPersonaContacto" class="form-label" style="font-weight: bold">Persona de Contacto: </label>
                  <input type="text" class="form-control" id="editarPersonaContacto" name="editarPersonaContacto" value="<?php echo $datosPaciente["NombreContactoPaciente"]?>">
                </div>

                <!-- Telefono Celular -->
                <div class="col-md-3">
                  <label for="editarNumeroContacto" class="form-label" style="font-weight: bold">Numero de Contacto: </label>
                  <input type="text" class="form-control" id="editarNumeroContacto" name="editarNumeroContacto" value="<?php echo $datosPaciente["NumeroContactoPaciente"]?>">
                </div>

              </div>
            </span>

            <!-- Datos Historia Clinica -->
            <span class="border border-3 p-3">
              <div class="container row g-3">
                <h3>Datos Historia</h3>
                <!-- Alergias encontradas -->
                <div class="col-md-12">
                  <label for="editarRiesgoAlergia" class="form-label" style="font-weight: bold">Riesgo de Alergia: </label>
                  <input type="text" class="form-control" id="editarRiesgoAlergia" name="editarRiesgoAlergia" value="<?php echo $datosCabecera["AlergiasEncontradas"]?>">
                </div>

                <!-- Datos del paciente -->
                <div class="col-md-12">
                  <label for="editarDatosInformante" class="form-label" style="font-weight: bold">Datos del informante: </label>
                  <input type="text" class="form-control" id="editarDatosInformante" name="editarDatosInformante" value="<?php echo $datosCabecera["DatosInformante"]?>">
                </div>

                <!-- Motivo de la consulta -->
                <div class="col-md-12">
                  <label for="editarMotivoConsulta" class="form-label" style="font-weight: bold">Motivo de la consulta: </label>
                  <input type="text" class="form-control" id="editarMotivoConsulta" name="editarMotivoConsulta" value="<?php echo $datosCabecera["MotivoConsulta"]?>">
                </div>

                <!-- Tiempo de enfermedad -->
                <div class="col-md-12">
                  <label for="editarTiempoEnfermedad" class="form-label" style="font-weight: bold">Tiempo de enfermedad: </label>
                  <input type="text" class="form-control" id="editarTiempoEnfermedad" name="editarTiempoEnfermedad" value="<?php echo $datosCabecera["TiempoEnfermedad"]?>">
                </div>

                <!-- Signos y síntomas principales -->
                <div class="col-md-12">
                  <label for="editarSignosSintomas" class="form-label" style="font-weight: bold">Singos y síntomas principales: </label>
                  <input type="text" class="form-control" id="editarSignosSintomas" name="editarSignosSintomas" value="<?php echo $datosCabecera["SignosSintomas"]?>">
                </div>

                <!-- Relato Cronólogico -->
                <div class="col-md-12">
                  <label for="editarRelatoCronologico" class="form-label" style="font-weight: bold">Relato Cronólogico: </label>
                  <input type="text" class="form-control" id="editarRelatoCronologico" name="editarRelatoCronologico" value="<?php echo $datosCabecera["RelatoCronologico"]?>">
                </div>

                <!-- Funciones Biológicas -->
                <div class="col-md-12">
                  <label for="editarFuncionesBiologicas" class="form-label" style="font-weight: bold">Funciones Biológicas: </label>
                  <input type="text" class="form-control" id="editarFuncionesBiologicas" name="editarFuncionesBiologicas" value="<?php echo $datosCabecera["FuncionesBiologicas"]?>">
                </div>

                <!-- Antecedentes Familiares -->
                <div class="col-md-12">
                  <label for="editarAntecedentesFamiliares" class="form-label" style="font-weight: bold">Antecedentes Familiares: </label>
                  <textarea class="form-control" id="editarAntecedentesFamiliares" name="editarAntecedentesFamiliares" rows="3"><?php echo $datosCabecera["AntecedentesFamiliares"]?></textarea>
                </div>

                <!-- Antecedentes Personales -->
                <div class="col-md-12">
                  <label for="editarAntecedentesPersonales" class="form-label" style="font-weight: bold">Antecedentes Personales: </label>
                  <textarea class="form-control" id="editarAntecedentesPersonales" name="editarAntecedentesPersonales" rows="3"><?php echo $datosCabecera["AntecedentesPersonales"]?></textarea>
                </div>

                <h4>Exploración Física</h4>
                <!-- Presion Arterial -->
                <div class="col-md-2">
                  <label for="editarPresionArterial" class="form-label" style="font-weight: bold">P.A: </label>
                  <input type="text" class="form-control" id="editarPresionArterial" name="editarPresionArterial" value="<?php echo $datosDetalle["PresionArterial"]?>">
                </div>

                <!-- Pulso -->
                <div class="col-md-2">
                  <label for="editarPulsoPaciente" class="form-label" style="font-weight: bold">Pulso: </label>
                  <input type="text" class="form-control" id="editarPulsoPaciente" name="editarPulsoPaciente" value="<?php echo $datosDetalle["Pulso"]?>">
                </div>

                <!-- Antecedentes Personales -->
                <div class="col-md-2">
                  <label for="editarTemperaturaPaciente" class="form-label" style="font-weight: bold">Temperatura: </label>
                  <input type="text" class="form-control" id="editarTemperaturaPaciente" name="editarTemperaturaPaciente" value="<?php echo $datosDetalle["Temperatura"]?>">
                </div>

                <!-- Frecuencia Cardiaca -->
                <div class="col-md-2">
                  <label for="editarFrecuenciaCardiaca" class="form-label" style="font-weight: bold">F.C : </label>
                  <input type="text" class="form-control" id="editarFrecuenciaCardiaca" name="editarFrecuenciaCardiaca" value="<?php echo $datosDetalle["FrecuenciaCardiaca"]?>">
                </div>

                <!-- Frecuencia Respiratoria -->
                <div class="col-md-2">
                  <label for="editarFrecuenciaRespiratoria" class="form-label" style="font-weight: bold">Frec. Resp: </label>
                  <input type="text" class="form-control" id="editarFrecuenciaRespiratoria" name="editarFrecuenciaRespiratoria" value="<?php echo $datosDetalle["FrecuenciaRespiratoria"]?>">
                </div>

                <!-- Primer examen, evaluacion -->
                <div class="col-md-12">
                  <label for="editarExamenOdonto" class="form-label" style="font-weight: bold">Exámen Odontoestoamatológico: </label>
                  <textarea class="form-control" id="editarExamenOdonto" name="editarExamenOdonto" rows="3"><?php echo $datosDetalle["ExamenOdonto"]?></textarea>
                </div>

                <!-- Diagnóstico presuntivo -->
                <div class="col-md-12">
                  <label for="editarDiagnosticoPresuntivo" class="form-label" style="font-weight: bold">Diagnóstico Presuntivo: </label>
                  <input type="text" class="form-control" id="editarDiagnosticoPresuntivo" name="editarDiagnosticoPresuntivo" value="<?php echo $datosDetalle["DiagnosticoPresuntivo"]?>">
                </div>
                
                <!-- Diagnóstico Definitivo -->
                <div class="col-md-12">
                  <label for="editarDiagnosticoDefinitivo" class="form-label" style="font-weight: bold">Diagnóstico Definitivo: </label>
                  <input type="text" class="form-control" id="editarDiagnosticoDefinitivo" name="editarDiagnosticoDefinitivo" value="<?php echo $datosDetalle["DiagnosticoDefinitivo"]?>">
                </div>
                
                <!-- Pronóstico -->
                <div class="col-md-12">
                  <label for="editarPronosticoHistoria" class="form-label" style="font-weight: bold">Pronóstico: </label>
                  <input type="text" class="form-control" id="editarPronosticoHistoria" name="editarPronosticoHistoria" value="<?php echo $datosDetalle["Pronostico"]?>">
                </div>

                <!-- Tratamiento -->
                <div class="col-md-12">
                  <label for="editarTratamiento" class="form-label" style="font-weight: bold">Tratamiento: </label>
                  <textarea class="form-control" id="editarTratamiento" name="editarTratamiento" rows="3"><?php echo $datosDetalle["TratamientoPaciente"]?></textarea>
                </div>

                <!-- Alta Paciente -->
                <div class="col-md-12">
                  <label for="editarAltaPaciente" class="form-label" style="font-weight: bold">Alta Paciente: </label>
                  <textarea class="form-control" id="editarAltaPaciente" name="editarAltaPaciente" rows="3"><?php echo $datosDetalle["InformacionAlta"]?></textarea>
                </div>
                
              </div>
            </span>

            <!-- Plan de tratamiento, donde se mostrará toda la lista de Procedimientos -->
            <span class="border border-3 p-3">
              <div class="container row g-3">
                <h3>Plan de Tratamiento</h3>
                <div class="d-inline-flex m-2">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarProcedimiento">Agregar Procedimiento</button>
                </div>

                <div class="row" style="font-weight: bold">
                  <div class="col-lg-5">Descripción</div>
                  <div class="col-lg-5">Observacion</div>
                  <div class="col-lg-2">Precio(S/.)</div>
                </div>

                <div class="form-group row nuevoProcedimiento">
                  <?php
                    $listaProcedimientos = ControllerTratamiento::ctrMostrarDetalleTratamiento($_GET["codHistoria"]);
                    foreach($listaProcedimientos as $value)
                    {
                      echo'
                        <div class="row" style="padding:5px 15px">

                          <!-- Descripción del procedimiento -->     
                          <div class="col-lg-5" style="padding-right:0px">
                            <div class="input-group">
                              <input type="text" class="form-control nuevoprocedimiento" codProcedimiento="'.$value["IdProcedimiento"].'" value="'.$value["NombreProcedimiento"].'" readonly>
                            </div>
                          </div>
                  
                          <!-- Observacion -->
                          <div class="col-lg-5 observacionProcedimiento">
                            <input type="text" class="form-control nuevaObservacionTratamiento" name="nuevaObservacionTratamiento" value="'.$value["ObservacionProcedimiento"].'">
                          </div>
                  
                          <!-- Precio del procedimiento -->
                          <div class="col-lg-2 precioProcedimiento">
                            <input type="number" class="form-control nuevoPrecioProcedimiento" name="nuevoPrecioProcedimiento" min="1.00" step="0.01" value="'.$value["PrecioProcedimiento"].'" required>
                          </div> 
                  
                        </div>
                      ';
                    }
                  ?>
                  <input type="hidden" id="listarProcedimientos" name="listarProcedimientos">
                </div>
              </div>
            </span>

            <!-- Pie de historia -->
            <span class="border border-3 p-3">
              <div class="container row g-3 p-3">
                <h3>Costo Total</h3>
                <div class="row" style="font-weight: bold">
                  <div class="col-lg-2"></div>
                  <div class="col-lg-2"><span>Costo Total(S/.):</span></div><div class="col-lg-2"><input type="number" style="text-align: right;" class="form-control input-lg" id="nuevoTotalTratamiento" name="nuevoTotalTratamiento" value="<?php echo $datosTratamiento["TotalTratamiento"]?>"readonly></div>            
                </div>

                <div class="container row g-3 p-3 justify-content-between">
                  <button type="button" class="col-1 d-inline-flex-center p-2 btn btn-secondary cerrarHistoria">Cerrar</button>
                  <button type="submit" class="col-2 d-inline-flex-center p-2 btn btn-primary ">Editar Historia</button>
                </div>
              </div>
            </span>
          </form>
        </div>
      </main>
    </div>
  </div>

<?php
  $editarHistoriaClinica = new ControllerHistorias;
  $editarHistoriaClinica -> ctrEditarHistoria();
?>

  
<!-- Modal agregar nuevo procedimiento -->
<div class="modal fade" id="modalAgregarProcedimiento" tabindex="-1" role="dialog" aria-labelledby="modalAgregarProcedimiento" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Listado de Gastos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Cuerpo modal -->
      <div class="modal-body">
        <table class="table table-striped dt-responsive tablaProcedimientos" width="100%">
          <thead>
            <tr>
              <th style ="width:10px">#</th>
              <th>Descripción del Gasto</th>
              <th>Acciones</th>           
            </tr> 
          </thead>
          <tbody>
            <?php
              $listaProcedimientos = ControllerProcedimientos::ctrMostraProcedimientosHistoria();
              foreach ($listaProcedimientos as $key => $value)
              {
                echo ' 
                  <tr>
                    <td>'.($key + 1).'</td>
                    <td>'.$value["NombreProcedimiento"].'</td>
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-primary btnAgregarProcedimiento recuperarBoton" codProcedimiento="'.$value["IdProcedimiento"].'">Agregar</button> 
                      </div>
                    </td>
                  </tr>'
                ;
              }
            ?> 
          </tbody>
        </table>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary pull-left" data-bs-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>
