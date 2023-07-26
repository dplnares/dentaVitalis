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
          <h1 class="mt-4">Todos los Costos Variables</h1>
          
          <div class="d-inline-flex m-2">
            <button type="button" class="btn btn-warning btnNuevoGastoVariable" id="btnNuevoGastoVariable">
              Nuevo Gasto Variable
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
                    <th>Proveedor</th>
                    <th>Numero Documento</th>
                    <th>Fecha de Documento</th>
                    <th>Total</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $listaCostosVariables = ControllerCostos::ctrMostrarCostosVariables("2");
                    foreach ($listaCostosVariables as $key => $value)
                    {
                      echo
                      '<tr>
                        <td>'.($key + 1).'</td>
                        <td>'.$value["NombreProveedor"].'</td>
                        <td>'.$value["NumeroDocumento"].'</td>
                        <td>'.$value["FechaCosto"].'</td>
                        <td>'.$value["TotalCosto"].'</td>
                        <td>
                          <button class="btn btn-warning btnEditarCostoVariable" id="btnEditarCostoVariable" codCosto="'.$value["IdCosto"].'"><i class="fa-solid fa-pencil"></i></button>
                          <button class="btn btn-danger btnEliminarCostoVariable" codCosto="'.$value["IdCosto"].'"><i class="fa-solid fa-trash"></i></button>
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