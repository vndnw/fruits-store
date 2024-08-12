<?php
session_start();
include 'config/connect.php';
include 'includes/send-mail.php';
if (isset($_POST['place_order'])) {
    $customer_name = $_POST['name'];
    $customer_phone = $_POST['phone'];
    $email = $_POST['email'];
    $customer_address = $_POST['address'];
    $note = $_POST['note'];
    $total_amount = $_POST['total-price'];

    $stmt = $conn->prepare("INSERT INTO orders (customer_name, customer_phone, email, customer_address, note, total_amount) VALUES (:customer_name, :customer_phone, :email, :customer_address, :note, :total_amount)");
    $stmt->bindParam(':customer_name', $customer_name);
    $stmt->bindParam(':customer_phone', $customer_phone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':customer_address', $customer_address);
    $stmt->bindParam(':note', $note);
    $stmt->bindParam(':total_amount', $total_amount);
    if ($stmt->execute()) {
        //Lấy ID đơn hàng vừa tạo
        $order_id = $conn->lastInsertId();
        foreach ($_SESSION['cart'] as $item) {
            $product_id = $item['id'];
            $quantity = $item['quantity'];
            $price = $item['price'];
            $stmt = $conn->prepare("INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)");
            $stmt->bindParam(':order_id', $order_id);
            $stmt->bindParam(':product_id', $product_id);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':price', $price);
            $stmt->execute();
        }

        $subject = '[FRUITS SHOP] THÔNG BÁO ĐẶT HÀNG THÀNH CÔNG';
        $message = 'Cảm ơn bạn đã đặt hàng tại cửa hàng chúng tôi. Đơn hàng của bạn đã được tiếp nhận và đang được xử lý. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.';
        sendEmail($email, $subject, $message);

        unset($_SESSION['cart']);
        header('Location: order_success.php');
    }
}
?>