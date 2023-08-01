</div>
      </div>
      <div class="sb-sidenav-footer">
        <div class="small">Sesión iniciada como:</div>
        <?php echo $_SESSION["nombreUsuario"] ?>
      </div>
    </nav>
  </div>
  <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid px-4 todosLosCostos">
        <h1 class="mt-4">
          <?php
            if (isset($_GET["fechaInicial"])) 
            {
              $fechaInicial = $_GET["fechaInicial"];
              $fechaFinal = $_GET["fechaFinal"];
              echo 'Reporte de Costos (Del : ' . $fechaInicial . ' Hasta: ' . $fechaFinal . ')';
            } 
            else 
            {
              $fechaInicial = null;
              $fechaFinal = null;
              echo 'Reporte de Costos';
            }
          ?>
        </h1>

        <div class="d-inline-flex m-2">
          <button type="button" class="btn btn-warning" id="dateRangeCosto">
            <i class="fa fa-calendar"></i> Rango de fecha<i class="fa fa-caret-down"></i>
          </button>
          <button type="button" class="btn btn-success btnDescargarRptCostos" id="btnDescargarRptCostos">
            <i class="fa fa-file-excel"></i> Descargar Excel
          </button>
        </div>

        <div class="card-body">
          <table class="table table-bordered table-striped dt-responsive tablasReporteCostos" width="100%">
            <thead>
              <tr>
                <th>Centro de Costos</th>
                <th>Socio</th>
                <th>Gasto</th>
                <th>Nro. Documento</th>
                <th>Fecha</th>
                <th>Costo</th>
              </tr>
            </thead>
            <tbody class="listaCostosPickFechas">

            </tbody>
          </table>
          <input type="hidden" value="<?php echo $fechaInicial; ?>" id="fechaInicial">
          <input type="hidden" value="<?php echo $fechaFinal; ?>" id="fechaFinal">
        </div>

      </div>
    </main>
  </div>
</div>