<?php
include 'includes/header.php'; ?>
<!-- Container -->
<main class="container">
  <div class="grid">
    <form action="process_payment.php" method="post">
      <div class="checkout grid__row">
        <div class="checkout__info grid__column-7">
          <div class="checkout__heading">
            <h1 class="checkout__title">Thông tin đơn hàng</h1>
          </div>
          <div class="checkout__form">
            <form class="checkout__form-box">
              <div class="checkout__form-group">
                <input required name="name" type="text" id="name" class="checkout__form-input"
                  placeholder="Họ và tên" />
              </div>
              <div class="checkout__form-group">
                <input required name="email" type="email" id="email" class="checkout__form-input" placeholder="Email" />
              </div>
              <div class="checkout__form-group">
                <input required name="phone" type="text" id="phone" class="checkout__form-input"
                  placeholder="Số điện thoại" />
              </div>
              <div class="checkout__form-group">
                <input required name="address" type="text" id="address" class="checkout__form-input"
                  placeholder="Địa chỉ" />
              </div>
              <div class="checkout__form-group">
                <textarea name="note" id="note" class="checkout__form-textarea" placeholder="Ghi chú"
                  rows="5"></textarea>
              </div>
              <h2>Phương thức thanh toán</h2>

              <div class="checkout__form-group payment">
                <div style="opacity: .2;">
                  <input disabled type="radio" name="payment" id="momo" class="checkout__form-radio" value="momo" />
                  <label for="momo" class="checkout__form-label">Thanh toán qua MoMo</label>
                </div>
                <div>
                  <input checked type="radio" name="payment" id="cod" class="checkout__form-radio" value="cod" />
                  <label for="cod" class="checkout__form-label">Thanh toán khi nhận hàng (COD)</label>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="checkout__cart grid__column-5">
          <div class="checkout__cart-item-list">

            <?php
            $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
            if (!empty($cart)) {
              include "config/connect.php";

              $productIds = array_keys($cart);
              $placeholders = rtrim(str_repeat('?,', count($productIds)), ','); // Tạo chuỗi ?,?,?
            
              $sql = "SELECT * FROM products WHERE id IN ($placeholders)";
              $stmt = $conn->prepare($sql);
              $stmt->execute($productIds);

              $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
              $totalPrice = 0.0;

              foreach ($products as $item):
                $totalPrice += $item['current_price'] * $cart[$item['id']]; ?>

                <div class="checkout__cart-item">
                  <div class="checkout__cart-item-img">
                    <img src="<?php echo $item['image']; ?>" alt="" class="checkout__cart-item-img-box" />
                  </div>
                  <div class="checkout__cart-item-info">
                    <h3 class="checkout__cart-item-title"><?php echo $item['name']; ?></h3>
                    <div class="checkout__cart-item-price"><?php echo number_format($item['current_price']); ?>đ</div>
                    <div class="checkout__cart-item-actions">
                      <a href="cart.php?action=remove&id=<?php echo $item['id'] ?>" class="checkout__cart-item-delete">
                        <i class="fa-solid fa-trash-can"></i>
                      </a>
                      <div class="checkout__cart-item-action">
                        <button type="button" class="checkout__cart-item-btn minus">-</button>
                        <input data-product-id="<?php echo $item['id']; ?>"
                          class="checkout__cart-item-quantity-input quantity" type="number" min="1"
                          value="<?php echo $cart[$item['id']]; ?>" />
                        <button type="button" class="checkout__cart-item-btn plus">+</button>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach;
            }
            ?>

          </div>
          <?php if (!isset($_SESSION['cart'])) {
            echo "<h2 class='checkout__cart-empty'>Giỏ hàng trống</h2>";
          } else { ?>
            <div class="checkout__cart-voucher">
              <form class="checkout__cart-voucher-input-group">
                <input name="voucher_code" value="" type="text" class="checkout__cart-voucher-input"
                  placeholder="Mã giảm giá" />
                <button type="submit" class="checkout__cart-voucher-btn">Áp dụng</button>
              </form>
              <?php
              if (isset($_SESSION['error'])) {
                echo "<p style='color:red;' class='checkout__cart-voucher-msg'>" . $_SESSION['error'] . "</p>";
                unset($_SESSION['error']);
              } else if (isset($_SESSION['description'])) {
                echo "<p style='color:green;' class='checkout__cart-voucher-msg'>" . $_SESSION['description'] . "</p>";
                unset($_SESSION['description']);
              }
              if (isset($_SESSION['discount'])) {

                echo $_SESSION['discount'];
              }
              ?>
            </div>

            <div class="checkout__cart-fee">
              <div class="checkout__cart-fee-item">
                <span class="checkout__cart-fee-title">Tạm tính</span>
                <span class="checkout__cart-fee-price"><?php echo (number_format($totalPrice)) ?>đ</span>
              </div>
              <div class="checkout__cart-fee-item">
                <span class="checkout__cart-fee-title">Phí vận chuyển</span>
                <span class="checkout__cart-fee-price">
                  <img src="./assets/img/checkout/shipper.png" alt="" />
                  30.000đ</span>
              </div>
              <div class="checkout__cart-fee-item">
                <span class="checkout__cart-fee-title">Tổng cộng</span>
                <span class="checkout__cart-fee-price"><?php echo (number_format($totalPrice + 30000)) ?>đ</span>
                <input type="text" name="total-price" hidden value="<?php echo ($totalPrice + 30000) ?>">
              </div>
            </div>
            <div class="checkout__cart-btn">
              <button name="place_order" class="checkout__cart-btn-link">Đặt hàng</button>
            </div>
          <?php }
          ?>


        </div>

        <div class="checkout__cart-success grid__column-5">
    <div class="success-message">
        <i class="success-icon"></i>
        <h1>Đặt Hàng Thành Công!</h1>
        <p>Cảm ơn bạn đã mua hàng. Mã đơn hàng của bạn là <strong>#123456</strong>.</p>
    </div>

    <div class="order-details">
        <h2>Chi Tiết Đơn Hàng</h2>
        <ul>
            <li>Tên sản phẩm: <span>Hộp Táo 250g</span></li>
            <li>Số lượng: <span>2</span></li>
            <li>Tổng giá: <span>800,000₫</span></li>
        </ul>
    </div>

    <div class="action-buttons">
        <a href="/shop" class="btn btn-primary">Tiếp Tục Mua Sắm</a>
        <a href="/orders" class="btn btn-secondary">Xem Đơn Hàng</a>
    </div>
</div>

      </div>
    </form>
  </div>
</main>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>