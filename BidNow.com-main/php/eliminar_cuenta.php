<?php
include("../php/conexion.php");
session_start();

// Verificar que el usuario esté logueado
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Debes iniciar sesión primero'); window.location.href = 'iniciar_sesion.php';</script>";
    exit();
}

$usuario_id = $_SESSION['user_id'];

// 1. (Opcional) Eliminar pujas hechas por el usuario
$sql_pujas = "DELETE FROM pujas WHERE usuario_id = ?";
$stmt = $conex->prepare($sql_pujas);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$stmt->close();

// 2. (Opcional) Eliminar productos/subastas subidos por el usuario
$sql_productos = "DELETE FROM productos WHERE usuario_id = ?";
$stmt = $conex->prepare($sql_productos);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$stmt->close();

// 3. Eliminar el usuario de la tabla usuarios
$sql_usuario = "DELETE FROM usuarios WHERE usuario_id = ?";
$stmt = $conex->prepare($sql_usuario);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$stmt->close();

// Cerrar sesión
session_destroy();

// Redirigir al inicio
echo "<script>alert('Tu cuenta ha sido eliminada exitosamente'); window.history.back();</script>";
?>
