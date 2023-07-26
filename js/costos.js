//  Redirigir la vista para crear un nuevo gasto fijo
$("#btnNuevoGastoFijo").on("click", function(){
  window.location = "index.php?ruta=crearNuevoCostoFijo";
});

//  Redirigir la vista para editar un gasto fijo
$(".table").on("click", ".btnEditarCostoFijo", function () {
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

//  Redirigir la vista para crear un nuevo gasto Variables
$("#btnNuevoGastoVariable").on("click", function(){
  window.location = "index.php?ruta=crearNuevoCostoVariable";
});

//  Redirigir la vista para editar un gasto Variable
$(".table").on("click", ".btnEditarCostoVariable", function () {
  var codCosto = $(this).attr("codCosto");
  if(codCosto!=null)
  {
    window.location = "index.php?ruta=editarCostoVariable&codCosto="+codCosto;
  }
});

//  Alerta para eliminar un gasto Variable
$(".table").on("click", ".btnEliminarCostoVariable", function () {
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
      window.location = "index.php?ruta=costosvariables&codCosto="+codCosto;
    }
  });
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
        '<div class="col-lg-4" style="padding-right:0px">'+
          '<div class="input-group">'+
            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarGasto" idGasto="'+idGasto+'"><i class="fa fa-times"></i></button></span>'+
            '<input type="text" class="form-control nuevogasto" idGasto="'+idGasto+'" value="'+nombreGasto+'" readonly>'+
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
          '<input type="number" class="form-control nuevoCostoGasto" name="nuevoCostoGasto" min="1.00" step="0.01" required>'+
        '</div>' +

      '</div>'
      );
      listarGastos();
      sumarListaGastos();
    } 
	});
});

//  Quitar los producto del ingreso
$(".formularioCostoFijo").on("click", "button.quitarGasto", function(){
  //  Eliminar el elemento listado
  $(this).parent().parent().parent().parent().remove();
  var idGasto = $(this).attr("idGasto");
  //  reactivar el boton del producto en el modal
  $("button.recuperarBoton[codGasto='"+idGasto+"']").removeClass('btn-default disabled');
  $("button.recuperarBoton[codGasto='"+idGasto+"']").addClass('btn-primary btnAgregarGasto');

  listarGastos();
  sumarListaGastos();
});

//  Actualizar el costo de un gasto
$(".formularioCostoFijo").on("change", "input.nuevoCostoGasto", function(){
  listarGastos();
  sumarListaGastos();
});

//  Quitar los producto del ingreso
$(".formularioCostoVariable").on("click", "button.quitarGasto", function(){
  //  Eliminar el elemento listado
  $(this).parent().parent().parent().parent().remove();
  var idGasto = $(this).attr("idGasto");
  //  reactivar el boton del producto en el modal
  $("button.recuperarBoton[codGasto='"+idGasto+"']").removeClass('btn-default disabled');
  $("button.recuperarBoton[codGasto='"+idGasto+"']").addClass('btn-primary btnAgregarGasto');

  listarGastos();
  sumarListaGastos();
});

//  Actualizar el costo de un gasto
$(".formularioCostoVariable").on("change", "input.nuevoCostoGasto", function(){
  listarGastos();
  sumarListaGastos();
});

//  FUNCIONES PARA SUMAR Y LISTAR LOS PRODUCTOS
function listarGastos()
{
  var listarGastos = [];
  var recurso = $(".nuevogasto")
  var observacion = $(".nuevaObservacionGasto")
  var precioGasto = $(".nuevoCostoGasto")
  for(var i = 0; i < recurso.length; i++)
  {
    listarGastos.push({
      "CodGasto" : $(recurso[i]).attr("idGasto"),
      "Observacion" : $(observacion[i]).val(),
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

  var igv=(sumaTotalPrecio*18)/100;
  var total=sumaTotalPrecio+igv;

  $("#nuevoSubTotalGasto").val(sumaTotalPrecio.toFixed(2));
  $("#nuevoImpuestoGasto").val(igv.toFixed(2));
  $("#nuevoTotalGasto").val(total.toFixed(2));
}