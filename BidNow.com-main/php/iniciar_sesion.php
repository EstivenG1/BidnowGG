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
            <form method="post" id="login_form" action="../php/iniciar.php">
                <h1>iniciar</h1>
                <hr>
                        <?php
                        if (isset($_GET['error'])) {
                            ?>
                            <p class="error">
                                <?php
                                echo $_GET['error']
                                ?>

                            </p>
                            <?php
                        }
                        ?>
                        
                        
                <hr>

        
                <input type="email" placeholder="email" required name="email">
                <input type="password" placeholder="contraseña" required name="password_ingresada">
                <input type="submit" value="iniciar" class="btn-s" name="iniciar">
                <a href="../php/registrarse.php">crear cuenta</a>






            </form>






        </div>
    </div>
    




</body>

</html>