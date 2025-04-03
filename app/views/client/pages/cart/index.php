<div class="cart">
  <div class="container">
    <div class="cart__wrapper">
      <h2 data-aos="fade-down" data-aos-duration="800" class="cart__title">
        Shopping Bag
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
                  <div class="quantity-adjust">
                    <?php
                    if ($item['ProductQuantity'] > 0) {
                    ?>
                      <a href="cart/add/<?= $item['ProductID'] ?>?quantity=-1&inCart=true" class="fa-solid fa-minus"></a>
                    <?php } else { ?>
                      <i class="fa-solid fa-minus"></i>
                    <?php } ?>
                    <input min="1" value="<?= $item['ProductQuantity'] ?>" type="number" name="quantity" id="quantity">
                    <a href="cart/add/<?= $item['ProductID'] ?>?quantity=1&inCart=true" class="fa-solid fa-plus"></a>
                  </div>
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
            <span><?= number_format($data['cart']['Total']) ?> VND </span>
          </div>
          <div class="cart__shipping">
            <span>Shipping</span>
            <span>Free</span>
          </div>
          <div class="cart__promo">
            <label for="promo">Promo Code</label>
            <input type="text" name="promo" id="promo" placeholder="Write here">
          </div>
        </div>
        <div data-aos="fade-down" data-aos-duration="800" class="cart__submit">
          <a href="order/<?= $data['cart']['ID'] ?>">
            Proceed to Checkout
          </a>
        </div>
      </div>
    </div>
  </div>
</div>