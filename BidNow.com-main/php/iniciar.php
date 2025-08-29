<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include("../php/conexion.php");

    session_start();

    if (isset($_SESSION['user_id'])) {
        header("Location: ../php/dashboard.php");
    }

    if (!empty($_POST)) {
        $email= trim($_POST['email']);
        $password_ingresada = $_POST['password_ingresada'];
        $sqli = "SELECT usuario_id, password FROM usuarios WHERE email = ?";
        $stmt2= mysqli_prepare($conex, $sqli);
        mysqli_stmt_bind_param($stmt2, "s", $email);
        mysqli_stmt_execute($stmt2);
        $resul=mysqli_stmt_get_result($stmt2);
        if ($resul->num_rows === 1){
            $usuario=mysqli_fetch_assoc($resul);
            $pass_al=$usuario['password'];


            if (password_verify($password_ingresada, $pass_al)){

                $_SESSION['user_id'] = $usuario['usuario_id'];
                echo "<script>";
                echo "alert('bienvenido');"; 
                echo "window.location='../php/dashboard.php';"; 
                echo "</script>";
                exit();





            }else{
                header("Location: ../php/iniciar_sesion.php?error=" . urlencode("El email o la contraseña son incorrectos."));
                exit();

            }



        }else{
            header("Location: ../php/iniciar_sesion.php?error=" . urlencode("El email o la contraseña son incorrectos."));
            exit();
                
        }



            
            
        }
        
            
        
    





    ?>





    
</body>
</html>