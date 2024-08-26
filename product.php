<?php include 'includes/header.php'; ?>
<?php include 'config/connect.php'; ?>

<!-- Container -->
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT name, description, image, old_price, current_price,100 * (old_price - current_price) / old_price AS sale_off   FROM products WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $product = $stmt->fetch();
}
?>
<article id="container" class="container">
    <div class="grid">
        <div class="grid__row">
            <div class="grid__column-12 page-product">
                <div class="grid__column-5 img-product">
                    <div class="wrapper-img-product-item">
                        <img class="img-product-item" src="<?php echo $product['image']; ?>" alt="">
                    </div>

                    <!-- Slideshow img -->
                    <div style="visibility: hidden;" class="slideshow-img">
                        <div class="list-Img">
                            <div class="myImg fade">
                                <img src="./assets/img/slides/slide1.png">
                            </div>

                            <div class="myImg fade">
                                <img src="./assets/img/slides/slide2.png">
                            </div>

                            <div class="myImg fade">
                                <img src="./assets/img/slides/slide3.png">
                            </div>

                            <div class="myImg fade">
                                <img src="./assets/img/slides/slide1.png">
                            </div>

                            <div class="myImg fade">
                                <img src="./assets/img/slides/slide2.png">
                            </div>
                            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                            <a class="next" onclick="plusSlides(1)">&#10095;</a>
                        </div>


                        <div style="text-align:center">
                            <span class="dot" onclick="currentSlide(1)"></span>
                            <span class="dot" onclick="currentSlide(2)"></span>
                            <span class="dot" onclick="currentSlide(3)"></span>
                            <span class="dot" onclick="currentSlide(1)"></span>
                            <span class="dot" onclick="currentSlide(2)"></span>
                        </div>
                    </div>

                    <div class="footer-img-product">
                        <div class="share-product">
                            <h3>Chia sẻ: </h3>
                            <div class="list-icon-product">
                                <a class="list-icon-product" href="">
                                    <i class="icon-product fa-brands fa-facebook"></i>
                                </a>

                                <a class="list-icon-product" href="">
                                    <i class="icon-product fa-brands fa-facebook-messenger"></i>
                                </a>

                                <a class="list-icon-product" href="">
                                    <i class="icon-product fa-brands fa-pinterest"></i>
                                </a>

                                <a class="list-icon-product" href="">
                                    <i class="icon-product fa-brands fa-square-x-twitter"></i>
                                </a>
                            </div>
                        </div>

                        <div class="favourite-product">
                            <i class="icon-product fa-regular fa-heart"></i>
                            <h3>Đã thích (<?php echo mt_rand(49, 99); ?>)</h3>
                        </div>
                    </div>
                </div>

                <div class="grid__column-7 info-product">
                    <div class="pay">
                        <div class="name-product">
                            <h1><?php echo $product['name']; ?></h1>
                            <div class="name-product__status">
                                <h3>Tình trạng: </h3>
                                <span>còn hàng</span>
                            </div>
                        </div>
                        <form action="cart.php" method="post">
                            <div class="pay-product">
                                <div class="pay-product__price-product">
                                    <h3>Giá: </h3>
                                    <span
                                        class="pay-product__price-current"><?php echo number_format($product['current_price']); ?>đ</span>
                                    <span
                                        class="pay-product__price-old"><?php echo number_format($product['old_price']); ?>đ</span>
                                    <div><?php echo number_format($product['sale_off']); ?>%</div>
                                </div>

                                <div class="pay-product__type-product">
                                    <p>Loại: </p>
                                    <input type="radio" id="type250g" name="product-type" class="pay-product__type-product-active">
                                    <label for="type250g" class="pay-product__type-product-label">Hộp 250g</label>

                                    <input type="radio" id="type330g" name="product-type">
                                    <label for="type330g" class="pay-product__type-product-label">Hộp 330g</label>
                                </div>


                                <div class="pay-product__quantity-product">
                                    <p>Số lượng: </p>
                                    <div onclick="changeQuantity(-1)" style="cursor: pointer;">
                                        <i class="fa-solid fa-minus"></i>
                                    </div>
                                    <div style="width: 40px; padding: 0;">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <input type="hidden" name="image" value="<?php echo $product['image']; ?>">
                                        <input type="hidden" name="product_name"
                                            value="<?php echo $product['name']; ?>">
                                        <input type="hidden" name="product_price"
                                            value="<?php echo $product['current_price']; ?>">
                                        <input id="quantity"
                                            style="width: 100%; height:100%; border: none; text-align: center;"
                                            type="number" min="1" name="quantity" value="1">

                                    </div>
                                    <div onclick="changeQuantity(1)" style="cursor: pointer;">
                                        <i class="fa-solid fa-plus"></i>
                                    </div>
                                </div>

                                <div class="pay-product__add-and-pay">
                                    <button type="submit" name="action" value="add-cart" class="add-and-pay__add-cart">
                                        Thêm vào giỏ</button>
                                    <button type="submit" name="action" value="buy-now" class="add-and-pay__pay-now">
                                        Mua Ngay</button>
                                </div>
                            </div>

                        </form>

                        <div class="grid__row delivery-product">
                            <div class="grid__column-3 delivery-product__commit">
                                <span>
                                    <i class="delivery-product__commit-icon fa-solid fa-box"></i>
                                </span>
                                Cam kết chính hãng 100%
                            </div>

                            <div class="grid__column-3 delivery-product__commit">
                                <span>
                                    <i class="delivery-product__commit-icon fa-solid fa-truck"></i>
                                </span>
                                Free giao hàng đơn hàng từ 500k
                            </div>

                            <div class="grid__column-3 delivery-product__commit">
                                <span>
                                    <i class="delivery-product__commit-icon fa-solid fa-phone-volume"></i>
                                </span>
                                Hỗ trợ 24/7
                            </div>


                            <div class="grid__column-3 delivery-product__commit">
                                <span>
                                    <i class="delivery-product__commit-icon fa-solid fa-shield-halved"></i>
                                </span>
                                Đảm bảo hàng đúng xuất xứ
                            </div>

                            <div class="grid__column-3 delivery-product__commit">
                                <span>
                                    <i class="delivery-product__commit-icon fa-solid fa-thumbs-up"></i>
                                </span>
                                Phục vụ nhiệt tình, nhanh chóng
                            </div>

                            <div class="grid__column-3 delivery-product__commit">
                                <span>
                                    <i class="delivery-product__commit-icon fa-solid fa-circle-left"></i>
                                </span>
                                Kiếm tra trước khi nhận hàng
                            </div>
                        </div>

                        <div class="describe-product">
                            <div class="describe-product__title">
                                <h2>Mô tả sản phẩm</h2>
                            </div>
                            <div class="describe-product__content">
                                <h3><?php echo $product['description']; ?></h3>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
</article>

<?php include 'includes/footer.php'; ?>