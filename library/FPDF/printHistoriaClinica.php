<?php
//  Controladores
require_once('../../controller/pacientes.controller.php');

//  Modelos
require_once('../../model/pacientes.model.php');

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
    $this->Ln(10);
    $this->Cell(80);
    $this->SetFont('Arial', 'B', 15);
    $this->Cell(30 ,10, utf8_decode('HISTORIA CLINICA ODONTOLÓGICA DENTA VITALIS'), 0, 0, 'C');

    
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
    $this->Cell(0, 8, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
  }
}

//  Obtener el codigo del paciente para recoger sus datos 
$codHistoria = $_GET["codHistoria"];
$datosHistoriaClinica = ControllerPacientes::ctrObtenerDatosHistoriaPdf($codHistoria);

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
$pdf->Cell(35,10,'Nombre Paciente:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(70,10,$datosHistoriaClinica["NombrePaciente"].' '.$datosHistoriaClinica["ApellidoPaciente"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,10,'Sexo:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(25,10,$datosHistoriaClinica["SexoPaciente"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,10,'Edad:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(25,10,$datosHistoriaClinica["EdadPaciente"],0);

$pdf->Ln(10);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(40,10,'Lugar de Nacimiento:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(20,10,$datosHistoriaClinica["LugarNacimiento"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(40,10,'Fecha de Nacimiento:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(25,10,$datosHistoriaClinica["FechaNacimiento"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,10,'Grado Instruccion:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(25,10,$datosHistoriaClinica["GradoInstruccion"],0);

$pdf->Ln(10);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,10,'Raza:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(20,10,$datosHistoriaClinica["RazaPaciente"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,10,'DNI:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(25,10,$datosHistoriaClinica["DNIPaciente"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(25,10,'Ocupacion:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(25,10,$datosHistoriaClinica["OcupacionPaciente"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,10,'Religion:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(25,10,$datosHistoriaClinica["ReligionPaciente"],0);

$pdf->Ln(10);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(25,10,'Estado Civil:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(20,10,$datosHistoriaClinica["EstadoCivil"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(40,10,'Lugar de Procedencia:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(20,10,$datosHistoriaClinica["LugarProcedencia"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,10,'Domicilio Actual:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(50,10,$datosHistoriaClinica["DomicilioPaciente"],0);

$pdf->Ln(10);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(52,10,'Nombre y Apellidos Contacto:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(80,10,$datosHistoriaClinica["NombreContactoPaciente"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,10,'Telefono:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(25,10,$datosHistoriaClinica["NumeroContactoPaciente"],0);

$pdf->Ln(10);



/**
 * MANDAR EL PDF A UNA NUEVA VENTANA
 */
$pdf->Output();



