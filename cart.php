<?php
session_start();

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $productId = $_POST['id'];
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    $quantity = $_POST['quantity'];
    $image = $_POST['image'];

    // Validate form data
    if (empty($productId) || empty($productName) || empty($productPrice) || empty($quantity)) {
        die('Invalid form data');
    }

    // Create a cart item array
    $cartItem = [
        'id' => $productId,
        'name' => $productName,
        'price' => $productPrice,
        'quantity' => $quantity,
        'image' => $image
    ];

    // Add the item to the cart session
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the product is already in the cart
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $productId) {
            $item['quantity'] += $quantity;
            $found = true;
            break;
        }
    }

    // If the product is not in the cart, add it
    if (!$found) {
        $_SESSION['cart'][] = $cartItem;
    }

    var_export($_SESSION['cart']);
    // session_destroy();
    // Redirect to the cart page or display a success message
    // header('Location: cart_view.php');
    header('location: ' . $_SERVER['HTTP_REFERER']);

    exit;
} else {
    die('Invalid request method');
}
?>