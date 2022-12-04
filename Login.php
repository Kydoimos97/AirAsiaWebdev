<?php
session_start();

// Reset Message
$_SESSION['message'] = "";

// If key's don't exist set them to empty string
if (!isset($_SESSION['userName'])) {
    $_SESSION['userName'] = "";
}

if (!isset($_SESSION['displayName'])) {
    $_SESSION['displayName'] = "";
}

// Redirect user when they are not logged in
if (isset($_SESSION["AuthSession"]) && $_SESSION["AuthSession"] != "" && isset($_SESSION['userName']) && $_SESSION['userName'] != ""){
    header("refresh:0;url=MyAccount.php");
}

// Run Auth User when the login button has been clicked
if (isset($_POST['logIn']) | array_key_exists('logIn', $_POST)) {
    require_once ("SourceCode/Func/Login.php");
    logIn();
}

// Logout Login
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['clearCookie'])) {
    require_once("SourceCode/Func/logOut.php");
    logOut();
}
?>

<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Login</title>

    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <!--CSS -->
    <link rel="stylesheet" href="MainStyle.css">

    <!-- Fonts -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"></script>

</head>

<body onload="checkCookie()">
<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <p class="h3-sidebar">Navigation</p>
        </div>

        <ul class="list-unstyled components">
            <li>
                <a href="Index.php">Home</a>
            </li>
            <li>
                <a href="Flights.php">Flights</a>
            </li>
            <li>
                <a href="Card-List.php">Cards</a>
            </li>
            <li>
                <a href="Login.php">My Account</a>
            </li>
            <?php if (isset($_SESSION["AuthSession"]) && $_SESSION['displayName'] != "") {
                echo '<li><br><br></li>            
            <li>
            <div class="text-center pt-1 mb-2 pb-0 w-75 center-block">
                <form action="Index.php" method="post">
                    <button class="btn btn-primary btn-block default-button-main"
                            type="submit" name = "clearCookie" id = "clearCookie"
                            value = "GO">Log Out</button>
                    </form>
                </div>
            </li>';
            } ?>
            <?php if (strtolower($_SESSION['userRole']) == "admin") {
                echo '           
            <li>
                <div class="text-center pt-3 mb-2 mt-3 pb-0 w-75 center-block">
                    <form action="AdminPage.php" method="post">
                        <button class="btn btn-primary btn-block default-button-main"
                                type="submit" name = "clearCookie" id = "clearCookie"
                                value = "GO" style = "border-radius: 15px">Admin Page</button>
                    </form>
                </div>
            </li>';
            } ?>
        </ul>
    </nav>


    <!-- Page Content  -->
    <div id="content_hidden">

        <!-- Navbar -->
        <nav class="navbar-default">
            <div class="container-fluid">
                <!--        left side of navbar-->
                <div class="nav navbar-left">
                    <ul class="nav navbar-left">
                        <li><a href="#null" class="a-navbar">
                                <span class="glyphicon glyphicon-align-justify glyph-center"
                                      id="sidebarCollapse"></span></a></li>
                    </ul>
                </div>

                <!--        navbar logo-->
                <div class="nav navbar-brand navbar-brand-logo">
                    <img src="CSS/Images/AAlogo.png" alt="Airasia Logo" width="97" height="40">
                </div>

                <!--        Right Side of Navbar-->
                <div class="navbar-right" id="cartAccount">
                    <ul class="nav navbar-right">
                        <li>
                            <a href="shoppingCart.php" class="navbar-user-text">
                                <div class="container d-inline-flex">
                                    <div class="row m-auto">
                                        <span class="glyphicon glyphicon-shopping-cart glyph-center-no-color"></span>
                                        <?php
                                        if ($_SESSION['userName'] != "") {
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
                                        ?>
                                        <p><?php echo $cart_count; ?></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="MyAccount.php" class="navbar-user-text">
                                <div class="container d-inline-flex">
                                    <div class="row m-auto">
                                        <span class="glyphicon glyphicon-user glyph-center-no-color"></span>
                                        <p><?php if ($_SESSION['displayName'] != "") {
                                                echo $_SESSION['displayName'];
                                            } ?></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!--login-->
        <!--        This means it is a container with 100% height and a default background-->
        <div class="pt-5"></div>
        <section class="container background-default">

            <!--    create main container-->
            <!--            py-lg-5 100 means a padded div with 100% width-->
            <div class="container py-lg-5">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-xl-12">
                        <!--                create content container-->
                        <div class="card rounded-3 text-black">
                            <div class="row g-0">
                                <!--                        Set column size-->
                                <div class="col-lg-6">
                                    <div class="card-body p-md-5 mx-md-4">
                                        <!--                                Logo-->
                                        <div class="text-center">
                                            <img src="CSS/Images/AAlogo.png"
                                                 style="width: 185px;" alt="logo">
                                        </div>
                                        <!--                                create login form-->
                                        <div class="phppot-container tile-container">
                                            <form name="frmUser" method="post" action="">
                                                <br>
                                                <div class="message text-center"><?php if ($_SESSION['message'] != "") {
                                                        echo $_SESSION['message'];
                                                    } ?></div>
                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="username">Username:</label>
                                                    <input id="username" class="form-control" name="userName"
                                                           placeholder="Email Adress"/>
                                                </div>

                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="password">Password:</label>
                                                    <input type="password" id="password" name="password"
                                                           placeholder="Password" class="form-control"/>
                                                </div>
                                                <!--                                    Login Button-->
                                                <div class="text-center pt-1 mb-2 pb-0">
                                                    <button class="btn btn-primary btn-block default-button-main"
                                                            type="submit" name="logIn" value="Run">Log in
                                                    </button>
                                                </div>
                                                <!--                                    forgot password-->
                                                <div class="text-center pt-1 mb-5 pb-0">
                                                    <a class="text-muted-site" href="UnderConstruction.html"> Forgot
                                                        password?</a>
                                                </div>
                                                <!--                                    create account-->
                                                <div class="d-flex align-items-center justify-content-center pb-4">
                                                    <p class="mb-0 me-2 text-padded">Don't have an account?</p>
                                                    <button type="submit" class="btn default-button-muted"
                                                            formaction="CreateAccount.php">Create new
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--                        Side image-->
                                <div class="col-lg-6">
                                    <img src="CSS/Images/backgroundegypt.png" class="img-responsive"
                                         alt="Destination Egypt">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>


<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>

<script type="text/javascript">
    window.onload = function () {
        $('#sidebar').addClass('no-transition').toggleClass('active')
    };
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').removeClass('no-transition').toggleClass('active');
        });
        // $("#sidebarCollapse").trigger('click')
    });

</script>
</body>

</html>



