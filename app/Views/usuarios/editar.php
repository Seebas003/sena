<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Usuario</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #1e1e2f;
      color: #fff;
      padding: 20px;
    }
    .form-container {
      background-color: #2e2e3e;
      padding: 30px;
      border-radius: 10px;
      max-width: 500px;
      margin: auto;
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }
    input, select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 5px;
      border: none;
      background: #fff;
      color: #000;
    }
    input[readonly] {
      background-color: #ccc;
      cursor: not-allowed;
    }
    .btn {
      margin-top: 20px;
      padding: 10px;
      width: 100%;
      background-color: #39FF14;
      color: #000;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
    }
    .btn:hover {
      background-color: #32cc10;
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h2><i class="fas fa-user-edit"></i> Editar Usuario</h2>

    <form action="<?= base_url('usuario/actualizar') ?>" method="post">
      <input type="hidden" name="id" value="<?= esc($usuario['id_usuario']) ?>">

      <label for="nombre">Nombre de Usuario</label>
      <input type="text" name="nombre" id="nombre" value="<?= esc($usuario['nombre_usuario']) ?>" required>

      <label for="correo">Correo</label>
      <input type="email" name="correo" id="correo" value="<?= esc($usuario['correo']) ?>" required>

      <label for="documento">Número de Documento</label>
      <input type="text" name="documento" id="documento" value="<?= esc($usuario['no_documento']) ?>" readonly>

      <label for="clave">Contraseña (opcional)</label>
      <input type="password" name="clave" id="clave" placeholder="Dejar en blanco">
      
      <label for="perfil">Perfil</label>
      <select name="perfil" id="perfil" required>
        <option value="1" <?= $usuario['id_perfil'] == 1 ? 'selected' : '' ?>>Aprendiz</option>
        <option value="2" <?= $usuario['id_perfil'] == 2 ? 'selected' : '' ?>>Administrador</option>
        <option value="3" <?= $usuario['id_perfil'] == 3 ? 'selected' : '' ?>>Instructor</option>
        <option value="4" <?= $usuario['id_perfil'] == 4 ? 'selected' : '' ?>>Administrativo</option>
      </select>

      <button type="submit" class="btn">Actualizar Usuario</button>
    </form>
  </div>

</body>
</html>
