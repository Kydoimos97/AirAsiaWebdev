<?php
session_start();
global $image;
require ("SourceCode/Func/cardDetail.php");
dbConnect();
placeHolder();
imageGetter();

function addCart(): void {
    addCartFunc();
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

<body class=content_hidden>
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
            <?php if (isset($_SESSION['userRole']) && strtolower($_SESSION['userRole']) == "admin") {
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
    <div id="content">

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
        <section class="container w-75 h-100 background-default p-5">
            <div class="container py-lg-5">
                <div class="row d-flex justify-content-center align-items-baseline h-95">
                    <div class="col-xl-10">

                        <div class="card rounded-3 text-black ">
                            <div class="row g-0">
                                <div class="card w-5 transparent-divider border-0 d-flex justify-content-center">
                                    <button onclick="history.back()" class="return-button bord">
                                        <span class="glyphicon glyphicon-chevron-left glyphicon-align-center"></span>
                                    </button>
                                </div>
                                <div class="card w-90 page-title border-0 center-block ">
                                    <p class="detail-title pt-3 pb-3 border-bottom">Gift card detail</p>
                                </div>
                                <div class="card w-5 transparent-divider border-0 d-flex justify-content-center">
                                    <a href= <?php echo 'Card-Update.php?id=' . $card['id']; ?>>
                                        <button class="return-button bord">
                                            <span class="glyphicon glyphicon-edit glyphicon-align-center"></span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="row g-0">
                                <div class="col-lg-6 d-flex border-right">
                                    <div class="card-body p-md-4 mx-md-4 card-detail-picture">
                                        <img alt="Brand Image" class="img-responsive"
                                             src=<?php echo 'CSS/Images/Brands/' . $image . '.png'; ?>>
                                    </div>
                                </div>
                                <div class="col-lg-6 h-90">
                                    <p class="detail-title pt-3"><?php echo ucfirst($card['name']) . " " . ucfirst($card['type']); ?></p>
                                    <div class="card-body p-md-4 mx-md-4">
                                        <div class="row g-0 pt-1">
                                            <div class="card w-25 card-detail-identifier">
                                                <p>Card Name</p>
                                            </div>
                                            <div class="card w-75 card-detail-text">
                                                <p><?php echo ucfirst($card['name']); ?></p>
                                            </div>
                                        </div>
                                        <div class="row g-0 pt-5">
                                            <div class="card w-25 card-detail-identifier">
                                                <p>Card Type</p>
                                            </div>
                                            <div class="card w-75 card-detail-text">
                                                <p><?php echo ucfirst($card['type']); ?></p>
                                            </div>
                                        </div>
                                        <div class="row g-0 pt-5">
                                            <div class="card w-15 pr-0 card-detail-identifier m-0">
                                                <p>Point Cost</p>
                                            </div>
                                            <div class="card w-25 card-detail-text-divided m-0">
                                                <p><?php echo ucfirst($card['cost']); ?></p>
                                            </div>
                                            <div class="card w-0 transparent-divider mx-auto">
                                            </div>
                                            <div class="card w-15 card-detail-identifier m-0">
                                                <p>Value</p>
                                            </div>
                                            <div class="card w-25 card-detail-text-divided m-0">
                                                <p><?php echo "$" . ucfirst($card['value']); ?></p>
                                            </div>
                                        </div>
                                        <div class="row g-0 pt-5">
                                            <div class="card w-25 card-detail-identifier">
                                                <p>Website</p>
                                            </div>
                                            <div class="card w-75 card-detail-text">
                                                <p><?php echo $card['website']; ?></p>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <p class="pt-4 text-center"><?php echo $pointsString; ?></p>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="text-center w-100 pt-2">
                                                <form action="" method="post">
                                                    <button class="btn btn-primary btn-block default-button-main"
                                                            type="submit" name="addCart" value="Submit">Add to cart
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card h-10 pt-4 text-black border-0">
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