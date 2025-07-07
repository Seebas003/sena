<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Instructor SENA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #FFFFFF; /* White background based on content area in image */
            color: #161616; /* Dark green text for general content, matching SENA logo text */
            display: flex;
        }
        .sidebar {
            width: 250px;
            background: #006B2D; /* Dark green from SENA header/footer in image */
            padding: 20px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            gap: 15px;
            box-shadow: 2px 0 10px rgba(0, 107, 45, 0.2); /* Subtle green shadow */
        }
        .sidebar a {
            color: #FFFFFF; /* White text for sidebar links */
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
            background: #008D4D; /* Slightly lighter green on hover for sidebar */
            color: #FFFFFF;
        }
        .content {
            margin-left: 270px;
            padding: 30px;
            flex-grow: 1;
            background-color: #FFFFFF; /* White content background matching image */
        }
        .dashboard-header {
            text-align: center;
            margin-bottom: 30px;
            color: #006B2D; /* Dark green header text */
        }
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        .card {
            background: #F0FFF0; /* Very light green card background, like subtle white */
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 15px rgba(0, 107, 45, 0.1); /* Subtle green shadow */
            transition: transform 0.3s;
            cursor: pointer;
            color: #0f0f0f; /* Dark green card text */
            border: 1px solid #f3f3f3; /* Light green border */
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 107, 45, 0.15); /* More pronounced green shadow on hover */
            border: 1px solid #171817; /* Dark green border on hover */
        }
        .card i {
            font-size: 40px;
            color: #1c1d1c; /* Bright SENA green for icons, from "¡Comienza ahora!" button */
            margin-bottom: 15px;
        }
        .section {
            display: none;
            margin-top: 20px;
            background: #FFFFFF; /* White section background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 107, 45, 0.1); /* Subtle green shadow */
            color: #111111; /* Dark green section text */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ebf3eb; /* Light green border */
            padding: 10px;
            text-align: center;
            color: #171818; /* Dark green table cell text */
        }
        th {
            background: #ffffff; /* Bright SENA green for table headers */
            color: #171817; /* Dark green text on green header */
        }
        button {
            background: #eff5ef; /* Bright SENA green for buttons */
            color: #000000; /* Dark green text for buttons */
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            margin: 5px;
            transition: all 0.3s;
        }
        button:hover {
            transform: scale(1.05);
            box-shadow: 0 0 10px rgba(211, 216, 211, 0.5); /* Green glow on hover */
        }
        .btn-verde {
            background: #24ad02; /* Explicit green button */
            color: #f5f5f5;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            background: #F0FFF0; /* Very light green input background */
            color: #000000; /* Dark green input text */
            border: 1px solid #8d918d; /* Light green border */
            border-radius: 5px;
        }
        .file-upload {
            border: 2px dashed #006B2D; /* Dark green dashed border */
            padding: 20px;
            text-align: center;
            border-radius: 5px;
            margin: 15px 0;
            color: #006B2D; /* Dark green file upload text */
        }
        .doc-list {
            background: #F0FFF0; /* Very light green doc list background */
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
            color: #006B2D; /* Dark green doc list text */
            border: 1px solid #98FB98; /* Light green border */
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
        }
        .badge-pendiente {
            background: #ffd902; /* Light green for pending, a distinct green */
            color: #151616; /* Dark green text on light green badge */
        }
        .badge-aprobado {
            background: #20860d; /* Bright SENA green for approved */
            color: #f3f7f3; /* Dark green text on bright green badge */
        }
        .badge-rechazado {
            background: #d63912; /* Orange for rejected - a contrasting but not clashing color for status */
            color: white;
        }
        /* Specific styles for inner elements to ensure consistency */
        #cronograma > div > div {
            background: #F0FFF0 !important; /* Light green background for inner cronograma divs */
            color: #191b1a !important;
            border: 1px solid #e9f5e9 !important;
        }
        #aulas form {
            background: #F0FFF0 !important; /* Light green background for Aula form */
            color: #191a19 !important;
            border: 1px solid #141614 !important;
        }
        #mensajes > div > div:first-child { /* Message list (left pane) */
            background: #F0FFF0 !important; /* Light green background */
            color: #eaf0ea !important;
            border-radius: 10px;
            border: 1px solid #98FB98 !important;
        }
        #mensajes > div > div:nth-child(2) { /* Chat window (right pane) */
            background: #FFFFFF !important; /* White background */
            color: #006B2D !important;
            border-radius: 10px;
            border: 1px solid #98FB98 !important;
        }
        #mensajes div[style*="text-align: right"] div { /* Sent message bubbles (your messages) */
            background: #eff5f2 !important; /* Dark green for sent messages */
            color: #757171 !important; /* White text on sent messages */
        }
        #mensajes div[style*="text-align: left"] div { /* Received message bubbles (other's messages) */
            background: #E0FFE0 !important; /* Very light green for received messages */
            color: #757171 !important; /* Dark green text on received messages */
        }
        #mensajes div[style*="font-size: 12px"] { /* Message timestamps */
            color: #666; /* Slightly darker grey for timestamps for readability */
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="#" onclick="showSection('cronograma')"><i class="fas fa-calendar-alt"></i> Mi Cronograma</a>
        <a href="#" onclick="showSection('certificados')"><i class="fas fa-file-alt"></i> Certificados</a>
        <a href="#" onclick="showSection('equipos')"><i class="fas fa-laptop"></i> Mis Equipos</a>
        <a href="#" onclick="showSection('aulas')"><i class="fas fa-door-open"></i> Gestión de Aulas</a>
        <a href="#" onclick="showSection('incapacidades')"><i class="fas fa-file-medical"></i> Incapacidades</a>
        <a href="#" onclick="showSection('trabajos')"><i class="fas fa-tasks"></i> Revisión Trabajos</a>
        <a href="#" onclick="showSection('mensajes')"><i class="fas fa-comments"></i> Mensajes</a>
        <a href="Rol.html"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
    </div>

    <div class="content">
        <div class="dashboard-header">
            <h1>Panel del Instructor SENA</h1>
            <p>Herramientas para la gestión académica</p>
        </div>

        <section class="cards">
            <div class="card" onclick="showSection('cronograma')">
                <i class="fas fa-calendar-alt"></i>
                <h3>Mi Cronograma</h3>
                <p>Horarios y actividades</p>
            </div>
            <div class="card" onclick="showSection('aulas')">
                <i class="fas fa-door-open"></i>
                <h3>Gestión de Aulas</h3>
                <p>Solicitar apertura/cierre</p>
            </div>
            <div class="card" onclick="showSection('trabajos')">
                <i class="fas fa-tasks"></i>
                <h3>Trabajos</h3>
                <p>Revisar entregas</p>
            </div>
        </section>

        <section id="cronograma" class="section" style="display: block;">
            <h2><i class="fas fa-calendar-alt"></i> Mi Cronograma</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                <div style="background: #F0FFF0; padding: 15px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.08); border: 1px solid #98FB98;">
                    <h3>Esta Semana</h3>
                    <table>
                        <tr><th>Día</th><th>Aula</th><th>Hora</th><th>Curso</th></tr>
                        <tr><td>Lunes</td><td>203</td><td>7:00-11:00</td><td>Programación</td></tr>
                        <tr><td>Martes</td><td>Lab 4</td><td>7:00-9:00</td><td>Base de Datos</td></tr>
                        <tr><td>Miércoles</td><td>203</td><td>7:00-11:00</td><td>Programación</td></tr>
                        <tr><td>Jueves</td><td>Lab 4</td><td>7:00-9:00</td><td>Base de Datos</td></tr>
                    </table>
                </div>

                <div style="background: #F0FFF0; padding: 15px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.08); border: 1px solid #98FB98;">
                    <h3>Próximas Actividades</h3>
                    <div style="margin-top: 15px;">
                        <div style="background: #E0FFE0; padding: 10px; border-radius: 5px; margin-bottom: 10px; color: #1e1f1e;">
                            <strong>Reunión de instructores</strong><br>
                            <small style="color: #666;">20/05/2024 - 10:00 AM</small>
                        </div>
                        <div style="background: #E0FFE0; padding: 10px; border-radius: 5px; margin-bottom: 10px; color: #1b1b1b;">
                            <strong>Entrega de notas parciales</strong><br>
                            <small style="color: #666;">25/05/2024 - Todo el día</small>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="certificados" class="section">
            <h2><i class="fas fa-file-alt"></i> Certificados Laborales</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                <div class="card" onclick="descargarCertificado('laboral')">
                    <i class="fas fa-briefcase"></i>
                    <h3>Certificado Laboral</h3>
                    <p>Descargar en PDF</p>
                </div>
                <div class="card" onclick="descargarCertificado('nomina')">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <h3>Desprendible de Nómina</h3>
                    <p>Descargar último pago</p>
                </div>
                <div class="card" onclick="descargarCertificado('vinculacion')">
                    <i class="fas fa-file-contract"></i>
                    <h3>Constancia de Vinculación</h3>
                    <p>Descargar en PDF</p>
                </div>
            </div>
        </section>

        <section id="equipos" class="section">
            <h2><i class="fas fa-laptop"></i> Registro de Equipos</h2>
            <form>
                <label>Tipo de Equipo:</label>
                <select>
                    <option>Portátil</option>
                    <option>Tablet</option>
                    <option>Celular</option>
                </select>
                
                <label>Marca/Modelo:</label>
                <input type="text" placeholder="Ej: HP Pavilion 15">
                
                <label>Número de Serie:</label>
                <input type="text" placeholder="Ej: 5CD1234XYZ">
                
                <button type="submit"><i class="fas fa-save"></i> Registrar Equipo</button>
            </form>
        </section>

        <section id="aulas" class="section">
            <h2><i class="fas fa-door-open"></i> Gestión de Aulas</h2>
            
            <form style="background: #F0FFF0; padding: 20px; border-radius: 10px; border: 1px solid #98FB98;">
                <h3>Solicitud de Aula</h3>
                <label>Aula:</label>
                <select>
                    <option>Aula 101</option>
                    <option>Aula 203</option>
                    <option>Laboratorio 3</option>
                    <option>Laboratorio 4</option>
                </select>
                
                <label>Tipo de Solicitud:</label>
                <select>
                    <option>Apertura</option>
                    <option>Cierre</option>
                    <option>Reporte de mantenimiento</option>
                </select>
                
                <label>Fecha/Hora:</label>
                <input type="datetime-local">
                
                <label>Descripción del estado:</label>
                <textarea rows="3" placeholder="Ej: Aula limpia, pero falta marcador..."></textarea>
                
                <button type="submit"><i class="fas fa-paper-plane"></i> Enviar Solicitud</button>
            </form>
            
            <h3 style="margin-top: 30px;">Historial Reciente</h3>
            <table>
                <tr>
                    <th>Fecha</th><th>Aula</th><th>Tipo</th><th>Estado</th><th>Comentarios</th>
                </tr>
                <tr>
                    <td>15/05/2024</td>
                    <td>203</td>
                    <td>Cierre</td>
                    <td><span class="badge badge-aprobado">Aprobado</span></td>
                    <td>Aula en buen estado</td>
                </tr>
                <tr>
                    <td>10/05/2024</td>
                    <td>Lab 4</td>
                    <td>Reporte</td>
                    <td><span class="badge badge-pendiente">Pendiente</span></td>
                    <td>Proyector no funciona</td>
                </tr>
            </table>
        </section>

        <section id="incapacidades" class="section">
            <h2><i class="fas fa-file-medical"></i> Revisión de Incapacidades</h2>
            
            <table>
                <tr>
                    <th>Aprendiz</th><th>Fecha</th><th>Documento</th><th>Estado</th><th>Acciones</th>
                </tr>
                <tr>
                    <td>María Jiménez</td>
                    <td>15/05/2024</td>
                    <td><i class="fas fa-file-pdf"></i> Incapacidad.pdf</td>
                    <td><span class="badge badge-pendiente">Pendiente</span></td>
                    <td>
                        <button class="btn-verde" onclick="aprobarIncapacidad(1)"><i class="fas fa-check"></i> Aprobar</button>
                        <button onclick="rechazarIncapacidad(1)" style="background-color: #FF8C00; color: white;"><i class="fas fa-times"></i> Rechazar</button>
                    </td>
                </tr>
                <tr>
                    <td>Carlos Rodríguez</td>
                    <td>10/05/2024</td>
                    <td><i class="fas fa-file-image"></i> Incapacidad.jpg</td>
                    <td><span class="badge badge-aprobado">Aprobada</span></td>
                    <td>-</td>
                </tr>
            </table>
        </section>

        <section id="trabajos" class="section">
            <h2><i class="fas fa-tasks"></i> Revisión de Trabajos</h2>
            
            <div style="margin-bottom: 20px;">
                <label>Filtrar por curso:</label>
                <select onchange="filtrarTrabajos(this.value)" style="width: 300px; display: inline-block; margin-left: 10px; background: #F0FFF0; color: #0c0c0c; border: 1px solid #98FB98;">
                    <option value="todos">Todos los cursos</option>
                    <option value="programacion">Programación</option>
                    <option value="basedatos">Base de Datos</option>
                </select>
            </div>
            
            <table>
                <tr>
                    <th>Aprendiz</th><th>Actividad</th><th>Fecha Entrega</th><th>Archivo</th><th>Calificación</th><th>Feedback</th>
                </tr>
                <tr>
                    <td>María Jiménez</td>
                    <td>Proyecto BD</td>
                    <td>15/05/2024</td>
                    <td><i class="fas fa-file-code"></i> proyecto.zip</td>
                    <td>
                        <select style="width: 60px; background: #F0FFF0; color: #1a1b1b; border: 1px solid #0c0c0c;">
                            <option>5.0</option>
                            <option selected>4.8</option>
                            <option>4.5</option>
                        </select>
                    </td>
                    <td>
                        <button onclick="mostrarFeedback(1)"><i class="fas fa-comment-dots"></i> Ver</button>
                    </td>
                </tr>
                <tr>
                    <td>Carlos Rodríguez</td>
                    <td>Taller SQL</td>
                    <td>12/05/2024</td>
                    <td><i class="fas fa-file-word"></i> taller.docx</td>
                    <td>-</td>
                    <td>
                        <button onclick="mostrarFeedback(2)"><i class="fas fa-edit"></i> Calificar</button>
                    </td>
                </tr>
            </table>
        </section>

        <section id="mensajes" class="section">
            <h2><i class="fas fa-comments"></i> Mensajes</h2>
            
            <div style="display: grid; grid-template-columns: 250px 1fr; gap: 20px;">
                <div style="background: #F0FFF0; padding: 15px; border-radius: 10px; max-height: 500px; overflow-y: auto; box-shadow: 0 0 10px rgba(241, 237, 237, 0.08); border: 1px solid #98FB98;">
                    <div style="padding: 10px; border-bottom: 1px solid #E0FFE0; cursor: pointer; color: #0d0e0d;">
                        <strong>María Jiménez</strong><br>
                        <small style="color: #666;">Último mensaje: 15/05 10:30 AM</small>
                    </div>
                    <div style="padding: 10px; border-bottom: 1px solid #E0FFE0; cursor: pointer; background: #E0FFE0; color: #1c1d1d;">
                        <strong>Carlos Rodríguez</strong><br>
                        <small style="color: #666;">Último mensaje: 14/05 3:45 PM</small>
                    </div>
                </div>
                
                <div style="background: #FFFFFF; padding: 15px; border-radius: 10px; display: flex; flex-direction: column; height: 500px; box-shadow: 0 0 10px rgba(223, 218, 218, 0.08); border: 1px solid #98FB98;">
                    <div style="flex-grow: 1; overflow-y: auto; margin-bottom: 15px;">
                        <div style="text-align: right; margin-bottom: 10px;">
                            <div style="background: #006B2D; display: inline-block; padding: 8px 12px; border-radius: 10px; color: #FFFFFF;">
                                ¿Ya revisaste el proyecto?
                            </div>
                            <div style="font-size: 12px; color: #666;">15/05 10:30 AM</div>
                        </div>
                        <div style="text-align: left; margin-bottom: 10px;">
                            <div style="background: #E0FFE0; display: inline-block; padding: 8px 12px; border-radius: 10px; color: #006B2D;">
                                Sí, te enviaré los comentarios hoy
                            </div>
                            <div style="font-size: 12px; color: #666;">15/05 10:32 AM</div>
                        </div>
                    </div>
                    <div style="display: flex;">
                        <input type="text" placeholder="Escribe un mensaje..." style="flex-grow: 1; margin-right: 10px;">
                        <button><i class="fas fa-paper-plane"></i></button>
                    </div>
                </div>
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

        function descargarCertificado(tipo) {
            alert(`Descargando certificado ${tipo}... (simulación)`);
        }

        function aprobarIncapacidad(id) {
            if(confirm("¿Aprobar esta incapacidad?")) {
                alert(`Incapacidad ${id} aprobada correctamente`);
            }
        }

        function rechazarIncapacidad(id) {
            const motivo = prompt("Motivo del rechazo:");
            if(motivo) {
                alert(`Incapacidad ${id} rechazada por: ${motivo}`);
            }
        }

        function mostrarFeedback(id) {
            const feedback = prompt("Ingrese su feedback para el trabajo:");
            if(feedback) {
                alert(`Feedback guardado para trabajo ${id}`);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            showSection('cronograma');
        });
    </script>
</body>
</html>