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
</head>

<body>
    <?php include 'header.php'; ?>

    <main>
        <h1>Chào mừng, <?php echo $_SESSION['username']; ?></h1>
        <p>Đây là trang quản trị chính.</p>
        <a href="logout.php">Đăng xuất</a>
    </main>

</body>

</html>