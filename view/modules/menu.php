
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