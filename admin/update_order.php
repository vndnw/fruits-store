<?php
require_once '../config/session.php';
require_once '../config/connect.php';
requireLogin();


try {
    if (!isset($_GET['id'])) {
        die('ID đơn hàng không hợp lệ');
    }

    $order_id = $_GET['id'];

    // Lấy thông tin đơn hàng
    $stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
    $stmt->execute([$order_id]);
    $order = $stmt->fetch();
    if (!$order) {
        die('Đơn hàng không tồn tại');
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $customer_name = $_POST['customer_name'];
        $customer_phone = $_POST['customer_phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $note = $_POST['note'];
        $order_date = $_POST['order_date'];
        $status = $_POST['status'];
        $total_amount = $_POST['total_amount'];

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $current_time = (new DateTime())->format('H:i:s');
        $order_date = (new DateTime($order_date . ' ' . $current_time))->format('Y-m-d H:i:s');



        $stmt = $conn->prepare("UPDATE orders SET customer_name = ?, customer_phone = ?, email = ?, customer_address = ?, order_date = ?, status = ?, total_amount = ?, note = ? WHERE id = ?");
        $stmt->execute([$customer_name, $customer_phone, $email, $address, $order_date, $status, $total_amount, $note, $order_id]);

        header('Location: orders.php');
        exit;

    }

} catch (Exception $e) {
    die($e->getMessage());
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xobbee - Edit Order</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.6.0-web/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" href="favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="icon" href="favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <style>
        /* Global Styles */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Header Styles */
        .header-navbar {
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 120px;
        }

        .header-navbar__dashboard-name {
            font-size: 1.5rem;
            font-weight: bold;
            color: #6586E6;
        }

        .header-navbar__menu {
            display: flex;
        }

        .header-navbar__menu-item {
            text-decoration: none;
            margin: 0 12px;
            font-size: 1rem;
            color: #6586E6;
            transition: color 0.3s;
        }

        .header-navbar__menu-item:hover {
            color: #333;
        }

        /* Article Styles */
        .article {
            margin: 40px 120px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-group textarea {
            height: 100px;
            resize: vertical;
        }

        /* Button Styles */
        .form-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .form-buttons button {
            border: none;
            border-radius: 5px;
            width: 100px;
            height: 35px;
            color: #ffffff;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .button-save {
            background-color: #34a853;
            /* Green */
        }

        .button-save:hover {
            background-color: #2e8b57;
        }

        .button-cancel {
            background-color: #ea4335;
            /* Red */
        }

        .button-cancel:hover {
            background-color: #c62828;
        }
    </style>
</head>

<body>
    <div class="wrapper">

        <?php include "./header.php" ?>

        <article class="article">
            <h1>Edit Order</h1>

            <form action="" method="POST">
                <div class="form-group">
                    <label for="customer_name">Họ và tên</label>
                    <input type="text" id="customer_name" name="customer_name"
                        value="<?php echo htmlspecialchars($order['customer_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="customer_phone">Số điện thoại</label>
                    <input type="text" id="customer_phone" name="customer_phone"
                        value="<?php echo htmlspecialchars($order['customer_phone']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($order['email']); ?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <input type="text" id="address" name="address"
                        value="<?php echo htmlspecialchars($order['customer_address']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="note">Ghi chú</label>
                    <textarea id="note" name="note" required><?php echo htmlspecialchars($order['note']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="order-date">Ngày đặt hàng</label>
                    <input type="date" id="order-date" name="order_date"
                        value="<?php echo date('Y-m-d', strtotime($order['order_date'])); ?>" required>
                </div>
                <div class="form-group">
                    <label for="status">Trạng thái</label>
                    <select id="status" name="status" required>
                        <option value="pending" <?php echo $order['status'] == 'pending' ? 'selected' : ''; ?>>Chờ xác
                            nhận</option>
                        <option value="processed" <?php echo $order['status'] == 'processed' ? 'selected' : ''; ?>>Đã xử
                            lý</option>
                        <option value="shipped" <?php echo $order['status'] == 'shipped' ? 'selected' : ''; ?>>Đang giao
                            hàng</option>
                        <option value="delivered" <?php echo $order['status'] == 'delivered' ? 'selected' : ''; ?>>Đã nhận
                            hàng</option>
                        <option value="canceled" <?php echo $order['status'] == 'canceled' ? 'selected' : ''; ?>>Đã hủy
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="total-amount">Tổng tiền</label>
                    <input type="number" id="total-amount" name="total_amount"
                        value="<?php echo $order['total_amount']; ?>" required>
                </div>
                <div class="form-buttons">
                    <button type="submit" class="button-save">Lưu</button>
                    <a href="orders.php"><button type="button" class="button-cancel">Hủy</button></a>
                </div>
            </form>
        </article>

        <footer>

        </footer>
    </div>
</body>

</html>