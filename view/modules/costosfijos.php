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
          <h1 class="mt-4">Todos los Costos Fijos</h1>
          
          <div class="d-inline-flex m-2">
            <button type="button" class="btn btn-warning btnNuevoGastoFijo" id="btnNuevoGastoFijo">
              Nuevo Gasto Fijo
            </button>
          </div>

          <div class="card mb-4">
            <div class="card-header">
              <i class="fas fa-table me-1"></i>
              Todos los Costos Fijos
            </div>

            <div class="card-body">
              <table id="datatablesSimple" class="data-table-AllGastos table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nombre Socio</th>
                    <th>Numero Documento</th>
                    <th>Fecha de Documento</th>
                    <th>Total</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $listaCostos = ControllerCostos::ctrMostrarCostosFijos();
                    foreach ($listaCostos as $key => $value)
                    {
                      echo
                      '<tr>
                        <td>'.($key + 1).'</td>
                        <td>'.$value["NombreSocio"].'</td>
                        <td>'.$value["NumeroDocumento"].'</td>
                        <td>'.$value["FechaCosto"].'</td>
                        <td>'.$value["TotalCosto"].'</td>
                        <td>
                          <button class="btn btn-warning btnEditarCostoFijo" id="btnEditarCostoFijo" codCosto="'.$value["IdCosto"].'"><i class="fa-solid fa-pencil"></i></button>
                          <button class="btn btn-danger btnEliminarCosto" codCosto="'.$value["IdCosto"].'"><i class="fa-solid fa-trash"></i></button>
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
  $eliminarCostoFijo = new ControllerCostos();
  $eliminarCostoFijo -> ctrEliminarCosto();
?>