<!DOCTYPE html>
<html lang="en">
<head>
    <meta charse<t="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/forms.css">

</head>
<body>
    <?php
include("../php/conexion.php");


if (!empty($_POST['registrar'])) {
    if (
        strlen($_POST['nombre'])>=1 &&
        strlen($_POST['telefono'])>=1 &&
        strlen($_POST['email'])>=1 &&
        strlen($_POST['password'])>=1 
        ) {

            $nombre= trim($_POST['nombre']);
            $telefono= trim($_POST['telefono']);
            $email= trim($_POST['email']);
            $password= ($_POST['password']);
            $password_encriptada=password_hash($password, PASSWORD_DEFAULT);
            $fecha_registro=date("Y-m-d H:i:s");
            $tipo_usuario="estandar";

            $sqlr="INSERT INTO `usuarios` (`usuario_id`, `nombre`, `email`, `password`, `telefono`, `tipo_usuario`, `fecha_registro`) 
               VALUES (NULL, ?, ?, ?, ?, ?, ?)";
            $stmt= mysqli_prepare($conex, $sqlr);
            
            mysqli_stmt_bind_param($stmt,"ssssss", $nombre, $email, $password_encriptada, $telefono, $tipo_usuario, $fecha_registro);
            if (mysqli_execute($stmt)) {
                echo "<script>alert('felicidades, has sido registrado con éxito! Ahora inicia sesion.'); 
                window.location='../php/iniciar_sesion.php';</script>";
                mysqli_stmt_close($stmt);
                mysqli_close($conex);
                exit(); 
            }else {
                echo "<script>alert('error al registrarse'); window.location='../php/registrarse.php';</script>";
            } 
    }
    
}

?>




    
</body>
</html>

