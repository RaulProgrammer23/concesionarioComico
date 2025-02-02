<?php
require_once "../concesionarioComico/includes/cabezera.php";

// Verificar si la cookie existe
if (isset($_COOKIE['cookie'])) {
    echo "<p>" . $_COOKIE['cookie'] . "</p>";

    // Mostrando el video si la cookie tiene el error de añadir el usuario y password no indicada"!
    echo "<video controls autoplay width='600'>
            <source src='video/ohNo.mp4' type='video/mp4'>
            Tu navegador no soporta el elemento de video.
          </video>" .
          "<p>Ahora tu ruta http podría ser divertida, pero mejor la dejamos como está :)</p>"
          ;

    // Elimino la cookie después de mostrar el mensaje y el video
    setcookie("cookie", "", time() - 3600);  
    // Elimino la variable global de la cookie
    unset($_COOKIE['cookie']);  
}
?>

<h3>Acceso al sistema</h3>

<form action="login.php" method="POST">
    <label for="usuario">Usuario</label>
    <input type="text" name="usuario" required>
    <br><br>
    <label for="password">Password</label>
    <input type="password" name="password" required>
    <br><br>
    <input type="submit" value="Enviar">
</form>

<p>El usuario es "user" , la password "user", créame, no pruebe con otra,
    es mejor llevarse bien con las solicitudes de http , no queremos 
    colapsos innecesarios
</p>

<?php require_once "../concesionarioComico/includes/pie.php"; ?>


