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
          <h1 class="mt-4">Todos los Gastos</h1>
          
          <div class="d-flex m-2">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalNuevoGasto">
              Todos los Gastos
            </button>
          </div>

          <div class="card mb-4">
            <div class="card-header">
              <i class="fas fa-table me-1"></i>
              Todos los Gastos
            </div>

            <div class="card-body">
              <table id="datatablesSimple" class="data-table-AllGastos table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Fecha Compra</th>
                    <th>Total</th>
                    <th>Fecha de Creacion</th>
                    <th>UsuarioCreado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $listaGastos = ControllerMovimientos::ctrMostrarAllGastos();
                    foreach ($listaGastos as $value)
                    {
                      
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>e
        </div>
      </main>
    </div>
  </div>
