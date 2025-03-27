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
            <div data-aos="fade-down" data-aos-duration="800" class="cart__table-item">
              <div class="cart__table-name">
                <div class="cart__table-image">
                  <img src="public/images/fragment-1.png" alt="">
                </div>
                <div class="cart__table-item-title">
                  <h4>Luxrious Elixir</h4>
                  <p class="cart__table-price-mobile">$599</p>
                </div>
              </div>
              <div class="cart__table-price">
                $559
              </div>
              <div class="cart__table-quantity">
                <div class="quantity-adjust">
                  <i class="fa-solid fa-minus"></i>
                  <input min="1" value="1" type="number" name="quantity" id="quantity">
                  <i class="fa-solid fa-plus"></i>
                </div>
              </div>
              <div class="cart__table-total">
                $559
              </div>
            </div>
            <?php
            for ($i = 0; $i < 5; $i++) {
              echo '
            <div data-aos="fade-down" data-aos-duration="800" data-aos-delay="200" class="cart__table-item">
              <div class="cart__table-name">
                <div class="cart__table-image">
                  <img src="public/images/fragment-1.png" alt="">
                </div>
                <div class="cart__table-item-title">
                  <h4>Luxrious Elixir</h4>
                  <p class="cart__table-price-mobile">$599</p>
                </div>
              </div>
              <div class="cart__table-price">
                $559
              </div>
              <div class="cart__table-quantity">
                <div class="quantity-adjust">
                  <i class="fa-solid fa-minus"></i>
                  <input min="1" value="1" type="number" name="quantity" id="quantity">
                  <i class="fa-solid fa-plus"></i>
                </div>
              </div>
              <div class="cart__table-total">
                $559
              </div>
            </div>
            ';
            }
            ?>
          </div>
        </div>
        <div data-aos="fade-down" data-aos-duration="800" class="cart__summary">
          <div class="cart__subtotal">
            <span>Subtotal</span>
            <span>$599</span>
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
          <button>
            Proceed to Checkout
          </button>
        </div>
      </div>
    </div>
  </div>
</div>