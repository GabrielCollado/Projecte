<?php

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

    $server = "localhost";
    $userbase = "admin";
    $password = "123";
    $base = "baseProjecte";
    $user = $_POST['nom'];
    $pwd = $_POST['pwd'];

    $conn = new mysqli($server, $userbase, $password, $base);

if ($conn->connect_error) {
    die("Error de conexió " . $conn->connect_error);
}

$query = "SELECT nom, password FROM usuaris WHERE nom='$user' AND password='$pwd'";

$result = $conn->query($query);

if ($result === FALSE) {
    echo "Error consulta " . $conn->error;
} else {
    if ($result->num_rows > 0) {
        header("Location: ../principal.html");
    } else {
        echo "<script>alert('Login incorrecte');</script>";
        echo "<script>window.location.href = '../login.html';</script>";
    }
}
$conn->close();

?>