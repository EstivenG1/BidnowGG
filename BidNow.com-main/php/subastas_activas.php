<?php


// Verificar que el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Debes iniciar sesión para poder ver las subastas activas'); window.location.href = '../php/iniciar_sesion.php';</script>";
    exit();
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/subastas_activas.css">
</head>
<body>
    <?php
    include("../php/conexion.php");
    ?>
    <h2 class="titulo-principal">Subastas activas</h2>
    
    <div class="container-productos">
        <?php
        $sql = "SELECT producto_id, nombre, precio_actual, imagen FROM productos WHERE estado = 'activa'";
        $result = $conex->query($sql);
        ?>
        
        <div class="cont-producto">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    ?>
                    <div class="producto">
                        <img src="../uploads/<?php echo htmlspecialchars($row['imagen']); ?>" alt="<?php echo htmlspecialchars($row['nombre']); ?>" class="producto-imagen">
                        <div class="producto-detalles">
                            <h4 class="titulo-producto"><?php echo htmlspecialchars($row['nombre']); ?></h4>
                            <p class="precio-actual">Precio actual: $<?php echo number_format($row['precio_actual'], 2); ?></p>
                            <a href="detalles_subasta.php?id=<?php echo $row['producto_id']; ?>" class="btn-ver-detalles">Ver detalles</a>
                        </div>
                        
                    </div>
                    <?php
                }
            } else {
                echo '<p class="sin-subastas">No hay subastas activas en este momento.</p>';
            }
            ?>
        </div>
    </div>
    
    <?php
    $conex->close();
    ?>

</body>
</html>