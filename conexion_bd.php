<?php
$host = "localhost";
$user = "root";
$password = "";
$db ="dbdentsystem";

$conexion = new mysqli($host,$user,$password,$db);
if($conexion ->connect_errno){ 
    echo "conexion fallida";
}

?>