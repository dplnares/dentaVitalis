<?php
//  Controladores
require_once('../../controller/pacientes.controller.php');
require_once('../../controller/tratamiento.controller.php');
require_once('../../controller/historias.controller.php');
require_once('../../controller/pagos.controller.php');

//  Modelos
require_once('../../model/pacientes.model.php');
require_once('../../model/tratamiento.model.php');
require_once('../../model/historias.model.php');
require_once('../../model/pagos.model.php');

require('tfpdf.php');

//  Historia en PDF
class PDFHistoriaClinica extends TFPDF
{
  // Cabecera de página
  function Header()
  {
    // Logo
    // $this->Image('logo.png', 10, 8, 33);
    // Arial bold 15
    $this->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
    
    // Título
    $this->SetFont('DejaVu', '', 12);
    $this->Cell(0 ,10, 'Denta Vitalis', 0, 0, 'R');
    $this->Ln(15);
    $this->Cell(80);
    $this->SetFont('Arial', 'B', 15);
    $this->Cell(30 ,10, utf8_decode('FICHA DE PAGO'), 0, 0, 'C');

    
    // Salto de línea
    $this->Ln(15);
  }

  // Pie de página
  function Footer()
  {
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
    $this->SetFont('DejaVu', '', 8);
    // Número de página
    $this->Cell(0, 8, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'L');
  }

  //  Imprimir plan de tratamiento
  function TablaProcedimientos($header, $listaTratamiento)
  {
    $this->SetFont('Arial', 'B', 10);
    $this->Cell(60,7,$header[0],1,0,'C'); 
    $this->Cell(50,7,$header[1],1,0,'C'); 
    $this->Cell(25,7,$header[2],1,0,'C'); 
    $this->Cell(25,7,$header[3],1,0,'C'); 
    $this->Cell(25,7,$header[4],1,0,'C'); 
    
    foreach($listaTratamiento as $dato)
    {
      $this->SetFont('DejaVu', '', 10);
      if($dato["EstadoTratamiento"] != '1'){
        $estado = "Realizado";
      } else {
        $estado = "No Realizado";
      }
      if($dato["FechaProcedimiento"] == '0000-00-00'){
        $fecha = "Sin Asignar";
      } else {
        $fecha = $dato["FechaProcedimiento"];
      }
      $this->Ln();
      $this->Cell(60,5,$dato["NombreProcedimiento"],1);
      $this->Cell(50,5,$dato["ObservacionProcedimiento"],1);
      $this->Cell(25,5,$estado,1);
      $this->Cell(25,5,$fecha,1);
      $this->Cell(25,5,'(S/.) '.$dato["PrecioProcedimiento"],1);
    }
  }

  //  Imprimir todos los pagos realizados
  function TablaPagos($header, $listaPagos)
  {
    $this->SetX(25);
    $this->SetFont('Arial', 'B', 10);
    $this->Cell(40,7,$header[0],1,0,'C');
    $this->Cell(40,7,$header[1],1,0,'C');
    $this->Cell(25,7,$header[2],1,0,'C');
    $this->Cell(50,7,$header[3],1,0,'C');
    
    foreach($listaPagos as $dato)
    {
      $this->SetFont('DejaVu', '', 10);
      
      $this->Ln();
      $this->SetX(25);
      $this->Cell(40,5,$dato["DescripcionTipo"],1);
      $this->Cell(40,5,'(S/.) '.$dato["TotalPago"],1);
      $this->Cell(25,5,$dato["FechaPago"],1);
      $this->Cell(50,5,$dato["ObservacionPago"],1);
    }
  }
}

//  Obtener el codigo del paciente para recoger sus datos 
$codPaciente = $_GET["codPaciente"];
$datosPaciente = ControllerPacientes::ctrMostrarDatosImprimir($codPaciente);
$codHistoria = ControllerHistorias::ctrObtenerCodHistoria($codPaciente);

//  Plan de Tratamiento
$planTratamiento = ControllerTratamiento::ctrMostrarDetalleTratamientoCompleto($codHistoria["IdHistoriaClinica"]);

//  Pagos realizados
$listaPagos = ControllerPagos::ctrMostrarPagosPorPaciente($codPaciente);

// Creacion de los datos de la historia clínica
$pdf = new PDFHistoriaClinica();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);

/**
 * DATOS GENERALES DEL PACIENTE
 */
$pdf->SetFont('Arial','B',14);
$pdf->Cell(80,10,'Datos Generales del Paciente',0,'L');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,8,'Nombre Paciente:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(80,8,$datosPaciente["NombrePaciente"].' '.$datosPaciente["ApellidoPaciente"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,8,'DNI:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(25,8,$datosPaciente["DNIPaciente"],0);

$pdf->Ln(8);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,8,'Fecha Nacimiento:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(25,8,$datosPaciente["FechaNacimiento"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,8,'Celular:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(40,8,$datosPaciente["CelularPaciente"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,8,'Edad:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(10,8,$datosPaciente["EdadPaciente"],0);

$pdf->Ln(10);

/**
 * PLAN DE TRATAMIENTO DEL PACIENTE
 */
$pdf->SetFont('Arial','B',14);
$pdf->Cell(80,10,'Lista de Procedimientos',0,'L');

//Títulos de las columnas
$header=array('Descripcion','Observacion','Estado','Fecha','Precio');
$pdf->AliasNbPages();

//$pdf->AddPage();
$pdf->TablaProcedimientos($header, $planTratamiento);

$pdf->Ln(10);


/**
 * PAGOS REALIZADOS
 */
$pdf->SetFont('Arial','B',14);
$pdf->Cell(80,10,'Lista de Pagos Realizado',0,'L');

//Títulos de las columnas
$header=array('Tipo Pago','Total Pagado','Fecha Pago','Observacion');
$pdf->AliasNbPages();

//$pdf->AddPage();
$pdf->TablaPagos($header, $listaPagos);


$pdf->Output();