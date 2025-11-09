<?php
session_start();

require 'localConfig.php';
$conn= new mysqli($DB_local_host,$DB_local_user,$DB_local_pass,$DB_local_name,$local_door);
if($conn->connect_error)
    die("errore");

$json=file_get_contents("php://input");
$dati=json_decode($json,true);


$nome=$dati["nome"];
$cognome=$dati["cognome"];
$_SESSION["email"]=$dati["email"];
$password=$dati["passw"];


$sql="INSERT INTO accessi (nome,cognome,email,passw) VALUES (?,?,?,?)";

$stmt= $conn->prepare($sql);
$stmt-> bind_param("ssss", $nome, $cognome, $_SESSION["email"], $password);
if(!$stmt->execute()) die("Errore: " . $stmt->error);

header("Location: index.html");
    


$stmt->close();
$conn->close();


?>