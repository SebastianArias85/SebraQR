<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sebasoft Z-DS22</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body style="background-color:#f8f9fa;">
    <!--#181742-->

    <div class="grande">
        <div class="row">
            
            <div class="col-6">
                <img class="escudo" src="assets/img/SISPE.png" alt="ESCUDO" style="width:90%">
            </div>

            <div class="col-6">
                <div class="container mt-5" style="width:70%">
                    <h2 class="text-center">Iniciar Sesión</h2>
                    <form action="controlador/validar_login.php" method="POST" class="mt-4">
                        <div class="form-group">
                            <label for="usuario">Usuario:</label>
                            <input type="text" id="usuario" name="usuario" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="contrasena">Contraseña:</label>
                            <input type="password" id="contrasena" name="contrasena" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">INGRESAR</button>
                    </form>
                </div>
            </div>
            
        </div>
    </div>

    <div class="chico">
        <div class="row">
            <div class="col-12">
                <img class="escudo mx-auto" src="img/SISPE.png" alt="ESCUDO" style="width:80%">
            </div>
        </div>

        <h5 class="text-center mt-4">QR LECTOR</h5>

        <div class="row">
            <div class="col-12">
                <div class="container mt-5" style="width:70%">
                    <h2 class="text-center">Iniciar Sesión</h2>
                    <form action="controlador/validar_login.php" method="POST" class="mt-4">
                        <div class="form-group">
                            <label for="usuario">Usuario:</label>
                            <input type="text" id="usuario" name="usuario" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="contrasena">Contraseña:</label>
                            <input type="password" id="contrasena" name="contrasena" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">INGRESAR</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>