<?php
require_once '../config/session.php';
require_once '../config/connect.php';
requireLogin();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xobbee - Vouchers</title>
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

        .add-voucher {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .voucher-add-new {
            border: 2px solid #6586E6;
            background-color: #6586E6;
            border-radius: 5px;
            width: 100px;
            height: 35px;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s;
        }

        .voucher-add-new:hover {
            background-color: #566fb7;
        }

        .voucher-add-new p {
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
    </style>
</head>

<body>
    <div class="wrapper">

        <?php include "./header.php" ?>

        <article class="article">
            <div class="add-voucher">
                <h1 class="vouchers-name">Vouchers</h1>
                <a href="" class="voucher-add-new">
                    <p>Thêm mới</p>
                </a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Thứ tự</th>
                        <th>Mã giảm giá</th>
                        <th>Mô tả</th>
                        <th>Phần trăm giảm giá</th>
                        <th>Hợp lệ từ</th>
                        <th>Hợp lệ đến</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM vouchers");
                    $stmt->execute();
                    $vouchers = $stmt->fetchAll();
                    foreach ($vouchers as $index => $voucher): ?>
                        <tr>
                            <td><?php echo $index ?></td>
                            <td><?php echo $voucher['code'] ?></td>
                            <td><?php echo $voucher['description'] ?></td>
                            <td><?php echo number_format($voucher['discount_percentage']) ?>%</td>
                            <td><?php echo $voucher['valid_from'] ?></td>
                            <td><?php echo $voucher['valid_to'] ?></td>
                            <td><?php echo $voucher['status'] ?></td>
                            <td>
                                <a href="<?php echo 'update_voucher.php?id=' . $voucher['id'] ?>"><button
                                        class="button-edit">Chỉnh sửa</button></a>
                                <a href="<?php echo 'update_voucher.php?id=' . $voucher['id'] ?>"><button
                                        class="button-delete">Xoá</button></a>
                            </td>
                        </tr>
                    <?php endforeach;
                    ?>

            </table>
        </article>

        <footer>

        </footer>
    </div>
</body>

</html>