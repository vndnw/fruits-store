<?php
session_start();
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$productId = $data['productId'];
$quantity = $data['quantity'];

if (empty($productId) || empty($quantity) || $quantity <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid product ID or quantity']);
    exit;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$_SESSION['cart'][$productId] = $quantity;
// header('location: ' . $_SERVER['HTTP_REFERER']);

echo json_encode(['success' => true, 'message' => 'Cart updated successfully']);
?>