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
    
    <link rel="stylesheet" href="../assets/css/btnSearch.css">
    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

    <!--BARRA DE NAVEGACION-->
    <?php include '../navbar.php'; ?>
    <!--BARRA DE NAVEGACION-->

    <!--BUSCADOR-->
    <div class="container mt-5">
        <form method="GET" action="">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="search" placeholder="Buscar..." aria-label="Buscar"
                    aria-describedby="button-addon2"
                    value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Buscar</button>
                </div>
            </div>
        </form>
    </div>

    <!--TABLA DE DATOS-->
    <?php
    include '../phpqrcode/qrlib.php';
    include '../db/db.php';

    // Crear el directorio temporal para los códigos QR si no existe
    $tempDir = 'temp/';
    if (!file_exists($tempDir)) {
        mkdir($tempDir);
    }

    // Configuración de paginación
    $results_per_page = 6; // Número de registros por página

    // Filtrar resultados por término de búsqueda si existe
    $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

    $search_sql = "";
    if (!empty($search)) {
        $search_sql = " WHERE id LIKE '%$search%' OR dependencia LIKE '%$search%' OR ip LIKE '%$search%'";
    }

    // Obtener el número total de registros
    $sql = "SELECT COUNT(id) AS total FROM cpus" . $search_sql;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $total_records = $row["total"];
    $total_pages = ceil($total_records / $results_per_page);

    // Determinar la página actual
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($current_page < 1) {
        $current_page = 1;
    } elseif ($current_page > $total_pages && $total_pages > 0) {
        $current_page = $total_pages;
    }

    // Calcular el OFFSET para la consulta SQL
    $offset = ($current_page - 1) * $results_per_page;

    // Obtener los registros de la tabla con límite y offset
    $sql = "SELECT id, dependencia, ip, mac, procesador, memoria, disco, marca, mother, so FROM cpus" . $search_sql . " LIMIT $results_per_page OFFSET $offset";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='container mt-5'>";
        echo "<table class='table table-bordered'>";
        echo "<thead class='thead-dark'>";
        echo "<tr><th>ID</th><th>Dependencia</th><th>IP</th><th>QR</th></tr>";
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
            echo "<button style='height:50px; width:50px;' class='btn btn-primary rounded-circle' data-toggle='modal' data-target='#modal{$id}'><img class='search' src='../assets/img/qr.png' alt='addPC' style='height:22px; width:22px;' /></button>";        
            echo "<button style='height:50px; width:50px;' class='btn btn-warning ml-2 rounded-circle' data-toggle='modal' data-target='#modalone{$id}'><img class='search' src='../assets/img/info.png' alt='addPC' style='height:22px; width:12px;' /></button>";
            echo "</td>";
            echo "</tr>";
            // FIN Mostrar los datos en la tabla

            // Código del modal
            // MODAL QR
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

            // MODAL INFO
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
                            La máquina {$id} depende del {$dependencia} <br> IP: {$ip} <br> MAC: {$mac} <br> Procesador: {$procesador} <br> Memoria RAM: {$memoria} <br> Disco: {$disco} <br> Marca: {$marca} <br> Mother: {$mother} <br> SO: {$so}
                        </div>
                        <div class='modal-footer'>                        
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>";
            // FIN Código del modal
        }

        echo "</tbody></table></div>";

        // Paginación
        echo "<nav aria-label='Page navigation example'>";
        echo "<ul class='pagination justify-content-center'>";
        
        if ($current_page > 1) {
            echo "<li class='page-item'><a class='page-link' href='?page=" . ($current_page - 1) . "&search=" . urlencode($search) . "'>Anterior</a></li>";
        } else {
            echo "<li class='page-item disabled'><a class='page-link' href='#'>Anterior</a></li>";
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $current_page) {
                echo "<li class='page-item active'><a class='page-link' href='#'>{$i}</a></li>";
            } else {
                echo "<li class='page-item'><a class='page-link' href='?page={$i}&search=" . urlencode($search) . "'>{$i}</a></li>";
            }
        }

        if ($current_page < $total_pages) {
            echo "<li class='page-item'><a class='page-link' href='?page=" . ($current_page + 1) . "&search=" . urlencode($search) . "'>Siguiente</a></li>";
        } else {
            echo "<li class='page-item disabled'><a class='page-link' href='#'>Siguiente</a></li>";
        }

        echo "</ul></nav>";

    } else {
        echo "<div class='container mt-5'><p>No se encontraron registros.</p></div>";
    }
    // FIN Paginación

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