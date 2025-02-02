<?php
session_start();
require_once "operaciones.php";
$videos = require_once "videos.php";
require_once "mensajes.php";

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra de coches</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .alerta {
            background-color: #007bff;
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px auto;
            max-width: 900px;
            font-size: 28px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
        }

        .alerta .texto {
            margin-bottom: 20px;
            font-size: 27px;
            font-weight: bold;
        }

        .video-container {
            margin-bottom: 20px;
        }

        .video-container iframe {
            display: block;
            margin: 0 auto;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .cartera {
            margin-top: 20px;
        }

      
    </style>
</head>
<body>

<?php
// Si la sesión está activa y es el usuario correcto
if (isset($_SESSION['sesion']) && $_SESSION['sesion'] == 'user') {
    // Verificamos si se pasa la matrícula del Coche X

    if (isset($_GET['matricula']) && !empty($_GET['matricula'])) {
        $matricula = $_GET['matricula'];

        // Inicializar las variables de mensaje y video
        $mensajeCompra = "";
        $mensajeError = "";
        $iframe = "";
        // Inicializamos el contador desde la sesión si ya existe, sino lo ponemos en 0
        $contador = isset($_SESSION['contador']) ? $_SESSION['contador'] : 0;

        // Buscar el coche en el listado para añadirle el video y mensajes de cookie.
        switch ($matricula) {
            case "53434":  // El Passat
                $mensajeCompra = $compradoPassat;
                $mensajeError = $vendidoPassat;
                $iframe = $videos['53434'];
                $contador++;
                break;
            case "3423432":  // Polo
                $mensajeCompra = $compradoPolo;
                $mensajeError = $esclafadoPolo;
                $iframe = $videos['3423432'];
                $contador++;
                break;
            case "053-432-43G":  // Aventador
                $mensajeCompra = $compradoAventador;
                $mensajeError = $vendidoAventador;
                $iframe = $videos['053-432-43G'];
                $contador++;
                break;
            case "miMatriculaJAJA":  // Hyundai Coupe FX
                $mensajeCompra = $compradoRaul;
                $mensajeError = $vendidoRaul;
                $iframe = $videos['miMatriculaJAJA'];
                $contador++;
                break;
            case "aMarteXSiempre":  // Cyber-TRUMP
                $mensajeCompra = $compradoTrump;
                $mensajeError = $vendidoTrump;
                $iframe = $videos['aMarteXSiempre'];
                $contador++;
                break;
            default:
                $mensajeError = "Error, coche no encontrado.";
                break;
        }

        // Si la compra fue exitosa
        if (addCompra($matricula)) {

            // Aplico estilos directamente en la cookie.
            setcookie(
                "cookie",
                "
                    <div class='texto'>$mensajeCompra</div>
                    <div class='video-container'>$iframe</div>
                    <img src='images/cartera.png' alt='Cartera' width='250' height='235'
                    position: relative; left: 1400px;>                  
                ",
                time() + 3600,
                "/"
            );
            
        } else {
            // Si la compra no fue exitosa, guardamos el mensaje de error en la cookie
            setcookie(
                "cookie",
                "
                    <div class='texto'>$mensajeError</div>
                    <img src='images/cartera.png' alt='Cartera' width='250' height='235'
                    position: relative; left: 1400px;>
                    
                ",
                time() + 3600,
                "/"
            );
        }

        // Redirigir al concesionario 
        header("Location: concesionario.php");
        exit;
    } else {
        // Si no se pasa una matrícula válida
        setcookie("cookie", "Error, no hay datos", time() + 3600, "/");
        header("Location: index.php");
        exit;
    }
} else {
    // Si no está validado, redirigimos al inicio
    setcookie("cookie", "Usuario no validado!", time() + 3600, "/");
    header("Location: index.php");
    exit;
}
?>

</body>
</html>
