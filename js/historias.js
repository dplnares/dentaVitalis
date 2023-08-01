//  Redirigir la vista para crear un nuevo gasto fijo
$("#btnNuevaHistoria").on("click", function(){
  window.location = "index.php?ruta=crearNuevaHistoria";
});

//  Redirigir la vista para editar un gasto fijo
$(".table").on("click", ".btnEditarHistoria", function () {
  var codHistoria = $(this).attr("codHistoria");
  if(codHistoria!=null)
  {
    window.location = "index.php?ruta=editarHistoria&codHistoria="+codHistoria;
  }
});

//  Redirigir la vista para editar un gasto fijo
$(".table").on("click", ".btnVisualizarHistoria", function () {
  var codHistoria = $(this).attr("codHistoria");
  if(codHistoria!=null)
  {
    window.location = "index.php?ruta=visualizarHistoria&codHistoria="+codHistoria;
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