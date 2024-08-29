<?php include 'includes/header.php'; ?>
<?php include 'config/connect.php'; ?>
<!-- Marquee -->
<div class="scrolling-container">
    <div class="scrolling-text">
        <b class="scrolling-text__content">
            Giá <span class="highlight">DÂU ĐÀ LẠT</span> giảm chỉ 370k/kg giảm còn
            <span class="highlight">350k/kg</span> khi mua từ 2kg trở lên - Liên hệ 032.609.2480 (Zalo) để đặt hàng
        </b>
    </div>
</div>

<!-- Slideshow container -->
<div class="slideshow-container">
    <div class="mySlides fade">
        <img src="./uploads/slides/slide1.png">
    </div>

    <div class="mySlides fade">
        <img src="./uploads/slides/slide2.png">
    </div>

    <div class="mySlides fade">
        <img src="./uploads/slides/slide3.png">
    </div>

    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
    <br>
    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>
</div>

<!-- Sản phẩm nổi bật -->

<body>
    <div class="featured-products">
        <div class="products-navigation">
            <h2>Sản phẩm nổi bật</h2>
            <div class="products-navigation__prev-next">
                <button class="prev-btn">&#10094;</button>
                <button class="next-btn">&#10095;</button>
            </div>
        </div>
        <div class="products-container">
            <?php
            // Fetch featured products from the database
            $stmt = $conn->prepare("SELECT id, name, image, old_price, current_price, 100 * (old_price - current_price) / old_price AS sale_off 
                                FROM products 
                                WHERE is_featured = 1");
            $stmt->execute();
            $featuredProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($featuredProducts as $product) {
                ?>
                <div class="product">
                    <a href="./product.php?id=<?php echo $product['id']; ?>" class="product-link">
                        <div class="product-image">
                            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                        </div>
                        <div class="product-name">
                            <p><?php echo $product['name']; ?></p>
                        </div>
                        <div class="product-prices">
                            <p>Giá cũ: <span
                                    class="old-price"><?php echo number_format($product['old_price'], 0, ',', '.'); ?>đ</span>
                            </p>
                            <p>Giá mới: <span
                                    class="new-price"><?php echo number_format($product['current_price'], 0, ',', '.'); ?>đ</span>
                            </p>
                        </div>
                        <div class="product-prices__sale-off">
                            <span class="product-prices__sale-off-percent">
                                <p>-<?php echo round($product['sale_off']); ?>%</p>
                            </span>
                        </div>
                    </a>
                    <div class="add-to-cart">
                        <a onclick="return addToCart()" href="cart.php?id=<?php echo $product['id'] ?>"
                            class="add-to-cart__content">Thêm vào giỏ</a>
                        <span>
                            <a onclick="return addToCart()" href="cart.php?id=<?php echo $product['id'] ?>"><i
                                    class="home-product-item__add-cart-icon fa-solid fa-basket-shopping"></i></a>
                        </span>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>

</body>






<!-- Container -->
<article id="product" class="container">
    <div class="grid">
        <div class="grid__row">
            <div class="grid__column-12">
                <div class="type-product">
                    <label class="type-product-fruits">Trái Cây</label>
                </div>
            </div>
            <div class="grid__column-12">
                <div class="home-product">
                    <div class="grid__row">

                        <!-- Product item -->
                        <?php
                        $limit = 12;
                        $stmt = $conn->prepare("SELECT COUNT(*) as total FROM products");
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $totalRecords = $row['total'];
                        $totalPages = ceil($totalRecords / $limit);

                        $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                        if ($currentPage < 1 || $currentPage > $totalPages) {
                            $currentPage = 1;
                        }

                        $offset = ($currentPage - 1) * $limit;

                        $stmt = $conn->prepare("SELECT id, name, image, old_price, current_price, 100 * (old_price - current_price) / old_price AS sale_off 
                                        FROM products 
                                        LIMIT :limit OFFSET :offset");
                        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                        $stmt->execute();
                        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);



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
                                    <a onclick="return addToCart()" href="cart.php?id=<?php echo $product['id'] ?>">
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
                        ?>


                    </div>
                </div>

                <!-- Pagination -->
                <?php


                // Generate pagination links
                echo '<ul class="pagination home-product__pagination">';
                // Previous link
                if ($currentPage > 1) {
                    echo '<li class="pagination-item"><a href="?page=' . ($currentPage - 1) . '" class="pagination-item__link"><i class="pagination-item__icon fa-solid fa-angle-left"></i></a></li>';
                }
                // Page numbers
                for ($i = 1; $i <= $totalPages; $i++) {
                    $activeClass = ($i == $currentPage) ? 'pagination-item--active' : '';
                    echo '<li class="pagination-item ' . $activeClass . '"><a href="?page=' . $i . '" class="pagination-item__link">' . $i . '</a></li>';
                }

                // Next link
                if ($currentPage < $totalPages) {
                    echo '<li class="pagination-item"><a href="?page=' . ($currentPage + 1) . '" class="pagination-item__link"><i class="pagination-item__icon fa-solid fa-angle-right"></i></a></li>';
                }

                echo '</ul>';
                ?>

            </div>
        </div>
    </div>
</article>

</body>

<script>
    const container = document.querySelector('.products-container');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');

    nextBtn.addEventListener('click', () => {
        container.scrollBy({ left: 240, behavior: 'smooth' });
    });

    prevBtn.addEventListener('click', () => {
        container.scrollBy({ left: -240, behavior: 'smooth' });
    });
</script>

<?php include 'includes/footer.php'; ?>