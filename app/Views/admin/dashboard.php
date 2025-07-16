<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Administrador SENA</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #ffffff;
      color: #000000;
      display: flex;
    }
    .sidebar {
      width: 250px;
      background: #006B2D;
      padding: 20px;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      display: flex;
      flex-direction: column;
      gap: 15px;
      box-shadow: 2px 0 10px rgba(255, 65, 108, 0.3); 
    }
    .sidebar a {
      color: #fcfcfc; 
      text-decoration: none;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px;
      border-radius: 8px;
      transition: background 0.3s;
    }
    .sidebar a:hover {
      background: #39FF14; 
      color: #000;
    }
    .content {
      margin-left: 270px;
      padding: 30px;
      flex-grow: 1;
    }
    .dashboard-header {
      text-align: center;
      margin-bottom: 30px;
      color: #006B2D;
    }
    .cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }
    .card {
      background: #42f15918;
      padding: 20px;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 0 15px rgba(109, 108, 108, 0.767);
      transition: transform 0.3s;
      cursor: pointer;
    }
    .card:hover {
      transform: translateY(-5px);
    }
    .card i {
      font-size: 40px;
      color: #006B2D; 
      margin-bottom: 15px;
    }
    .section {
      margin-top: 20px;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(90, 90, 90, 0.541);
    }
    h2 i {
      margin-right: 10px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 6px 8px;
      text-align: center;
      vertical-align: middle;
    }
    th {
      background: #42f15918; 
      color: #0e0d0d;
    }
    .btn {
      margin: 5px 2px;
      padding: 6px 10px;
      background: #42f15918;
      color: #000000;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-weight: 600;
      font-size: 0.9rem;
    }
    .btn:hover {
  background: inherit;
  color: inherit;
  box-shadow: none;
  transform: none;
}
    .btn-accion {
      width: 90px;
      display: inline-block;
    }
    .one {
      background: #42f15918;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <a href="#" onclick="showSection('usuarios')"><i class="fas fa-users"></i> Gestión de Usuarios</a>
    <a href="#" onclick="showSection('reportes')"><i class="fas fa-chart-line"></i> Reportes</a>
    <a href="#" onclick="showSection('configuracion')"><i class="fas fa-cogs"></i> Configuración</a>
    <a href="#" onclick="showSection('auditorias')"><i class="fas fa-user-shield"></i> Auditorías</a>
    <a href="#" onclick="showSection('soporte')"><i class="fas fa-life-ring"></i> Soporte</a>
    <a href="<?= base_url('/login') ?>"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
  </div>

  <div class="content">
    <div class="dashboard-header">
      <h1>Panel del Administrador</h1>
      <p>Gestión y control del sistema SENA</p>
    </div>

    <section class="cards">
      <div class="card" onclick="showSection('usuarios')">
        <i class="fas fa-users"></i>
        <h3>Usuarios</h3>
        <p>Administrar cuentas</p>
      </div>
    </section>

    <section id="usuarios" class="section">
      <h2 style="display: flex; justify-content: space-between; align-items: center;">
        <span><i class="fas fa-users"></i> Gestión de Usuarios</span>
        <div style="display: flex; gap: 10px;">
          <a href="<?= base_url('usuario/nuevo') ?>">
            <button class="btn">
              <i class="fas fa-user-plus"></i> Agregar
            </button>
          </a>
          <a href="<?= base_url('usuario/exportarExcel') ?>">
            <button class="btn">
              <i class="fas fa-file-excel"></i> Descargar Excel
            </button>
          </a>
        </div>
      </h2>

      <table id="tablaUsuarios">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>No. Documento</th>
            <th>Perfil</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($usuarios)): ?>
            <?php foreach ($usuarios as $usuario): ?>
              <tr>
                <td><?= esc($usuario['nombre_usuario']) ?></td>
                <td><?= esc($usuario['correo']) ?></td>
                <td><?= esc($usuario['no_documento']) ?></td>
                <td><?= esc($usuario['id_perfil']) ?></td>
                <td><?= $usuario['estado'] == 1 ? 'Activo' : 'Inactivo' ?></td>
                <td>
  <a href="<?= base_url('usuario/editar/' . $usuario['id_usuario']) ?>">
    <button class="btn btn-accion">
      <i class="fas fa-edit"></i> Editar
    </button>
  </a>

  <?php if ($usuario['estado'] == 1): ?>
    <button class="btn btn-accion" onclick="desactivarUsuario(<?= $usuario['id_usuario'] ?>)">
      <i class="fas fa-user-slash"></i> Desactivar
    </button>
  <?php else: ?>
    <button class="btn btn-accion" onclick="activarUsuario(<?= $usuario['id_usuario'] ?>)">
      <i class="fas fa-user-check"></i> Activar
    </button>
  <?php endif; ?>
</td>

              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr><td colspan="7">No hay usuarios registrados.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </section>
  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script>
    function showSection(sectionId) {
      document.querySelectorAll('.section').forEach(section => {
        section.style.display = 'none';
      });
      document.getElementById(sectionId).style.display = 'block';
    }

    function desactivarUsuario(id) {
    Swal.fire({
        title: '¿Seguro que quieres desactivar este usuario?',
        text: "El usuario no podrá acceder más hasta ser reactivado.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, desactivar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('<?= base_url('usuario/desactivar/') ?>' + id)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire(
                        'Desactivado',
                        'El usuario fue desactivado correctamente.',
                        'success'
                    ).then(() => {
                        location.reload(); // Recarga la tabla o la página
                    });
                } else {
                    Swal.fire('Error', data.message || 'No se pudo desactivar.', 'error');
                }
            })
            .catch(() => {
                Swal.fire('Error', 'Ocurrió un error al conectar con el servidor.', 'error');
            });
        }
    });
}

    function activarUsuario(id) {
  Swal.fire({
    title: '¿Seguro que quieres activar este usuario?',
    text: "El usuario podrá acceder nuevamente al sistema.",
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#28a745',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Sí, activar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      fetch('<?= base_url('usuario/activar/') ?>' + id)
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            Swal.fire(
              'Activado',
              'El usuario fue activado correctamente.',
              'success'
            ).then(() => {
              location.reload();
            });
          } else {
            Swal.fire('Error', data.message || 'No se pudo activar.', 'error');
          }
        })
        .catch(() => {
          Swal.fire('Error', 'Ocurrió un error al conectar con el servidor.', 'error');
        });
    }
  });
}


    window.onload = function () {
      showSection('usuarios');
      $('#tablaUsuarios').DataTable({
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        }
      });
    };
  </script>
</body>
</html>
