<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
    /* Tu estilo original resumido */
    html, body {
      height: 100%; margin: 0; padding: 0;
      font-family: 'Poppins', sans-serif;
    }

    header {
      padding: 25px; height: 5%; width: 99%;
      z-index: 5; background-color: #00332c;
    }

    .top-right-buttons {
      display: flex; justify-content: flex-end;
      min-height: 80%; min-width: 80%; margin-inline: 10px;
    }

    .top-right-button {
      padding: 10px 20px; margin-inline: 2px;
      background-color: transparent;
      color: #fff; border: 2px solid #00ffae;
      border-radius: 8px; cursor: pointer;
      transition: background-color 0.3s, color 0.3s;
      text-decoration: none;
    }

    .top-right-button:hover {
      background-color: #00ffae; color: #000;
    }

    main {
      display: flex; justify-content: center;
      align-items: center; min-height: 90%;
      backdrop-filter: blur(4px);
    }

    .main-container {
      background: url('https://www.bloomberglinea.com/resizer/v2/RAEW7WILHFA3JJHMQAYOWKN4EM.jpeg?auth=2d9996b6e3bd09f86ba0666285d6c9a921996fb4e8ae4470773335616e80f35e&width=800&height=533&quality=80&smart=true') no-repeat center center fixed;
      background-size: cover;
    }

    .login-container {
      position: relative;
      background: rgba(31, 31, 31, 0.8);
      backdrop-filter: blur(12px);
      border: 2px solid rgba(0, 255, 174, 0.4);
      border-radius: 15px;
      padding: 40px 30px;
      box-shadow: 0 8px 20px rgba(0, 255, 174, 0.2);
      width: 350px;
      animation: fadeInUp 1s ease-out;
      text-align: center;
    }

    .robot {
      width: 100px; margin: 0 auto 20px;
    }

    .robot img { width: 100%; }

    .form-container {
      display: flex; flex-direction: column;
      justify-content: center; align-items: center;
    }

    .input-group {
      width: 100%; display: flex; flex-direction: row;
      margin-bottom: 20px; text-align: left;
    }

    .input-group label {
      width: 30%; padding: 5px; font-size: 14px;
      color: #fff;
    }

    .input-group input {
      width: 65%; padding: 5px;
      border-radius: 8px;
      border: 1px solid transparent;
      background-color: #ffffff;
      color: #000; font-size: 14px;
      transition: border 0.3s, box-shadow 0.3s;
    }

    .input-group input:focus {
      outline: none;
      box-shadow: 0 0 8px #00ffae;
      border: 1px solid #00ffae;
    }

    .toggle-password {
      position: absolute; top: 50%; right: 10px;
      transform: translateY(-50%);
      cursor: pointer; color: #000;
    }

    .login-btn-entrar, .login-btn {
      width: 100%; padding: 12px;
      background-color: #00ffae;
      color: #000; border: none;
      border-radius: 8px; font-weight: bold;
      font-size: 15px; cursor: pointer;
      box-shadow: 0 0 10px #00ffae;
      transition: background-color 0.3s, transform 0.2s, box-shadow 0.3s;
    }

    .login-btn-entrar:hover, .login-btn:hover {
      background-color: #00d996;
      transform: scale(1.05);
      box-shadow: 0 0 15px #00ffae;
    }

    .article-login-container { margin: 1px; padding: 1px; }

    .alerta-error-overlay {
      position: absolute;
      top: -15px;
      left: 50%;
      transform: translateX(-50%);
      background-color: #ffe5e5;
      color: #8b0000;
      border: 1px solid #f5c2c2;
      border-radius: 10px;
      padding: 10px 20px;
      font-size: 14px;
      width: 100%;
      max-width: 340px;
      z-index: 999;
      box-shadow: 0 0 10px rgba(255, 0, 0, 0.2);
    }

    .alerta-error-overlay .encabezado {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .alerta-error-overlay .encabezado i {
      margin-right: 10px;
      color: #d9534f;
    }

    .alerta-error-overlay .cerrar {
      font-size: 16px;
      font-weight: bold;
      color: #d9534f;
      cursor: pointer;
    }

    .alerta-error-overlay ul {
      margin: 5px 0 0 20px;
      padding: 0;
    }

    @media (max-width: 600px) {
      .login-container { width: 80%; padding: 20px 15px; }
      .input-group { flex-direction: column; }
      .input-group label, .input-group input { width: 100%; }
    }
  </style>
</head>

<body>
  <header>
    <div class="top-right-buttons">
      <a href="http://localhost/sena/public/sena/" class="top-right-button">Inicio</a>
      <a href="#" class="top-right-button">Sobre Nosotros</a>
    </div>
  </header>

  <main class="main-container">
    <div class="login-container">
      <div class="robot">
        <img src="https://i.pinimg.com/originals/4b/cb/1f/4bcb1fb72d1d08efa44efa5ceb712ec7.gif" alt="Icono de robot">
      </div>

      <?php if(session()->getFlashdata('mensaje')): ?>
        <div class="alerta-error-overlay">
          <div class="encabezado">
            <span><i class="fas fa-exclamation-triangle"></i><strong> Error:</strong></span>
            <span class="cerrar" onclick="this.parentElement.parentElement.style.display='none'">&times;</span>
          </div>
          <ul>
            <li><?= session()->getFlashdata('mensaje') ?></li>
          </ul>
        </div>
      <?php endif; ?>

      <h2>Iniciar Sesión</h2>

      <form class="form-container" action="<?= base_url('/login/acceder'); ?>" method="POST">
        <div class="input-group">
          <label for="usuario">Usuario</label>
          <input type="text" id="usuario" name="usuario" placeholder="Usuario" required />
        </div>
        <div class="input-group" style="position: relative;">
          <label for="password">Contraseña</label>
          <input type="password" id="password" name="password" placeholder="Contraseña" required />
          <i class="toggle-password fas fa-eye-slash" onclick="togglePassword()"></i>
        </div>
        <button type="submit" class="login-btn-entrar">Entrar</button>
      </form>

      <article class="article-login-container"><h3>o</h3></article>

      <form action="<?= base_url('/registro') ?>" method="get">
        <button type="submit" class="login-btn">Registrarse</button>
      </form>
    </div>
  </main>

  <script>
    function togglePassword() {
      const input = document.getElementById("password");
      const icon = document.querySelector(".toggle-password");
      if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      } else {
        input.type = "password";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
      }
    }
  </script>
</body>
</html>
