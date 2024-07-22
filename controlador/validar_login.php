<?php
// Incluir archivo de conexión a la base de datos
include '../db/dbUser.php';

// Verificar si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener usuario y contraseña del formulario
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Consulta para verificar las credenciales
    $sql = "SELECT * FROM usuarios WHERE usuario = ? AND contrasena = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $contrasena);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró un usuario con las credenciales proporcionadas
    if ($result->num_rows == 1) {
        // Iniciar sesión y redirigir a la página de bienvenida
        session_start();
        $_SESSION['usuario'] = $usuario;
        header("Location: ../vistas/index.php");
    } else {
        // Credenciales incorrectas, redirigir al formulario de inicio de sesión
        header("Location: login.php");
    }
} else {
    // Redirigir si se accede directamente a este script sin datos POST
    header("Location: login.php");
}

$stmt->close();
$conn->close();
?>
