<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['clearCookie'])) {
    func();
}
function func(): void
{
    unset($_SESSION["AuthSession"]);
    unset($_SESSION['userName']);
    unset($_SESSION['displayName']);
    setcookie("AuthCookie", '', time() - 3600, "/");
    $_SESSION['displayName'] = "";
    header("refresh:0;url=Login.php");
}

?>

<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>DEBUG TITLE</title>

    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <!--CSS -->
    <link rel="stylesheet" href="MainStyle.css">

    <!-- Fonts -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"></script>
</head>

<body>
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
            <?php if (isset($_SESSION['displayName']) && isset($_SESSION["AuthSession"]) && $_SESSION['displayName'] != "") {
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

        <!--Main Content-->
        <section class="container w-100 h-100">
            <!--      Slide show-->
            <div class="crossfade">
                <figure></figure>
                <figure></figure>
                <figure></figure>
                <figure></figure>
                <figure></figure>
            </div>
            <div class="row h-15" style="height: 7rem"></div>
            <div class="row h-15 border-0 background-darkened">

                <div class="col-sm-1 background-transparent d-flex m-auto">
                    <button onclick="history.back()" class="return-button bord">
                        <span class="glyphicon glyphicon-chevron-left glyphicon-align-center text-white"></span>
                    </button>
                </div>
                <div class="col-sm-10 background-transparent pb-3 pt-3 ">
                    <div class="card w-75 page-title border-0 center-block ">
                        <p class="page-title pt-3 pb-3 border-bottom text-white">Book Your flight</p>
                    </div>
                </div>
                <div class="col-sm-1 background-transparent"></div>
                <!--        Form-->
                <div class="col-sm-3 background-transparent pb-5 pt-3 text-center text-white" style="height: 7rem">
                    <div class="pr-4 border-right">
                        <label class="form-label">Origin:</label>
                        <label for="origin"></label><input id="origin" placeholder="Origin" class="form-control"/>
                    </div>
                </div>
                <div class="col-sm-3 background-transparent pb-5 pt-3 text-center text-white" style="height: 7rem">
                    <div class="pr-4 border-right">
                        <label class="form-label">Destination:</label>
                        <label for="destination"></label><input id="destination" placeholder="Destination"
                                                                class="form-control"/>
                    </div>
                </div>
                <div class="col-sm-3 background-transparent pb-5 pt-3 text-center text-white" style="height: 7rem">
                    <div class="pr-4 border-right">
                        <label class="form-label pb-0 m-0">Class:</label>
                        <br>
                        <label class="radio-inline my-3"><input type="radio" name="classradio">Business Class</label>
                        <label class="radio-inline"><input type="radio" name="classradio" checked>Economy</label>
                    </div>
                </div>
                <div class="col-sm-3 background-transparent text-center text-white" style="height: 7rem">
                    <div class="pr-4">
                        <label class="form-label pt-3 pb-0 m-0">Transfers:</label>
                        <br>
                        <label class="radio-inline my-3"><input type="radio" name="optradio" checked>Direct</label>
                        <label class="radio-inline"><input type="radio" name="optradio">Max One</label>
                        <label class="radio-inline"><input type="radio" name="optradio">Any Amount</label>
                    </div>
                </div>
                <div class="col-sm-4 background-transparent pb-3 pt-3 " style="height: 5rem"></div>
                <div class="col-sm-4 background-transparent pb-3 pt-3 " style="height: 5rem">
                    <div class="text-center w-100 h-100 m-auto pb-2">
                        <a href="UnderConstruction.html">
                            <button class="btn btn-primary btn-block default-button-main justify-content-end"
                                    style="padding: 2%"
                                    type="button">Book Flight
                            </button>
                        </a>
                    </div>
                </div>
                <div class="col-sm-4 background-transparent pb-3 pt-3 " style="height: 4rem"></div>
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