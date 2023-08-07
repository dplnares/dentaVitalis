//  Alerta para eliminar un gasto Fijo
$(".table").on("click", ".btnEliminarPago", function () {
  var codPago = $(this).attr("codPago");
  swal.fire({
    title: '¿Está seguro de borrar este Pago?',
    text: "¡No podrá revertir el cambio!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar historia!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "index.php?ruta=pacientes&codPago="+codPago;
    }
  });
});