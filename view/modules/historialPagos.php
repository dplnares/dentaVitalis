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
          <h1 class="mt-4">Historial de pagos</h1>
          <div class="d-inline-flex m-2">
          <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalAgregarPago">
              Agregar Nuevo Pago
            </button>
          </div>

          <div class="card-body">
            <table id="datatablesSimple" class="data-table-AllCostos table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Paciente</th>
                  <th>DNI</th>
                  <th>Total Cancelado</th>
                  <th>Tipo de Pago</th>
                  <th>Fecha de Pago</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $listaPagos = ControllerPagos::ctrMostrarTodosLosPagos();
                  foreach($listaPagos as $key => $value)
                  {
                    echo
                    '<tr>
                      <td>'.($key + 1).'</td>
                      <td>'.$value["NombrePaciente"].' '.$value["ApellidoPaciente"].'</td>
                      <td>'.$value["DNIPaciente"].'</td>
                      <td>'.$value["TotalPago"].'</td>
                      <td>'.$value["DescripcionTipo"].'</td>
                      <td>'.$value["FechaPago"].'</td>
                      <td>
                        <button class="btn btn-success btnDescargarPago" id="btnDescargarPago" codPago="'.$value["IdPago"].'"><i class="fa-solid fa-file-text"></i></button>
                        <button class="btn btn-warning btnEditarPago" id="btnEditarPago" codPago="'.$value["IdPago"].'"><i class="fa-solid fa-pencil"></i></button>
                        <button class="btn btn-danger btnEliminarPago" codPago="'.$value["IdPago"].'"><i class="fa-solid fa-trash"></i></button>
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

<!-- Modal Agregar un nuevo Paciente -->
<div class="modal fade" id="modalAgregarPago" tabindex="-1" role="dialog" aria-labelledby="modalAgregarPago" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Generar un nuevo Pago</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Cuerpo modal -->
      <div class="modal-body">
        <form role="form" method="post">
          <!-- DNI Paciente -->
          <div class="form-group">
            <label for="dniPacientePago" class="col-form-label">DNI:</label>
            <input type="text" class="form-control" id="dniPacientePago" name="dniPacientePago">
          </div>

          <!-- Nombre del Paciente-->
          <div class="form-group">
            <label for="nombrePaciente" class="col-form-label">Nombre del Paciente:</label>
            <input type="text" class="form-control" id="nombrePaciente" name="nombrePaciente" readonly>
          </div>

          <!-- Tipo de pago -->
          <div class="form-group">
            <label for="nombrePaciente" class="col-form-label">Método de Pago:</label>
            <select class="form-control tipoDePago" name="tipoDePago">
              <?php
                $listaTipoPago = ControllerPagos::ctrMostrarTiposPago();
                foreach ($listaTipoPago as $value)
                {
                  echo '<option value="'.$value["IdTipoPago"].'">'.$value["DescripcionTipo"].'</option>';
                }
              ?>
            </select>
          </div>

          <!-- Monto a Pagar -->
          <div class="form-group">
            <label for="montoDePAgo" class="col-form-label">Monto a Cancelar:</label>
            <input type="text" class="form-control" id="montoDePAgo" name="montoDePAgo">
          </div>
          
          <!-- Subir archivo-->
          <div class="form-group">
            <label for="comprobantePago" class="col-form-label">Subir Archivo:</label>
            
            <div class="input-group">
              <label class="input-group-btn">
                <span class="btn-file">
                  <input accept=".jpg,.png,.jpeg,.pdf" class="hidden" name="comprobantePago" type="file" id="comprobantePago">
                </span>
              </label>

            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Generar PAgo</button>
          </div>
          <?php
            $crearNuevoPago = new ControllerPagos();
            //$crearNuevoPago -> ctrGenerarNuevoPago();
          ?>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
  $eliminarPago = new ControllerPagos();
  $eliminarPago -> ctrEliminarPago();
?>