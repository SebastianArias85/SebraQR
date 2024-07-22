<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$usuario = $_SESSION['usuario'];
?>

<?php
// Incluir el archivo de conexión
include '../db/db.php';

$id = $_GET['id'];

$sql = "SELECT * FROM cpus WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

$data = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Datos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    
    <!--CARGADOR DE PC-->
    <div class="container mt-4 pb-5">
        <h1 class="text-center">Modificar Datos del Equipo</h1>
        <div class="card eqcard mx-auto">
            <h2 class="card-header text-center">Equipo: <?php echo $data['id']; ?></h2>

            <form class="formpc m-3" method="post" action="../controlador/guardar.php">
                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="dependencia">DEPENDENCIA</label>
                        <input type="text" id="dependencia" name="dependencia" class="form-control"
                            value="<?php echo $data['dependencia']; ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ip">IP</label>
                        <input type="text" id="ip" name="ip" class="form-control" value="<?php echo $data['ip']; ?>"
                            required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="mac">MAC</label>
                        <input type="text" id="mac" name="mac" class="form-control" value="<?php echo $data['mac']; ?>"
                            required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="procesador">PROCESADOR</label>
                        <input type="text" id="procesador" name="procesador" class="form-control"
                            value="<?php echo $data['procesador']; ?>" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="memoria">MEMORIA</label>
                        <input type="text" id="memoria" name="memoria" class="form-control"
                            value="<?php echo $data['memoria']; ?>" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="disco">DISCO</label>
                        <input type="text" id="disco" name="disco" class="form-control"
                            value="<?php echo $data['disco']; ?>" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="marca">MARCA</label>
                        <input type="text" id="marca" name="marca" class="form-control"
                            value="<?php echo $data['marca']; ?>" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="mother">MOTHER</label>
                        <input type="text" id="mother" name="mother" class="form-control"
                            value="<?php echo $data['mother']; ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="so">S.O.</label>
                        <input type="text" id="so" name="so" class="form-control" value="<?php echo $data['so']; ?>"
                            required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="observaciones">OBSERVACIONES</label>
                        <textarea id="observaciones" name="observaciones" class="form-control"
                            required><?php echo $data['observaciones']; ?></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Modificar</button>
                <a href="buscar.php?codigo=<?php echo $data['id']; ?>" class="btn btn-secondary">Volver</a>
            </form>
        </div>
    </div>
    <!--CARGADOR DE PC-->

</body>

</html>