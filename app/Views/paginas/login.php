<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Iniciar Sesión</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
        <style>
    
           html, body {
                height: 100%; 
                background: none; 
                margin: 0;
                padding: 0;
                font-family: 'Poppins', sans-serif;
            }   

            header {
                padding: 25px;
                height: 5%; 
                width: 99%; 

                z-index: 5;
                background-color: #00332c;
                
            }
            .top-right-buttons {
                display: flex;
                justify-content: flex-end;
                min-height: 80%; 
                min-width: 80%; 
                margin-inline: 10px;
                
            }
            .top-right-buttons a {
                text-decoration: none;
            }

            .top-right-button {
                padding: 10px 20px;
                margin-inline: 2px;
                background-color: transparent;
                color: #fff;
                border: 2px solid #00ffae;
                
                border-radius: 8px;
                cursor: pointer;
                transition: background-color 0.3s, color 0.3s;
            }

            .top-right-button:hover {
                background-color: #00ffae;
                color: #000;
            }

            main {
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 90%; 
                width: 100%;           
                
                backdrop-filter: blur(4px);
            }

            .main-container {

                background: url('https://www.bloomberglinea.com/resizer/v2/RAEW7WILHFA3JJHMQAYOWKN4EM.jpeg?auth=2d9996b6e3bd09f86ba0666285d6c9a921996fb4e8ae4470773335616e80f35e&width=800&height=533&quality=80&smart=true') no-repeat center center fixed;
                background-size: cover;
            }

            .login-container {
                width: 90%;
                height: 90%;

                background: rgba(31, 31, 31, 0.8);
                backdrop-filter: blur(12px);
                border: 2px solid rgba(0, 255, 174, 0.4);
                border-radius: 15px;
                padding: 40px 30px;
                box-shadow: 0 8px 20px rgba(0, 255, 174, 0.2);
                width: 350px;
                animation: fadeInUp 1s ease-out;
                position: relative;
                text-align: center;
            }

           

            .robot {
                width: 100px;
                margin: 0 auto 20px;
                transition: transform 0.3s;
            }

            .robot img {
                width: 100%;
            }

            .form-container {
                display: flex;             
                justify-content: center; 
                align-items: center; 
                flex-direction: column; 
            }

            .input-group {
                height: 99%; 
                width: 99%; 

                display: flex; 
                flex-direction: row; 
                

                margin-bottom: 20px;
                text-align: left;
            }

            .input-group label {
                
                width: 30%; 
                padding: 5px;
                margin-bottom: 5px;

                font-size: 14px;
                color: #fff;
                
            }

            .input-group input {
                width: 60%; 
                padding: 5px;
                margin-bottom: 5px;

                border-radius: 8px;
                border: 1px solid transparent;
                background-color: #ffffff;
                color: #000;
                font-size: 14px;
                transition: border 0.3s, box-shadow 0.3s;
            }

            .input-group input:focus {
                outline: none;
                box-shadow: 0 0 8px #00ffae;
                border: 1px solid #00ffae;
            }

            .toggle-password {
                position: absolute;
                top: 50%;
                right: 10px;
                transform: translateY(-50%);
                cursor: pointer;
                color: #000;
            }


            .login-btn-entrar {
                width: 100%;
                padding: 12px;
                margin-top: 30px;

                background-color: #00ffae;
                color: #000;
                border: none;
                
                border-radius: 8px;
                font-weight: bold;
                font-size: 15px;
                cursor: pointer;
                box-shadow: 0 0 10px #00ffae;
                transition: background-color 0.3s, transform 0.2s, box-shadow 0.3s;
            }

            .login-btn-entrar:hover {
                background-color: #00d996;
                transform: scale(1.05);
                box-shadow: 0 0 15px #00ffae;
            }

            .article-login-container{
                width: 100%;
                padding: 1 px;
                margin: 1 px;
            }

            .login-btn {
                width: 100%;
                padding: 12px;

                background-color: #00ffae;
                color: #000;
                border: none;
                
                border-radius: 8px;
                font-weight: bold;
                font-size: 15px;
                cursor: pointer;
                box-shadow: 0 0 10px #00ffae;
                transition: background-color 0.3s, transform 0.2s, box-shadow 0.3s;
            }

            .login-btn:hover {
                background-color: #00d996;
                transform: scale(1.05);
                box-shadow: 0 0 15px #00ffae;
            }

            @media (max-width: 600px) {


                .login-container {
                    width: 80%;
                    padding: 20px 15px;
                }

                .form-container {
                    width: 100%;
                }

                .input-group {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .input-group label {
                    width: 100%;
                    margin-bottom: 5px;
                }

                .input-group input {
                    width: 100%;
                }

                .login-btn-entrar,
                .login-btn {
                    font-size: 14px;
                    padding: 10px;
                }

                .robot {
                    width: 80px;
                }
            }

        </style>
    </head>
    <body>
        <header>
            <div class="top-right-buttons">
                <a href="index.html" class="top-right-button">Inicio</a>
                <a href="http://localhost/ProjectSIA/public/SIA/" class="top-right-button">Sobre Nosotros</a>
            </div>
        </header>
        
        <main class="main-container">
            <div class="login-container">
                <div class="robot">
                    <img id="robotImg" src="https://i.pinimg.com/originals/4b/cb/1f/4bcb1fb72d1d08efa44efa5ceb712ec7.gif" alt="Icono de robot representando la página de inicio de sesión" />
                </div>
                <h2>Iniciar Sesión</h2>
                <form class = "form-container" action="<?= base_url('/login/acceder');?>" method="POST">
                    <div class="input-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" id="usuario" name="usuario" placeholder="Usuario" required />
                    </div>
                    <div class="input-group" style="position: relative;">
                      <label for="password">Contraseña</label>
                      <input type="password" id="password" name="password" placeholder="Contraseña" required />
                      <i class="toggle-password" onclick="togglePassword()"></i> 
                    </div>
                    <button href="dashboard.php" class="login-btn-entrar">Entrar</button>
                </form>
                <article class = "article-login-container">
                    <h3>o</h3>
                </article>
                <form action="<?= base_url('/registro') ?>" method="get">
                    <button type="submit" class="login-btn">Registrarse</button>
                </form>
            </div>
        </main>
        </body>
</html>

