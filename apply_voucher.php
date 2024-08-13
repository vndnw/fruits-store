<?php
session_start();
include './config/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $voucher_code = $_POST['voucher_code'];

    $stmt = $conn->prepare("SELECT * FROM vouchers WHERE code = ? AND valid_from >= CURDATE()");
    $stmt->bind_param("s", $voucher_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $voucher = $result->fetch_assoc();

        $_SESSION['discount'] = $voucher['discount'];
        $_SESSION['description'] = $voucher['description'];

        // if ($voucher['max_use'] > 0 && $voucher['used'] >= $voucher['max_use']) {
        //     $_SESSION['error'] = "Mã giảm giá này đã hết hạn sử dụng.";
        // } else {
        //     // Áp dụng giảm giá
        //     $_SESSION['discount'] = $voucher['discount'];

        //     // Cập nhật số lần sử dụng của mã giảm giá
        //     $stmt = $conn->prepare("UPDATE vouchers SET used = used + 1 WHERE id = ?");
        //     $stmt->bind_param("i", $voucher['id']);
        //     $stmt->execute();

        //     $_SESSION['success'] = "Mã giảm giá đã được áp dụng thành công!";
        // }
    } else {
        $_SESSION['error'] = "Mã giảm giá không hợp lệ hoặc đã hết hạn.";
    }

    // Đóng kết nối
    $stmt->close();
    $conn->close();

    // Chuyển hướng về trang giỏ hàng hoặc thanh toán
    header("Location: checkout.php");
    exit;
}
?>