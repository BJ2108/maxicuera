<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si se ha enviado una solicitud POST para guardar los usuarios
    if (isset($_POST['guardar'])) {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $nombre_apellido = $_POST['nombre_apellido'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $_POST['role'];

        // Actualiza los datos del usuario en la base de datos
        if (empty($id)) {
            $sql = "INSERT INTO users (username, nombre_apellido, password, role) VALUES ('$username', '$nombre_apellido', '$password', '$role')";
        } else {
            $sql = "UPDATE users SET username='$username', nombre_apellido='$nombre_apellido', password='$password', role='$role' WHERE id=$id";
        }

        if ($conn->query($sql) === TRUE) {
            //echo "Usuario guardado exitosamente.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Elimina el usuario que elijas de la base de datos
    if (isset($_POST['eliminar'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM users WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            //echo "Usuario eliminado exitosamente.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>
