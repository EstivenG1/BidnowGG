<?php

include("../php/conexion.php");


// Verificar que el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Debes iniciar sesión para poder agregar una subasta.'); window.location.href = '../php/iniciar_sesion.php';</script>";
    exit();
}


$usuario_id = $_SESSION['user_id'];


// --- Mis Pujas ---
$sql_pujas = "SELECT 
                p.puja_id,
                pr.nombre AS producto_nombre,
                pr.descripcion AS producto_descripcion,
                p.monto AS monto_puja,
                p.fecha_puja,
                pr.precio_actual,
                pr.estado,
                pr.imagen
            FROM pujas p
            JOIN productos pr ON p.producto_id = pr.producto_id
            WHERE p.usuario_id = ?
            ORDER BY p.fecha_puja DESC";

$stmt = $conex->prepare($sql_pujas);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();

$pujas = [];
while($fila = $resultado->fetch_assoc()) {
    $pujas[] = $fila;
}
$stmt->close();

// --- Mis Productos ---
$sql_productos = "SELECT producto_id, nombre, descripcion, precio_inicial, precio_actual, fecha_inicio, fecha_fin, estado, imagen
                  FROM productos
                  WHERE usuario_id = ?
                  ORDER BY fecha_inicio DESC";

$stmt2 = $conex->prepare($sql_productos);
$stmt2->bind_param("i", $usuario_id);
$stmt2->execute();
$resultado2 = $stmt2->get_result();

$productos = [];
while($fila = $resultado2->fetch_assoc()) {
    $productos[] = $fila;
}
$stmt2->close();
$conex->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Cuenta</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { margin-top: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        img { max-width: 100px; }
    </style>
</head>
<body>

<h1>Mi Cuenta</h1>

<!-- Sección Mis Pujas -->
<h2>Mis Pujas</h2>
<table>
    <thead>
        <tr>
            <th>Producto</th>
            <th>Descripción</th>
            <th>Monto de la puja</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Imagen</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($pujas as $puja): ?>
        <?php 
            $img_puja = "../uploads/" . $puja['imagen'];
            if(!file_exists($img_puja)) { $img_puja = "../img/default.png"; }
        ?>
        <tr>
            <td><?php echo htmlspecialchars($puja['producto_nombre']); ?></td>
            <td><?php echo htmlspecialchars($puja['producto_descripcion']); ?></td>
            <td><?php echo number_format($puja['monto_puja'], 2); ?></td>
            <td><?php echo $puja['fecha_puja']; ?></td>
            <td><?php echo htmlspecialchars($puja['estado']); ?></td>
            <td><img src="<?php echo $img_puja; ?>" alt="Imagen del producto"></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Sección Mis Productos -->
<h2>Mis Productos</h2>
<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio Inicial</th>
            <th>Precio Actual</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Estado</th>
            <th>Imagen</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($productos as $producto): ?>
        <?php 
            $img_producto = "../uploads/" . $producto['imagen'];
            if(!file_exists($img_producto)) { $img_producto = "../img/default.png"; }
        ?>
        <tr>
            <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
            <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
            <td><?php echo number_format($producto['precio_inicial'], 2); ?></td>
            <td><?php echo number_format($producto['precio_actual'], 2); ?></td>
            <td><?php echo $producto['fecha_inicio']; ?></td>
            <td><?php echo $producto['fecha_fin']; ?></td>
            <td><?php echo htmlspecialchars($producto['estado']); ?></td>
            <td><img src="<?php echo $img_producto; ?>" alt="Imagen del producto"></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>

<?php
include("../php/conexion.php");

// Verificar que el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    echo "<script>
            alert('Debes iniciar sesión para ver tu historial');
            window.location.href = '../php/iniciar_sesion.php';
          </script>";
    exit();
}

$usuario_id = $_SESSION['user_id'];

// Consultar subastas finalizadas creadas por el usuario
$sql = "SELECT producto_id, nombre, precio_actual, imagen, fecha_fin 
        FROM productos 
        WHERE estado = 'finalizada' AND usuario_id = ? 
        ORDER BY fecha_fin DESC";

$stmt = $conex->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Subastas</title>

    <style>
        body {
    font-family: Arial, sans-serif;
    padding: 20px;
}

.titulo {
    text-align: center;
    color: #122c52;
    margin-bottom: 20px;
}

.container-productos {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 1rem;
}

.producto {
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    padding: 15px;
    text-align: center;
    transition: transform 0.2s ease-in-out;
}

.producto:hover {
    transform: scale(1.03);
}

.producto img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 10px;
}

.producto h4 {
    color: #333;
    margin: 10px 0 5px;
    font-size: 16px;
}

.producto p {
    margin: 5px 0;
    color: #555;
}

.sin-historial {
    text-align: center;
    color: #777;
    font-size: 18px;
    margin-top: 20px;
}

    </style>
</head>
<body>

    <h2 class="titulo">Historial de Subastas</h2>

    <div class="container-productos">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="producto">
                    <img src="../uploads/<?php echo htmlspecialchars($row['imagen']); ?>" 
                         alt="<?php echo htmlspecialchars($row['nombre']); ?>">

                    <h4><?php echo htmlspecialchars($row['nombre']); ?></h4>
                    
                    <p>💰 Precio final: 
                        $<?php echo number_format($row['precio_actual'], 2, ',', '.'); ?>
                    </p>
                    
                    <p>📅 Finalizó el: <?php echo htmlspecialchars($row['fecha_fin']); ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="sin-historial">No tienes subastas finalizadas.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
$stmt->close();
$conex->close();
?>

<form action="eliminar_cuenta.php" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar tu cuenta? Esta acción no se puede deshacer.');">
    <button type="submit" name="eliminar" class="btn-eliminar">
        ❌ Eliminar mi cuenta
    </button>
</form>
<style>
    .btn-eliminar {
    background-color: #d9534f;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    margin-top: 20px;
    transition: background 0.3s ease;
}

.btn-eliminar:hover {
    background-color: #c9302c;
}
</style>