<?php
require_once '../config/session.php';
require_once '../config/connect.php';
requireLogin();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        main {
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }

        main h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
        }

        main p {
            color: #666;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>

    <main>
        <h1>Chào mừng, <?php echo $_SESSION['username']; ?></h1>
        <p>Đây là trang quản trị chính.</p>
    </main>

</body>

</html>