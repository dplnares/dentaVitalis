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
          <h1 class="mt-4">Reporte de Costos</h1>

        <!-- Gasto total actual--> 
        <div class="row">
          <!-- <div class="col-xl-4 col-md-6">
            <div class="card bg-primary text-white mb-4">
              <div class="card-body">
                <label style="font-size: 17px">
                  <?php 
                    // $costosTotal = ControllerCostos::ctrSumarTodosCostos();
                    // echo 'Costo Total Actual  (S/.) : '.$costosTotal["suma_total"];
                  ?>
                </label>
              </div>
              <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="allCostos">Ver Detalles</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
              </div>
            </div>
          </div> -->

          <!-- Costos total de este mes -->
          <div class="col-xl-6 col-md-6">
            <div class="card bg-success text-white mb-4">
              <div class="card-body">
                <label style="font-size: 17px">
                  <?php 
                    $mayorCostoMes = ControllerCostos::ctrSumarCostosMesActual();
                    echo 'Costo Total del Mes (S/.) : '.$mayorCostoMes["suma_mes"];
                  ?>
                </label>
              </div>
              <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">Ver Detalles</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
              </div>
            </div>
          </div>

          <!-- Centro de costos en el que se gasto más -->
          <div class="col-xl-6 col-md-6">
            <div class="card bg-danger text-white mb-4">
              <div class="card-body">
                <label style="font-size: 17px">
                  <?php 
                    $mayorCentroCostos = ControllerCostos::ctrSumarMayorCentroCostos();
                    echo 'Mayor Costo : '.$mayorCentroCostos["DescripcionCentro"].'.  (S/.) '.$mayorCentroCostos["SumaMayorCosto"];
                  ?>
                </label>
              </div>
              <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">Ver Detalles</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
              </div>
              </div>
            </div>
          </div>

          <!-- Grafica de gastos por filtrado de fecha -->
          <div class="row justify-content-center">
            <div class="col-xl-10">
              <div class="d-inline-flex m-2">
                <button type="button" class="btn btn-success" id="dateRangeRptCostoFecha">
                  <i class="fa fa-calendar"></i> Rango de fecha  <i class="fa fa-caret-down"></i>
                </button>
              </div>

              <div class="card mb-4">
                <div class="card-header">
                  <i class="fas fa-chart-area me-1"></i>
                  Costo Por Rango De Fechas
                </div>
                <div class="card-body"><canvas id="chartCostoFecha" width="100%" height="40"></canvas></div>
              </div>
            </div>
          </div>

          <div class="row justify-content-center">
            <div class="col-xl-10">
              <div class="d-inline-flex m-2">
                <select class="form-select" name="chartCentroCostos" id="chartCentroCostos" required>
                  <option selected="true" value="" disabled>Centro de Costos</option>
                  <?php
                    $centrosCostos = ControllerCostos::ctrMostrarCentrosCostos();
                    foreach ($centrosCostos as $key => $value)
                    {
                      echo '<option value="'.$value["IdCentroCostos"].'">'.$value["DescripcionCentro"].'</option>';
                    }
                  ?>
                </select>
              </div>
              <div class="card mb-4">
                <div class="card-header">
                  <i class="fas fa-chart-bar me-1"></i>
                  Bar Chart Example
                </div>
                <div class="card-body"><canvas id="charCentroCosto" width="100%" height="40"></canvas></div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
