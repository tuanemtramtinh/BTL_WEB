<div class="order__success">
  <div class="container">
    <div class="order__success-wrapper">
      <div class="order__success-alert">
        <i class="fa-solid fa-check"></i> Order successfully! We will process your order as soon as possible.
      </div>
      <div class="order__success-info">
        Email: anhnguyentuan073@gmail.com
      </div>
    </div>
  </div>
</div>

<div class="cart">
  <div class="container">

    <div class="order" data-aos="fade-down" data-aos-duration="500">
      <div class="order__title">Personal Information</div>
      <table class="order__table">
        <tbody>
          <tr>
            <td>Fullname</td>
            <td>
              <input disabled value="<?= $data['order']['OrderFullname'] ?>" type="text" placeholder="Fullname" name="fullname">
            </td>
          </tr>
          <tr>
            <td>Email</td>
            <td>
              <input disabled value="<?= $data['order']['OrderEmail'] ?>" type="email" placeholder="Email" name="email">
            </td>
          </tr>
          <tr>
            <td>Phone Number</td>
            <td>
              <input disabled value="<?= $data['order']['OrderPhone'] ?>" type="text" placeholder="Phone Number" name="phone">
            </td>
          </tr>
          <tr>
            <td>Address</td>
            <td>
              <input disabled value="<?= $data['order']['OrderAddress'] ?>" type="text" placeholder="Address" name="address">
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="cart__wrapper">
      <h2 data-aos="fade-down" data-aos-duration="800" class="cart__title">
        Order Detail
      </h2>
      <div class="cart__main">
        <div class="cart__table">
          <div class="cart__table-header">
            <h3 class="cart__table-title">
              Item
            </h3>
            <h3 class="cart__table-title">
              Price
            </h3>
            <h3 class="cart__table-title">
              Quantity
            </h3>
            <h3 class="cart__table-title">
              Total
            </h3>
          </div>
          <div class="cart__table-list">
            <?php
            if (isset($data['items'])) foreach ($data['items'] as $item) {
            ?>
              <?php
              $productImage = json_decode($item['ProductImage'])
              ?>
              <div data-aos="fade-down" data-aos-duration="800" class="cart__table-item">
                <div class="cart__table-name">
                  <div class="cart__table-image">
                    <img src="<?= $productImage[0] ?>" alt="">
                  </div>
                  <div class="cart__table-item-title">
                    <h4><?= $item['ProductName'] ?></h4>
                    <p class="cart__table-price-mobile"><?= number_format($item['ProductPrice']) ?> VND</p>
                  </div>
                </div>
                <div class="cart__table-price">
                  <?= number_format($item['ProductPrice']) ?> VND
                </div>
                <div class="cart__table-quantity">
                  <p><?= $item['Quantity'] ?></p>
                </div>
                <div class="cart__table-total">
                  <?= number_format($item['Total']) ?> VND
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
        <div data-aos="fade-down" data-aos-duration="800" class="cart__summary">
          <div class="cart__subtotal">
            <span>Subtotal</span>
            <span><?= number_format($data['order']['Total']) ?> VND </span>
          </div>
        </div>
        <div data-aos="fade-down" data-aos-duration="800" class="cart__submit">
          <a href="product/index">
            Back to Shopping
          </a>
        </div>
      </div>
    </div>
  </div>
</div>