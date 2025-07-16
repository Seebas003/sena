<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Aprendiz</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4fdf4;
            padding: 40px;
        }

        h2 {
            color: #006B2D;
            margin-bottom: 20px;
            text-align: center;
        }

        form {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }

        label {
            font-weight: 600;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px 0;
            border: 1px solid #98FB98;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        input[readonly] {
            background-color: #e0e0e0;
        }

        button {
            background-color: #006B2D;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #039e4d;
        }
    </style>
</head>
<body>

<h2><i class="fas fa-user-graduate"></i> Datos del Aprendiz</h2>

<form action="<?= base_url('/aprendiz/guardar') ?>" method="post">
    <!-- Nombres y Apellidos -->
    <label>Nombres:</label>
    <input type="text" name="nombres" value="<?= esc($usuario['nombres']) ?>" required>

    <label>Apellidos:</label>
    <input type="text" name="apellidos" value="<?= esc($usuario['apellidos']) ?>" required>

    <!-- Documento y correo (readonly) -->
    <label>Número de Documento:</label>
    <input type="text" value="<?= esc($usuario['no_documento']) ?>" readonly>

    <label>Correo Electrónico:</label>
    <input type="email" value="<?= esc($usuario['correo']) ?>" readonly>

    <!-- Número de teléfono deshabilitado -->
    <label>Número de Teléfono:</label>
    <input type="text" name="telefono" placeholder="(opcional)" disabled>

    <!-- Datos del aprendiz -->
    <label>Ficha de Formación:</label>
    <input type="text" name="ficha_formacion" required value="<?= esc($aprendiz['ficha_formacion'] ?? '') ?>">

    <label for="programa_formacion">Programa de Formación:</label>
    <select name="programa_formacion" id="programa_formacion" required>
        <option value="">-- Selecciona un programa --</option>
        <?php
            $programas = [
                "Análisis y Desarrollo de Software",
                "Gestión de Redes de Datos",
                "Gestión Administrativa",
                "Contabilidad y Finanzas",
                "Diseño e Integración de Multimedia",
                "Mecatrónica",
                "Seguridad y Salud en el Trabajo"
            ];

            foreach ($programas as $programa):
                $selected = (isset($aprendiz['programa_formacion']) && $aprendiz['programa_formacion'] === $programa) ? 'selected' : '';
        ?>
            <option value="<?= esc($programa) ?>" <?= $selected ?>><?= esc($programa) ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit"><i class="fas fa-save"></i> Guardar Datos</button>
</form>

<!-- Mensajes Flash -->
<?php if(session()->getFlashdata('success')): ?>
  <script>
    Swal.fire('¡Éxito!', '<?= session()->getFlashdata('success') ?>', 'success');
  </script>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
  <script>
    Swal.fire('Error', '<?= session()->getFlashdata('error') ?>', 'error');
  </script>
<?php endif; ?>

</body>
</html>
