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
          <h1 class="mt-4">Todos los Costos</h1>
          
          <div class="d-inline-flex m-2">
            <button type="button" class="btn btn-warning btnNuevoCosto" id="btnNuevoCosto">
              Agregar Nuevo Costo
            </button>
          </div>

          <div class="card mb-4">
            <div class="card-header">
              <i class="fas fa-table me-1"></i>
              Todos los Costos Fijos
            </div>

            <div class="card-body">
              <table id="datatablesSimple" class="data-table-AllCostos table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Centro de Costos</th>
                    <th>Mes de Costo</th>
                    <th>Total</th>
                    <th>Fecha Creacion</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $listaCostos = ControllerCostos::ctrMostrarTodosCostos();
                    foreach($listaCostos as $value)
                    {
                      
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
