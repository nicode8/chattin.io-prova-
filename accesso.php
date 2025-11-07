<?php
session_start();

require 'localConfig.php';
$conn= new mysqli($DB_local_host,$DB_local_user,$DB_local_pass,$DB_local_name,$local_door);

if($conn->connect_error)
    die("error");

$email=$_POST["email"];
$password=$_POST["passw"];

if(strlen($email))
{
$sql="SELECT * FROM accessi WHERE email=? AND passw=? ";

$stmt= $conn->prepare($sql);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result= $stmt->get_result();


if($row= $result->fetch_assoc())
{   $_SESSION["email"]=$_POST["email"];
    header("Location: destinatario.html");
}
else
{   echo "<script> alert('questo account non esiste');
    window.location.href='index.html';
    </script>";
}


$stmt->close();
$conn->close();
}
else
    header("location:index.html");

?>