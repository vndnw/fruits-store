<?php
require_once '../config/connect.php';
require_once '../config/session.php';
requireLogin();

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
// Lấy chi tiết sản phẩm của đơn hàng
$stmt_details = $conn->prepare("
SELECT od.*, p.name AS product_name, p.image AS product_image 
FROM order_details od 
JOIN products p ON od.product_id = p.id 
WHERE od.order_id = :order_id
");

$stmt_details->bindParam(':order_id', $order_id, PDO::PARAM_STR);
$stmt_details->execute();
$order_details = $stmt_details->fetchAll(PDO::FETCH_ASSOC);

// if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
//     $id = $_GET['id'];
//     $stmt = $conn->prepare("DELETE FROM products WHERE id = :id");
//     $stmt->bindParam(':id', $id);
//     if ($stmt->execute()) {
//         header("Location: products.php");
//     } else {
//         echo "Error deleting product.";
//     }
// }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xobbee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.6.0-web/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" href="./favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="icon" href="./favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
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

        .add-product {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .product-add-new {
            border: 2px solid #6586E6;
            background-color: #6586E6;
            border-radius: 5px;
            width: 100px;
            height: 35px;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s;
        }

        .product-add-new:hover {
            background-color: #566fb7;
        }

        .product-add-new p {
            font-size: 14px;
            margin: 0;
            color: #ffffff;
            font-weight: 500;
            line-height: 35px;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
            font-size: 0.9rem;
        }

        /* Header Row */
        thead tr {
            background-color: #e0e7ff;
            color: #333;
            font-weight: 600;
        }

        /* Even Rows */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Hover Effect */
        tr:hover {
            background-color: #f1f1f1;
        }

        caption {
            font-weight: 600;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        /* Button Styles */
        button {
            border: none;
            border-radius: 5px;
            width: 80px;
            height: 35px;
            color: #ffffff;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .button-edit {
            background-color: #34a853;
            /* Green */
        }

        .button-edit:hover {
            background-color: #2e8b57;
        }

        .button-delete {
            background-color: #ea4335;
            /* Red */
        }

        .button-delete:hover {
            background-color: #c62828;
        }

        .button-preview {
            background-color: #fbbc05;
            /* Yellow */
        }

        .button-preview:hover {
            background-color: #f9a825;
        }

        /* Hidden Header for Future Use */
        h3 {
            text-align: center;
            display: none;
        }

        .product-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }

        .order-details-container {
            display: flex;
            justify-content: space-between;
        }

        .order-products {
            flex: 1;
            margin-right: 20px;
        }

        .order-info {
            flex: 1;
        }
    </style>
</head>

<body>
    <div class="wrapper">

        <?php include "./header.php" ?>

        <article class="article">
            <div class="add-product">
                <h1 class="products-name">Order Details</h1>
                <h4>Order #66dadfaa9e167</h4>
            </div>
            <div class="order-details-container">
                <div class="order-products">
                    <table>
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($order_details as $detail): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($detail['product_name']); ?></td>
                                    <td><?php echo htmlspecialchars($detail['quantity']); ?></td>
                                    <td><?php echo number_format($detail['price']); ?>đ</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <p>Tổng tiền: <?php echo number_format($order['total_amount']); ?>đ</p>
                    <h2>Trạng thái đơn hàng: <?php echo htmlspecialchars($order['status']); ?></h2>
                </div>
                <div class="order-info">
                    <h2>Thông tin khách hàng</h2>
                    <p>Họ và tên: <?php echo htmlspecialchars($order['customer_name']); ?></p>
                    <p>Số điện thoại: <?php echo htmlspecialchars($order['customer_phone']); ?></p>
                    <p>Email: <?php echo htmlspecialchars($order['email']); ?></p>
                    <p>Địa chỉ: <?php echo htmlspecialchars($order['customer_address']); ?></p>
                    <p>Ghi chú: <?php echo htmlspecialchars($order['note']); ?></p>
                    <p>Ngày đặt: <?php echo htmlspecialchars($order['order_date']); ?></p>
                </div>
            </div>
        </article>

        <footer>

        </footer>
    </div>
    <script>
        function confirmDelete() {
            return confirm("Bạn có chắc chắn muốn xóa sản phẩm này?");
        }
    </script>
</body>

</html>