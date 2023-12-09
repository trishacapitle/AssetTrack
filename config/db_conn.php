<?php

$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "assettrack";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
    echo "Connection failed: " . mysqli_connect_error();
     die(mysqli_error($conn));
}

?>
