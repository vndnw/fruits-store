<?php
require_once '../config/session.php';
require_once '../config/connect.php';
requireLogin();


// Truy vấn tổng số tiền
$stmt = $conn->prepare("SELECT SUM(total_amount) AS total_amount FROM orders");
$stmt->execute();
$total_amount = $stmt->fetch(PDO::FETCH_ASSOC)['total_amount'];

// Truy vấn tổng đơn hàng
$stmt = $conn->prepare("SELECT COUNT(*) AS total_orders FROM orders");
$stmt->execute();
$total_orders = $stmt->fetch(PDO::FETCH_ASSOC)['total_orders'];

// Truy vấn tổng sản phẩm
$stmt = $conn->prepare("SELECT COUNT(*) AS total_products FROM products");
$stmt->execute();
$total_products = $stmt->fetch(PDO::FETCH_ASSOC)['total_products'];

// Truy vấn 5 đơn hàng gần đây
$stmt = $conn->query("SELECT * FROM orders ORDER BY order_date DESC LIMIT 5");
$recent_orders = $stmt->fetchAll();


?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
            background-color: #f1f1f1;
        }

        main {
            padding: 20px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -15px;
        }

        .column {
            flex: 33.33%;
            padding: 15px;
            box-sizing: border-box;
        }

        .column-full {
            flex: 100%;
            padding: 15px;
            box-sizing: border-box;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            margin: 10px 0;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>
    <main>
        <p>Chào mừng, <?php echo $_SESSION['username']; ?>!</p>

        <div class="row">
            <div class="column">
                <div class="card">
                    <h2>Tổng số tiền</h2>
                    <p><?php echo number_format($total_amount); ?> VND</p>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <h2>Tổng đơn hàng</h2>
                    <p><?php echo $total_orders; ?></p>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <h2>Tổng sản phẩm</h2>
                    <p><?php echo $total_products; ?></p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="column-full">
                <div class="card">
                    <h2>Đơn hàng gần đây</h2>
                    <table cellpadding="10" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tên khách hàng</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_orders as $order): ?>
                                <tr>
                                    <td>
                                        <a
                                            href="order_details.php?id=<?php echo $order['id']; ?>">#<?php echo $order['id']; ?></a>
                                    </td>
                                    <td><?php echo $order['customer_name']; ?></td>
                                    <td><?php echo number_format($order['total_amount']); ?>đ</td>
                                    <td><?php echo $order['status']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </main>



</body>

</html>