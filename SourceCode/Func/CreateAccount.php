<?php

function updateUser(): void
{
    $_SESSION['message'] = "";
    $incompleteFlag = false;
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $incompleteFlag = true;
        }
    }

    if (!$incompleteFlag) {
        if (isset($_POST['password']) && isset($_POST['passwordConfirm']) && $_POST['password'] != "Password" && !empty($_POST['password'])) {
            $passWord = $_POST['password'];
            $passWordConfirm = $_POST['passwordConfirm'];
            include_once("passwordChecker.php");
            $passHash = passChecker($passWord, $passWordConfirm);
            if ($passHash != "false" && !empty($passHash)) { //Check if this doesn't give an error
                createUser();
            }
        } elseif (isset($_POST['password']) && $_POST['password'] === "") {
            $_SESSION["message"] = "Passwords do not match";
        }

    } else {
        $_SESSION["message"] = "All fields are required";
    }
}

function createUser(): void
{
    $_SESSION['message'] = "";
    // Connect to DB
    $conn = mysqli_connect("localhost", "root", "", "airasiadb");
    if ($conn->connect_error) {
        $_SESSION['message'] = "An error Occurred while creating user";
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the username is valid
    $userName = $_POST['userName'];
    $emailFlag = false;

    if (filter_var($userName, FILTER_VALIDATE_EMAIL)) {
        if (str_contains(strtolower($userName), "admin")) {
            $_SESSION["message"] = "Email contains forbidden substring";
        } else {
            $emailFlag = true;
        }
    } else {
        $_SESSION["message"] = "Email is not valid";
    }

    // Update user
    if ($emailFlag) {
        $result = mysqli_query($conn, "SELECT * FROM `users` WHERE userName = '" . $userName . "'");
        if ($result->num_rows > 0) {
            $passWord = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $displayName = ucfirst(strtok($userName, '@'));
            $result = mysqli_query($conn, "INSERT INTO users (userName, password, displayName, security, adress, city, state, zip, points, role) VALUES ('" . $userName . "', '" . $passWord . "', '" . $displayName . "', '" . $_POST['securityPhrase'] . "', '" . $_POST['adressLine'] . "' , '" . $_POST['cityInp'] . "', '" . $_POST['state'] . "', '" . $_POST['zip'] . "',  0, 'user')");
            if ($result) {
                $_SESSION['message'] = "User Successfully Created, redirecting in 2 seconds";
                header("refresh:2;url=Login.php");
            } else {
                $_SESSION['message'] = "An error Occurred while creating user";
            }
        } else {
            $_SESSION['message'] = "Account already exists with the given email";
        }
    } else {
        $_SESSION['message'] = "User creation failed try again";
    }
}
