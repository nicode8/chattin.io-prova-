<?php
session_start();

require 'localConfig.php';
$conn= new mysqli($DB_local_host,$DB_local_user,$DB_local_pass,$DB_local_name,$local_door);
if($conn->connect_error)
    die("error".$conn->error);


$sql="SELECT messaggio from messaggi_inviati where ricevente=? AND mittente=?";

$stmt= $conn->prepare($sql);
$stmt->bind_param("ss",$_SESSION["email"],$_SESSION["destinatario"]);
$stmt->execute();
$result=$stmt->get_result();

$messaggio=[];
while($row=$result->fetch_assoc())
{
    $messaggio[]=$row["messaggio"];

}
header('Content-Type: application/json');
echo json_encode($messaggio);






?>