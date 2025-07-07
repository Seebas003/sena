<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Usuario</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #1e1e2f;
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .form-container {
      background: #333;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(57, 255, 20, 0.4);
      width: 400px;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-top: 15px;
      margin-bottom: 5px;
      font-weight: 600;
    }

    input, select, button {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 5px;
      margin-top: 5px;
    }

    input, select {
      background: #222;
      color: #fff;
    }

    button {
      background: #39FF14;
      color: #000;
      font-weight: bold;
      margin-top: 20px;
      cursor: pointer;
    }

    button:hover {
      background: #32cc10;
    }

    .back-link {
      display: block;
      text-align: center;
      margin-top: 15px;
      color: #39FF14;
      text-decoration: none;
    }

    .back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Editar Usuario</h2>

    <form action="<?= base_url('usuario/actualizar') ?>" method="post">
    <input type="hidden" name="id" value="<?= esc($usuario['id_usuario']) ?>">

    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?= esc($usuario['nombre_usuario']) ?>" required>

    <label>Correo:</label>
    <input type="email" name="correo" value="<?= esc($usuario['correo']) ?>" required>

    <label>No. Documento:</label>
    <input type="text" name="documento" value="<?= esc($usuario['no_documento']) ?>" required>

    <label>Contraseña:</label>
    <input type="password" name="clave" value="<?= esc($usuario['pass_usuario']) ?>" required>

    <label>Perfil:</label>
    <select name="perfil" required>
        <option value="1" <?= $usuario['id_perfil'] == 1 ? 'selected' : '' ?>>Administrador</option>
        <option value="2" <?= $usuario['id_perfil'] == 2 ? 'selected' : '' ?>>Instructor</option>
        <option value="3" <?= $usuario['id_perfil'] == 3 ? 'selected' : '' ?>>Aprendiz</option>
        <option value="4" <?= $usuario['id_perfil'] == 4 ? 'selected' : '' ?>>Administrativo</option>
    </select>

    <button type="submit">Guardar Cambios</button>
</form>


    <a href="http://localhost/sena/public/index.php/dashboard" class="back-link">Volver al Dashboard</a>
  </div>
</body>
</html>
