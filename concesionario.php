<?php
session_start();
ob_start();  // Inicia el almacenamiento en búfer de la salida

require_once("includes/cabezera.php"); 
require_once("includes/cartera.php"); 
require_once("datos.inc"); 

if (isset($_SESSION['sesion']) && $_SESSION['sesion'] == "user") { 
    global $imprimeMensaje; 

    // Mostrar el mensaje global si está disponible
    if (!empty($imprimeMensaje)) {
        echo "<p class='alerta'>$imprimeMensaje</p>";
    }

    // Mostrar los coches en la tabla
    echo "<h3>Listado de coches</h3>";
    echo "<table border='4'>
        <tr> 
            <th>MARCA</th> 
            <th>MODELO</th> 
            <th>COLOR</th> 
            <th>MATRICULA</th>  
            <th>PRECIO</th> 
            <th>FOTO</th>
        </tr>";

    // Recorrer el listado de coches
    foreach($listado2 as $v) {
        echo "<tr>
                <td><a href='comprar.php?matricula={$v['matricula']}'>{$v['marca']}</a></td>
                <td><a href='comprar.php?matricula={$v['matricula']}'>{$v['modelo']}</a></td>
                <td><a href='comprar.php?matricula={$v['matricula']}'>{$v['color']}</a></td>
                <td><a href='comprar.php?matricula={$v['matricula']}'>{$v['matricula']}</a></td>
                <td><a href='comprar.php?matricula={$v['matricula']}'>{$v['precio']}</a></td>
                <td><a href='comprar.php?matricula={$v['matricula']}'><img src='images/{$v['foto']}' alt='Foto del coche' width='100'></a></td>
            </tr>";
    }

    echo "</table>";

    // Si hay un mensaje en la cookie, lo mostramos
    if (isset($_COOKIE['cookie'])) {
        echo "<p class='alerta'>" . $_COOKIE['cookie'] . 
            "<span style='color: white; font-weight: bold; font-size: 11px; position: relative; bottom: 75px; left: 60px;'>" . 
            $pesetas . "€</span>" .
        "</p>";
        // Borro la cookie para que no se muestre ma´s en la próxima carga
        setcookie("cookie", "", time() - 3600, "/"); 
        unset($_COOKIE['cookie']);
    }

    // Verificar si todos los coches han sido comprados
    $carpetaCompras = 'compras';
    $archivosComprados = scandir($carpetaCompras);
    $totalCoches = count($listado2); // Número total de coches en el listado

    // solo cuento los .txt
    $archivosValidos = array_filter($archivosComprados, function($archivo) {
        return strpos($archivo, '.txt') !== false; 
    });

    if (count($archivosValidos) == $totalCoches) {
        echo "<form method='POST' action=''>
                <button type='submit' name='borrarTodo' style='
                    background-color: red; 
                    color: white; 
                    padding: 10px 20px; 
                    font-size: 18px; 
                    border: none; 
                    border-radius: 5px; 
                    cursor: pointer;'>
                    🗑️ Vaciar Compras
                </button>
              </form>";
    }

    // Si se presiona el botón de borrar, eliminar la carpeta "compras"
    if (isset($_POST['borrarTodo'])) {
        array_map('unlink', glob("$carpetaCompras/*.txt")); // Borrar todos los .txt
        rmdir($carpetaCompras); // Eliminar la carpeta compras
        mkdir($carpetaCompras, 0777, true); // Crear la carpeta de nuevo
        echo "<p class='alerta'>Usted compró todos los COCHES!!! .</p>";
    }

} else {
    // Si no está validado, redirigir
    setcookie("cookie", "No puede acceder", time() + 3600, "/");
    header("Location: index.php"); 
    exit;
}

ob_end_flush();  // Enviar la salida al navegador al final
?>

<a href="cerrar.php">Cerrar sesión</a>
<?php require_once("includes/pie.php"); ?>
