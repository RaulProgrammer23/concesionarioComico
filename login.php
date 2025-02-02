<?php
    session_start();

    if(isset($_POST['usuario']) && isset($_POST['password'])){
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

        if(($usuario == "user") && ($password == "user")){
            $_SESSION['sesion'] = $usuario;
            header("Location: concesionario.php");

        }else{
            // si el usuario no es valido creo la cookie
            setcookie("cookie","usuario y/o contraseña incorrectossss");
            
            header("Location: index.php");
        }

    }
     
?>