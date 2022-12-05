<?php
session_start();
function Authorization(): void
{
    if (!isset($_SESSION['userName']) || $_SESSION['userName'] == "") {
        header("Location: UnAuthorized.html");
    }
}

function AuthtoLogin(): void
{
    if (!isset($_SESSION['userName']) || $_SESSION['userName'] == "") {
        header("Location: UnAuthorized.html");
    }
}

function AuthorizationAdmin(): void {
    if (isset($_SESSION['userRole']) && $_SESSION['userRole'] != "admin"){
        header("Location: UnAuthorized.html");
    }
}