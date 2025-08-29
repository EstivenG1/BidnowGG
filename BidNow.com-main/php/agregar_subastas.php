<?php


// Verificar que el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Debes iniciar sesión para poder agregar una subasta.'); window.location.href = '../php/iniciar_sesion.php';</script>";
    exit();
}



?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/agregar_subasta.css">
</head>

<body>
    <h2 class="titulo-principal">Crear una nueva subasta:</h2>

    <form action="../php/procesar_subasta.php" method="post" enctype="multipart/form-data" class="conatiner-form-s">
        <p>Completa el formulario para publicar un artículo.</p>
        <div class="form-group">
            <label for="nombre">Nombre del artículo:</label>
            <input type="text" name="nombre" id="nombre" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="6" required></textarea>
        </div>

        <div class="form-group">
            <label for="precio_inicial">Precio inicial ($):</label>
            <input type="number" name="precio_inicial" id="precio_inicial" placeholder="0.00" step="0.01" min="0"
                required>
        </div>

        <div class="form-group">
            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*" required>
        </div>

        <div class="form-group">
            <label for="fecha_cierre">Fecha de Cierre:</label>
            <input type="datetime-local" id="fecha_cierre" name="fecha_fin" required>
        </div>
        <input type="submit" value="crear subasta" class="btn-s" name="crear-subasta">

    </form>
</body>

</html>