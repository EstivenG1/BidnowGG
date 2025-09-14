<?php
include("../php/conexion.php");

// Forzar zona horaria a Colombia
date_default_timezone_set('America/Bogota');

// Verificar que el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Debes iniciar sesión para poder ver las subastas activas'); window.location.href = '../php/iniciar_sesion.php';</script>";
    exit();
}

// Actualizar subastas vencidas a "finalizada"
$ahora = date("Y-m-d H:i:s");
$sql_update = "UPDATE productos 
               SET estado = 'finalizada' 
               WHERE fecha_fin IS NOT NULL 
               AND fecha_fin <> '0000-00-00 00:00:00'
               AND fecha_fin <= ? 
               AND estado = 'activa'";
$stmt = $conex->prepare($sql_update);
$stmt->bind_param("s", $ahora);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subastas Activas</title>
    <link rel="stylesheet" href="../css/subastas_activas.css">
</head>
<body>
    <h2 class="titulo-principal">Subastas activas</h2>
    
    <div class="cont-producto"> <!-- AQUÍ va el grid -->
        <?php
        $sql = "SELECT producto_id, nombre, precio_actual, imagen 
                FROM productos 
                WHERE estado = 'activa'";
        $result = $conex->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) { ?>
                <div class="producto">
                    <img src="../uploads/<?php echo htmlspecialchars($row['imagen']); ?>" 
                         alt="<?php echo htmlspecialchars($row['nombre']); ?>" 
                         class="producto-imagen">
                    <div class="producto-detalles">
                        <h4><?php echo htmlspecialchars($row['nombre']); ?></h4>
                        <p>Precio actual: $<?php echo number_format($row['precio_actual'], 2, ',', '.'); ?></p>
                        <a href="detalles_subasta.php?id=<?php echo $row['producto_id']; ?>">Ver detalles</a>
                    </div>
                </div>
        <?php }
        } else {
            echo '<p class="sin-subastas">No hay subastas activas en este momento.</p>';
        }
        ?>
    </div>

</body>
</html>

<?php $conex->close(); ?>
