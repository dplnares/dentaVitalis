<?php

require_once "../../controller/costos.controller.php";
require_once "../../controller/gastos.controller.php";
require_once "../../controller/historias.controller.php";
require_once "../../controller/pacientes.controller.php";
require_once "../../controller/procedimientos.controller.php";
require_once "../../controller/reportesExcel.controller.php";
require_once "../../controller/socios.controller.php";
require_once "../../controller/usuarios.controller.php";

require_once "../../model/costos.model.php";
require_once "../../model/gastos.model.php";
require_once "../../model/historias.model.php";
require_once "../../model/pacientes.model.php";
require_once "../../model/procedimientos.model.php";
require_once "../../model/socios.model.php";
require_once "../../model/usuarios.model.php";


//  Exportar reporte por fechas de la vista FiltrarCostos
if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"]))
{
	$reporteStockTienda = new ControllerReportes();
	$reporteStockTienda -> ctrDescargarReportePorFechas();
}