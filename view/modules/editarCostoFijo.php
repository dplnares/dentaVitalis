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
          <h1 class="mt-4">
            <?php 
              if(isset($_GET["codCosto"]))
              {
                $cabeceraIngreso = ControllerCostos::ctrObtenerCabaceraGF($_GET["codCosto"]);
                echo "Editar Costo".' - '.$cabeceraIngreso["NumeroDocumento"] ;
              }
              else 
              {
                echo'
                  <script>
                    window.location = "index.php?ruta=costosfijos";
                  </script>
                ';
              }
            ?>
          </h1>
        </div>

        <div class="container-fluid">
          <form role="form" method="post" class="row g-3 m-2 formularioCostoFijo">

            <!-- Cabecera -->
            <span class="border border-3 p-3">
              <div class="container row g-3">

                <h3>Datos Cabecera</h3>
                <!-- Seleccionar el Socio -->
                <div class="form-group col-md-4">
                  <label for="socioGastoFijo" class="form-label" style="font-weight: bold">Socio:</label>
                  <select class="form-control" name="socioGastoFijo">
                    <?php
                      $listaSocios = ControllerSocios::ctrMostrarSociosGastos();
                      foreach ($listaSocios as $value)
                      {
                        echo '<option value="'.$value["IdSocio"].'">'.$value["NombreSocio"].'</option>';
                      }
                    ?>
                  </select>
                </div>

                <!-- Numero de documento -->
                <div class="col-md-4">
                  <label for="numeroDocumentoGastoFijo" class="form-label" style="font-weight: bold">Número de documento</label>
                  <input type="text" class="form-control" id="numeroDocumentoGastoFijo" name="numeroDocumentoGastoFijo">
                </div>

                <!-- Seleccionar la fecha del costo -->
                <div class="col-md-4">
                  <label for="fechaIngresoGastoFijo" class="form-label" style="font-weight: bold">Fecha de Documento</label>
                  <input type="date" class="form-control" id="fechaIngresoGastoFijo" name="fechaIngresoGastoFijo">
                </div>
              </div>
            </span>

            <!-- Detalle del Costo -->
            <span class="border border-3 p-3">
              <div class="container row g-3">
                <h3>Datos Detalle</h3>
                <div class="d-inline-flex m-2">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarGastoFijo">Agregar Gasto</button>
                </div>

                <div class="row" style="font-weight: bold">
                  <div class="col-lg-4">Nombre Gasto</div>
                  <div class="col-lg-5">Observacion</div>
                  <div class="col-lg-1">Cantidad</div>
                  <div class="col-lg-2">Costo(S/.)</div>
                </div>

                <div class="form-group row nuevoGastoFijo">
                  <input type="hidden" id="listarGastosFijos" name="listarGastosFijos">
                </div>
              </div>
            </span>

            <!-- Pie de movimiento -->
            <span class="border border-3 p-3">
              <div class="container row g-3">
                <h3>Datos Total</h3>
                <div class="row" style="font-weight: bold">
                  <div class="col-lg-2"></div>
                  <div class="col-lg-2"><span>SubTotal (S/.):</span></div><div class="col-lg-2"><input type="number" style="text-align: right;" class="form-control input-lg" id="nuevoSubTotalGastoFijo" name="nuevoSubTotalGastoFijo" placeholder="0.00" readonly></div>            
                </div>

                <div class="row" style="font-weight: bold">
                  <div class="col-lg-2"></div>
                  <div class="col-lg-2"><span>IGV (S/.):</span></div><div class="col-lg-2"><input type="number" style="text-align: right;" class="form-control input-lg" min="0" id="nuevoImpuestoGastoFijo" name="nuevoImpuestoGastoFijo" placeholder="0.00" readonly></div>              
                </div>

                <div class="row" style="font-weight: bold">
                  <div class="col-lg-2"></div>
                  <div class="col-lg-2"><span>Total (S/.):</span></div><div class="col-lg-2"><input type="number" style="text-align: right;" class="form-control input-lg" min="0" id="nuevoTotalGastoFijo" name="nuevoTotalGastoFijo" placeholder="0.00" readonly></div>              
                </div>
              </div>

              <div class="container row g-3 p-3">
                <button type="submit" class="col-2 d-inline-flex p-2 btn btn-primary ">Editar Registro</button>
              </div>
            </span>

          </form>
        </div>
      </main>
    </div>
  </div>

<?php
  $crearGastoFijo = new ControllerCostos;
  $crearGastoFijo -> ctrCrearNuevoCostoFijo();
?>

<!-- Modal agregar un nuevo gasto -->
<div class="modal fade" id="modalAgregarGastoFijo" tabindex="-1" role="dialog" aria-labelledby="modalAgregarGastoFijo" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Listado de Gastos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Cuerpo modal -->
      <div class="modal-body">
        <table class="table table-striped dt-responsive tablaGastos" width="100%">
          <thead>
            <tr>
              <th style ="width:10px">#</th>
              <th>Descripción del Gasto</th>
              <th>Acciones</th>           
            </tr> 
          </thead>
          <tbody>
            <?php
              $listaGastos = ControllerGastos::ctrMostrarGastosPorTipo("1");
              foreach ($listaGastos as $key => $value)
              {
                echo ' 
                  <tr>
                    <td>'.($key + 1).'</td>
                    <td>'.$value["NombreGasto"].'</td>
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-primary btnAgregarGastoFijo recuperarBoton" codGasto="'.$value["IdGasto"].'">Agregar</button> 
                      </div>
                    </td>
                  </tr>'
                ;
              }
            ?>
          </tbody>
        </table>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary pull-left" data-bs-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>
