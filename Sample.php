<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "testdb";

$con = mysqli_connect($servername, $username, $password, $database);

if (!$con) {
    echo"MYSQL is not Connected";
}
else {
    echo "MYSQL is Connected";
}
mysqli_close($con);
?>
