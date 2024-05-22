<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$server = "localhost";
$userbase = "admin";
$password = "123";
$base = "baseProjecte";

if(isset($_POST['nom'], $_POST['pwd'])){
    $user = $_POST['nom'];
    $pwd = $_POST['pwd'];

    // Crear la conexión
    $conn = new mysqli($server, $userbase, $password, $base);

    if ($conn->connect_error) {
        die("Error de conexió" . $conn->connect_error);
    }

    // Escapar las variables de usuario y contraseña después de crear la conexión
    $user = mysqli_real_escape_string($conn, $user);
    $pwd = mysqli_real_escape_string($conn, $pwd);

    $query = "INSERT INTO usuaris (nom, password) VALUES ('$user', '$pwd')";

    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Usuari creat');</script>";
        echo "<script>window.location.href = '../index.php';</script>";
    } else {
        echo "Error al crear usuari: " . $conn->error;
    }

    $conn->close();
} else {
    die("Error: Falten dades");
}
?>