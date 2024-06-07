<?php
if (!isset($_COOKIE['saludo'])) {
    $saludo = "Buenos dias + Usuario(Azul)";
    setcookie('saludo', $saludo, time() + 3600); // Cookie lasts for 1 hour
    header('Location: Ej3.html');
    exit();
} else {
    $saludo = (string) $_COOKIE['saludo'];
    $change = isset($_POST['change']) ? $_POST['change'] : 'No';

    if ($change == 'Si') {
        if ($saludo == "Buenos dias + Usuario(Azul)") {
            $saludo = "Hola + Usuario(Verde)";
        } elseif ($saludo == "Hola + Usuario(Verde)") {
            $saludo = "Buenos dias + Usuario(Azul)";
        }
        setcookie('saludo', $saludo, time() + 3600); // Cookie lasts for 1 hour
    }

    header('Location: Ej3.html');
    exit();
}
?>
