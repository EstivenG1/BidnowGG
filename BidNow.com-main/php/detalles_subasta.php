<?php
include("../php/conexion.php");

// Inicia la sesión
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Debes iniciar sesión para poder ver los detalles de la subasta.'); window.location.href = '../php/iniciar_sesion.php';</script>";
    exit();
}



// Validar si el ID del producto está en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<p>Error: No se ha especificado un ID de producto.</p>";
    exit();
}

// Obtener el ID del producto de la URL y limpiarlo
$producto_id = intval($_GET['id']);

// Consulta para obtener los detalles del producto
$sql = "SELECT * FROM productos WHERE producto_id = ?";

// Usar consultas preparadas para mayor seguridad
$stmt = mysqli_prepare($conex, $sql);
mysqli_stmt_bind_param($stmt, "i", $producto_id); // "i" indica que el parámetro es un entero
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Verificar si se encontró el producto
if (mysqli_num_rows($result) > 0) {
    $producto = mysqli_fetch_assoc($result);
} else {
    echo "<p>Error: El producto no fue encontrado.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($producto['nombre']); ?> - Detalles</title>
    <link rel="stylesheet" href="../css/detalles_subasta.css"> </head>
<body>

    
    <div class="contenedor-detalles">
        <a href="../php/dashboard.php" class="back-link">volver</a>
        <h2 class="titulo-producto"><?php echo htmlspecialchars($producto['nombre']); ?></h2>
        <div class="imagen-principal-contenedor">
          <img src="../uploads/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" class="imagen-principal">
        </div>
        
        <div class="info-producto">
            <p class="descripcion-producto"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
            <p class="precio-actual">Precio Actual: <strong>$<?php echo number_format($producto['precio_actual'], 2); ?></strong></p>
            <p class="fecha-fin">Finaliza: <strong><?php echo htmlspecialchars($producto['fecha_fin']); ?></strong></p>
            
            <form action="procesar_puja.php" method="POST">
                <input type="hidden" name="producto_id" value="<?php echo htmlspecialchars($producto['producto_id']); ?>">
                <label for="monto_puja">Tu puja:</label>
                <input type="number" id="monto_puja" name="monto_puja" step="0.01" min="<?php echo $producto['precio_actual'] + 0.01; ?>" required>
                <button type="submit" name="pujar">Pujar</button>
            </form>
        </div>
    </div>

    <?php
    mysqli_close($conex);
    ?>
</body>
</html>