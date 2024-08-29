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
    <title>Xobbee - Add New Voucher</title>
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
            <h1>Add New Voucher</h1>
            <form action="/add-voucher" method="post">
                <div class="form-group">
                    <label for="voucher-code">Mã giảm giá</label>
                    <input type="text" id="voucher-code" name="voucher_code" required>
                </div>

                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea id="description" name="description" required></textarea>
                </div>

                <div class="form-group">
                    <label for="discount">Phần trăm giảm giá</label>
                    <input type="number" id="discount" name="discount" min="0" max="100" required>
                </div>

                <div class="form-group">
                    <label for="valid-from">Hợp lệ từ</label>
                    <input type="date" id="valid-from" name="valid_from" required>
                </div>

                <div class="form-group">
                    <label for="valid-to">Hợp lệ đến</label>
                    <input type="date" id="valid-to" name="valid_to" required>
                </div>

                <div class="form-group">
                    <label for="status">Trạng thái</label>
                    <select id="status" name="status" required>
                        <option value="active">Kích hoạt</option>
                        <option value="inactive">Ngừng kích hoạt</option>
                    </select>
                </div>

                <div class="form-buttons">
                    <button type="submit" class="button-save">Lưu</button>
                    <a href="/vouchers"><button type="button" class="button-cancel">Hủy</button></a>
                </div>
            </form>
        </article>

        <footer>

        </footer>
    </div>
</body>

</html>