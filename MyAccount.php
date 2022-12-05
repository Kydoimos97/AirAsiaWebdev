<?php
session_start();
$userName = "";
$passWord = "";
global $userData;
$conn = mysqli_connect("localhost", "root", "", "airasiadb");
$sql = "SELECT * FROM users where userName = '" . $_SESSION['userName'] . "'";
$result = mysqli_query($conn, $sql);
$userData = mysqli_fetch_array($result);

require_once("SourceCode/Func/Auth.php");
AuthtoLogin();

// Connect to the database and get the userdata
if (isset($_POST['updateUser']) | array_key_exists('updateUser', $_POST)) {
    $conn = mysqli_connect("localhost", "root", "", "airasiadb");
    $sql = "SELECT * FROM users where userName = '" . $_SESSION['userName'] . "'";
    $result = mysqli_query($conn, $sql);
    $userData = mysqli_fetch_array($result);
    require_once("SourceCode/Func/passwordChecker.php");
    accountCheck($userData);
}

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

    <!--Check login cookie-->
    <script>
        function checkCookie() {
            if (document.cookie === false) {
                $('#x').text("No Cookie.");
            } else if (document.cookie.indexOf("expires") >= 0) {
                $('#x').text("You have Cookie.");
            }
        }
    </script>
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
            <?php if (isset($_SESSION["AuthSession"])) {
                echo '<li><br><br></li>            
            <li>
            <div class="text-center pt-1 mb-2 pb-0 w-75 center-block">
                <form action="" method="post">
                    <button class="btn btn-primary btn-block default-button-main"
                            type="submit" name = "clearCookie" id = "clearCookie"
                            value = "Run">Log Out</button>
                    </form>
                </div>
            </li>';
            } ?>
            <?php if (isset($_SESSION['userRole']) && $_SESSION['userRole'] == "admin") {
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
                                        require_once ("SourceCode/Func/shoppingCart.php");
                                        $cart_count = shoppingCart();
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
                                        <p><?php if (isset($_SESSION['displayName']) && $_SESSION['displayName'] != "") {
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
                                <div class="center-block p-5">
                                    <img class=img-responsive src="CSS/Images/AAlogo.png"
                                         style="max-height: 15rem;" alt="logo">
                                </div>
                            </div>
                            <div class="row g-0">
                                <div class=col-1></div>
                                <div class=col-10>
                                    <div class="card w-50 page-title border-0 center-block d-flex">
                                        <p class="page-title pt-3 pb-3 border-bottom"><?php if (isset($_SESSION['userName']) && $_SESSION['userName'] != "") echo "User Information for: " . ucfirst($_SESSION["userName"]); ?></p>
                                    </div>
                                </div>
                                <div class=col-1></div>
                            </div>
                            <div class="row g-0">
                                <!--                        Set column size-->
                                <form class=w-100 name="frmUser" method="post" action="">
                                    <div class="col-lg-6">
                                        <div class="card-body p-md-5 mx-md-4">
                                            <!--                                Logo-->
                                            <!--                                create login form-->
                                            <div class="phppot-container tile-container">
                                                <div class="form-outline mb-4 border-bottom">
                                                    <p class="disabled font-weight-bold" style="text-align: center">
                                                        Security:</p>
                                                </div>
                                                <!--Password-->
                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="password"> New Password:</label>
                                                    <input type="password" name="password"
                                                           placeholder="Password" class="form-control">
                                                </div>

                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="passwordConfirm">Confirm New
                                                        Password:</label>
                                                    <input type="password" name="passwordConfirm"
                                                           placeholder="Password" class="form-control">
                                                </div>
                                                <!--Security Phrase-->
                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="passwordConfirm">Security
                                                        Phrase:</label>
                                                    <input class="form-control" name="security"
                                                        <?php global $userData; if (isset($userData) && !empty($userData['security'])) echo "value = '" . $userData["security"] . "'"; ?>>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--                        Side image-->
                                    <div class="col-lg-6">
                                        <div class="card-body p-md-5 mx-md-4">
                                            <div class="form-outline mb-4 border-bottom">
                                                <p class="disabled font-weight-bold" style="text-align: center">
                                                    Address:</p>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="passwordConfirm">Adress Line:</label>
                                                <input class="form-control" name="adress"
                                                    <?php if (isset($userData) && !empty($userData['adress'])) echo "value = '" . $userData["adress"] . "'"; ?>>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="passwordConfirm">City:</label>
                                                <input class="form-control" name="city"
                                                    <?php if (isset($userData) && !empty($userData['city'])) echo "value = '" . $userData["city"] . "'"; ?>>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <div class=row>
                                                    <div class=col>
                                                        <label class="form-label" for="passwordConfirm">State:</label>
                                                        <select class="form-control"
                                                                style="height: 60%; box-sizing: border-box"
                                                                name="state">
                                                            <option value=""><?php if (isset($userData) && !empty($userData['state'])) echo $userData["state"]; else echo "N/A"; ?></option>
                                                            <option value="AK">Alaska</option>
                                                            <option value="AL">Alabama</option>
                                                            <option value="AR">Arkansas</option>
                                                            <option value="AZ">Arizona</option>
                                                            <option value="CA">California</option>
                                                            <option value="CO">Colorado</option>
                                                            <option value="CT">Connecticut</option>
                                                            <option value="DC">District of Columbia</option>
                                                            <option value="DE">Delaware</option>
                                                            <option value="FL">Florida</option>
                                                            <option value="GA">Georgia</option>
                                                            <option value="HI">Hawaii</option>
                                                            <option value="IA">Iowa</option>
                                                            <option value="ID">Idaho</option>
                                                            <option value="IL">Illinois</option>
                                                            <option value="IN">Indiana</option>
                                                            <option value="KS">Kansas</option>
                                                            <option value="KY">Kentucky</option>
                                                            <option value="LA">Louisiana</option>
                                                            <option value="MA">Massachusetts</option>
                                                            <option value="MD">Maryland</option>
                                                            <option value="ME">Maine</option>
                                                            <option value="MI">Michigan</option>
                                                            <option value="MN">Minnesota</option>
                                                            <option value="MO">Missouri</option>
                                                            <option value="MS">Mississippi</option>
                                                            <option value="MT">Montana</option>
                                                            <option value="NC">North Carolina</option>
                                                            <option value="ND">North Dakota</option>
                                                            <option value="NE">Nebraska</option>
                                                            <option value="NH">New Hampshire</option>
                                                            <option value="NJ">New Jersey</option>
                                                            <option value="NM">New Mexico</option>
                                                            <option value="NV">Nevada</option>
                                                            <option value="NY">New York</option>
                                                            <option value="OH">Ohio</option>
                                                            <option value="OK">Oklahoma</option>
                                                            <option value="OR">Oregon</option>
                                                            <option value="PA">Pennsylvania</option>
                                                            <option value="PR">Puerto Rico</option>
                                                            <option value="RI">Rhode Island</option>
                                                            <option value="SC">South Carolina</option>
                                                            <option value="SD">South Dakota</option>
                                                            <option value="TN">Tennessee</option>
                                                            <option value="TX">Texas</option>
                                                            <option value="UT">Utah</option>
                                                            <option value="VA">Virginia</option>
                                                            <option value="VT">Vermont</option>
                                                            <option value="WA">Washington</option>
                                                            <option value="WI">Wisconsin</option>
                                                            <option value="WV">West Virginia</option>
                                                            <option value="WY">Wyoming</option>
                                                            <!--                                                        https://gist.github.com/RichLogan/9903043-->
                                                        </select>
                                                    </div>
                                                    <div class=col>
                                                        <label class="form-label" for="passwordConfirm">Zip
                                                            Code:</label>
                                                        <input class="form-control" name="zip" placeholder="Zip"
                                                            <?php if (isset($userData) && !empty($userData['zip'])) echo "value = '" . $userData["zip"] . "'"; ?>>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--                                    Submit Button-->
                                        </div>
                                    </div>

                                    <div class="row"
                                    ">
                                    <div class="col-2"></div>
                                    <div class="col-8 border-top my-auto pt-2" style="text-align: center">
                                        <p><?php if (isset($_SESSION['messageAccount']) && !empty($_SESSION['messageAccount'])) echo $_SESSION["message"] ?></p>
                                    </div>
                                    <div class="col-2"></div>
                            </div>
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-8">
                                    <div class="text-center mx-auto pt-3 mb-2 pb-5 w-50">
                                        <button class="btn btn-primary btn-block default-button-main"
                                                type="submit" name="updateUser" value="Submit">Update User
                                        </button>
                                    </div>
                                </div>
                                <div class="col-2"></div>
                            </div>
                            <div class="row">
                                <div class="col-9"></div>
                                <div class="col-3">
                                    <div class="text-center mx-auto pt-3 mb-2 pb-5 w-50">
                                        <form action="" method="post">
                                            <button class="btn btn-primary btn-block default-button-muted"
                                                    type="submit" name = "clearCookie" id = "clearCookie"
                                                    value = "Run">Log Out</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            </form>

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



