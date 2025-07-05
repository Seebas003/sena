<?php if (session()->getFlashdata('errors')): ?>
  <div style="color:red;">
    <ul>
      <?php foreach (session()->getFlashdata('errors') as $error): ?>
        <li><?= esc($error) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registro de Usuario</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: #ffffff;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .form-container {
      background: #f0f0f0;
      padding: 35px 40px;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      width: 400px;
      position: relative;
    }

    h2 {
      text-align: center;
      color: #008f5a;
      margin-bottom: 25px;
    }

    label {
      display: block;
      margin-top: 15px;
      font-weight: 600;
      color: #333;
    }

    input {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: 2px solid #ccc;
      margin-bottom: 10px;
      background-color: #fff;
      font-size: 14px;
    }

    button {
      width: 100%;
      background-color: #008f5a;
      color: #fff;
      border: none;
      padding: 12px;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s;
      margin-top: 15px;
    }

    button:hover {
      background-color: #007347;
    }

    .robot {
      width: 80px;
      height: 80px;
      position: absolute;
      top: -40px;
      left: 50%;
      transform: translateX(-50%);
    }

    .robot img {
      width: 100%;
      animation: bounce 1.5s infinite;
    }

    @keyframes bounce {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    .btn-google {
      background: #555;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <div class="robot">
      <img src="https://i.pinimg.com/originals/4b/cb/1f/4bcb1fb72d1d08efa44efa5ceb712ec7.gif" alt="Robot animado">
    </div>

    <h2>Registro de Usuario</h2>

    <form action="<?= base_url('/registro/guardar') ?>" method="post">
      <label for="nombre">Nombre Completo</label>
      <input type="text" id="nombre" name="nombre" required />

      <label for="correo">Correo Electrónico</label>
      <input type="email" id="correo" name="correo" required />

      <label for="contrasena">Contraseña</label>
      <input type="password" id="contrasena" name="contrasena" required />

      <label for="confirm-password">Confirmar Contraseña</label>
      <input type="password" id="confirm-password" name="confirm-password" required />

      <button type="submit">Registrarse</button>
    </form>

    <button class="btn-google" onclick="alert('Registro con Google no disponible aún')">Registrarse con Google</button>
  </div>
</body>
</html>