//  Select de Fechas
$('#dateRangeRptCostoFecha').daterangepicker({
  opens: 'right',
  locale: {
    format: 'YYYY-MM-DD',
  },
});

// Agrega el evento 'apply.daterangepicker' para manejar la selección de fechas
$('#dateRangeRptCostoFecha').on('apply.daterangepicker', function(ev, picker) {
  var fechaInicial = picker.startDate.format('YYYY-MM-DD');
  var fechaFinal = picker.endDate.format('YYYY-MM-DD');

  var datos = new FormData();
  datos.append("FechaInicial", fechaInicial);
  datos.append("FechaFinal", fechaFinal);

  $.ajax({
    url:"ajax/costos-assets.ajax.php",
    method: "POST",
    data: datos,
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta)
    {
      var centrosCostos = [];
      var costosTotales = [];

      for (var i = 0; i < respuesta.length; i++) {
        centrosCostos.push(respuesta[i].DescripcionCentro);
        costosTotales.push(parseFloat(respuesta[i].SumaTotalCosto));
      }
      //  Actualizar las etiquetas y datos del gráfico
      chartCostoRango.data.labels = centrosCostos;
      chartCostoRango.data.datasets[0].data = costosTotales;

      // Actualizar el gráfico
      chartCostoRango.update();
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log("Error en la solicitud AJAX: ", textStatus, errorThrown);
    }
  });
});

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Area Chart Example
var ctx = document.getElementById("chartCostoFecha");
var chartCostoRango = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
    datasets: [{
      label: "Sessions",
      lineTension: 0.3,
      backgroundColor: "rgba(2,117,216,0.2)",
      borderColor: "rgba(2,117,216,1)",
      pointRadius: 5,
      pointBackgroundColor: "rgba(2,117,216,1)",
      pointBorderColor: "rgba(255,255,255,0.8)",
      pointHoverRadius: 5,
      pointHoverBackgroundColor: "rgba(2,117,216,1)",
      pointHitRadius: 50,
      pointBorderWidth: 2,
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 10000,
          maxTicksLimit: 6
        },
        gridLines: {
          color: "rgba(0, 0, 0, .125)",
        }
      }],
    },
    legend: {
      display: false
    }
  }
});
