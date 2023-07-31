//  Mostrar los datos en el modal para editar centro de costos
$(".table").on("click", ".btnEditarCentro", function () {
  var codCentroCosto = $(this).attr("codCentroCosto");
  var datos = new FormData();

  datos.append("codCentroCosto", codCentroCosto);
  $.ajax({
    url: "ajax/costos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",

    success: function (respuesta) {
      $("#editarNombreCentro").val(respuesta["DescripcionCentro"]);
      $("#codCentroCosto").val(respuesta["IdCentroCostos"]);
    }
  });
});

//  Alerta para eliminar un centro de costos
$(".table").on("click", ".btnEliminarCentro", function () {
  var codCentroCosto = $(this).attr("codCentroCosto");

  swal.fire({
    title: '¿Está seguro de borrar el centro de costos?',
    text: "¡No podrá revertir el cambio!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar Centro de Costos!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "index.php?ruta=centroCostos&codCentroCosto="+codCentroCosto;
    }
  });
});

//  Redirigir la vista para crear un nuevo gasto fijo
$("#btnNuevoCosto").on("click", function(){
  window.location = "index.php?ruta=crearNuevoCosto";
});


//  Agregar los productos del modal al detalle del ingreso
$(".tablaGastos").on("click", ".btnAgregarGasto", function(){
  
  var codGastoAgregar = $(this).attr("codGasto");
  $(this).removeClass("btn-primary btnAgregarGasto");
  $(this).addClass("btn-default disabled");

  var datos = new FormData();
  datos.append("codGastoAgregar", codGastoAgregar);
  $.ajax({
    url:"ajax/gastos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta)
    {
      var idGasto = respuesta["IdGasto"];
      var nombreGasto = respuesta["NombreGasto"];

      $(".nuevoGasto").append(
      '<div class="row" style="padding:5px 15px">'+

        '<!-- Descripción del producto -->'+          
        '<div class="col-lg-2" style="padding-right:0px">'+
          '<div class="input-group">'+
            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarGasto" idGasto="'+idGasto+'"><i class="fa fa-times"></i></button></span>'+
            '<input type="text" class="form-control nuevogasto" idGasto="'+idGasto+'" value="'+nombreGasto+'" readonly>'+
          '</div>'+
        '</div>'+

        '<!-- Observacion -->'+
        '<div class="col-lg-2 ingresoObservacionGasto">'+
          '<input type="text" class="form-control nuevaObservacionGasto" name="nuevaObservacionGasto" >'+
        '</div>' +

        '<!-- Cantidad del producto -->'+
        '<div class="col-lg-1 ingresoCantidad">'+
          '<input type="number" class="form-control cantidadGasto" name="cantidadGasto" value="1" readonly>'+
        '</div>' +

        '<!-- Socio -->'+
          '<div class="col-lg-2 ingresoSocio">'+
            '<input type="text" class="form-control nuevoSocio" name="nuevoSocio">'+
          '</div>'+

        '<!-- Numero Documento -->'+
        '<div class="col-lg-2 ingresoNroDocumento">'+
          '<input type="text" class="form-control nuevonNroDocumento" name="nuevonNroDocumento" required>'+
        '</div>' +

        '<!-- Fecha de Documento -->'+
        '<div class="col-lg-2 ingresoFecha">'+
          '<input type="date" class="form-control nuevaFechaDocumento" name="nuevaFechaDocumento" required>'+
        '</div>' +

        '<!-- Precio del Gasto -->'+
        '<div class="col-lg-1 ingresoPrecioGasto">'+
          '<input type="number" class="form-control nuevoCostoGasto" name="nuevoCostoGasto" min="1.00" step="0.01" required>'+
        '</div>' +

      '</div>'
      );
      listarGastos();
      sumarListaGastos();
    },
    error: function(jqXHR, textStatus, errorThrown) {
      // Manejar el error aquí si es necesario
      console.log("Error en la solicitud AJAX: ", textStatus, errorThrown);
    } 
	});
});

//  Actualizar el costo de un gasto
$(".formularioCostoFijo").on("change", "input.nuevoCostoGasto", function(){
  listarGastos();
  sumarListaGastos();
});

//  Actualizar el modal al momento de modificar el centro de costos, solo mostrará los gastos que tienen este codigo de centro de costos.
$("#centroDeCostos").change(function(){
  var codCCostosModal = $('#centroDeCostos').val();
  var datos = new FormData();

  datos.append("codCCostosModal", codCCostosModal);
  $.ajax({
    url:"ajax/gastos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta)
    {
      respuesta.forEach(elemento => {
        $(".nuevaListaGastos").append(
          '<tr>'+
          '<td> 1 </td>'+
          '<td>'+elemento["NombreGasto"]+'</td>'+
          '<td>'+
            '<div class="btn-group">'+
              '<button class="btn btn-primary btnAgregarGasto recuperarBoton" codGasto="'+elemento["IdGasto"]+'">Agregar</button>'+
            '</div>'+
          '</td>'+
        '</tr>'
        );
      });
    }
  });
});

//  FUNCIONES PARA SUMAR Y LISTAR LOS PRODUCTOS
function listarGastos()
{
  var listarGastos = [];
  var recurso = $(".nuevogasto")
  var observacion = $(".nuevaObservacionGasto")
  var socio = $(".nuevoSocio")
  var nroDocumento = $(".nuevonNroDocumento")
  var fechaDocumento = $(".nuevaFechaDocumento")
  var precioGasto = $(".nuevoCostoGasto")
  for(var i = 0; i < recurso.length; i++)
  {
    listarGastos.push({
      "CodGasto" : $(recurso[i]).attr("idGasto"),
      "Observacion" : $(observacion[i]).val(),
      "Socio" : $(socio[i]).val(),
      "NroDocumento" : $(nroDocumento[i]).val(),
      "FechaDocumento" : $(fechaDocumento[i]).val(),
      "PrecioGasto" : $(precioGasto[i]).val(),
    });
  }
  $("#listarGastos").val(JSON.stringify(listarGastos));
}

function sumarListaGastos()
{
  var precioGasto = $(".nuevoCostoGasto");
  var arraySumaPrecio = []; 

  for(var i = 0; i < precioGasto.length; i++)
  {
    arraySumaPrecio.push(Number($(precioGasto[i]).val()));
  }

  //  Funcion para sumar todos los precios del array
  function sumaArrayPrecios(total, numero)
  {
    return total + numero;
  }

  if(arraySumaPrecio.length == 0)
  {
    var sumaTotalPrecio = 0;
  }
  else
  {
    var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
  }

  $("#nuevoTotalGasto").val(sumaTotalPrecio.toFixed(2));
}