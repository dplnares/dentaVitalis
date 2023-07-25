//  Redirigir la vista para crear un nuevo gasto fijo
$("#btnNuevoGastoFijo").on("click", function(){
  window.location = "index.php?ruta=crearNuevoCostoFijo";
});

//  Redirigir la vista para editar un gasto fijo
$("#btnEditarCostoFijo").on("click", function(){
  var codCosto = $(this).attr("codCosto");
  if(codCosto!=null)
  {
    window.location = "index.php?ruta=editarCostoFijo&codCosto="+codCosto;
  }
});

//  Alerta para eliminar un gasto Fijo
$(".table").on("click", ".btnEliminarCosto", function () {
  var codCosto = $(this).attr("codCosto");
  swal.fire({
    title: '¿Está seguro de borrar el registro?',
    text: "¡No podrá revertir el cambio!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar costo!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "index.php?ruta=costosfijos&codCosto="+codCosto;
    }
  });
});

//  Agregar los productos del modal al detalle del ingreso
$(".tablaGastos").on("click", ".btnAgregarGastoFijo", function(){
  
  var codGastoFijo = $(this).attr("codGasto");
  $(this).removeClass("btn-primary btnAgregarGastoFijo");
  $(this).addClass("btn-default disabled");

  var datos = new FormData();
  datos.append("codGastoFijo", codGastoFijo);
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
      var tipoGasto = respuesta["NombreTipoGasto"];

      $(".nuevoGastoFijo").append(
      '<div class="row" style="padding:5px 15px">'+

        '<!-- Descripción del producto -->'+          
        '<div class="col-lg-4" style="padding-right:0px">'+
          '<div class="input-group">'+
            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarGastoFijo" idGasto="'+idGasto+'"><i class="fa fa-times"></i></button></span>'+
            '<input type="text" class="form-control nuevogastoFijo" idGasto="'+idGasto+'" value="'+nombreGasto+'" readonly>'+
          '</div>'+
        '</div>'+

        '<!-- Observacion -->'+
        '<div class="col-lg-5 ingresoObservacionGasto">'+
          '<input type="text" class="form-control nuevaObservacionGasto" name="nuevaObservacionGasto" required>'+
        '</div>' +

        '<!-- Cantidad del producto -->'+
        '<div class="col-lg-1 ingresoCantidad">'+
          '<input type="number" class="form-control cantidadGasto" name="cantidadGasto" value="1" readonly>'+
        '</div>' +

        '<!-- Precio del Gasto -->'+
        '<div class="col-lg-2 ingresoPrecioGasto">'+
          '<input type="number" class="form-control nuevoCostoGastoFijo" name="nuevoCostoGastoFijo" min="1.00" step="0.01" required>'+
        '</div>' +

      '</div>'
      );
      listarGastosFijos();
      sumarListaGastosFijos();
    } 
	});
});

//  Quitar los producto del ingreso
$(".formularioCostoFijo").on("click", "button.quitarGastoFijo", function(){
  //  Eliminar el elemento listado
  $(this).parent().parent().parent().parent().remove();
  var idGasto = $(this).attr("idGasto");
  //  reactivar el boton del producto en el modal
  $("button.recuperarBoton[codGasto='"+idGasto+"']").removeClass('btn-default disabled');
  $("button.recuperarBoton[codGasto='"+idGasto+"']").addClass('btn-primary btnAgregarGastoFijo');

  listarGastosFijos();
  sumarListaGastosFijos();
});

//  Actualizar el costo de un gasto
$(".formularioCostoFijo").on("change", "input.nuevoCostoGastoFijo", function(){
  listarGastosFijos();
  sumarListaGastosFijos();
});

//  FUNCIONES PARA SUMAR Y LISTAR LOS PRODUCTOS
function listarGastosFijos()
{
  var listarGastosFijos = [];
  var recurso = $(".nuevogastoFijo")
  var observacion = $(".nuevaObservacionGasto")
  var precioGasto = $(".nuevoCostoGastoFijo")
  for(var i = 0; i < recurso.length; i++)
  {
    listarGastosFijos.push({
      "CodGasto" : $(recurso[i]).attr("idGasto"),
      "Observacion" : $(observacion[i]).val(),
      "PrecioGasto" : $(precioGasto[i]).val(),
    });
  }
  $("#listarGastosFijos").val(JSON.stringify(listarGastosFijos));
}

function sumarListaGastosFijos()
{
  var precioGasto = $(".nuevoCostoGastoFijo");
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

  var igv=(sumaTotalPrecio*18)/100;
  var total=sumaTotalPrecio+igv;

  $("#nuevoSubTotalGastoFijo").val(sumaTotalPrecio.toFixed(2));
  $("#nuevoImpuestoGastoFijo").val(igv.toFixed(2));
  $("#nuevoTotalGastoFijo").val(total.toFixed(2));
}