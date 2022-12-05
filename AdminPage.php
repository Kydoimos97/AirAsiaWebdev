<?php
session_start();

require_once("SourceCode/Func/Auth.php");
AuthorizationAdmin();

function display_data($array): string
{
    // start table
    $html = "";
    // header row
    $html .= '<tr>';
    foreach ($array[0] as $key => $value) {
        if ($key == null) {
            $key = "Index";
        }
        $html .= '<th>' . htmlspecialchars($key) . '</th>';
    }
    $html .= '</tr>';

    // data rows
    /** @noinspection PhpUnusedLocalVariableInspection */
    foreach ($array as $key => $value) {
        $html .= '<tr>';
        /** @noinspection PhpUnusedLocalVariableInspection */
        foreach ($value as $key2 => $value2) {
            if ($value2 == null) {
                $value2 = "null";
            }
            $html .= '<td>' . htmlspecialchars($value2) . '</td>';
        }
        $html .= '</tr>';
    }

    return $html;
}

?>

<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Admin Center</title>

    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <!--CSS -->
    <link rel="stylesheet" href="MainStyle.css">

    <!-- Fonts -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"></script>
</head>

<body class="content_hidden">
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
            <div class="row h-15" style="height: 7rem"></div>
            <div class="row h-15 background-darkened p-5" style="border-radius: 15px">
                <div class="col-sm-1 w-100"></div>
                <div class="col-sm-10 w-100">
                    <div class="card w-5 transparent-divider border-0 d-flex justify-content-center">
                    </div>
                    <div class="card w-100 page-title border-0 center-block ">
                        <p class="page-title pt-3 pb-3 border-bottom" style="color: var(--offwhite)">Gift card
                            detail</p>
                    </div>
                    <div class="card w-5 transparent-divider border-0 d-flex justify-content-center">
                    </div>
                </div>
                <div class="col-sm-1 w-100"></div>
                <div class="col-sm-3 w-100"></div>
                <div class="col-sm-6 w-100">
                    <div class="card w-5 transparent-divider border-0 d-flex justify-content-center">
                    </div>
                    <div class="card w-100 border-0 center-block background-default"
                         style="border-color: var(--blendborder)">
                        <p class="text-center pt-3 pb-3"
                           style="color: var(--grey)"><?php require("SourceCode/Func/inlineEcho.php"); if (inlineEcho("message", "session", "", "", "bool")) {
                                echo inlineEcho("message", "session");
                            } else {
                                echo "---Return Code---";
                            } ?></>
                    </div>
                    <div class="card w-5 transparent-divider border-0 d-flex justify-content-center">
                    </div>
                </div>
                <div class="col-sm-3 w-100"></div>
                <div class="col-sm-12 background-transparent d-flex m-auto" style="height: 10rem">
                    <div class="col-sm-4 background-transparent pb-3 pt-3 ">
                        <div class="text-center w-100 h-100 m-auto p-5">
                            <a href="SourceCode/SQL/phpImage.php">
                                <button class="btn btn-primary btn-block default-button-main justify-content-end"
                                        style="padding: 3%"
                                        type="button">Reset Image Database
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-4 background-transparent pb-3 pt-3 ">
                        <div class="text-center w-100 h-100 m-auto p-5">
                            <a href="SourceCode/SQL/phpUser.php">
                                <button class="btn btn-primary btn-block default-button-main justify-content-end"
                                        style="padding: 3%"
                                        type="button">Reset User Database
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-4 background-transparent pb-3 pt-3 ">
                        <div class="text-center w-100 h-100 m-auto p-5">
                            <a href="SourceCode/SQL/phpPopulation.php">
                                <button class="btn btn-primary btn-block default-button-main justify-content-end"
                                        style="padding: 3%"
                                        type="button">Reset Product Database
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row h-15 background-transparent pr-5 pl-5">
                <div class="col-sm-1 w-100"></div>
                <div class="col-sm-10 w-100">
                    <div class="card w-5 transparent-divider border-0 d-flex justify-content-center">
                    </div>
                    <div class="card w-100 page-title border-0 center-block ">
                        <p class="page-title pt-3 pb-3 border-bottom"
                           style="color: var(--grey)"><?php if (isset($_SESSION['table']) && $_SESSION['table'] != null) echo ucfirst($_SESSION['table']) ?>
                            Table</p>
                    </div>
                    <div class="card w-5 transparent-divider border-0 d-flex justify-content-center">
                    </div>
                </div>
                <div class="col-sm-1 w-100"></div>
                <div class="col-sm-1 w-100"></div>
                <div class="col-sm-10 w-100 table-responsive">
                    <table class="table text-center border m-auto w-100" style="color: #303030">
                        <?php
                        if (isset($_SESSION['table']) && $_SESSION['table'] != "") {
                            $connection = mysqli_connect('localhost', 'root', '', 'airasiadb');

                            $query = "SELECT * FROM " . $_SESSION['table'];
                            $result = mysqli_query($connection, $query);

                            echo display_data(mysqli_fetch_all($result));
                            mysqli_close($connection);
                            unset($_SESSION['table']); //TODO new change
                        }
                        ?>
                    </table>
                </div>
            </div>
            <div class="col-sm-1 w-100"></div>
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