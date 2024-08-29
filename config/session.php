<?php
session_start();

function isLoggedIn()
{
    return isset($_SESSION['login']) && $_SESSION['login'] === true;
}

function requireLogin()
{
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}
?>