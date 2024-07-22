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
    <title>QR</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

    <!--BARRA DE NAVEGACION-->
    <?php
    include '../navbar.php';
    ?>
    <!--BARRA DE NAVEGACION-->


    <!--TABLA DE DATOS-->
    <?php
include '../phpqrcode/qrlib.php';
include '../db/db.php';

// Crear el directorio temporal para los códigos QR si no existe
$tempDir = 'temp/';
if (!file_exists($tempDir)) {
    mkdir($tempDir);
}

// Obtener los registros de la tabla
$sql = "SELECT id, dependencia, ip, mac, procesador, memoria, disco, marca, mother, so FROM cpus";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='container mt-5'>";
    echo "<table class='table table-bordered'>";
    echo "<thead class='thead-dark'>";
    echo "<tr><th>ID</th><th>Dependencia</th><th>ip</th><th>QR</th></tr>";
    echo "</thead><tbody>";

    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $dependencia = $row['dependencia'];
        $ip = $row['ip'];
        $mac = $row['mac'];
        $procesador = $row['procesador'];
        $memoria = $row['memoria']; 
        $disco = $row['disco'];
        $marca = $row['marca'];
        $mother = $row['mother']; 
        $so = $row['so']; 


        // Nombre del archivo de código QR
        $fileName = 'qrcode_' . md5($id) . '.png';
        $filePath = $tempDir . $fileName;

        // Generar el código QR si no existe
        if (!file_exists($filePath)) {
            QRcode::png($id, $filePath);
        }

        // Mostrar los datos en la tabla
        echo "<tr>";
        echo "<td>{$id}</td>";
        echo "<td>{$dependencia}</td>";
        echo "<td>{$ip}</td>";        
        echo "<td>";
        echo "<button style='height:50px; width:50px;' class='btn btn-primary .table-chica rounded-circle' data-toggle='modal' data-target='#modal{$id}'><img class='search' src='../assets/img/qr.png' alt='addPC' style='height:22px; width:22px;' /></button>";        
        echo "<button style='height:50px; width:50px;' class='btn btn-warning ml-2 rounded-circle' data-toggle='modal' data-target='#modalone{$id}'><img class='search' src='../assets/img/info.png' alt='addPC' style='height:22px; width:12px;' /></button>";
        echo "</td>";
        echo "</tr>";

        // Código del modal
        echo "
        <div class='modal fade' id='modal{$id}' tabindex='-1' role='dialog' aria-labelledby='modalLabel{$id}' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='modalLabel{$id}'>Código QR de {$ip}</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body text-center'>
                        <img src='{$filePath}' alt='QR Code' class='img-fluid'>
                    </div>
                    <div class='modal-footer'>
                        <a href='{$filePath}' class='btn btn-primary' download='qrcode_{$id}.png'>Descargar</a>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                    </div>
                </div>
            </div>
        </div>";

        echo "
        <div class='modal fade' id='modalone{$id}' tabindex='-1' role='dialog' aria-labelledby='modalLabel{$id}' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='modalLabel{$id}'>Datos de {$ip}</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                    La maquina {$id} depende del {$dependencia} <br> IP: {$ip} <br> MAC {$mac} <br> Posee un procesador {$procesador} <br> Posee {$memoria} de memoria ram <br> Disco de {$disco} de marca {$marca} <br> Mother {$mother} y un sistema operativo {$so}.
                    </div>
                    <div class='modal-footer'>                        
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                    </div>
                </div>
            </div>
        </div>";
    }

    echo "</tbody></table></div>";
} else {
    echo "No se encontraron registros.";
}

$conn->close();
?>
<!--TABLA DE DATOS-->

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