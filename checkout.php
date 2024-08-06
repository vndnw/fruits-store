<?php include 'includes/header.php'; ?>
      <!-- Container -->
      <main class="container">
        <div class="grid">
          <div class="checkout grid__row">
            <div class="checkout__info grid__column-7">
              <div class="checkout__heading">
                <h1 class="checkout__title">Thông tin đơn hàng</h1>
              </div>
              <div class="checkout__form">
                <form class="checkout__form-box">
                  <div class="checkout__form-group">
                    <input
                      type="text"
                      id="name"
                      class="checkout__form-input"
                      placeholder="Họ và tên"
                    />
                  </div>
                  <div class="checkout__form-group">
                    <input
                      type="text"
                      id="phone"
                      class="checkout__form-input"
                      placeholder="Số điện thoại"
                    />
                  </div>
                  <div class="checkout__form-group">
                    <input
                      type="text"
                      id="address"
                      class="checkout__form-input"
                      placeholder="Địa chỉ"
                    />
                  </div>
                  <div class="checkout__form-group">
                    <textarea
                      name="note"
                      id="note"
                      class="checkout__form-textarea"
                      placeholder="Ghi chú"
                      rows="5"
                    ></textarea>
                  </div>
                  <h2>Phương thức thanh toán</h2>

                  <div class="checkout__form-group payment">
                    <div>
                      <input
                        type="radio"
                        name="payment"
                        id="momo"
                        class="checkout__form-radio"
                        value="momo"
                      />
                      <label for="momo" class="checkout__form-label"
                        >Thanh toán qua MoMo</label
                      >
                    </div>
                    <div>
                      <input
                        type="radio"
                        name="payment"
                        id="cod"
                        class="checkout__form-radio"
                        value="cod"
                      />
                      <label for="cod" class="checkout__form-label"
                        >Thanh toán khi nhận hàng (COD)</label
                      >
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="checkout__cart grid__column-5">
              <div class="checkout__cart-item-list">
                <div class="checkout__cart-item">
                  <div class="checkout__cart-item-img">
                    <img
                      src="./assets/img/checkout/buoi-da-xanh.jpg"
                      alt=""
                      class="checkout__cart-item-img-box"
                    />
                  </div>
                  <div class="checkout__cart-item-info">
                    <h3 class="checkout__cart-item-title">Bưởi da xanh</h3>
                    <div class="checkout__cart-item-price">30.000đ</div>
                    <div class="checkout__cart-item-actions">
                      <div class="checkout__cart-item-delete">
                        <i class="fa-solid fa-trash-can"></i>
                      </div>
                      <div class="checkout__cart-item-action">
                        <button class="checkout__cart-item-btn">-</button>
                        <input
                          class="checkout__cart-item-quantity-input"
                          type="text"
                          value="1"
                        />
                        <button class="checkout__cart-item-btn">+</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="checkout__cart-item">
                  <div class="checkout__cart-item-img">
                    <img
                      src="./assets/img/checkout/dau-tay.jpg"
                      alt=""
                      class="checkout__cart-item-img-box"
                    />
                  </div>
                  <div class="checkout__cart-item-info">
                    <h3 class="checkout__cart-item-title">Dâu tây Đà Lạt</h3>
                    <div class="checkout__cart-item-price">100.000đ</div>
                    <div class="checkout__cart-item-actions">
                      <div class="checkout__cart-item-delete">
                        <i class="fa-solid fa-trash-can"></i>
                      </div>
                      <div class="checkout__cart-item-action">
                        <button class="checkout__cart-item-btn">-</button>
                        <input
                          class="checkout__cart-item-quantity-input"
                          type="text"
                          value="2"
                        />
                        <button class="checkout__cart-item-btn">+</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="checkout__cart-voucher">
                <input
                  type="text"
                  class="checkout__cart-voucher-input"
                  placeholder="Mã giảm giá"
                />
                <button class="checkout__cart-voucher-btn">Áp dụng</button>
              </div>
              <div class="checkout__cart-fee">
                <div class="checkout__cart-fee-item">
                  <span class="checkout__cart-fee-title">Tạm tính</span>
                  <span class="checkout__cart-fee-price">230.000đ</span>
                </div>
                <div class="checkout__cart-fee-item">
                  <span class="checkout__cart-fee-title">Phí vận chuyển</span>
                  <span class="checkout__cart-fee-price">
                    <img src="./assets/img/checkout/shipper.png" alt="" />
                    30.000đ</span
                  >
                </div>
                <div class="checkout__cart-fee-item">
                  <span class="checkout__cart-fee-title">Tổng cộng</span>
                  <span class="checkout__cart-fee-price">260.000đ</span>
                </div>
              </div>
              <div class="checkout__cart-btn">
                <button class="checkout__cart-btn-link">Thanh toán</button>
              </div>
            </div>
          </div>
        </div>
      </main>

      <!-- Footer -->
<?php include 'includes/footer.php'; ?>