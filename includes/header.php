<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xobbee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/product.css">
    <link rel="stylesheet" href="./assets/css/checkout.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.6.0-web/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" href="favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="icon" href="favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <script src="./assets/js/script.js" defer></script>
</head>

<body>
    <div class="wrapper">
        <!-- Header -->
        <header class="header">
            <div class="grid">
                <nav class="header__navbar header__navbar-list">
                    <a class="header__navbar-list header__navbar-logo" href="/">
                        <img style="height: 70px; width: 70px;" src="./assets/img/header/logo.png" alt="logo">
                    </a>

                    <ul class="header__navbar-list header__navbar-list-info">
                        <li class="header__navbar-item header__navbar-item--separate">
                            <a class="header__navbar-item-link" href="">TRANG CHỦ</a>
                        </li>
                        <li class="header__navbar-item header__navbar-item--separate">
                            <a class="header__navbar-item-link" href="#product">SẢN PHẨM</a>
                        </li>
                        <li class="header__navbar-item">
                            <a class="header__navbar-item" href="">
                                <span class="header__navbar-item--no-pointer">KẾT NỐI</span>
                                <a href="" class="header__navbar-icon-link">
                                    <i class="header__navbar-icon fa-brands fa-tiktok "></i>
                                </a>
                                <a href="" class="header__navbar-icon-link">
                                    <i class="header__navbar-icon fa-brands fa-facebook"></i>
                                </a>
                                <a href="" class="header__navbar-icon-link">
                                    <i class="header__navbar-icon fa-brands fa-youtube"></i>
                                </a>
                            </a>
                        </li>
                    </ul>

                    <div class="header__navbar-list">
                        <ul class="header__navbar-list">
                            <div class="header__navbar-item">
                                <input class="header__navbar-search" type="text" placeholder="Tìm kiếm...">
                                <i class="header__navbar-search-icon fa-solid fa-magnifying-glass"></i>
                            </div>
                        </ul>

                        <!-- Cart -->
                        <div class="header__navbar-list">
                            <div class="header__navbar-box">
                                <i class="header__navbar-cart fa-solid fa-bag-shopping"></i>
                                <?php if (isset($_SESSION['cart'])) {
                                    echo "<span class='header__navbar-notice'>" . count($_SESSION['cart']) . "</span>";
                                }
                                ?>


                                <!-- No cart: header__cart-list--no-cart -->
                                <div class="header__cart-list ">
                                    <img src="./assets/img/header/no_cart.png" class="header__cart-no-cart-img">
                                    <h4 class='header__cart-heading'>
                                        <?php
                                        echo (isset($_SESSION['cart']) ? "Sản phẩm đã thêm" : "Giỏ hàng trống");
                                        ?>
                                    </h4>



                                    <ul class="header__cart-list-item">
                                        <!-- Cart-item -->
                                        <?php
                                        if (isset($_SESSION['cart'])) {

                                            $cartItems = $_SESSION["cart"];
                                            foreach ($cartItems as $item): ?>

                                                <li class="header__cart-item">
                                                    <img src="<?php echo $item['image']; ?>" alt="" class="header__cart-img">
                                                    <div class="header__cart-item-info">
                                                        <div class="header__cart-item-head">
                                                            <h5 class="header__cart-item-name"><?php echo $item['name']; ?></h5>
                                                            <div class="header__cart-item-price-wrap">
                                                                <span
                                                                    class="header__cart-item-price"><?php echo number_format($item['price']); ?>đ</span>
                                                                <span class="header__cart-item-multiply">x</span>
                                                                <span
                                                                    class="header__cart-item-quantity"><?php echo $item['quantity']; ?></span>
                                                            </div>
                                                        </div>

                                                        <div class="header__cart-item-body">
                                                            <span class="header__cart-item-description">
                                                                <!-- Loại: Hộp 250g -->
                                                            </span>
                                                            <a href="cart.php?action=remove&id=<?php echo $item['id'] ?>" class="
                                                                header__cart-item-remove">Xoá</a>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endforeach;

                                        }
                                        ?>

                                    </ul>
                                    <a href="checkout.php">

                                        <button class="header__cart-checkout">Thanh toán</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>