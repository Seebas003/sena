<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Agregar Usuario - SENA</title>
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
    .form-container {
      background: #333;
      padding: 30px;
      border-radius: 10px;
      max-width: 500px;
      margin: 0 auto;
      box-shadow: 0 0 15px rgba(255, 65, 108, 0.3);
    }
    h2 {
      text-align: center;
      color: #39FF14;
    }
    input, select {
      margin: 10px 0;
      padding: 10px;
      width: 100%;
      border-radius: 5px;
      border: none;
      outline: none;
    }
    button {
      width: 100%;
      background: #39FF14;
      color: #000;
      padding: 10px;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
      margin-top: 15px;
    }
    button:hover {
      background: #32cc10;
    }
    .back-link {
      display: block;
      margin-top: 20px;
      text-align: center;
      color: #39FF14;
      text-decoration: none;
    }
    .back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <a href="<?= base_url('/usuario') ?>"><i class="fas fa-arrow-left"></i> Volver</a>
  </div>

  <div class="content">
    <div class="form-container">
      <h2><i class="fas fa-user-plus"></i> Agregar Nuevo Usuario</h2>
      <form action="<?= base_url('usuario/agregar') ?>" method="post">
        <input type="text" name="nombre" placeholder="Nombre de usuario" required>
        <input type="email" name="correo" placeholder="Correo electrónico" required>
        <input type="text" name="documento" placeholder="Número de documento" required>
        <input type="password" name="clave" placeholder="Contraseña" required>
        <select name="perfil" required>
          <option value="">Seleccione un perfil</option>
          <option value="2">Administrador</option>
          <option value="3">Instructor</option>
          <option value="1">Aprendiz</option>
          <option value="4">Administrativo</option>
        </select>
        <button type="submit">Guardar Usuario</button>
      </form>
      <a class="back-link" href="<?= base_url('usuario') ?>"><i class="fas fa-arrow-left"></i> Volver al listado</a>
    </div>
  </div>
</body>
</html>
