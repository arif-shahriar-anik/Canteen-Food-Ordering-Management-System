<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 11/19/2018
 * Time: 11:55 PM
 */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Canteen";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
  /*  echo "Connected";*/
}

?>