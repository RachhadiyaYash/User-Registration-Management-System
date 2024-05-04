<?php
$servername = "localhost";
$username ="root"; 
$password = "";
$database = "user_registration"; 


$connection = mysqli_connect($servername, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
