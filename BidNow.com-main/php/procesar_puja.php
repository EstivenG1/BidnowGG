<?php
// Incluir la conexión a la base de datos
include("../php/conexion.php");
session_start();

// Habilitar la visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verificar que el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Debes iniciar sesión para poder pujar.'); window.location.href = '../php/iniciar_sesion.php';</script>";
    exit();
}

// Validar que los datos del formulario existen
if (!isset($_POST['pujar']) || !isset($_POST['producto_id']) || !isset($_POST['monto_puja'])) {
    echo "<script>alert('Error: Datos de puja no válidos.'); window.history.back();</script>";
    exit();
}

//  Obtener y limpiar los datos del formulario
$producto_id = intval($_POST['producto_id']);
$monto_puja = floatval($_POST['monto_puja']);
$usuario_id = $_SESSION['user_id'];

//  Obtener el precio actual de la subasta desde la base de datos
$sql_producto = "SELECT precio_actual, fecha_fin FROM productos WHERE producto_id = ?";
$stmt_producto = mysqli_prepare($conex, $sql_producto);
mysqli_stmt_bind_param($stmt_producto, "i", $producto_id);
mysqli_stmt_execute($stmt_producto);
$result_producto = mysqli_stmt_get_result($stmt_producto);

if (mysqli_num_rows($result_producto) == 0) {
    echo "<script>alert('Error: Producto no encontrado.'); window.history.back();</script>";
    exit();
}

$producto = mysqli_fetch_assoc($result_producto);
$precio_actual = floatval($producto['precio_actual']);
$fecha_fin = $producto['fecha_fin'];

//  Validar que la subasta no ha terminado
if (strtotime($fecha_fin) < time()) {
    echo "<script>alert('Esta subasta ha finalizado y ya no se aceptan pujas.'); window.history.back();</script>";
    exit();
}

//  Validar que el monto de la puja es mayor que el precio actual
if ($monto_puja <= $precio_actual) {
    echo "<script>alert('Tu puja debe ser mayor que el precio actual.'); window.history.back();</script>";
    exit();
}

//  Actualizar el precio actual del producto en la base de datos
$sql_update = "UPDATE productos SET precio_actual = ? WHERE producto_id = ?";
$stmt_update = mysqli_prepare($conex, $sql_update);
mysqli_stmt_bind_param($stmt_update, "di", $monto_puja, $producto_id);

if (mysqli_stmt_execute($stmt_update)) {
    //  Registrar la puja en una tabla de historial (opcional, pero recomendado)
    $sql_puja = "INSERT INTO pujas (producto_id, usuario_id, monto, fecha_puja) VALUES (?, ?, ?, NOW())";
    $stmt_puja = mysqli_prepare($conex, $sql_puja);
    mysqli_stmt_bind_param($stmt_puja, "iid", $producto_id, $usuario_id, $monto_puja);
    mysqli_stmt_execute($stmt_puja);
    mysqli_stmt_close($stmt_puja);

    echo "<script>alert('¡Puja realizada con éxito! ¡Eres el mejor postor!'); window.location.href = 'detalles_subasta.php?id=" . $producto_id . "';</script>";
} else {
    echo "<script>alert('Error al procesar la puja. Por favor, inténtelo de nuevo.'); window.history.back();</script>";
}

//  Cerrar las declaraciones y la conexión
mysqli_stmt_close($stmt_producto);
mysqli_stmt_close($stmt_update);
mysqli_close($conex);
?>