<?php

function getData(): void
{
    global $card;
    global $imagesAll;
    global $id;
    $id = substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], "=") + 1);

    if (isset($_SESSION['cardid']) && $_SESSION['cardid'] != $id) {
        $_SESSION['returnCode'] = "";
    } // TODO make sure the session code changes when the page changes (don't have to use session for this?)

    $_SESSION['cardid'] = $id;
    $conn = mysqli_connect("localhost", "root", "", "airasiadb");
    // Get product data
    $result = mysqli_query($conn, "SELECT * FROM `cards` WHERE id = '" . $id . "'");
    $card = mysqli_fetch_array($result);

    $result = mysqli_query($conn, "SELECT name_ref FROM `images`");
    $imagesAll = mysqli_fetch_all($result);

}

function imageGetter(): void
{
    global $imagesAll;
    $imageFlag = false;
    global $card;
    // Check if image exists
    foreach ($imagesAll as $key => $value) {
        if (!empty($card['name'])) {
            if (strtolower($card['name']) == $value[0]) {
                $imageFlag = true;
            }
        }
    }

    // If image doesn't exist use placeholders
    if (!$imageFlag) {
        global $image;
        $image = "null-card";
    } else {
        global $image;
        $image = $card['name'];
    }
}

function newCard(): void
{
    if (count($_POST) > 0) {

        global $card;

        if ($_POST['cardName'] == "" | $_POST['cardName'] == null) {
            $_POST['cardName'] = $card['name'];
        }

        if ($_POST['cardType'] == "" | $_POST['cardType'] == null) {
            $_POST['cardType'] = $card['type'];
        }

        if ($_POST['cardCost'] == "" | $_POST['cardCost'] == null) {
            $_POST['cardCost'] = $card['cost'];
        }

        if ($_POST['cardValue'] == "" | $_POST['cardValue'] == null) {
            $_POST['cardValue'] = $card['value'];
        }

        if ($_POST['cardWebsite'] == "" | $_POST['cardWebsite'] == null) {
            $_POST['cardWebsite'] = $card['website'];
        }

        $_POST['cardName'] = strtolower($_POST['cardName']);
        $_POST['cardType'] = strtolower($_POST['cardType']);
        $_POST['cardCost'] = strtolower($_POST['cardCost']);
        $_POST['cardValue'] = strtolower($_POST['cardValue']);
        $_POST['cardWebsite'] = strtolower($_POST['cardWebsite']);

        $conn = mysqli_connect("localhost", "root", "", "airasiadb");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        global $id;
        $result = mysqli_query($conn, "UPDATE cards SET 
                 name = '" . $_POST['cardName'] . "',
                 type = '" . $_POST['cardType'] . "',
                 cost = '" . $_POST['cardCost'] . "',
                 value = '" . $_POST['cardValue'] . "',
                 website = '" . $_POST['cardWebsite'] . "'
                 WHERE id = '" . $id. "'");
//        TODO WRITE ALL THE SAME EXCEPTION

        if ($result) {
            $_SESSION['returnCode'] = "Card Successfully Updated Redirecting in 2 Seconds";
            sleep(2);
            header("location: Card-Details.php?id=" . $_SESSION['cardid']);
        } else {
            $_SESSION['returnCode'] = "An error Occurred while updating gift card";
        }

    }
}
