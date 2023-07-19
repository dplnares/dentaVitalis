</div>
        </div>
        <div class="sb-sidenav-footer">
          <div class="small">Sesión iniciada como:</div>
          <?php echo $_SESSION["nombreUsuario"] ?>
        </div>
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main class="bg">
        <div class="container-fluid px-4">
          <h1 class="mt-4">Calendario de citas</h1>

          <div id="calendar"></div>
          
          <div id="event-modal" class="modal">
            <div class="modal-content">
              <span class="close">&times;</span>
              <h2>Añadir Evento</h2>
              <input type="text" id="event-title" placeholder="Título del Evento">
              <button id="add-event-btn">Añadir</button>
            </div>
          </div>
          
        </div>
      </main>
    </div>
  </div>