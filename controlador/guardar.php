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

$sql = "UPDATE cpus SET dependencia = ?, ip = ?, mac = ?, procesador = ?, memoria = ?, disco = ?, marca = ?, mother = ?, so = ?, observaciones = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssi", $dependencia, $ip, $mac, $procesador, $memoria, $disco, $marca, $mother, $so, $observaciones, $id);

if ($stmt->execute()) {
    header("Location: ../vistas/buscar.php?codigo=$id");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
