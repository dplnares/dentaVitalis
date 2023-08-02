
<!-- Menu de todos los usuarios en general -->
<div class="sb-sidenav-menu-heading">Inicio</div>
<a class="nav-link" href="home">
  <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
  Inicio
</a>

<!-- Definir las vistas de los modulos de cada usuario -->

<?php
  if($_SESSION["perfilUsuario"] == "1")
  {
?>
  <!-- Usuarios -->
  <div class="sb-sidenav-menu-heading">Usuarios</div>
  <a class="nav-link" href="usuario">
    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
    Administrar Usuarios
  </a>
<?php
  }
?>

<!-- Calendario 
<div class="sb-sidenav-menu-heading">Calendario</div>
  <a class="nav-link" href="calendario">
    <div class="sb-nav-link-icon"><i class="fas fa-calendar"></i></div>
    Calendario Citas
  </a> -->

<!-- Historias Clinica -->
<div class="sb-sidenav-menu-heading">Pacientes</div>
  <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#listaHistoria" aria-expanded="false" aria-controls="collapseLayouts">
    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
    Pacientes
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
  </a>
  <div class="collapse" id="listaHistoria" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
      <a class="nav-link" href="historiaClinica">Historias Clinica</a>
      <a class="nav-link" href="calendario">Calendario Citas</a>
    </nav>
  </div>

<!-- Historias Pagos 
<div class="sb-sidenav-menu-heading">Historial Pagos</div>
  <a class="nav-link" href="historialPagos">
    <div class="sb-nav-link-icon"><i class="fas fa-money"></i></div>
    Historias de pagos
  </a> -->
  
<!-- Costos  -->
<div class="sb-sidenav-menu-heading">Costos</div>
  <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#listaCostos" aria-expanded="false" aria-controls="collapseLayouts">
    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
    Costos
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
  </a>
  <div class="collapse" id="listaCostos" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
      <a class="nav-link" href="allCostos">Planilla de Costos</a>
      <a class="nav-link" href="buscarCostos">Filtrar Costos</a>
      <a class="nav-link" href="reporteCostos">Reporte de Costos</a>
    </nav>
  </div>

<!-- Catálogo -->
<div class="sb-sidenav-menu-heading">Catálogo</div>
  <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#listaCatalogoCostos" aria-expanded="false" aria-controls="collapseLayouts">
    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
    Catálogo Costos
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
  </a>
  <div class="collapse" id="listaCatalogoCostos" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
      <a class="nav-link" href="centroCostos">Centros de Costos</a>  
      <a class="nav-link" href="socios">Catálogo de Socios</a>
      <a class="nav-link" href="gastos">Catálogo de Costos</a>
    </nav>
  </div>
  <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#listaCatalogoPacientes" aria-expanded="false" aria-controls="collapseLayouts">
    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
    Catálogo Historias
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
  </a>
  <div class="collapse" id="listaCatalogoPacientes" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
      <a class="nav-link" href="procedimientos">Procedimientos</a>
      <a class="nav-link" href="pacientes">Pacientes</a>
    </nav>
  </div>