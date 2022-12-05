<?php
session_start();
$_SESSION['table'] = "images";

$path = dirname(__DIR__, 2) . "\CSS\Images\Brands";
$dir = new DirectoryIterator($path);

$conn = mysqli_connect("localhost", "root", "", "airasiadb");
$sql = "DROP TABLE IF EXISTS images";
$result = mysqli_query($conn, $sql);
$sql = "CREATE TABLE images (
                    id int auto_increment primary key,
                    name_ref varchar(125) not null, 
                    img_src varchar(200) not null)";
$result = mysqli_query($conn, $sql);

foreach ($dir as $fileinfo) {
    if (!$fileinfo->isDot() && $fileinfo != "null-card.png") {
        $sql = "INSERT INTO images (name_ref, img_src) VALUES ('" . strtok($fileinfo, ".") . "', '" . $fileinfo . "')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $_SESSION['returnCode'] = "Table Successfully Created";
        } else {
            $_SESSION['returnCode'] = "An error occurred while updating table";
        }
    }
}

$sql = "INSERT INTO images (name_ref, img_src) VALUES ('null-card', 'null-card.png')";
$result = mysqli_query($conn, $sql);
if ($result) {
    $_SESSION['returnCode'] = "Table Successfully Created";
    sleep(1);
    header("location: ../../AdminPage.php");
} else {
    $_SESSION['returnCode'] = "An error occurred while updating table";
}



