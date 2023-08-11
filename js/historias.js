//  Redirigir la vista para crear una nueva historia
$("#btnNuevaHistoria").on("click", function(){
  Swal.fire({
    title: 'Ingrese el número de DNI del Paciente',
    input: 'text',
    inputAttributes: {
      autocapitalize: 'off'
    },
    showCancelButton: true,
    confirmButtonText: 'Confirmar',
  }).then((result) => {
    if (result.value)
    {
      var datos = new FormData();
      numeroDNIBuscar = result.value;
      datos.append("numeroDNIBuscar", numeroDNIBuscar);
      
      $.ajax({
        url: "ajax/pacientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
          if (respuesta == "ok") {
            window.location = "index.php?ruta=crearNuevaHistoria";
          } else {
            if (respuesta == "historia") {
              Swal.fire(
                'Error',
                'Este Paciente ya tiene una historia creada',
                'error'
              );
            } else {
              Swal.fire(
                'Error',
                'Número de DNI no registrado',
                'warning'
              );
            }
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log("Error en la solicitud AJAX: ", textStatus, errorThrown);
        } 
      });
    }
  })
});

//  Redirigir la vista para editar una historia
$(".table").on("click", ".btnEditarHistoria", function () {
  var codHistoria = $(this).attr("codHistoria");
  var codPaciente = $(this).attr("codPaciente");
  if(codHistoria!=null && codPaciente!=null)
  {
    window.location = "index.php?ruta=editarHistoria&codHistoria="+codHistoria+"&codPaciente="+codPaciente;
  }
});

//  Redirigir la vista para ver el plan de tratamiento
$(".table").on("click", ".btnListarPlanTratamiento", function () {
  var codHistoria = $(this).attr("codHistoria");
  var codPaciente = $(this).attr("codPaciente");
  if(codHistoria!=null && codPaciente!=null)
  {
    window.location = "index.php?ruta=planTratamiento&codHistoria="+codHistoria+"&codPaciente="+codPaciente;
  }
});

//  Alerta para eliminar un gasto Fijo
$(".table").on("click", ".btnEliminarHistoria", function () {
  var codHistoria = $(this).attr("codHistoria");
  swal.fire({
    title: '¿Está seguro de borrar la Historia Clínica?',
    text: "¡No podrá revertir el cambio!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar historia!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "index.php?ruta=historiaClinica&codHistoria="+codHistoria;
    }
  });
});

//  Mostrar los datos en los campos de la historia, según select.
$(".formularioHistoriaClinica").on("change", ".nombrePaciente", function () {
  var codPacienteHistoria = $(this).val();
  var datos = new FormData();

  datos.append("codPacienteHistoria", codPacienteHistoria);
  $.ajax({
    url: "ajax/pacientes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",

    success: function (respuesta) {
      $("#numeroDNI").val(respuesta["DNIPaciente"]);
      $("#celularPaciente").val(respuesta["CelularPaciente"]);
    }
  });
});

//  Agregar items del modal a la lista de procedimiento
$(".tablaProcedimientos").on("click", ".btnAgregarProcedimiento", function(){
  var codProcedimientoAgregar = $(this).attr("codProcedimiento");

  var datos = new FormData();
  datos.append("codProcedimientoAgregar", codProcedimientoAgregar);
  $.ajax({
    url:"ajax/procedimientos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta)
    {
      var idProcedimiento = respuesta["IdProcedimiento"];
      var nombreProcedimiento = respuesta["NombreProcedimiento"];
      var precioPromedio = respuesta["PrecioPromedio"];

      $(".nuevoProcedimiento").append(
      '<div class="row" style="padding:5px 15px">'+

        '<!-- Descripción del procedimiento -->'+          
        '<div class="col-lg-5" style="padding-right:0px">'+
          '<div class="input-group">'+
            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProcedimiento" codProcedimiento="'+idProcedimiento+'"><i class="fa fa-times"></i></button></span>'+
            '<input type="text" class="form-control nuevoprocedimiento" codProcedimiento="'+idProcedimiento+'" value="'+nombreProcedimiento+'" readonly>'+
          '</div>'+
        '</div>'+

        '<!-- Observacion -->'+
        '<div class="col-lg-5 observacionProcedimiento">'+
          '<input type="text" class="form-control nuevaObservacionTratamiento" name="nuevaObservacionTratamiento">'+
        '</div>' +

        '<!-- Precio del procedimiento -->'+
        '<div class="col-lg-2 precioProcedimiento">'+
          '<input type="number" class="form-control nuevoPrecioProcedimiento" name="nuevoPrecioProcedimiento" min="1.00" step="0.01" value="'+precioPromedio+'" required>'+
        '</div>' +

      '</div>'
      );
      listarProcedimientos();
      sumaProcedimientos();
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log("Error en la solicitud AJAX: ", textStatus, errorThrown);
    } 
	});
});

//  Eliminar el elemento listado
$(".formularioHistoriaClinica").on("click", "button.quitarProcedimiento", function(){
  $(this).parent().parent().parent().parent().remove();

  listarProcedimientos();
  sumaProcedimientos();
});

//  Actualizar al modificar la observacion
$(".formularioHistoriaClinica").on("change", "input.nuevaObservacionTratamiento", function(){
  listarProcedimientos();
  sumaProcedimientos();
});

//  Actualizar al modificar el precio
$(".formularioHistoriaClinica").on("change", "input.nuevoPrecioProcedimiento", function(){
  listarProcedimientos();
  sumaProcedimientos();
});

//  Boton para redirigir la vista actual a la de historia clinica
$(".cerrarHistoria").on("click", function(){
  window.location = "index.php?ruta=historiaClinica";
});

//  FUNCIONES PARA SUMAR Y LISTAR LOS PROCEDIMIENTOS
function listarProcedimientos()
{
  var listarProcedimientos = [];
  var procedimiento = $(".nuevoprocedimiento")
  var observacion = $(".nuevaObservacionTratamiento")
  var precio = $(".nuevoPrecioProcedimiento")
  for(var i = 0; i < procedimiento.length; i++)
  {
    listarProcedimientos.push({
      "CodProcedimiento" : $(procedimiento[i]).attr("codProcedimiento"),
      "ObservacionProcedimiento" : $(observacion[i]).val(),
      "PrecioProcedimiento" : $(precio[i]).val(),
    });
  }
  $("#listarProcedimientos").val(JSON.stringify(listarProcedimientos));
}

function sumaProcedimientos()
{
  var precioTratamiento = $(".nuevoPrecioProcedimiento");
  var arraySumaPrecio = []; 

  for(var i = 0; i < precioTratamiento.length; i++) {
    arraySumaPrecio.push(Number($(precioTratamiento[i]).val()));
  }

  //  Función para sumar todos los procedimientos
  function sumarProcedimientos(total, numero) {
    return total + numero;
  }

  if(arraySumaPrecio.length == 0) {
    var sumaTotalTratamiento = 0;
  } else {
    var sumaTotalTratamiento = arraySumaPrecio.reduce(sumarProcedimientos);
  }

  $("#nuevoTotalTratamiento").val(sumaTotalTratamiento.toFixed(2));
}

//  Descargar solo la historia clínica
$("#btnDescargarHistoria").on("click", function(){
  codHistoria = $(this).attr('codHistoria');
  if(codHistoria != null || codHistoria != undefined || codHistoria != '')
  {
    window.open("library/FPDF/printHistoriaClinica.php?&codHistoria=" + codHistoria, "_blank");
  }
  else
  {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: '¡No se encontró una Historia Clínica!',
    });
  }
});

//  Descargar la historia clínica completa con el detalle de los procedimientos más
$(".table").on("click", ".btnImprimirHistoria", function () {
  codHistoria = $(this).attr('codHistoria');
  if(codHistoria != null || codHistoria != undefined || codHistoria != '')
  {
    window.open("library/FPDF/printHistoriaCompleta.php?&codHistoria=" + codHistoria, "_blank");
  }
  else
  {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: '¡No se encontró una Historia Clínica!',
    });
  }
});
