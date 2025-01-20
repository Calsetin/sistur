<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Cambio de Turno</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="assets/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/stylesolicambioi.css"> <!-- Enlace al archivo CSS personalizado -->
</head>
<body>
    <div class="container">
        <div class="logo-con-titulo">
            <img src="http://localhost/sistur/logo/logo.png" alt="Logotipo" class="imagen-personalizada">
            <h1>Solicitud de Cambio de Turno</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">       
                 <!-- Mensaje de éxito/error -->
                 <?php
                 // Verificar si se ha enviado el formulario y mostrar el mensaje correspondiente
                 if (isset($_GET['status'])) {
                    if ($_GET['status'] === 'success') {
                        echo '<div class="alert alert-success show fade-out" role="alert">Solicitud enviada correctamente.</div>';
                    } elseif ($_GET['status'] === 'error') {
                        echo '<div class="alert alert-danger show fade-out" role="alert">Hubo un error al enviar la solicitud. Inténtelo de nuevo.</div>';
                    }
                }
                ?>
                <!-- Formulario de solicitud -->
                <form id="solicitudForm" action="procesar_solicitud.php" method="post">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="apellido">Apellido:</label>
                        <input type="text" id="apellido" name="apellido" class="form-control form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="correo">Correo Electronico:</label>
                        <input type="text" id="correo" name="correo" class="form-control form-input" required>
                    </div>

                    <div class="form-group">
                        <label for="motivo">Motivo del cambio:</label>
                        <textarea id="motivo" name="motivo" class="form-control form-input" rows="4" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Enviar Solicitud</button>
                    <a href="http://localhost/sistur/solicitudes/solicitudes.php" class="btn btn-secondary">Volver</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>



