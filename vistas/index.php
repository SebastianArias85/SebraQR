<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sebasoft Z-DS22</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <!--BARRA DE NAVEGACION-->
    <?php
    include '../navbar.php';
    ?>
    <!--BARRA DE NAVEGACION-->

    <!--AGREGAR EQUIPO
    <div class="text-center mt-4 mb-4">
        <a href="cargar.php" class="btn btn-success">Cargar Nuevo Equipo</a>
    </div>
    AGREGAR EQUIPO-->

    <!--BUSCADOR QR-->
    <div class="container mt-5">
        <div class="card eqcard mx-auto">
            <h2 class="card-header text-center">Consulta de Equipos</h2>
            <div class="card-body">
                <form id="scannerForm" method="post" action="buscar.php" class="mt-4">
                    <h5 class="card-title text-center">Escanea el Código QR:</h5>
                    <input type="text" id="codigo" name="codigo" class="form-control codqr mb-3 mx-auto" autofocus
                        required>
                    <button type="submit" class="btn btn-primary btn-search">Buscar</button>
                </form>
            </div>
        </div>
    </div>
    <!--BUSCADOR QR-->

    <!--AGREGAR EQUIPO-->
    <div class="text-center mt-4 mb-4">
        <a href="cargar.php" class="btn btn-success addpc"><img class="search" src="../assets/img/addMachin.png"
                alt="addPC" /></a>
    </div>
    <!--AGREGAR EQUIPO-->

    <!--FOOTER-->
    <?php
    include '../footer.php';
    ?>
    <!--FOOTER-->

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>

</body>

</html>