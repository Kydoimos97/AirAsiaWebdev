<?php

function shoppingCart(): string|null
{
    if (isset($_SESSION['userName']) && $_SESSION['userName'] != "") {
        $conn = mysqli_connect("localhost", "root", "", "airasiadb");
        $result = mysqli_query($conn, "SELECT userid FROM `users` where userName = '" . $_SESSION['userName'] . "'");
        $users = mysqli_fetch_array($result);
        $conn = mysqli_connect("localhost", "root", "", "airasiadb");
        $sql = "SELECT SUM(quantity) FROM `cart` WHERE userid = '" . $users['userid'] . "' GROUP BY userid";
        $cart_count = mysqli_fetch_array(mysqli_query($conn, $sql));
        if (isset($cart_count) && !empty($cart_count)) {
            $cart_count = $cart_count['SUM(quantity)'];
        } else $cart_count = "";
    } else $cart_count = "";

    return $cart_count;

}
