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
          <h1 class="mt-4">Todas las historias clínicas</h1>
          <div class="d-inline-flex m-2">
            <button type="button" class="btn btn-warning btnNuevaHistoria" id="btnNuevaHistoria">
              Nueva Historia Clinica
            </button>
          </div>

          <div class="card mb-4">
            <div class="card-header">
              <i class="fas fa-table me-1"></i>
              Todas las historias clínicas
            </div>

            <div class="card-body">
              <table id="datatablesSimple" class="data-table-AllHistorias table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>DNI</th>
                    <th>Medico Asignado</th>
                    <th>Última Actualización</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $listaHistorias = ControllerHistorias::ctrMostrarAllHistorias();
                    foreach ($listaHistorias as $key => $value)
                    {
                      echo
                      '<tr>
                        <td>'.($key + 1).'</td>
                        <td>'.$value["NombrePaciente"].'</td>
                        <td>'.$value["ApellidoPaciente"].'</td>
                        <td>'.$value["DNIPaciente"].'</td>
                        <td>'.$value["NombreSocio"].'</td>
                        <td>'.$value["FechaActualiza"].'</td>
                        <td>
                          <button class="btn btn-success btnVisualizarHistoria" id="btnVisualizarHistoria" codHistoria="'.$value["IdHistoriaClinica"].'"><i class="fa-solid fa-eye"></i></button>
                          <button class="btn btn-warning btnEditarHistoria" id="btnEditarHistoria" codPaciente="'.$value["IdPaciente"].'"  codHistoria="'.$value["IdHistoriaClinica"].'"><i class="fa-solid fa-pencil"></i></button>
                          <button class="btn btn-primary btnAsignarCita" id="btnAsignarCita" codHistoria="'.$value["IdHistoriaClinica"].'"><i class="fa-solid fa-calendar"></i></button>
                          <button class="btn btn-danger btnEliminarHistoria" codHistoria="'.$value["IdHistoriaClinica"].'"><i class="fa-solid fa-trash"></i></button>
                        </td>
                      </tr>';
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

<?php
  $eliminarHistoria = new ControllerHistorias();
  $eliminarHistoria -> ctrEliminarHistoria();
?>