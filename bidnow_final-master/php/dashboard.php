<?php


// Inicia la sesión
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Debes iniciar sesión para poder entrar a la dashboard.'); window.location.href = '../php/iniciar_sesion.php';</script>";
    exit();
}
//  contenido por defecto
$contenido_a_incluir = '../php/subastas_activas.php';
$seccion = 'subastas';
// Verifica si la variable 'seccion' está en la URL
if (isset($_GET['seccion'])) {
    $seccion = $_GET['seccion'];

    // Usa un switch para decidir qué archivo incluir
    switch ($seccion) {
        case 'subastas':
            $contenido_a_incluir = '../php/subastas_activas.php';
            break;
        case 'agregar-subasta':
            $contenido_a_incluir = '../php/agregar_subastas.php';
            break;
        case 'mi-cuenta':
            $contenido_a_incluir = '../php/mi_cuenta.php';
            break;
        default:
            // Si la sección no existe, carga el contenido por defecto
            $contenido_a_incluir = '../php/subastas_activas.php';
            break;
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/general.css">
    <link rel="icon" href="../img/logoBidNow2.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>

    <div class="wrapper">
        <aside>
            <header>
                <h1 class="logo">BidNow</h1>
            </header>
            <nav>
                <ul class="menu">
                    <li><a href="dashboard.php?seccion=subastas" class="boton-menu <?php echo ($seccion === 'subastas' ? 'active' : '');?>"><i class=" bi bi-hand-index-thumb-fill"></i>subastas</a></li>
                    <li><a href="dashboard.php?seccion=agregar-subasta" class="boton-menu <?php echo ($seccion === 'agregar-subasta' ? 'active' : '');?>"><i class=" bi-hand-index-thumb"></i>nueva subasta</a></li>
                    <li><a href="dashboard.php?seccion=mi-cuenta" class="boton-menu <?php echo ($seccion === 'mi-cuenta' ? 'active' : '');?>"><i class=" bi bi-hand-index-thumb"></i>mi cuenta</a></li>

                </ul>
            </nav>
            <footer>
                <a href="../php/cerrar_sesion.php" class="cerrar-sesion"><i class="bi bi-box-arrow-left"></i>cerrar sesion</a>
            </footer>
        </aside>

        

<main>
    <?php
        // Incluye el archivo PHP que corresponde a la sección seleccionada
        include($contenido_a_incluir);
    ?>
</main>
    </div>

</body>

</html>