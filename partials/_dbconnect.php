<?php
$server = 'localhost';
$user = "root";
$pass = "";
$db = 'notes';
$conn = mysqli_connect($server, $user, $pass, $db);
if(!$conn){
    echo "Could not connect to server";
}

?>