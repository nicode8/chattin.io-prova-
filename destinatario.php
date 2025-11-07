<?php
session_start();


$_SESSION["destinatario"]=$_POST["dest"];

if(strlen($_SESSION["destinatario"]))
header("location:homepage.html");
else
header("location:destinatario.html");
?>