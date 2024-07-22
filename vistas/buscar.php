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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sebasoft Z-DS22</title>
</head>

<body>

    <!--BUSQUEDA-->
    <?php
// Incluir el archivo de conexión
include '../db/db.php';

// Obtener el código del QR, sea por POST o GET
if (isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];
} elseif (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];
} else {
    die("Código QR no proporcionado.");
}

// Consulta para obtener los datos del equipo
$sql = "SELECT * FROM cpus WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $codigo);  // Si el ID es alfanumérico, ajusta el tipo de dato aquí
$stmt->execute();
$result = $stmt->get_result();

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Obtener los datos del equipo
    $row = $result->fetch_assoc();
    $nombre_equipo = $row['id'];  // Ajusta según la columna correcta que contiene el nombre del equipo
    $id_equipo = $row['id'];

    ?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Equipo: <?php echo $nombre_equipo; ?> (ID: <?php echo $id_equipo; ?>) - Resultados del Escaneo</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <link rel="stylesheet" href="../assets/css/style.css">
    </head>

    <!--CARGADOR DE PC GRANDE-->
    <body>
        <div class="container mt-5 tablaDatosGrande">
            <h1 class="text-center">Equipo: <?php echo $nombre_equipo; ?> </h1>
            <table class='table table-striped mt-4'>
                <thead class='thead-dark'>
                    <tr>
                        <th>Dependencia</th>
                        <th>IP</th>
                        <th>MAC</th>
                        <th>Procesador</th>
                        <th>Memoria</th>
                        <th>Disco</th>
                        <th>Marca</th>
                        <th>Mother</th>
                        <th>SO</th>
                        <th>Observaciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $row["dependencia"]; ?></td>
                        <td><?php echo $row["ip"]; ?></td>
                        <td><?php echo $row["mac"]; ?></td>
                        <td><?php echo $row["procesador"]; ?></td>
                        <td><?php echo $row["memoria"]; ?></td>
                        <td><?php echo $row["disco"]; ?></td>
                        <td><?php echo $row["marca"]; ?></td>
                        <td><?php echo $row["mother"]; ?></td>
                        <td><?php echo $row["so"]; ?></td>
                        <td><?php echo $row["observaciones"]; ?></td>
                        <td><a href='modificar.php?id=<?php echo $row["id"]; ?>' class='btn btn-warning'>Modificar</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center mt-4">
                <a href="index.php" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </body>    
    <!--CARGADOR DE PC GRANDE-->


    <!--CARGADOR DE PC CHICO-->
    <div class="container mt-4 mb-4 tablaDatosChico">
        <h3 class="text-center">DATOS DEL COMPUTADOR</h3>
        <div class="card eqcard mx-auto">
            <h2 class="card-header text-center">ID: <?php echo $row["id"]; ?></h2>
            <form class="formpc" method="post" action="guardar_nuevo.php">
                <div class="form-row mt-3">
                    <div class="form-group col-md-6">
                        <label class="formCh" for="dependencia">Dependencia:</label>
                        <label for="dependencia"><?php echo $row["dependencia"]; ?></label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="formCh" for="ip">IP:</label>
                        <label for="ip"><?php echo $row["ip"]; ?></label>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="formCh" for="mac">MAC:</label>
                        <label for="mac"><?php echo $row["mac"]; ?></label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="formCh" for="procesador">Procesador:</label>
                        <label for="procesador"><?php echo $row["procesador"]; ?></label>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="formCh" for="memoria">Memoria:</label>
                        <label for="memoria"><?php echo $row["memoria"]; ?></label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="formCh" for="disco">Disco:</label>
                        <label for="disco"><?php echo $row["disco"]; ?></label>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="formCh" for="marca">Marca:</label>
                        <label for="marca"><?php echo $row["marca"]; ?></label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="formCh" for="mother">Mother:</label>
                        <label for="mother"><?php echo $row["mother"]; ?></label>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="formCh" for="so">S.O.:</label>
                        <label for="so"><?php echo $row["so"]; ?></label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label class="formCh" for="observaciones">Observaciones:</label>
                        <label for="observaciones"><?php echo $row["observaciones"]; ?></label>
                    </div>
                </div>
                <a href='modificar.php?id=<?php echo $row["id"]; ?>' class='btn btn-warning mb-3'>Modificar</a>
            </form>            
        </div>
        <div class="text-center mt-4">
                <a href="index.php" class="btn btn-secondary">Volver</a>
            </div>
    </div>

    <?php
} else {
    echo "<div class='container mt-5'><div class='alert alert-warning'>No se encontraron resultados.</div></div>";
}

$stmt->close();
$conn->close();
?>
    <!--CARGADOR DE PC PC CHICO-->

</body>

</html>