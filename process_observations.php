<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
include 'db.php';
session_start();

// Obtener el usuario actual
$user_id = $_SESSION['user_id'];

// Consultar el rol del usuario actual
$role_result = $conn->query("SELECT role FROM users WHERE id = $user_id");
$role = $role_result->fetch_assoc()['role'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'add') {
        // Obtener los datos del formulario
        $product_id = $_POST['product_id'];
        $observacion = $_POST['observacion'];
        $fecha_hora = date('Y-m-d H:i:s');

        // Insertar la nueva observación
        $sql = "INSERT INTO observations (product_id, user_id, observacion, fecha_hora) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiss", $product_id, $user_id, $observacion, $fecha_hora);
        $stmt->execute();

        header("Location: observation.php");
        exit();
    
    } elseif ($action == 'delete') {
        // Verifica que el usuario tenga el rol de administrador para eliminar observaciones
        if ($role == 'admin') {
            $observacion_id = $_POST['observacion_id'];

            $sql = "DELETE FROM observations WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $observacion_id);
            $stmt->execute();

            // Verifica si la tabla quedó vacia
            $result = $conn->query("SELECT COUNT(*) AS total FROM observations");
            $row = $result->fetch_assoc();

            if ($row['total'] == 0) {
                $conn->query("ALTER TABLE observations AUTO_INCREMENT = 1");
            }

            header("Location: observation.php");
            exit();
        } else {
            echo "No tienes permiso para eliminar observaciones.";
        }
    }
} else {
    echo "Acción no válida.";
}
?>
