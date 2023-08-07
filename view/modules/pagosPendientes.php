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
            <button type="button" class="btn btn-warning btnNuevoPago" id="btnNuevoPago">
              Agregar Nuevo Pago
            </button>
          </div>

          <div class="card-body">
            <table id="datatablesSimple" class="data-table-AllCostos table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Paciente</th>
                  <th>Deuda Total</th>
                  <th>Total Pagado</th>
                  <th>Deuda Actual</th>
                  <th>Fecha de último Pago</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
              <!-- MOSTRAR EL COSTO DEL PLAN DE TRATAMIENTO Y DEBEMOS MOSTRAR CUANDO SE HA PAGADO DE ESTE PLAN, LA DEUDA TOTAL  Y LA DEUDA ACTUAL, TODO EN RELACION AL TRATAMIENTO -->
              </tbody>
            </table>
          </div>
        </div>
      </main>
    </div>
  </div>