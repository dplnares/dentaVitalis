<?php

class ControllerReportesExcel
{
  //  Descargar reporte del filtro de costos por fecha en excel
  public static function ctrDescargarReportePorFechas()
  {
    if(isset($_GET["fechaInicial"]))
    {
      $listaImprimir = ControllerCostos::ctrMostrarCostosPorMeses($_GET["fechaInicial"], $_GET["fechaFinal"]);
      
      //  Creamos el archivo excel
      $Name = "ReporteCostos.xls";

      header('Expires: 0');
      header('Cache-control: private');
      header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
      header("Cache-Control: cache, must-revalidate"); 
      header('Content-Description: File Transfer');
      header('Last-Modified: '.date('D, d M Y H:i:s'));
      header("Pragma: public"); 
      header('Content-Disposition:; filename="'.$Name.'"');
      header("Content-Transfer-Encoding: binary");

      //  Creamos nombre de las columnas del archivo
      echo utf8_decode("<table border='1'>
      
      </thead>
        <tr> 
          <th style='width:50%'>Centro de Costos</th>
          <th style='width:10%'>Nombre de Socio</th>
          <th style='width:10%'>Descripción de Costo</th>
          <th style='width:10%'>Observacion de Costo</th>
          <th style='width:10%'>Numero de Documento</th>
          <th style='width:10%'>Fecha de Costo</th>
          <th style='width:10%'>Fecha de Costo</th>
        </tr> 
      </thead>");
  
      // Rellenamos las columnas con los datos obtenidos
      foreach ($listaImprimir as $value) 
      {
        echo utf8_decode('<tr style="font-size:12px">

          <td style="width:50%">'.$value["DescripcionCentro"].'</td>
          <td style="width:10%">'.$value["NombreSocio"].'</td>
          <td style="width:10%">'.$value["NombreGasto"].'</td>
          <td style="width:10%">'.$value["ObservacionGasto"].'</td>
          <td style="width:10%">'.$value["NumeroDocumento"].'</td>
          <td style="width:10%">'.$value["PrecioGasto"].'</td>
          <td style="width:10%">'.$value["FechaCosto"].'</td>
        </tr>');
      }
      echo "</table>";
      
    }
  }
}