<?php
session_start();
include '../conexion.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $ci = $_POST['ci'];
    $rol = $_POST['rol'];


    $stmt = $conexion->prepare("INSERT INTO Persona (nombre, apellidos, ci, rol) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $apellidos, $ci, $rol);
    
    if ($stmt->execute()) {
        header("Location: funcionario.php?mensaje=Cuenta agregada exitosamente");
    } else {
        header("Location: funcionario.php?mensaje=Error al agregar cuenta");
    }
    
    $stmt->close();
}


$conexion->close();
?>
