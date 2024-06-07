<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (isset($_POST["grupo"]) && isset($_POST["edad"]) && isset($_POST["nombre"]) && isset($_POST["apellidos"]) && isset($_POST["asignatura"])) {
        // Retrieve and sanitize values from $_POST
        $grupo = htmlspecialchars(trim($_POST["grupo"]));
        $edad = intval($_POST["edad"]);
        $nombre = htmlspecialchars(trim($_POST["nombre"]));
        $apellidos = htmlspecialchars(trim($_POST["apellidos"]));
        $asignatura = htmlspecialchars(trim($_POST["asignatura"]));
        
        $nombreCompleto = $nombre . ' ' . $apellidos;
        $data = array($nombreCompleto, $grupo, $edad, $asignatura);

        // Ensure the base directory exists
        if (!file_exists($grupo)) {
            if (mkdir($grupo, 0777, true)) {
                echo "Directorio '$grupo' creado exitosamente.<br>";
            } else {
                echo "Error al crear el directorio '$grupo'.<br>";
                exit();
            }
        }

        // Directories for age groups
        $mayor = $grupo . "/mayor";
        $menor = $grupo . "/menor";

        // Ensure the 'mayor' and 'menor' directories exist
        if (!file_exists($mayor)) {
            if (mkdir($mayor, 0777, true)) {
                echo "Directorio 'mayor' creado exitosamente.<br>";
            } else {
                echo "Error al crear el directorio 'mayor'.<br>";
                exit();
            }
        }

        if (!file_exists($menor)) {
            if (mkdir($menor, 0777, true)) {
                echo "Directorio 'menor' creado exitosamente.<br>";
            } else {
                echo "Error al crear el directorio 'menor'.<br>";
                exit();
            }
        }

        // File paths
        $mayorFile = $mayor . "/mayor_de_18.csv";
        $menorFile = $menor . "/menor_de_18.csv";

        // Write to the appropriate file based on age
        if ($edad >= 18) {
            $file = fopen($mayorFile, "a");
            if ($file) {
                fputcsv($file, array($nombreCompleto));
                fclose($file);
            } else {
                echo "Error al escribir en el archivo '$mayorFile'.<br>";
                exit();
            }
        } else {
            $file = fopen($menorFile, "a");
            if ($file) {
                fputcsv($file, array($nombreCompleto));
                fclose($file);
            } else {
                echo "Error al escribir en el archivo '$menorFile'.<br>";
                exit();
            }
        }

        echo "Datos guardados exitosamente.<br>";

    } else {
        echo "Todos los campos del formulario son requeridos.<br>";
    }
}
?>
