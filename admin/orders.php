<?php
require_once '../config/connect.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xobbee - Orders</title>
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

        .add-order {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-add-new {
            border: 2px solid #6586E6;
            background-color: #6586E6;
            border-radius: 5px;
            width: 100px;
            height: 35px;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s;
        }

        .order-add-new:hover {
            background-color: #566fb7;
        }

        .order-add-new p {
            font-size: 14px;
            margin: 0;
            color: #ffffff;
            font-weight: 500;
            line-height: 35px;
        }

        /* Table Styles */
        .wrapper {
            max-width: 100%;
            overflow-x: auto;
            /* Add horizontal scroll if content overflows */
        }

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
            overflow: hidden;
            /* Ensure no overflow by default */
            box-sizing: border-box;
            /* Include padding in width/height calculations */
        }

        /* Column-specific styles */
        td:nth-child(1),
        td:nth-child(2),
        td:nth-child(3),
        td:nth-child(4),
        td:nth-child(5),
        td:nth-child(6),
        /* Tên khách hàng */
        td:nth-child(7),
        /* Email */
        td:nth-child(8)

        /* Địa chỉ */
            {
            max-width: 150px;
            /* Adjust as needed */
            overflow: auto;
            /* Add scroll bar if content exceeds width */
            white-space: nowrap;
            /* Prevent text from wrapping */
        }

        th:nth-child(1),
        th:nth-child(2),
        th:nth-child(3),
        th:nth-child(4),
        th:nth-child(5),
        th:nth-child(6),
        /* Tên khách hàng */
        th:nth-child(7),
        /* Email */
        th:nth-child(8)

        /* Địa chỉ */
            {
            max-width: 150px;
            /* Adjust as needed */
            overflow: auto;
            /* Add scroll bar if content exceeds width */
            white-space: nowrap;
            /* Prevent text from wrapping */
        }

        /* Ensure all rows have the same height */
        tr {
            height: 50px;
            /* Adjust as needed */
        }

        /* Custom Scrollbar Styles */
        td::-webkit-scrollbar {
            width: 6px;
            /* Width of the scrollbar */
            height: 10px;
        }

        td::-webkit-scrollbar-track {
            background: #f1f1f1;
            /* Track color */
        }

        td::-webkit-scrollbar-thumb {
            background: #888;
            /* Scrollbar color */
            border-radius: 3px;
        }

        td::-webkit-scrollbar-thumb:hover {
            background: #555;
            /* Color on hover */
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

        /* Button container styles */
        td:last-child {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        /* Hidden Header for Future Use */
        h3 {
            text-align: center;
            display: none;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <header class="header-navbar">
            <h2 class="header-navbar__dashboard-name">Dashboard</h2>

            <div class="header-navbar__menu">
                <a class="header-navbar__menu-item" href="">Products</a>
                <a class="header-navbar__menu-item" href="">Vouchers</a>
                <a class="header-navbar__menu-item" href="">Orders</a>
            </div>
        </header>

        <article class="article">
            <div class="add-order">
                <h1 class="orders-name">Orders</h1>
                <a href="" class="order-add-new">
                    <p>Thêm mới</p>
                </a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Thứ tự</th>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Ngày đặt</th>
                        <th>Trạng thái</th>
                        <th>Tổng tiền</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM orders");
                    $stmt->execute();
                    $orders = $stmt->fetchAll();
                    foreach ($orders as $index => $order): ?>
                        <tr>
                            <td><?php echo $index ?></td>
                            <td><?php echo $order['customer_name'] ?></td>
                            <td><?php echo $order['customer_phone'] ?></td>
                            <td><?php echo $order['email'] ?></td>
                            <td><?php echo $order['customer_address'] ?></td>
                            <td><?php echo $order['order_date'] ?></td>
                            <td><?php echo $order['status'] ?></td>
                            <td><?php echo number_format($order['total_amount']) ?></td>
                            <td>
                                <a href="<?php echo 'update_order.php?id=' . $order['id'] ?>"><button
                                        class="button-edit">Chỉnh sửa</button></a>
                                <a href="<?php echo 'update_order.php?id=' . $order['id'] ?>"><button
                                        class="button-delete">Xoá</button></a>
                            </td>
                        </tr>
                    <?php endforeach;
                    ?>
                </tbody>
            </table>
        </article>

        <footer>
        </footer>
    </div>
</body>

</html>