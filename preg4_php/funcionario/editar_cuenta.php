<?php
session_start();
include '../conexion.php'; 

if (!isset($_GET['id'])) {
    header("Location: funcionario.php");
    exit();
}

$id = $_GET['id'];

$stmt = $conexion->prepare("SELECT * FROM Persona WHERE cod_persona = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$persona = $resultado->fetch_assoc();

if (!$persona) {
    header("Location: funcionario.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $ci = $_POST['ci'];
    $rol = $_POST['rol'];

    $stmt = $conexion->prepare("UPDATE Persona SET nombre = ?, apellidos = ?, ci = ?, rol = ? WHERE cod_persona = ?");
    $stmt->bind_param("ssssi", $nombre, $apellidos, $ci, $rol, $id);
    
    if ($stmt->execute()) {
        header("Location: funcionario.php?mensaje=Cuenta editada exitosamente");
    } else {
        header("Location: funcionario.php?mensaje=Error al editar cuenta");
    }
    
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Editar Cuenta</title>
    <style>
        body {
            background-color: #f8f9fa; /* Color de fondo */
        }
        .edit-container {
            max-width: 600px; /* Ancho máximo del formulario */
            margin: 100px auto; /* Centrar verticalmente y horizontalmente */
            padding: 20px;
            background-color: white; /* Fondo blanco para el formulario */
            border-radius: 8px; /* Bordes redondeados */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra para efecto de elevación */
        }
    </style>
</head>
<body>
    <div class="edit-container">
        <h2 class="text-center">Editar Cuenta</h2>
        <form method="post">
            <div class="mb-3">
                <label for="ci" class="form-label">Carnet de Identidad:</label>
                <input readonly type="text" class="form-control" id="ci" name="ci" value="<?php echo htmlspecialchars($persona['ci']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($persona['nombre']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos:</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo htmlspecialchars($persona['apellidos']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol:</label>
                <input type="text" class="form-control" id="rol" name="rol" value="<?php echo htmlspecialchars($persona['rol']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Cuenta</button>
        </form>
        <br>
        <a href="funcionario.php" class="btn btn-secondary">Volver al listado</a>
    </div>
</body>
</html>

<?php
$conexion->close();
?>
