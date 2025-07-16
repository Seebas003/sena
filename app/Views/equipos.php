<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Equipo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #eef6f0;
            padding: 40px;
            color: #333;
        }

        h2 {
            color: #006B2D;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        label {
            font-weight: 600;
            margin-top: 15px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #98FB98;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #006B2D;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #039e4d;
        }
    </style>
</head>
<body>

<h2><i class="fas fa-laptop"></i> Registrar Nuevo Equipo</h2>

<form id="equipoForm" action="<?= base_url('/registrar') ?>" method="POST">
    <label>Tipo de Equipo:</label>
    <select name="tipo_equipo" required>
        <option value="Portátil">Portátil</option>
        <option value="Tablet">Tablet</option>
        <option value="Celular">Celular</option>
    </select>

    <label>Marca/Modelo:</label>
    <input type="text" name="marca_modelo" required>

    <label>Número de Serie:</label>
    <input type="text" name="numero_serie" required>

    <button type="submit"><i class="fas fa-plus-circle"></i> Registrar Equipo</button>
</form>
<script>
document.getElementById("equipoForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const form = this;
    const formData = new FormData(form);

    fetch("<?= base_url('/registrar') ?>", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: '¡Registrado!',
                text: data.message,
                confirmButtonText: 'Ir al Dashboard'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = data.redirect;
                }
            });
        } else {
            Swal.fire('Error', data.message, 'error');
        }
    })
    .catch(() => {
        Swal.fire('Error', 'No se pudo procesar la solicitud.', 'error');
    });
});
</script>

</body>
</html>
