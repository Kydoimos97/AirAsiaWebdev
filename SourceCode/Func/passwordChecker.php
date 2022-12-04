<?php

function accountCheck(array $userData): void
{
    if ($_POST['updateUser'] == "Submit") {
        $setString = "";
        foreach ($userData as $key => $value) {
            if (!is_integer($key)) {
                if (!empty($_POST[$key]) | $key != "state") {
                    if (!in_array($key, array("userId", "userName", "displayName", "points", "password", "state"))) {
                        if ($value != $_POST[$key]) {
                            if (strlen($setString > 0)) {
                                $setString = $setString . " , $key = \"$_POST[$key]\"";
                            } else {
                                $setString = "$key = \"$_POST[$key]\"";
                            }
                        }
                    }

                    if ($key == "password") {
                        if (!empty($_POST['password'])) {
                            $passHash = passChecker($_POST['password'], $_POST['passwordConfirm']);
                            $setString = "$key = \"$passHash\"";
                        }
                    }

                    if ($key == "state") {
                        if (!empty($_POST[$key])) {
                            if ($value != $_POST[$key]) {
                                if (strlen($setString > 0)) {
                                    $setString = $setString . " , $key = \"$_POST[$key]\"";
                                } else {
                                    $setString = "$key = \"$_POST[$key]\"";
                                }
                            }
                        }
                    }
                } else {
                    $_SESSION["message"] = "Empty " . ucfirst($key) . " value detected please try again";
                }
            }
        }

        if (strlen($setString > 0)) {
            $userName = $_SESSION['userName'];
            $sqlString = "UPDATE users SET $setString WHERE userName = " . "\"$userName\"";
            $conn = mysqli_connect("localhost", "root", "", "airasiadb");
            $result = mysqli_query($conn, $sqlString);
            if ($result) {
                $_SESSION["message"] = "Update Successful";
            } else {
                $_SESSION["message"] = "Database connection error occurred please try again";
            }
        } elseif ($_SESSION["message"] == "Passwords don't match") {
            $_SESSION["message"] = "Passwords don't match";
        } else {
            $_SESSION["message"] = "No values changed";
        }
        header("Refresh:0");
    }
}
    
                
                
                        

function passChecker(String $passWord, String $confirmPass): String
{

    $uppercaseFlag = preg_match('@[A-Z].*[A-Z]@', $passWord); // Two Upper case needed
    $lowercaseFLag = preg_match('@[a-z].*[A-Z]@', $passWord); // Two lower case needed
    $numberFlag = preg_match('@[0-9].*[0-9]@', $passWord);
    $specialCharsFlag = preg_match('@[^\w].*[^\w]@', $passWord);
    $lengthFlag = strlen($passWord) > 10;

    if (!$uppercaseFlag || !$lowercaseFLag || !$numberFlag || !$specialCharsFlag || !$lengthFlag) {
        $_SESSION['message'] = "Password needs at least 2 uppercase, lowercase, numbers, and special characters.";
        return "false";
    } else {
        if ($passWord != $confirmPass) {
            $_SESSION['message'] = "Passwords do not match";
            return "false";
        } else {
            return password_hash($passWord, PASSWORD_DEFAULT);
        }
    }
}

