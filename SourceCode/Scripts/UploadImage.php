<?php
session_start();

// TODO FIX THIS FUNCTION
function showConfirmDialog(): void
{
    echo '<script type="text/javascript">';
    echo 'function overwriteConfirm() {';
    echo '$_SESSION["overwriteBool"] = 0";';
    echo 'if (confirm("File already exists. \n Do you want to overwrite?")) {';
    echo '$_SESSION["overwriteBool"] = 1";';
    echo '} else {';
    echo '}';
    echo '}';
    echo '</script>';


    echo '<script type="text/javascript">overwriteConfirm()</script>';
}

function uploadImage(): void
{
    global $message;
    global $targetFile;
    // Get needed Data
    $conn = mysqli_connect("localhost", "root", "", "airasiadb");
    $result = mysqli_query($conn, "SELECT * FROM `cards` WHERE id = '" . $_SESSION['cardid'] . "'");
    $card = mysqli_fetch_array($result);
    $destination_path = realpath(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR);
    $imageDir = $destination_path . "\CSS\Images\Brands\\";
    $targetFile = "";

    // Check the card Name
    if (empty($card['name'])) {
        $message = "Card name cannot be null when adding an image";
        header("location: ../Card-Update.php?id=" . $_SESSION['cardid']);
    } elseif (isset($_FILES['customFile']) && !empty($_FILES['customFile'])) {
        $upload = 1;
        if (isset($_POST['cardName']) && !empty($_POST['cardName'])) {
            $targetFile = $imageDir . $_POST['cardName'] . ".png";
        } else {
            $targetFile = $imageDir . $card['name'] . ".png";
        }

        global $targetFile;
        echo $targetFile;

        // Check file size to protect the database
        if ($_FILES['customFile']["size"] > 500000) {
            $message = "Sorry, your file is too large.";
            $upload = 0;
            header("location: Card-Details.php?id=" . $_SESSION['cardid']);
        }

//        // Check if file already exists
//        global $targetFile;
//        if (file_exists($targetFile)) {
//            $message = "Sorry, the image file already exists.";
//            showConfirmDialog();
//            if ($_SESSION['overwriteBoolean'] == "1") {
//                unlink($targetFile);
//                $upload = 1;
//            } else {
//                $upload = 0;
//            }
//
//        }

        // Commence Upload
        if ($upload != 0) {
            global $targetFile;
            if (move_uploaded_file($_FILES["customFile"]["tmp_name"], $targetFile)) {
                include(dirname(__DIR__) . "\\SQL\\" . "phpImage.php");
                header("location: Card-Details.php?id=" . $_SESSION['cardid']);
            } else {
                header("location: Card-Details.php?id=" . $_SESSION['cardid']);
            }
        }
    }
}



