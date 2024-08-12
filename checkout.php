<?php include 'includes/header.php'; ?>
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
                <input name="name" type="text" id="name" class="checkout__form-input" placeholder="Họ và tên" />
              </div>
              <div class="checkout__form-group">
                <input name="email" type="email" id="email" class="checkout__form-input" placeholder="Email" />
              </div>
              <div class="checkout__form-group">
                <input name="phone" type="text" id="phone" class="checkout__form-input" placeholder="Số điện thoại" />
              </div>
              <div class="checkout__form-group">
                <input name="address" type="text" id="address" class="checkout__form-input" placeholder="Địa chỉ" />
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
            $isCart = isset($_SESSION['cart']);
            if ($isCart) {
              $cartItems = $_SESSION["cart"];
              $totalPrice = 0.0;
              foreach ($cartItems as $item):
                $totalPrice += $item['price'] * $item['quantity']; ?>

                <div class="checkout__cart-item">
                  <div class="checkout__cart-item-img">
                    <img src="./assets/img/checkout/buoi-da-xanh.jpg" alt="" class="checkout__cart-item-img-box" />
                  </div>
                  <div class="checkout__cart-item-info">
                    <h3 class="checkout__cart-item-title"><?php echo $item['name']; ?></h3>
                    <div class="checkout__cart-item-price"><?php echo number_format($item['price']); ?>đ</div>
                    <div class="checkout__cart-item-actions">
                      <div class="checkout__cart-item-delete">
                        <i class="fa-solid fa-trash-can"></i>
                      </div>
                      <div class="checkout__cart-item-action">
                        <button type="button" class="checkout__cart-item-btn">-</button>
                        <input class="checkout__cart-item-quantity-input" type="text"
                          value="<?php echo $item['quantity']; ?>" />

                        <button type="button" class="checkout__cart-item-btn">+</button>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach;
            }
            ?>

          </div>
          <?php if (!$isCart) {
            echo "<h2 class='checkout__cart-empty'>Giỏ hàng trống</h2>";
          } else { ?>
            <div class="checkout__cart-voucher">
              <input type="text" class="checkout__cart-voucher-input" placeholder="Mã giảm giá" />
              <button type="button" class="checkout__cart-voucher-btn">Áp dụng</button>
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
      </div>
    </form>
  </div>
</main>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>