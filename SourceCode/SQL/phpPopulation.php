<?php
session_start();
$_SESSION['table'] = "cards";

try {
    $conn = $conn = mysqli_connect("localhost", "root", "", "airasiadb");
    $commands = file_get_contents("sqlProduct.sql");
    $result = mysqli_multi_query($conn, $commands);
    $_SESSION['returnCode'] = "Product Table Successfully Reset";
    sleep(1);

} catch (Exception $e) {
    $_SESSION['returnCode'] = "An error occurred while resetting product table";
}

header("location: ../../AdminPage.php");
