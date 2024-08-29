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



        include "config/connect.php";
        $cart = $_SESSION['cart'];
        $productIds = array_keys($cart);
        $placeholders = rtrim(str_repeat('?,', count($productIds)), ','); // Tạo chuỗi ?,?,?

        $sql = "SELECT * FROM products WHERE id IN ($placeholders)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($productIds);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as $item) {
            $product_id = $item['id'];
            $quantity = $cart[$item['id']];
            $price = $item['current_price'];
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

        // Truy xuất lại thông tin đơn hàng vừa lưu để hiển thị
        $stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
        $stmt->execute([$order_id]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $conn->prepare("SELECT od.*, p.name,  p.image FROM order_details od JOIN products p ON od.product_id = p.id WHERE order_id = ?");
        $stmt->execute([$order_id]);
        $orderDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);



        $_SESSION['order'] = $order;
        $_SESSION['orderDetails'] = $orderDetails;
        $_SESSION['orderSuccess'] = true;

        header('location: ' . $_SERVER['HTTP_REFERER']);
    }
}
?>