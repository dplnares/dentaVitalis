<?php 

//  Controllers
require_once "controller/plantilla.controller.php";
require_once "controller/usuarios.controller.php";
require_once "controller/gastos.controller.php";

//  Models
require_once "model/usuarios.model.php";
require_once "model/gastos.model.php";


$plantilla = new ControllerPlantilla();
$plantilla -> ctrPlantilla();