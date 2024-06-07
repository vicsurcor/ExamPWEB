<?php
$usuario = trim($_POST["usuario"]);
if (!isset($_COOKIE['saludo'])) {
    $saludo = "Buenos dias + " .  $usuario;
    setcookie('saludo', $saludo, time() + 3600); // Cookie lasts for 1 hour
    header('Location: Ej3.html');
    exit();
} else {
    $saludo = (string) $_COOKIE['saludo'];
    $change = isset($_POST['change']) ? $_POST['change'] : 'No';

    if ($change == 'Si') {
        if (strpos ($saludo , "Buenos dias") !== false) {
            $saludo = "Hola + " . $usuario;
        } elseif (strpos ($saludo , "Hola") !== false) {
            $saludo = "Buenos dias + " . $usuario;
        }
        setcookie('saludo', $saludo, time() + 3600); // Cookie lasts for 1 hour
    }

    header('Location: Ej3.html');
    exit();
}
?>
