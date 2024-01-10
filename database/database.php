<?php
$servername = "localhost";
$username = "root";
$password = "";
$databasename ="dangstorepj2";
// Create connection
$conn = new mysqli($servername, $username, $password,$databasename);
// Check connection
if ($conn->connect_error) {
  die("Kết nối thất bại " .$conn->connect_error);
  exit();
}
?>