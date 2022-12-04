<?php
session_start();
$_SESSION['table'] = "users";


try {
    $conn = $conn = mysqli_connect("localhost", "root", "", "airasiadb");
    $commands = file_get_contents("sqlUser.sql");
    $result = mysqli_multi_query($conn, $commands);
    $_SESSION['returnCode'] = "User Table Successfully Reset | admin create with password admin";
    sleep(1);

} catch (Exception $e) {
    $_SESSION['returnCode'] = "An error occurred while resetting user table";
}

header("location: ../../AdminPage.php");

