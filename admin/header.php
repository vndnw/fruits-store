<?php
require_once '../config/session.php';
require_once '../config/connect.php';
requireLogin();

?>
<style>
    /* Global Styles */
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f1f1f1;
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
        align-items: center;
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

    .header-navbar__menu-item--logout {
        color: #ffffff;
        background-color: #f44336;
        padding: 10px;
        border-radius: 5px;
        text-decoration: none;
    }

    .header-navbar__menu-item--logout:hover {
        background-color: #d32f2f;
    }
</style>

<header class="header-navbar">
    <h2 class="header-navbar__dashboard-name"><a style="text-decoration: none;" href="dashboard.php">Dashboard</a></h2>

    <div class="header-navbar__menu">
        <a class="header-navbar__menu-item" href="products.php">Products</a>
        <a class="header-navbar__menu-item" href="vouchers.php">Vouchers</a>
        <a class="header-navbar__menu-item" href="orders.php">Orders</a>
        <a class="header-navbar__menu-item header-navbar__menu-item--logout" href="logout.php">Logout</a>
    </div>
</header>