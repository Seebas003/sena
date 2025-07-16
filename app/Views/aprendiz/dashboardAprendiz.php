<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Aprendiz SENA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

  <!-- Formulario de carga -->
  <form action="<?= base_url('/horario/importar') ?>" method="post" enctype="multipart/form-data" style="margin-bottom: 20px;">
    <input type="file" name="archivo_excel" accept=".xlsx,.xls" required>
    <button type="submit"><i class="fas fa-upload"></i> Cargar Programación</button>
  </form>

  <!-- Mensaje de éxito -->
  <?php if (session()->getFlashdata('success')): ?>
    <div style="background-color: #d4edda; padding: 10px; margin-top: 10px; border-left: 5px solid #28a745;">
      <?= esc(session()->getFlashdata('success')) ?>
    </div>
  <?php endif; ?>

  <!-- Tabla de horario -->
  <?php if (isset($horario) && count($horario) > 0): ?>
    <pre><?php print_r($horario); ?></pre>

    <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; margin-top: 20px; text-align: center;">
      <thead style="background-color: #f8f9fa;">
        <tr>
          <th>Hora</th>
          <th>Lunes</th>
          <th>Martes</th>
          <th>Miércoles</th>
          <th>Jueves</th>
          <th>Viernes</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $horas = [];

          // Agrupar por bloque horario (hora_inicio - hora_fin)
          foreach ($horario as $fila) {
            $horaClave = esc($fila['hora_inicio']) . ' - ' . esc($fila['hora_fin']);
            if (!isset($horas[$horaClave])) {
              $horas[$horaClave] = [
                'Lunes' => '', 'Martes' => '', 'Miércoles' => '', 'Jueves' => '', 'Viernes' => ''
              ];
            }

            $contenido = esc($fila['asignatura']) . '<br><small>' . esc($fila['aula']) . '</small>';
            // Si ya hay contenido en esa celda, lo concatenamos (varios eventos en la misma hora/día)
            if (!empty($horas[$horaClave][$fila['dia']])) {
              $horas[$horaClave][$fila['dia']] .= '<hr>' . $contenido;
            } else {
              $horas[$horaClave][$fila['dia']] = $contenido;
            }
          }

          // Renderizar tabla
          foreach ($horas as $hora => $dias) {
            echo "<tr><td><strong>$hora</strong></td>";
            foreach (['Lunes','Martes','Miércoles','Jueves','Viernes'] as $dia) {
              echo "<td>" . ($dias[$dia] ?? '') . "</td>";
            }
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>
  <?php else: ?>
    <p style="color: #666;">📂 Aún no se ha cargado programación para tu ficha.</p>
  <?php endif; ?>
</section>


        <section id="perfil" class="section">
    <h2><i class="fas fa-user-edit"></i> Perfil del Aprendiz</h2>

    <?php if (isset($aprendiz_completo) && $aprendiz_completo): ?>
        <div class="card" style="text-align: left; max-width: 600px; margin: 0 auto;">
            <h3 style="color:#006B2D"><i class="fas fa-id-badge"></i> Información Personal</h3>
            <p><strong>Nombres:</strong> <?= esc($usuario['nombres']) ?></p>
<p><strong>Apellidos:</strong> <?= esc($usuario['apellidos']) ?></p>
            <p><strong>Correo:</strong> <?= esc(session()->get('correo')) ?></p>
            <p><strong>Número de Documento:</strong> <?= esc(session()->get('no_documento')) ?></p>
            <p><strong>Ficha de Formación:</strong> <?= esc($aprendiz['ficha_formacion'] ?? 'No registrada') ?></p>
<p><strong>Programa de Formación:</strong> <?= esc($aprendiz['programa_formacion'] ?? 'No registrado') ?></p>

        </div>
        <p style="color: #006B2D;">✅ Has completado tu perfil de aprendiz.</p>
    <?php else: ?>
        <p style="color: #ADFF2F;">⚠️ Aún no has completado tu perfil de aprendiz.</p>
        <a href="<?= base_url('/aprendiz/formulario') ?>">
            <button><i class="fas fa-user-plus"></i> Completar Información del Aprendiz</button>
        </a>
    <?php endif; ?>
</section>



        <section id="equipos" class="section">
    <h2><i class="fas fa-laptop"></i> Registro de Equipos</h2>

    <!-- ✅ Mensajes Flash -->
    <?php if(session()->getFlashdata('success')): ?>
      <div style="background: #d4edda; padding: 10px; margin-bottom: 1rem; border-left: 5px solid #28a745; color: #155724;">
        <?= session()->getFlashdata('success') ?>
      </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('error')): ?>
      <div style="background: #f8d7da; padding: 10px; margin-bottom: 1rem; border-left: 5px solid #dc3545; color: #721c24;">
        <?= session()->getFlashdata('error') ?>
      </div>
    <?php endif; ?>

    <!-- Botón para ir a la vista de registro -->
    <a href="<?= base_url('/equipos') ?>">
        <button type="button"><i class="fas fa-plus-circle"></i> Registrar Nuevo Equipo</button>
    </a>

    <h2><i class="fas fa-table"></i> Lista de Equipos Registrados</h2>
    <table id="tablaEquipos">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Marca/Modelo</th>
                <th>Serie</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aquí se cargan los equipos por JS -->
        </tbody>
    </table>
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
    function showSection(id) {
    document.querySelectorAll('.section').forEach(s => s.style.display = 'none');
    document.getElementById(id).style.display = 'block';
  }
  document.addEventListener('DOMContentLoaded', function () {
    showSection('horario');
  });
    function showSection(sectionId) {
        document.querySelectorAll('.section').forEach(section => {
            section.style.display = 'none';
        });
        document.getElementById(sectionId).style.display = 'block';

        // ✅ Cargar equipos si se entra a la sección "equipos"
        if (sectionId === 'equipos') {
            cargarEquipos();
        }
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

    function cargarEquipos() {
    fetch("<?= base_url('/equipos/listar') ?>")
        .then(res => res.json())
        .then(data => {
            const tbody = document.querySelector("#tablaEquipos tbody");
            tbody.innerHTML = "";

            data.forEach(equipo => {
                const fila = `
                    <tr>
                        <td>${equipo.tipo_equipo}</td>
                        <td>${equipo.marca_modelo}</td>
                        <td>${equipo.numero_serie}</td>
                        <td>${equipo.estado == 1 ? 'Activo' : 'Inactivo'}</td>
                        <td>
                            <button class="btn-delete" onclick="eliminarEquipo(${equipo.id_equipo})">Eliminar</button>
                        </td>
                    </tr>
                `;
                tbody.innerHTML += fila;
            });
        });
}
    function eliminarEquipo(id) {
    Swal.fire({
        title: '¿Eliminar equipo?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`<?= base_url('/equipos/eliminar/') ?>${id}`, {
                method: 'DELETE'
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire(
                        '¡Eliminado!',
                        'El equipo ha sido eliminado.',
                        'success'
                    );
                    cargarEquipos(); // Recarga la tabla
                } else {
                    Swal.fire(
                        'Error',
                        'No se pudo eliminar el equipo.',
                        'error'
                    );
                }
            })
            .catch(error => {
                console.error(error);
                Swal.fire('Error', 'Hubo un problema en el servidor.', 'error');
            });
        }
    });
}


</script>
</body>
</html>