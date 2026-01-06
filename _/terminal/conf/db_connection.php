<?php
// $username1 = "u709820750_afia";
// $password1 = "Bib@2012aa++";
// $dbname1 = "u709820750_afia";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "afia";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
// if ($conn->connect_error) {
    
// $conn = new mysqli($servername, $username1, $password1, $dbname1);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 	
// } 


date_default_timezone_set('Africa/Dar_es_Salaam');
?>