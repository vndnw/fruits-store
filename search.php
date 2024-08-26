<?php
include_once "config/connect.php";
include 'includes/header.php';
?>

<article style="min-height: 45vh;" id="product" class="container">
    <div class="grid">
        <div class="grid__row">

            <?php
            $query = isset($_GET['query']) ? $_GET['query'] : '';
            $sql = "SELECT id, name, image, old_price, current_price, 100 * (old_price - current_price) / old_price AS sale_off 
                                        FROM products WHERE name LIKE :query OR description LIKE :query";
            $stmt = $conn->prepare($sql);
            $stmt->execute(['query' => "%$query%"]);
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($products) > 0) {
                ?>
                <div class="grid__column-12">
                    <div class="type-product">
                        <label class="type-product-fruits">Tìm kiếm</label>
                    </div>
                    <br>
                    <h2>Có <span style="color:green"><?php echo count($products); ?></span> sản phẩm được tìm thấy</h2>

                </div>
                <div class="grid__column-12">
                    <div class="home-product">
                        <div class="grid__row">
                            <!-- Product item -->
                            <?php
                            foreach ($products as $product) {
                                ?>
                                <div class="grid__column-2">
                                    <div class="home-product-item">
                                        <!-- thẻ a của thông tin sản phẩm -->
                                        <a href="./product.php?id=<?php echo $product['id']; ?>">
                                            <div class="home-product-item__img"
                                                style="background-image: url(<?php echo $product['image']; ?>);">
                                            </div>
                                            <h4 class="home-product-item__name"><?php echo $product['name']; ?></h4>

                                            <div class="home-product-item__price">
                                                <span
                                                    class="home-product-item__price-old"><?php echo number_format($product['old_price']); ?>đ</span>
                                                <span
                                                    class="home-product-item__price-current"><?php echo number_format($product['current_price']); ?>đ</span>
                                            </div>

                                            <div class="home-product-item__favourite">
                                                <i class="fa-solid fa-check"></i>
                                                <span>Yêu thích</span>
                                            </div>
                                        </a>

                                        <div class="home-product-item__sale-off">
                                            <span
                                                class="home-product-item__sale-off-percent"><?php echo number_format($product['sale_off']); ?>%</span>
                                            <span class="home-product-item__sale-off-label">GIẢM</span>
                                        </div>
                                        <!-- thẻ a của thêm vào giỏ hàng -->
                                        <a href="cart.php?id=<?php echo $product['id'] ?>">
                                            <div class="home-product-item__add">
                                                <h3 class="home-product-item__add-cart-label">Thêm vào giỏ</h3>
                                                <span>
                                                    <i class="home-product-item__add-cart-icon fa-solid fa-basket-shopping"></i>
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <?php
                            }
            } else { ?>
                            <div class="grid__column-12">
                                <div class="type-product">
                                    <label class="type-product-fruits">Tìm kiếm</label>
                                </div>
                                <br>
                                <h2>
                                    Không tìm thấy "<?php echo $query; ?>". Vui lòng kiểm tra chính tả, sử dụng
                                    các từ tổng quát hơn và thử lại!
                                </h2>

                            </div>
                            <?php
            }
            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
<?php include 'includes/footer.php'; ?>