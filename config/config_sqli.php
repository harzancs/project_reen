<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cat";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
date_default_timezone_set('Asia/Bangkok');

function dateThai($strDate){
}
?>