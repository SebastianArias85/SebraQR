<?php
// Incluir el archivo de conexión
include '../db/db.php';

$id = $_POST['id'];
$dependencia = $_POST['dependencia'];
$ip = $_POST['ip'];
$mac = $_POST['mac'];
$procesador = $_POST['procesador'];
$memoria = $_POST['memoria'];
$disco = $_POST['disco'];
$marca = $_POST['marca'];
$mother = $_POST['mother'];
$so = $_POST['so'];
$observaciones = $_POST['observaciones'];

// Verificar si el id ya existe
$idCheckSql = "SELECT id FROM cpus WHERE id = ?";
$idCheckStmt = $conn->prepare($idCheckSql);
$idCheckStmt->bind_param("s", $id);
$idCheckStmt->execute();
$idCheckStmt->store_result();

if ($idCheckStmt->num_rows > 0) {
    echo "Error: El ID '$id' ya existe.";
    $idCheckStmt->close();
    $conn->close();
    exit();
}
$idCheckStmt->close();

$sql = "INSERT INTO cpus (id, dependencia, ip, mac, procesador, memoria, disco, marca, mother, so, observaciones) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssss", $id, $dependencia, $ip, $mac, $procesador, $memoria, $disco, $marca, $mother, $so, $observaciones);

if ($stmt->execute()) {
    header("Location: ../vistas/index.php");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
