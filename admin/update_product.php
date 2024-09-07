<?php
require_once '../config/session.php';
require_once '../config/connect.php';
requireLogin();

try {
    if (!isset($_GET['id'])) {
        die('ID đơn hàng không hợp lệ');
    }

    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $old_price = $_POST['old_price'];
        $current_price = $_POST['current_price'];
        $is_new = $_POST['is_new'];
        $is_featured = $_POST['is_featured'];

        echo $is_new;
        echo $is_featured;

        $target_dir = "../uploads/products/";
        $image = $result['image'];


        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
            $unique_name = pathinfo($_FILES["image"]["name"], PATHINFO_FILENAME) . uniqid() . '.' . pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            $target_file = $target_dir . $unique_name;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $target_dir = "uploads/products/";
                $image = $target_dir . $unique_name;
            } else {
                echo "Error uploading the file.";
            }
        } else {
            echo "Error: " . $_FILES["image"]["error"];
        }



        $stmt = $conn->prepare("UPDATE products SET name = :name, description = :description, image = :image, old_price = :old_price, current_price = :current_price, is_new = :is_new, is_featured = :is_featured WHERE id = :id");
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':image', $image);
        $stmt->bindValue(':old_price', $old_price);
        $stmt->bindValue(':current_price', $current_price);
        $stmt->bindValue(':is_new', $is_new, PDO::PARAM_INT);
        $stmt->bindValue(':is_featured', $is_featured, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header('Location: products.php');
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
    <title>Xobbee - Edit Product</title>
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

        .form-group input[type="file"] {
            padding: 0;
        }

        /* Image Preview Styles */
        .image-preview {
            margin-top: 15px;
        }

        .image-preview img {
            max-width: 100%;
            max-height: 200px;
            border-radius: 5px;
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

        .product-options label {
            display: inline-block;
            margin-right: 10px;
        }

        .product-options input[type="radio"] {
            margin-left: 5px;
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="wrapper">

        <?php include "./header.php" ?>

        <article class="article">
            <h1>Edit Product</h1>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input type="text" id="name" name="name" value="<?php echo $result['name'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea id="description" name="description"
                        required><?php echo $result['description'] ?></textarea>
                </div>

                <div class="form-group">
                    <label for="image">Hình ảnh</label>
                    <input type="file" id="image" name="image" accept="image/*">
                    <div class="image-preview" id="image-preview">
                        <?php if (!empty($result['image'])): ?>
                            <img src="../<?php echo htmlspecialchars($result['image']); ?>"
                                alt="<?php echo $result['name'] ?>">
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="old-price">Giá cũ</label>
                    <input type="number" id="old-price" name="old_price" value="<?php echo $result['old_price'] ?>"
                        required>
                </div>

                <div class="form-group">
                    <label for="current_price">Giá mới</label>
                    <input type="number" id="current_price" name="current_price"
                        value="<?php echo $result['current_price'] ?>" required>
                </div>

                <!-- <div class="form-group">
                    <label for="status">Trạng thái</label>
                    <select id="status" name="status" required>
                        <option value="in_stock">Còn hàng
                        </option>
                        <option value="out_of_stock">
                            Hết hàng</option>
                    </select>
                </div> -->
                <div class="">
                    <div class="product-options">
                        <label for="new_product_yes">Hàng mới:
                            <input type="radio" id="new_product_yes" name="is_new" value="1" <?php echo $result['is_new'] == 1 ? 'checked' : ''; ?>> Có
                            <input type="radio" id="new_product_no" name="is_new" value="0" <?php echo $result['is_new'] == 0 ? 'checked' : ''; ?>> Không
                        </label>
                        <br>
                        <label for="featured_product_yes">Hàng nổi bật:
                            <input type="radio" id="featured_product_yes" name="is_featured" value="1" <?php echo $result['is_featured'] == 1 ? 'checked' : ''; ?>> Có
                            <input type="radio" id="featured_product_no" name="is_featured" value="0" <?php echo $result['is_featured'] == 0 ? 'checked' : ''; ?>> Không
                        </label>
                    </div>
                </div>


                <div class="form-buttons">
                    <button type="submit" class="button-save">Lưu</button>
                    <a href="products.php"><button type="button" class="button-cancel">Hủy</button></a>
                </div>
            </form>
        </article>

        <footer>

        </footer>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const imagePreview = document.getElementById('image-preview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    imagePreview.innerHTML = ''; // Clear any previous image
                    imagePreview.appendChild(img);
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.innerHTML = ''; // Clear preview if no file
            }
        });
    </script>
</body>

</html>