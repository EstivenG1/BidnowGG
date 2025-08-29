<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/forms.css">


</head>

<body>
    <div class="container">
        <a href="../html/index.html" class="back-link">volver</a>
        <div class="form-container">
            <form method="post" id="register_form" action="../php/registrar.php">
                <h1>crea tu cuenta</h1>
                <input type="text" placeholder="nombre" required name="nombre">
                <input type="text" placeholder="telefono" required name="telefono">
                <input type="email" placeholder="email" required name="email">
                <input type="password" placeholder="contraseña" required name="password">
                <input type="submit" value="registrar" name="registrar" class="btn-s">
                <a href="../php/iniciar_sesion.php">iniciar</a>

                        






            </form>







        </div>
    </div>
    




</body>

</html>