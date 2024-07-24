<?php
// download_excel.php
require '../db/db.php';

// Definir el nombre del archivo y el tipo de contenido
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="cpus.xls"');

// Iniciar el buffer de salida
ob_start();

// Crear el contenido HTML de la tabla
echo '<table border="1">';
echo '<tr>';
echo '<th>ID</th>';
echo '<th>Dependencia</th>';
echo '<th>IP</th>';
echo '<th>MAC</th>';
echo '<th>Procesador</th>';
echo '<th>Memoria</th>';
echo '<th>Disco</th>';
echo '<th>Marca</th>';
echo '<th>Mother</th>';
echo '<th>S.O.</th>';
echo '<th>Observaciones</th>';
echo '</tr>';

// Obtener datos de la tabla cpus
$sql = "SELECT id, dependencia, ip, mac, procesador, memoria, disco, marca, mother, so, observaciones FROM cpus";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['dependencia'] . '</td>';
        echo '<td>' . $row['ip'] . '</td>';
        echo '<td>' . $row['mac'] . '</td>';
        echo '<td>' . $row['procesador'] . '</td>';
        echo '<td>' . $row['memoria'] . '</td>';
        echo '<td>' . $row['disco'] . '</td>';
        echo '<td>' . $row['marca'] . '</td>';
        echo '<td>' . $row['mother'] . '</td>';
        echo '<td>' . $row['so'] . '</td>';
        echo '<td>' . $row['observaciones'] . '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="3">No hay resultados</td></tr>';
}

echo '</table>';

$conn->close();

// Obtener el contenido del buffer y limpiar el buffer
$content = ob_get_clean();

// Escribir el contenido al archivo
echo $content;

exit();
?>
