<?php
session_start();

require 'localConfig.php';
$conn= new mysqli($DB_local_host,$DB_local_user,$DB_local_pass,$DB_local_name,$local_door);
if($conn->connect_error)
    die("errore");

$json=file_get_contents("php://input");
$dati=json_decode($json,true);


$nome=$dati["nome"];
$username=$dati["username"];
$_SESSION["email"]=$dati["email"];
$password=$dati["passw"];


$sql_check="SELECT * FROM accessi WHERE cognome=? AND email=? AND passw=? ";
$stmt2= $conn->prepare($sql_check);
$stmt2->bind_param("sss",$username,$_SESSION["email"],$password);

$stmt2_result= $stmt2->get_result();

if($stmt2_result->num_rows>0)
{
    echo json_encode("email gia esistente");
    exit();
}




$sql="INSERT INTO accessi (nome,cognome,email,passw) VALUES (?,?,?,?)";


$stmt= $conn->prepare($sql);
$stmt-> bind_param("ssss", $nome, $username, $_SESSION["email"], $password);
if(!$stmt->execute()) die("Errore: " . $stmt->error);






$stmt->close();
$conn->close();


?>