<?php
session_start();

require 'localConfig.php';
$conn= new mysqli($DB_local_host,$DB_local_user,$DB_local_pass,$DB_local_name,$local_door);
if($conn->connect_error)
    die("error");

$messaggio=$_POST["messaggio"];
$ora = (new DateTime())->format("Y-m-d H:i:s");

$sql="INSERT INTO messaggi_inviati (mittente,ricevente,messaggio,ora) VALUES (?,?,?,?)";

$invio= $conn->prepare($sql);
$invio->bind_param("ssss",$_SESSION["email"],$_SESSION["destinatario"],$messaggio,$ora);
$invio->execute();


$invio->close();
$conn->close();













?>