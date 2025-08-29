<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "registration_system";
$conn = new mysqli($servername, $username, $password, $database);
if (!$conn) {
    echo"MYSQL is not Connected";
}
else {
    echo "";
}
?>
