<?php
$servername = "127.0.0.1";
$username = "user";
$password = "test";
$db = "myDb";

$conn = new mysqli('host.docker.internal', $username, $password,$db,'3306') or die("Connect failed: %s\n". $conn -> error);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";