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
        <img src="./assets/img/slides/slide1.png">
    </div>

    <div class="mySlides fade">
        <img src="./assets/img/slides/slide2.png">
    </div>

    <div class="mySlides fade">
        <img src="./assets/img/slides/slide3.png">
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
                        $sql = "SELECT id, name, image , old_price, current_price, 100 * (old_price - current_price) / old_price AS sale_off FROM products";

                        $products = $conn->query($sql);
                        // $conn->close();
                        
                        foreach ($products as $product) {
                            ?>
                            <div class="grid__column-2">
                                <a class="home-product-item" href="./product.php?id=<?php echo $product['id']; ?>">
                                    <div class="home-product-item__img"
                                        style="background-image: url(<?php echo $product['image']; ?>);"></div>
                                    <h4 class="home-product-item__name"><?php echo $product['name']; ?></h4>

                                    <div class="home-product-item__price">
                                        <span
                                            class="home-product-item__price-old"><?php echo number_format($product['old_price']); ?>đ</span>
                                        <span
                                            class="home-product-item__price-current"><?php echo number_format($product['current_price']); ?>đ</span>
                                    </div>

                                    <div class="home-product-item__add">
                                        <h3 class="home-product-item__add-cart-label">Thêm vào giỏ</h3>
                                        <span>
                                            <i class="home-product-item__add-cart-icon fa-solid fa-basket-shopping"></i>
                                        </span>
                                    </div>

                                    <div class="home-product-item__favourite">
                                        <i class="fa-solid fa-check"></i>
                                        <span>Yêu thích</span>
                                    </div>

                                    <div class="home-product-item__sale-off">
                                        <span
                                            class="home-product-item__sale-off-percent"><?php echo number_format($product['sale_off']); ?>%</span>
                                        <span class="home-product-item__sale-off-label">GIẢM</span>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                        ?>


                    </div>
                </div>

                <!-- Pagination -->
                <ul class="pagination home-product__pagination">
                    <li class="pagination-item">
                        <a href="" class="pagination-item__link">
                            <i class="pagination-item__icon fa-solid fa-angle-left"></i>
                        </a>
                    </li>

                    <li class="pagination-item pagination-item--active">
                        <a href="" class="pagination-item__link">1</a>
                    </li>

                    <li class="pagination-item">
                        <a href="" class="pagination-item__link">2</a>
                    </li>

                    <li class="pagination-item">
                        <a href="" class="pagination-item__link">3</a>
                    </li>

                    <li class="pagination-item">
                        <a href="" class="pagination-item__link">4</a>
                    </li>

                    <li class="pagination-item">
                        <a href="" class="pagination-item__link">5</a>
                    </li>

                    <li class="pagination-item">
                        <a href="" class="pagination-item__link">...</a>
                    </li>

                    <li class="pagination-item">
                        <a href="" class="pagination-item__link">14</a>
                    </li>

                    <li class="pagination-item">
                        <a href="" class="pagination-item__link">
                            <i class="pagination-item__icon fa-solid fa-angle-right"></i>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</article>

<?php include 'includes/footer.php'; ?>