<?php
// Habilitar la visualización de errores (esto es solo para depuración)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("../php/conexion.php");
session_start();

// Validar que el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Debes iniciar sesión para poder agregar una subasta.'); window.location.href = '../php/iniciar_sesion.php';</script>";
    exit();
}

// -----------------  Procesar el formulario  -----------------

if (isset($_POST['crear-subasta'])) {
    // Validar que los campos principales no estén vacíos
    if (empty($_POST['nombre']) || empty($_POST['descripcion']) || empty($_POST['precio_inicial']) || empty($_POST['fecha_fin'])) {
        echo "<script>alert('Error: Por favor, complete todos los campos requeridos.'); window.history.back();</script>";
        exit();
    }

    $nombre_producto = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $precio_inicial = floatval(trim($_POST['precio_inicial']));
    $fecha_fin = trim($_POST['fecha_fin']);
    
    // Obtener el ID del usuario de la sesión
    $usuario_id = $_SESSION['user_id'];
    
    $precio_actual = $precio_inicial;
    $fecha_inicio = date("Y-m-d H:i:s");
    $estado = "activa";

    // -----------------  Procesar la imagen  -----------------
    if (!isset($_FILES['imagen']) || $_FILES['imagen']['error'] !== UPLOAD_ERR_OK) {
        echo "<script>alert('Error al subir la imagen.'); window.history.back();</script>";
        exit();
    }

    $nombre_imagen = $_FILES['imagen']['name'];
    $ruta_temporal = $_FILES['imagen']['tmp_name'];
    $tamano_imagen = $_FILES['imagen']['size'];
    $formato_imagen = strtolower(pathinfo($nombre_imagen, PATHINFO_EXTENSION));

    $directorio_destino = "../uploads/";
    $nombre_unico = uniqid() . '.' . $formato_imagen;
    $ruta_destino_completa = $directorio_destino . $nombre_unico;

    // Validar el tipo de archivo
    $formatos_permitidos = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($formato_imagen, $formatos_permitidos)) {
        echo "<script>alert('Error: Formato de imagen no permitido.'); window.history.back();</script>";
        exit();
    }

    // Mover el archivo a la carpeta de destino
    if (!move_uploaded_file($ruta_temporal, $ruta_destino_completa)) {
        echo "<script>alert('Error al mover la imagen. Verifique los permisos de la carpeta uploads.'); window.history.back();</script>";
        exit();
    }

    // -----------------  Insertar en la base de datos  -----------------

    $sql_insert = "INSERT INTO `productos` (`nombre`, `descripcion`, `precio_inicial`, `precio_actual`, `fecha_inicio`, `fecha_fin`, `usuario_id`, `estado`, `imagen`) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conex, $sql_insert);
    
    // Verificar si la preparación de la consulta falló
    if ($stmt === false) {
        echo "<script>alert('Error en la consulta preparada: " . mysqli_error($conex) . "'); window.history.back();</script>";
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "ssddssiss", $nombre_producto, $descripcion, $precio_inicial, $precio_actual, $fecha_inicio, $fecha_fin, $usuario_id, $estado, $nombre_unico);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Subasta creada con éxito.'); window.location.href = '../php/dashboard.php';</script>";
    } else {
        echo "<script>alert('Error al registrar la subasta: " . mysqli_error($conex) . "'); window.history.back();</script>";
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conex);

} else {
    // Si el formulario no fue enviado, redirige o muestra un mensaje
    echo "<script>alert('Acceso no válido.'); window.history.back();</script>";
}

?>