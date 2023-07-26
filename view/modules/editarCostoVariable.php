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
                $cabeceraIngreso = ControllerCostos::ctrObtenerCabaceraGV($_GET["codCosto"]);
                echo "Editar Costo".' - '.$cabeceraIngreso["NumeroDocumento"] ;
              }
              else 
              {
                echo'
                  <script>
                    window.location = "index.php?ruta=costosvariables";
                  </script>
                ';
              }
            ?>
          </h1>
        </div>

        <div class="container-fluid">
          <form role="form" method="post" class="row g-3 m-2 formularioCostoVariable">

            <!-- Cabecera -->
            <span class="border border-3 p-3">
              <div class="container row g-3">

                <h3>Datos Cabecera</h3>
                <!-- Nombre del proveedor -->
                <div class="col-md-4">
                  <label for="editarNombreProveedorGastoVariable" class="form-label" style="font-weight: bold">Nombre de Proveedor</label>
                  <input type="text" class="form-control" id="editarNombreProveedorGastoVariable" name="editarNombreProveedorGastoVariable" value="<?php echo $cabeceraIngreso["NombreProveedor"] ?>">
                </div>

                <!-- Numero de documento -->
                <div class="col-md-4">
                  <label for="editarNumeroDocumentoGastoVariable" class="form-label" style="font-weight: bold">Número de documento</label>
                  <input type="text" class="form-control" id="editarNumeroDocumentoGastoVariable" name="editarNumeroDocumentoGastoVariable" value="<?php echo $cabeceraIngreso["NumeroDocumento"] ?>">
                </div>

                <!-- Seleccionar la fecha del costo -->
                <div class="col-md-4">
                  <label for="editarFechaIngresoGastoVariable" class="form-label" style="font-weight: bold">Fecha de Documento</label>
                  <input type="date" class="form-control" id="editarFechaIngresoGastoVariable" name="editarFechaIngresoGastoVariable" value="<?php echo $cabeceraIngreso["FechaCosto"] ?>">
                </div>
              </div>
            </span>

            <!-- Detalle del Costo -->
            <span class="border border-3 p-3">
              <div class="container row g-3">
                <h3>Datos Detalle</h3>
                <div class="d-inline-flex m-2">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarGastoVariable">Agregar Gasto</button>
                </div>

                <div class="row" style="font-weight: bold">
                  <div class="col-lg-4">Nombre Gasto</div>
                  <div class="col-lg-5">Observacion</div>
                  <div class="col-lg-1">Cantidad</div>
                  <div class="col-lg-2">Costo(S/.)</div>
                </div>

                <div class="form-group row nuevoGasto">
                  <?php
                    $listaCostos = ControllerCostos::ctrObtenerDetalleGF($_GET["codCosto"]);
                    foreach($listaCostos as $value)
                    {
                      echo '
                      <div class="row" style="padding:5px 15px">

                        <!-- Descripción del producto -->
                        <div class="col-lg-4" style="padding-right:0px">
                          <div class="input-group">
                            <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarGasto" idProducto="'.$value["IdGasto"].'"><i class="fa fa-times"></i></button></span>
                            <input type="text" class="form-control nuevogasto" idGasto="'.$value["IdGasto"].'" name="agregarProducto" value="'.$value["NombreGasto"].'" readonly>
                          </div>
                        </div>

                        <!-- Observacion -->
                        <div class="col-lg-5">
                          <input type="text" class="form-control nuevaObservacionGasto" name="nuevaObservacionGasto" value="'.$value["ObservacionGasto"].'" >
                        </div>

                        <!-- Cantidad -->
                        <div class="col-lg-1">
                          <input type="text" class="form-control cantidadGasto" name="cantidadGasto" value="1" readonly>
                        </div>

                        <!-- Costo -->
                        <div class="col-lg-2 ingresoCantidad">
                          <input type="number" class="form-control nuevoCostoGasto" name="nuevoCostoGasto" min="1" value="'.$value["PrecioGasto"].'" required>
                        </div>
                      </div>
                      ';
                    }
                  ?>
                  <input type="hidden" id="listarGastos" name="listarGastos">
                </div>
              </div>
            </span>

            <!-- Pie de movimiento -->
            <span class="border border-3 p-3">
              <div class="container row g-3">
                <h3>Datos Total</h3>
                <div class="row" style="font-weight: bold">
                  <div class="col-lg-2"></div>
                  <div class="col-lg-2"><span>SubTotal (S/.):</span></div><div class="col-lg-2"><input type="number" style="text-align: right;" class="form-control input-lg" id="nuevoSubTotalGasto" name="nuevoSubTotalGasto" value="<?php echo $cabeceraIngreso["SubTotalCosto"] ?>" readonly></div>
                </div>

                <div class="row" style="font-weight: bold">
                  <div class="col-lg-2"></div>
                  <div class="col-lg-2"><span>IGV (S/.):</span></div><div class="col-lg-2"><input type="number" style="text-align: right;" class="form-control input-lg" min="0" id="nuevoImpuestoGasto" name="nuevoImpuestoGasto" value="<?php echo $cabeceraIngreso["IGVCosto"] ?>" readonly></div>
                </div>

                <div class="row" style="font-weight: bold">
                  <div class="col-lg-2"></div>
                  <div class="col-lg-2"><span>Total (S/.):</span></div><div class="col-lg-2"><input type="number" style="text-align: right;" class="form-control input-lg" min="0" id="nuevoTotalGasto" name="nuevoTotalGasto" value="<?php echo $cabeceraIngreso["TotalCosto"] ?>" readonly></div>
                </div>
              </div>

              <div class="container row g-3 p-3">
                <input type="hidden" name="codCosto" id="codCosto" value="<?php echo $_GET["codCosto"] ?>"> 
                <button type="submit" class="col-2 d-inline-flex p-2 btn btn-primary ">Editar Registro</button>
              </div>
            </span>
          </form>
        </div>
      </main>
    </div>
  </div>

<?php
  $editarCostoVariable = new ControllerCostos;
  $editarCostoVariable -> ctrEditaroCostoVariable();
?>

<!-- Modal agregar un nuevo gasto -->
<div class="modal fade" id="modalAgregarGastoVariable" tabindex="-1" role="dialog" aria-labelledby="modalAgregarGastoVariable" aria-hidden="true">
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
                        <button class="btn btn-primary btnAgregarGasto recuperarBoton" codGasto="'.$value["IdGasto"].'">Agregar</button> 
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
