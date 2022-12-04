<?php
// database connection
function dbConnect(): void
{
    global $card;
    global $user;
    global $conn;

    $id = substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], "=") + 1);
    $conn = mysqli_connect("localhost", "root", "", "airasiadb");

    // Get product data
    $result = mysqli_query($conn, "SELECT * FROM `cards` WHERE id = '" . $id . "'");
    $card = mysqli_fetch_array($result);

    //Get user points
    $result = mysqli_query($conn, "SELECT * FROM `users` WHERE userName = '" . $_SESSION['userName'] . "'");
    $user = mysqli_fetch_array($result);
}

function placeHolder(): void
{
    global $card;
    global $user;
    if ($card['name'] == null | empty($card['name'])) {
        $card['name'] = "gift card";
    }

    if ($card['website'] == null | empty($card['website'])) {
        $card['website'] = "--unknown--";
    }

    $pointsString = "";
    /** @noinspection PhpIfWithCommonPartsInspection */
    if ($user == null) {
        global $pointsString;
        $pointsString = "";
    } else {
        global $pointsString;
        $pointsString = "You have " . $user["points"] . " points available";
    }
}

// images
function imageGetter(): void
{
    global $card;
    global $conn;
    global $image;
    $result = mysqli_query($conn, "SELECT name_ref FROM `images`");
    $imagesAll = mysqli_fetch_all($result);
    $imageFlag = false;

    foreach ($imagesAll as $key => $value) {
        if (strtolower($card['name']) == $value[0]) {
            $imageFlag = true;
        }
    }

    if (!$imageFlag) {
        $image = "null-card";
    } else {
        $image = $card['name'];
    }


    if (isset($_POST['addCart']) | array_key_exists('addCart', $_POST)) {
        addCart();
    }
}


function addCartFunc(): void
{
    global $conn;
    global $user;
    global $id;

    $id = substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], "=") + 1);

    $result = mysqli_query($conn, "SELECT * FROM cart WHERE cardid = $id and userid = '" . $user['userId'] . "'");

    if (!empty($result) && $result->num_rows > 0) {
        $result = mysqli_fetch_array($result);
        $quantity = strval(intval($result['quantity']) + 1);

        $result = mysqli_query($conn, "UPDATE cart SET quantity =  $quantity WHERE cardid = $id and userid = '" . $user['userId'] . "'");
    } else {
        $user_id = $user['userId'];
        $result = mysqli_query($conn, "INSERT INTO cart (userid, cardid, quantity) VALUES ($user_id, $id , 1)");
    }
}

