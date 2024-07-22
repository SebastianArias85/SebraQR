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
    <title>Cargar Nuevo Equipo</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

    <!--BARRA DE NAVEGACION-->
    <?php
    include '../navbar.php';
    ?>
    <!--BARRA DE NAVEGACION-->
  

    <!--CARGADOR DE PC-->
    <div class="container mt-4 mb-4">
        <div class="card eqcard mx-auto">
            <h2 class="card-header text-center">Cargar Nuevo Equipo</h2>
            <form class="formpc" method="post" action="../controlador/guardar_nuevo.php">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="id">ID*</label>
                        <input type="text" class="form-control" id="id" name="id" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="dependencia">Dependencia</label>
                        <input type="text" class="form-control" id="dependencia" name="dependencia" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="ip">IP</label>
                        <input type="text" class="form-control" id="ip" name="ip" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="mac">MAC</label>
                        <input type="text" class="form-control" id="mac" name="mac" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="procesador">Procesador</label>
                        <input type="text" class="form-control" id="procesador" name="procesador" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="memoria">Memoria</label>
                        <input type="text" class="form-control" id="memoria" name="memoria" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="disco">Disco</label>
                        <input type="text" class="form-control" id="disco" name="disco" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="marca">Marca</label>
                        <input type="text" class="form-control" id="marca" name="marca" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="mother">Mother</label>
                        <input type="text" class="form-control" id="mother" name="mother" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="so">S.O.</label>
                        <input type="text" class="form-control" id="so" name="so" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="observaciones">Observaciones</label>
                        <textarea id="observaciones" name="observaciones" class="form-control" required></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mb-2">Guardar</button>
                <a href="index.php" class="btn btn-secondary mb-2">Volver</a>
            </form>
        </div>
    </div>
    <!--CARGADOR DE PC-->

    <!--BARRA DE NAVEGACION-->
    <?php
    include '../footer.php';
    ?>
    <!--BARRA DE NAVEGACION-->

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

</body>

</html>