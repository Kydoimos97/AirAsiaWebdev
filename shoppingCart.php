<?php
session_start();

if (!isset($_SESSION['userName'])) {
    header("Location: Login.php");
}
$counter = 0;
$conn = mysqli_connect("localhost", "root", "", "airasiadb");
$result = mysqli_query($conn, "SELECT userid FROM `users` where userName = '" . $_SESSION['userName'] . "'");
$users = mysqli_fetch_array($result);

$userId = $users['userid'];
$sql = "SELECT * FROM `cart` WHERE userid = '" . $users['userid'] . "'";
$cart_items = mysqli_query($conn, $sql);

if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['clearCookie'])) {
    func();
}

if (isset($_GET['updateCart']) | array_key_exists('updateCart', $_GET)) {
    updateCart();

} else {
    global $id_array;
    $id_array = array();
}


if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['clearCookie'])) {
    require_once("SourceCode/Func/logOut.php");
    logOut();
}


function updateCart(): void
{
    global $userId;

    $conn = mysqli_connect("localhost", "root", "", "airasiadb");
    $quantityArray = isset($_GET['quantity']) && is_array($_GET['quantity']) ? $_GET['quantity'] : array();
    $id_array = $_SESSION['idArray'];
    $counter = 0;
    /** @noinspection PhpUnusedLocalVariableInspection */
    foreach ($quantityArray as $key => $value) {
        $quantity = $value;
        if ($quantity != 0) {
            mysqli_query($conn, "UPDATE cart SET quantity = $quantity WHERE cardid = $id_array[$counter] and userid = $userId");
        } else {
            mysqli_query($conn, "DELETE FROM cart WHERE cardid = $id_array[$counter] and userid = $userId");
        }
        $counter++;

    }

    header("Location: ProductCart.php");
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
            <div class=row><br><br></div>
            <div class=row>
                <div class="col-2 p-0"></div>
                <div class="col-8 p-0">
                    <div class="card bg-light mb-3 mt-5" style="min-width: 10rem;">
                        <div class="page-title text-center mx-auto pt-2">Cart</div>
                        <div class="card-body">
                            <form class=w-100 style="display: inline-block" method="get" action="">
                                <?php
                                $total = 0;
                                while ($cart = mysqli_fetch_array(
                                    $cart_items, MYSQLI_ASSOC)):
                                    global $id_array;
                                    $id_array[] = $cart['cardid'];
                                    ?>
                                    <?php
                                    if ($cart['quantity'] == 0) {
                                        continue;
                                    }
                                    $conn = mysqli_connect("localhost", "root", "", "airasiadb");
                                    $cardData = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `cards` where id = '" . $cart['cardid'] . "'"));
                                    $cardName = $cardData['name'];
                                    if ($cardName == "" | $cardName == null) {
                                        $cardName = "Generic Card";
                                        $cardImage = "return.png";
                                    } else {
                                        $cardImage = mysqli_fetch_array(mysqli_query($conn, "SELECT img_src FROM `images` where name_ref = '" . $cardName . "'"));
                                        if (empty($cardImage)) {
                                            $cardImage = "return.png";
                                        } else {
                                            $cardImage = $cardImage['img_src'];
                                        }
                                    }
                                    $total = $total + $cardData['cost'] * $cart['quantity'];
                                    ?>
                                    <div class="row ">
                                        <div class="col-2 m-auto" style="display: block">
                                            <div class="m-auto d-flex justify-content-center">
                                                <input style="max-width: 75%; align-content: center" type="number"
                                                       name="quantity[<?php echo $counter ?>]" min="0" max="15"
                                                       value="<?php echo $cart['quantity']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-9 w-90 border-top">
                                            <div class="row">
                                                <div class="col-3">
                                                    <a href = <?php echo 'Card-Details.php?id=' . $cart['cardid']; ?>>
                                                    <img alt="Brand image"
                                                         class="img-responsive m-auto vertical-center-img"
                                                         style="max-height: 3rem; max-width: 75%"
                                                         src=<?php echo 'CSS/Images/Brands/' . $cardImage; ?>>
                                                    </a>
                                                </div>
                                                <div class="col-7 w-65 m-auto pt-3">
                                                    <p class="detail-title p-0 m-0"
                                                       style="text-align: left; font-size: 12px"><?php echo ucfirst($cardName); ?>
                                                    <p></p>
                                                    <p class=pt0><?php echo "Value = $" . $cardData['value'] * $cart['quantity']; ?>
                                                </div>
                                                <div class="col-2 w-65 m-auto pt-3">
                                                    <p class="detail-title p-0 m-0 border-bottom"
                                                       style="text-align: center; font-size: 12px">Cost
                                                    <p></p>
                                                    <p class="text-center"><?php echo $cardData['cost'] * $cart['quantity'] . " pt"; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1"></div>
                                    </div>
                                    <?php
                                    $counter++;
                                endwhile;
                                // While loop must be terminated
                                /** @noinspection PhpUndefinedVariableInspection */
                                $_SESSION['idArray'] = $id_array;
                                ?>
                                <div class="row border-top">
                                    <div class="col pt-3">
                                        <p class="card-title font-weight-bold"
                                           style="text-align: end; font-size: 16px"><?php echo "Total: " . $total ?></p>
                                    </div>
                                    <div class="col-1"></div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-1"></div>
                                    <div class="col-5">
                                        <button class="btn btn-primary btn-block default-button-muted justify-content-end w-50"
                                                style="padding: 3%; border-radius: 15px"
                                                type="submit" name="updateCart" id="updateCart" value="Submit">Update
                                            Cart
                                        </button>
                                    </div>

                                    <div class="col-5">
                                        <a href="UnderConstruction.html">
                                            <button class="btn btn-primary btn-block default-button-main justify-content-end w-75"
                                                    style="padding: 3%"
                                                    type="button" name="checkOut">Checkout
                                            </button>
                                        </a>
                                    </div>
                                    <div class="col-1"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2 p-0"></div>
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