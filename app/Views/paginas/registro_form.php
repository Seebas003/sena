<?php
function traducirMensaje($mensaje) {
    $traducciones = [
        'The pass_usuario field is required.' => 'El campo contraseña es obligatorio.',
        'The confirm-password field does not match the pass_usuario field.' => 'La confirmación de la contraseña no coincide.',
        'The pass_usuario field must be at least 6 characters in length.' => 'La contraseña debe tener al menos 6 caracteres.',
        'The nombre_usuario field is required.' => 'El campo nombre de usuario es obligatorio.',
        'The correo field is required.' => 'El campo correo es obligatorio.',
        'The correo field must contain a valid email address.' => 'El correo electrónico no es válido.',
        'The correo field must contain a unique value.' => 'El correo ya está registrado.',
        'The no_documento field is required.' => 'El campo número de documento es obligatorio.',
        'The no_documento field must contain only numbers.' => 'El número de documento debe ser numérico.',
        'The no_documento field must contain a unique value.' => 'Este número de documento ya está registrado.',
        'The nombres field is required.' => 'El campo nombres es obligatorio.',
        'The apellidos field is required.' => 'El campo apellidos es obligatorio.',
    ];

    return $traducciones[$mensaje] ?? $mensaje;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registro de Usuario</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: url('https://www.bloomberglinea.com/resizer/v2/RAEW7WILHFA3JJHMQAYOWKN4EM.jpeg?auth=2d9996b6e3bd09f86ba0666285d6c9a921996fb4e8ae4470773335616e80f35e&width=800&height=533&quality=80&smart=true') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .form-container {
      background: rgba(240, 240, 240, 0.95);
      padding: 35px 40px;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
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

    .error-container {
      position: fixed;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);
      width: 90%;
      max-width: 500px;
      background-color: #ffe6e6;
      border: 1px solid #ff9999;
      border-radius: 8px;
      padding: 20px 40px 20px 20px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      z-index: 999;
      color: #b30000;
      animation: fadeIn 0.3s ease-in-out;
    }

    .error-container strong {
      color: #b30000;
    }

    .error-container ul {
      list-style: disc;
      padding-left: 20px;
    }

    .close-btn {
      position: absolute;
      top: 10px;
      right: 15px;
      background: transparent;
      border: none;
      font-size: 18px;
      color: #900;
      cursor: pointer;
      padding: 5px;
      border-radius: 50%;
      width: 24px;
      height: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background-color 0.2s;
    }

    .close-btn:active, 
    .close-btn:focus {
      background-color: transparent !important;
      outline: none;
    }

    .close-btn:hover {
      background-color: rgba(153, 0, 0, 0.1);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translate(-50%, -10px); }
      to { opacity: 1; transform: translate(-50%, 0); }
    }
  </style>
</head>
<body>
  <?php if (session()->getFlashdata('errors')): ?>
    <div class="error-container" id="errorContainer">
      <button class="close-btn" onclick="cerrarError()">✖</button>
      <strong>⚠️ Se encontraron los siguientes errores:</strong>
      <ul>
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
          <li><?= esc(traducirMensaje($error)) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <div class="form-container">
    <div class="robot">
      <img src="https://i.pinimg.com/originals/4b/cb/1f/4bcb1fb72d1d08efa44efa5ceb712ec7.gif" alt="Robot animado">
    </div>

    <h2>Registro de Usuario</h2>

    <form action="<?= base_url('/registro/guardar') ?>" method="post">
      <label>Nombre de usuario</label>
      <input type="text" name="nombre_usuario" required>

      <label>Nombres</label>
      <input type="text" name="nombres" required>

      <label>Apellidos</label>
      <input type="text" name="apellidos" required>

      <label for="correo">Correo Electrónico</label>
      <input type="email" id="correo" name="correo" required />

      <label for="documento">Número de Documento</label>
      <input type="text" id="documento" name="no_documento" required />

      <label for="pass_usuario">Contraseña</label>
      <input type="password" id="pass_usuario" name="pass_usuario" required />

      <label for="confirm-password">Confirmar Contraseña</label>
      <input type="password" id="confirm-password" name="confirm-password" required />

      <button type="submit">Registrarse</button>
    </form>

    <button class="btn-google" onclick="alert('Registro con Google no disponible aún')">Registrarse con Google</button>
  </div>

  <script>
    function cerrarError() {
      const errorBox = document.getElementById('errorContainer');
      if (errorBox) {
        errorBox.style.opacity = '0';
        setTimeout(() => errorBox.remove(), 300);
      }
    }
    <?php if (session()->getFlashdata('mensaje')): ?>
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: '<?= session()->getFlashdata('mensaje') ?>',
        confirmButtonColor: '#006B2D',
        timer: 3000,
        timerProgressBar: true
    });
</script>
<?php endif; ?>


    setTimeout(() => {
      cerrarError();
    }, 5000);
  </script>
</body>
</html>
