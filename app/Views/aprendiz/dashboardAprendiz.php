<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Aprendiz SENA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #FFFFFF; /* White background based on content area in image */
            color: #006B2D; /* Dark green text for general content, matching SENA logo text */
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
            color: #000000; /* Dark green card text */
            border: 1px solid #98FB98; /* Light green border */
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 107, 45, 0.15); /* More pronounced green shadow on hover */
            border: 1px solid #006B2D; /* Dark green border on hover */
        }
        .card i {
            font-size: 40px;
            color: #050505; /* Bright SENA green for icons */
            margin-bottom: 15px;
        }
        .section {
            display: none;
            margin-top: 20px;
            background: #FFFFFF; /* White section background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 107, 45, 0.1); /* Subtle green shadow */
            color: #121312; /* Dark green section text */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #98FB98; /* Light green border */
            padding: 10px;
            text-align: center;
            color: #020202; /* Dark green table cell text */
        }
        th {
            background: #F0FFF0; /* Bright SENA green for table headers */
            color: #0c0c0c; /* Dark green text on green header */
        }
        button {
            background: #43d828; /* Bright SENA green for buttons */
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
            box-shadow: 0 0 10px rgba(57, 255, 20, 0.5); /* Green glow on hover */
        }
        button.delete {
            background: #FF8C00; /* Orange for delete/reject, a contrasting but not clashing color */
            color: white;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            background: #F0FFF0; /* Very light green input background */
            color: #000000; /* Dark green input text */
            border: 1px solid #98FB98; /* Light green border */
            border-radius: 5px;
        }
        .file-upload {
            border: 2px dashed #006B2D; /* Dark green dashed border */
            padding: 20px;
            text-align: center;
            border-radius: 5px;
            margin: 15px 0;
            color: #0f0f0f; /* Dark green file upload text */
        }
        .doc-list {
            background: #F0FFF0; /* Very light green doc list background */
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
            color: #0a0a0a; /* Dark green doc list text */
            border: 1px solid #98FB98; /* Light green border */
        }
        /* Specific styles for status spans */
        .status {
            font-weight: bold;
        }
        .status[style*="#39FF14"] { /* Approved status, matches badge-aprobado */
            color: #39FF14 !important;
        }
        .status[style*="#FFA500"] { /* In review status, matches badge-pendiente */
            color: #ADFF2F !important; /* Adjusted to a lighter green for 'En revisión' for consistency */
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="#" onclick="showSection('horario')"><i class="fas fa-calendar-alt"></i> Mi Horario</a>
        <a href="#" onclick="showSection('perfil')"><i class="fas fa-user-edit"></i> Mi Perfil</a>
        <a href="#" onclick="showSection('equipos')"><i class="fas fa-laptop"></i> Equipos</a>
        <a href="#" onclick="showSection('certificado')"><i class="fas fa-file-alt"></i> Certificado</a>
        <a href="#" onclick="showSection('incapacidades')"><i class="fas fa-file-medical"></i> Incapacidades</a>
        <a href="#" onclick="showSection('trabajos')"><i class="fas fa-tasks"></i> Mis Trabajos</a>
        <a href="<?= base_url('/login') ?>"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
    </div>

    <div class="content">
        <div class="dashboard-header">
            <h1>Panel del Aprendiz SENA</h1>
            <p>Bienvenido a tu espacio de formación</p>
        </div>

        <section class="cards">
            <div class="card" onclick="showSection('horario')">
                <i class="fas fa-calendar-alt"></i>
                <h3>Mi Horario</h3>
                <p>Consulta tus clases y actividades</p>
            </div>
            <div class="card" onclick="showSection('certificado')">
                <i class="fas fa-file-alt"></i>
                <h3>Certificado</h3>
                <p>Descarga tu certificado</p>
            </div>
            <div class="card" onclick="showSection('trabajos')">
                <i class="fas fa-tasks"></i>
                <h3>Mis Trabajos</h3>
                <p>Revisa tus entregas</p>
            </div>
        </section>

        <section id="horario" class="section" style="display: block;">
            <h2><i class="fas fa-calendar-alt"></i> Mi Horario Semanal</h2>
            <table>
                <tr>
                    <th>Hora</th><th>Lunes</th><th>Martes</th><th>Miércoles</th><th>Jueves</th><th>Viernes</th>
                </tr>
                <tr>
                    <td>7:00-9:00</td>
                    <td>Programación<br><small style="color: #666;">Aula 203</small></td>
                    <td>Base de datos<br><small style="color: #666;">Lab. 4</small></td>
                    <td>Programación<br><small style="color: #666;">Aula 203</small></td>
                    <td>Base de datos<br><small style="color: #666;">Lab. 4</small></td>
                    <td>Proyecto<br><small style="color: #666;">Aula 105</small></td>
                </tr>
                <tr>
                    <td>9:00-11:00</td>
                    <td>Matemáticas<br><small style="color: #666;">Aula 201</small></td>
                    <td>Inglés Técnico<br><small style="color: #666;">Aula 102</small></td>
                    <td>Matemáticas<br><small style="color: #666;">Aula 201</small></td>
                    <td>Inglés Técnico<br><small style="color: #666;">Aula 102</small></td>
                    <td>Taller<br><small style="color: #666;">Lab. 3</small></td>
                </tr>
            </table>
        </section>

        <section id="perfil" class="section">
            <h2><i class="fas fa-user-edit"></i> Editar Perfil</h2>
            <form>
                <label>Nombre Completo:</label>
                <input type="text" value="Juan Pérez">
                
                <label>Correo Electrónico:</label>
                <input type="email" value="juan.perez@sena.edu.co">
                
                <label>Teléfono:</label>
                <input type="tel" value="3001234567">
                
                <button type="submit">Guardar Cambios</button>
                <button class="delete" type="button">Eliminar Cuenta</button>
            </form>
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

        <section id="certificado" class="section">
            <h2><i class="fas fa-file-alt"></i> Certificado Estudiantil</h2>
            <div class="doc-list">
                <h3>Certificado disponible para descarga:</h3>
                <p><i class="fas fa-file-pdf"></i> Certificado_Formacion_2024.pdf</p>
                <button onclick="descargarCertificado()"><i class="fas fa-download"></i> Descargar Certificado</button>
            </div>
        </section>

        <section id="incapacidades" class="section">
            <h2><i class="fas fa-file-medical"></i> Gestión de Incapacidades</h2>
            
            <div class="file-upload">
                <h3><i class="fas fa-cloud-upload-alt"></i> Subir Nueva Incapacidad</h3>
                <input type="file" id="incapacidadFile" accept=".pdf,.jpg,.png">
                <label>Fecha de incapacidad:</label>
                <input type="date">
                <button onclick="subirIncapacidad()"><i class="fas fa-upload"></i> Subir Documento</button>
            </div>
            
            <h3>Historial de Incapacidades:</h3>
            <div class="doc-list">
                <p><i class="fas fa-file-pdf"></i> Incapacidad_2024-03-15.pdf <span class="status" style="color:#158601">Aprobada</span></p>
                <p><i class="fas fa-file-image"></i> Incapacidad_2024-02-10.jpg <span class="status" style="color:#ffee00">En revisión</span></p>
            </div>
        </section>

        <section id="trabajos" class="section">
            <h2><i class="fas fa-tasks"></i> Mis Trabajos Entregados</h2>
            
            <table>
                <tr>
                    <th>Actividad</th>
                    <th>Fecha Entrega</th>
                    <th>Archivo</th>
                    <th>Estado</th>
                    <th>Calificación</th>
                </tr>
                <tr>
                    <td>Proyecto Base de Datos</td>
                    <td>15/03/2024</td>
                    <td><i class="fas fa-file-code"></i> proyecto_bd.zip</td>
                    <td><span style="color:#169400">Aprobado</span></td>
                    <td>4.8/5.0</td>
                </tr>
                <tr>
                    <td>Informe de Matemáticas</td>
                    <td>28/02/2024</td>
                    <td><i class="fas fa-file-word"></i> informe_matematicas.docx</td>
                    <td><span style="color:#ffd104">En revisión</span></td>
                    <td>-</td>
                </tr>
            </table>
            
            <div class="file-upload" style="margin-top: 30px;">
                <h3><i class="fas fa-cloud-upload-alt"></i> Entregar Nuevo Trabajo</h3>
                <label>Seleccionar actividad:</label>
                <select>
                    <option>Proyecto Final Programación</option>
                    <option>Taller de Inglés</option>
                </select>
                <input type="file" id="trabajoFile">
                <button onclick="entregarTrabajo()"><i class="fas fa-paper-plane"></i> Enviar Trabajo</button>
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

        function descargarCertificado() {
            alert("Descargando certificado... (simulación)");
        }

        function subirIncapacidad() {
            const file = document.getElementById('incapacidadFile').files[0];
            if (file) {
                alert(`Incapacidad "${file.name}" subida correctamente. Se notificará al instructor.`);
            } else {
                alert("Por favor selecciona un archivo");
            }
        }

        function entregarTrabajo() {
            const file = document.getElementById('trabajoFile').files[0];
            if (file) {
                alert(`Trabajo "${file.name}" entregado correctamente.`);
            } else {
                alert("Por favor selecciona un archivo");
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            showSection('horario');
        });
    </script>
</body>
</html>