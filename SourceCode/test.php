<?php
session_start();

$_SESSION["test"] = "Hello";


include("Func/inlineEcho.php");

if (Func\inlineEcho("test", "Session", "this is a test and it says: ", "", "bool")) {
    echo "Hello";
} else {
    echo "no";
}

?>

<html>
<body>

<p><?php echo print(Func\inlineEcho("test", "post", "", "", "bool")) ?></p>
<p><?php echo print(Func\inlineEcho("test", "Session", "", "", "bool")) ?></p>


</body>
</html>
