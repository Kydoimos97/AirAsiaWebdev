<?php
session_start();

require_once("SourceCode/Func/Auth.php");
AuthtoLogin();

$conn = mysqli_connect("localhost", "root", "", "airasiadb");
$sql = "SELECT * FROM `cards`";
$all_cards = mysqli_query($conn, $sql);


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
        <div class="pt-5"></div>
        <section class="container w-75 pb-0 pr-5 pl-5 background-default">
            <div class="card rounded-3 text-black border-0">
                <div class="row background-default">
                    <div class="card w-5 transparent-divider border-0 justify-content-center">
                        <button onclick="history.back()" class="return-button bord">
                            <span class="glyphicon glyphicon-chevron-left glyphicon-align-center"></span>
                        </button>
                    </div>
                    <div class="card w-50 page-title border-0 center-block d-flex">
                        <p class="page-title pt-3 pb-3 border-bottom">Gift card shop</p>
                    </div>
                    <div class="card w-5 transparent-divider border-0 d-inline-flex justify-content-center">
                        <a href="Card-Add.php">
                            <button class="return-button bord">
                                <span class="glyphicon glyphicon-edit glyphicon-align-center"></span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="container w-75 h-90 background-default p-5">

            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php
                while ($card = mysqli_fetch_array(
                    $all_cards, MYSQLI_ASSOC)):
                    ?>
                    <?php if ($card['name'] == null) {
                    $card['name'] = "giftcard";
                } ?>
                    <div class="col-4 pb-5">
                        <a class="custom-card" href=<?php echo 'Card-Details.php?id=' . $card['id']; ?>>
                            <div class="card h-200 card-d" style="height: 30rem">
                                <div class="card-body p-md-4 mx-md-4 h-75 card-picture border-bottom d-flex">

                                    <!--                              String Searching for images-->
                                    <?php
                                    global $conn;
                                    $result = mysqli_query($conn, "SELECT * FROM `images` WHERE name_ref like '" . strtolower($card['name']) . "'");
                                    $cardImageSub = "";
                                    if (mysqli_num_rows($result) == 0) {
                                        $allNames = mysqli_query($conn, "SELECT * FROM `images`");
                                        while ($card2 = mysqli_fetch_array($allNames, MYSQLI_ASSOC)):
                                            {
                                                if (str_contains(strtolower($card['name']), strtolower($card2['name_ref']))) {
                                                    $cardImageSub = $card2['img_src'];
                                                }
                                            } endwhile;

                                        if ($cardImageSub != "") {
                                            $cardImage = $cardImageSub;
                                        } else {
                                            $cardImage = "null-card.png";
                                        }
                                    } else {
                                        $tempArray = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                        $cardImage = ($tempArray['img_src']);
                                    }
                                    ?>
                                    <!--suppress HtmlUnknownTarget, RequiredAttributes -->
                                    <img alt="Brand image" class="card-picture"
                                         alt=<?php echo 'CSS/Images/Brands/' . $cardImage; ?> src=<?php echo 'CSS/Images/Brands/' . $cardImage; ?>>
                                </div>
                                <div class="card-body h-25">
                                    <p class="card-text"><?php echo "Value = $" . $card['value'] . "  |  " . "Cost = " . $card['cost'] . " pts"; ?></p>
                                    <h5 class="h5-card"><?php echo ucfirst($card['name']) . " " . ucfirst($card['type']); ?></h5>
                                </div>
                            </div>
                    </div>
                    <option value="<?php echo $card["id"]; ?>">
                    </option>
                <?php
                endwhile;
                // While loop must be terminated
                ?>
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