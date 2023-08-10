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
          <h1 class="mt-4">Todos los Pagos Pendientes</h1>
          <div class="d-inline-flex m-2">

          </div>

          <div class="card-body">
            <table id="datatablesSimple" class="data-table-AllCostos table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Paciente</th>
                  <th>DNI</th>
                  <th>Deuda Total (S/.)</th>
                  <th>Total Pagado (S/.)</th>
                  <th>Deuda Actual (S/.)</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $listaCostoTratamientos = ControllerPagos::ctrMostrarTotalPorPaciente();
                  foreach ($listaCostoTratamientos as $key => $value)
                  {
                    $deudaActual = $value["TotalTratamiento"] - $value["TotalPagado"];
                    echo
                      '<tr>
                        <td>'.($key + 1).'</td>
                        <td>'.$value["NombrePaciente"].' '.$value["ApellidoPaciente"].'</td>
                        <td>'.$value["DNIPaciente"].'</td>
                        <td>'.$value["TotalTratamiento"].'</td>
                        <td>'.$value["TotalPagado"].'</td>
                        <td>'.$deudaActual.'</td>
                        <td>
                          <button class="btn btn-success btnDescargarPagosPendientes" id="btnDescargarPagosPendientes" codPaciente="'.$value["IdPaciente"].'"><i class="fa-solid fa-file-text"></i></button>
                          <button class="btn btn-primary btnVisualizarPagos" id="btnVisualizarPagos" codPaciente="'.$value["IdPaciente"].'" codHistoria="'.$value["IdHistoriaClinica"].'"><i class="fa fa-eye"></i></button>
                        </td>
                      </tr>';
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </main>
    </div>
  </div>