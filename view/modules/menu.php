
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

<!-- Calendario -->
<div class="sb-sidenav-menu-heading">Calendario</div>
  <a class="nav-link" href="calendario">
    <div class="sb-nav-link-icon"><i class="fas fa-calendar"></i></div>
    Calendario Citas
  </a>

<!-- Historias Clinica -->
<div class="sb-sidenav-menu-heading">Historias Clínicas</div>
  <a class="nav-link" href="historiaClinica">
    <div class="sb-nav-link-icon"><i class="fas fa-file-text"></i></div>
    Historias Clinica
  </a>

<!-- Catalogo -->
<div class="sb-sidenav-menu-heading">Catálogo</div>
  <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#listaCatalogo" aria-expanded="false" aria-controls="collapseLayouts">
    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
    Catálogo
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
  </a>
  <div class="collapse" id="listaCatalogo" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
      <a class="nav-link" href="procedimientos">Procedimientos</a>
      <a class="nav-link" href="gastos">Gastos</a>
      <a class="nav-link" href="socios">Socios</a>
      <a class="nav-link" href="pacientes">Pacientes</a>
    </nav>
  </div>

<!-- Historias Pagos -->
<div class="sb-sidenav-menu-heading">Historial Pagos</div>
  <a class="nav-link" href="historialPagos">
    <div class="sb-nav-link-icon"><i class="fas fa-money"></i></div>
    Historias de pagos
  </a>
  