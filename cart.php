<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
} else {
    $id = $_GET['id'];
    $quantity = 1;
}
// Validate product ID and quantity
if (empty($id) || empty($quantity) || $quantity <= 0) {
    die('Invalid product ID or quantity');
}

// Check if the cart session variable exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add or update the product ID and quantity in the cart session
if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id] += $quantity;
} else {
    $_SESSION['cart'][$id] = $quantity;
}

if ($_POST['action'] === 'buy-now') {
    header('Location: checkout.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['action']) && $_GET['action'] === 'remove') {
        $id = $_GET['id'];
        unset($_SESSION['cart'][$id]);
    }
}
header('location: ' . $_SERVER['HTTP_REFERER']);
exit;
?>