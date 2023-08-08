//  Eliminar el elemento listado
$(".formularioHistoriaClinica").on("click", "button.eliminarProcedimiento", function(){
  var codProcedimiento = $(this).attr("codProcedimiento");
  var codEstado = $(this).attr("codEstado");
  //  Si el procedimiento está realizado, no se podrá eliminar. Caso contrario, se le notificará si quiere que este elemento se elimine o no, ya que esto puede ocacionar variaciones en el plan de tratamiento original
  if(codEstado == 1)
  {
    swal.fire({
      title: '¿Está seguro de borrar este procedimiento?',
      text: "¡Se eliminará del plan de tratamiento original!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar historia!'
    }).then((result) => {
      if (result.isConfirmed) {
        $(this).parent().parent().parent().parent().remove();
      listarProcedimientos();
      sumaProcedimientos();
      }
    });
  }
  else
  {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: '¡No se puede eliminar un procedimiento que ya esté realizado!',
    });
  }
});

//  Al modificar el estado de realizado a no real
$(".formularioHistoriaClinica").on("click", "button.eliminarProcedimiento", function(){
  
});
//estadoProcedimiento
