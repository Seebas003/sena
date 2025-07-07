<?php foreach ($usuarios as $usuario): ?>
<tr>
  <td><?= esc($usuario['nombre_usuario']) ?></td>
  <td><?= esc($usuario['correo']) ?></td>
  <td><?= esc($usuario['no_documento']) ?></td>
  <td><?= esc($usuario['pass_usuario']) ?></td>
  <td><?= esc($usuario['id_perfil']) ?></td>
  <td>
    <button onclick="editarUsuario(
      '<?= $usuario['id_usuario'] ?>',
      '<?= $usuario['nombre_usuario'] ?>',
      '<?= $usuario['correo'] ?>',
      '<?= $usuario['no_documento'] ?>',
      '<?= $usuario['pass_usuario'] ?>',
      '<?= $usuario['id_perfil'] ?>'
        )">Editar</button>
    <button onclick="desactivarUsuario(<?= $usuario['id_usuario'] ?>)">Desactivar</button>
  </td>
</tr>
<?php endforeach; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Administrador SENA</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #1e1e2f;
      color: #fff;
      display: flex;
    }
    .sidebar {
      width: 250px;
      background: #111;
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
      color: #39FF14; 
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
    }
    .cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }
    .card {
      background: #222;
      padding: 20px;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 0 15px rgba(255, 65, 108, 0.3);
      transition: transform 0.3s;
      cursor: pointer;
    }
    .card:hover {
      transform: translateY(-5px);
    }
    .card i {
      font-size: 40px;
      color: #39FF14; 
      margin-bottom: 15px;
    }
    .section {
      display: none;
      margin-top: 20px;
      background: #333;
      padding: 20px;
      border-radius: 10px;
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
      padding: 10px;
      text-align: center;
    }
    th {
      background: #39FF14; 
      color: #000;
    }
    button {
      margin: 5px 2px;
      padding: 5px 10px;
      background: #39FF14;
      color: #000;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    button:hover {
      background: #32cc10;
    }
    input, select {
      margin: 5px 0;
      padding: 8px;
      width: 100%;
      border-radius: 5px;
      border: none;
      outline: none;
    }
    form {
      margin-top: 15px;
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
    <a href="Rol.html"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
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
      <div class="card" onclick="showSection('reportes')">
        <i class="fas fa-chart-line"></i>
        <h3>Reportes</h3>
        <p>Estadísticas y métricas</p>
      </div>
      <div class="card" onclick="showSection('auditorias')">
        <i class="fas fa-user-shield"></i>
        <h3>Auditorías</h3>
        <p>Historial de acciones</p>
      </div>
    </section>

    <section id="usuarios" class="section">
      <h2><i class="fas fa-users"></i> Gestión de Usuarios</h2>

      <button onclick="mostrarFormularioAgregar()">Agregar Usuario</button>

      <table>
        <tr>
          <th>Nombre</th>
          <th>Correo</th>
          <th>Número de Documento</th>
          <th>Contraseña</th>
          <th>ID Perfil</th>
          <th>Acciones</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
        <tr>
          <td><?= esc($usuario['nombre_usuario']) ?></td>
          <td><?= esc($usuario['correo']) ?></td>
          <td><?= esc($usuario['no_documento']) ?></td>
          <td><?= esc($usuario['pass_usuario']) ?></td>
          <td><?= esc($usuario['id_perfil']) ?></td>
          <td>
            <button onclick="editarUsuario(
              '<?= $usuario['id_usuario'] ?>',
              '<?= $usuario['nombre_usuario'] ?>',
              '<?= $usuario['correo'] ?>',
              '<?= $usuario['no_documento'] ?>',
              '<?= $usuario['pass_usuario'] ?>',
              '<?= $usuario['id_perfil'] ?>'
            )">Editar</button>
            <button onclick="desactivarUsuario(<?= $usuario['id_usuario'] ?>)">Desactivar</button>
          </td>
        </tr>
        <?php endforeach; ?>
      </table>

      <!-- Formulario para agregar -->
      <div id="formAgregar" style="display:none;">
        <h3>Agregar Usuario</h3>
        <form id="formNuevoUsuario">
          <input type="text" name="nombre" placeholder="Nombre" required>
          <input type="email" name="correo" placeholder="Correo" required>
          <input type="text" name="documento" placeholder="No. Documento" required>
          <input type="password" name="clave" placeholder="Contraseña" required>
          <select name="perfil">
            <option value="1">Administrador</option>
            <option value="2">Instructor</option>
            <option value="3">Aprendiz</option>
            <option value="4">Administrativo</option>
          </select>
          <button type="submit">Guardar</button>
        </form>
      </div>

      <!-- Formulario para editar -->
      <div id="formEditar" style="display:none;">
        <h3>Editar Usuario</h3>
        <form id="formEditarUsuario">
          <input type="hidden" name="id" id="edit_id">
          <input type="text" name="nombre" id="edit_nombre" placeholder="Nombre" required>
          <input type="email" name="correo" id="edit_correo" placeholder="Correo" required>
          <input type="text" name="documento" id="edit_documento" placeholder="No. Documento" required>
          <input type="password" name="clave" id="edit_clave" placeholder="Contraseña" required>
          <select name="perfil" id="edit_perfil">
            <option value="1">Administrador</option>
            <option value="2">Instructor</option>
            <option value="3">Aprendiz</option>
            <option value="4">Administrativo</option>
          </select>
          <button type="submit">Actualizar</button>
        </form>
      </div>

    </section>
  </div>

  <script>
    function showSection(sectionId) {
      document.querySelectorAll('.section').forEach(section => {
        section.style.display = 'none';
      });
      document.getElementById(sectionId).style.display = 'block';
    }

    function mostrarFormularioAgregar() {
      document.getElementById('formAgregar').style.display = 'block';
      document.getElementById('formEditar').style.display = 'none';
    }

    function editarUsuario(id, nombre, correo, documento, clave, perfil) {
      document.getElementById('formEditar').style.display = 'block';
      document.getElementById('formAgregar').style.display = 'none';

      document.getElementById('edit_id').value = id;
      document.getElementById('edit_nombre').value = nombre;
      document.getElementById('edit_correo').value = correo;
      document.getElementById('edit_documento').value = documento;
      document.getElementById('edit_clave').value = clave;
      document.getElementById('edit_perfil').value = perfil;
    }

    function desactivarUsuario(id) {
      if (confirm("¿Seguro que quieres desactivar este usuario?")) {
        alert("Usuario " + id + " desactivado (simulado)");
      }
    }

    document.getElementById('formNuevoUsuario').addEventListener('submit', function (e) {
      e.preventDefault();
      alert("Usuario agregado (simulado)");
    });

    document.getElementById('formEditarUsuario').addEventListener('submit', function (e) {
      e.preventDefault();
      alert("Usuario actualizado (simulado)");
    });
  </script>
</body>
</html>
