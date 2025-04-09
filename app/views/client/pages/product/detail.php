<div class="product-detail">
  <div class="container">
    <div class="product-detail__wrapper">
      <div class="product-detail__buy">
        <div data-aos="fade-down" data-aos-duration="800" class="product-detail__image">
          <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2" id="image">
            <div class="swiper-wrapper">
              <?php
              $productImages = json_decode($data['product']['Image']);
              foreach ($productImages as $image) {
              ?>
                <div class="swiper-slide">
                  <img src="<?= $image ?>" alt="">
                </div>
              <?php } ?>
              <!-- <div class="swiper-slide">
                <img src="public/images/fragment-1.png" alt="">
              </div> -->
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          </div>
          <div thumbsSlider="" class="swiper mySwiper">
            <div class="swiper-wrapper">
              <?php foreach ($productImages as $image) { ?>
                <div class="swiper-slide">
                  <img src="<?= $image ?>" alt="">
                </div>
              <?php } ?>
              <!-- <div class="swiper-slide">
                <img src="public/images/fragment-1.png" alt="">
              </div>
              <div class="swiper-slide">
                <img src="public/images/fragment-1.png" alt="">
              </div>
              <div class="swiper-slide">
                <img src="public/images/fragment-1.png" alt="">
              </div>
              <div class="swiper-slide">
                <img src="public/images/fragment-1.png" alt="">
              </div>
              <div class="swiper-slide">
                <img src="public/images/fragment-1.png" alt="">
              </div> -->
            </div>
          </div>
        </div>
        <div data-aos="fade-down" data-aos-duration="800" class="product-detail__bag">
          <h3 class="product-detail__name">
            Luxurious Elixir
          </h3>
          <div class="product-detail__info">
            <div class="product-detail__info-item">
              <strong>Brand</strong>
              <br>
              <span><?= $data['product']['Brand'] ?></span>
            </div>
            <div class="product-detail__info-item">
              <strong>Category</strong>
              <br>
              <span><?= $data['product']['CategoryName'] ?></span>
            </div>
          </div>
          <!-- <p class="product-detail__desc">
            Step into a world of unparalleled opulence with Luxurious Elixir, an exquisite fragrance that weaves an enchanting symphony of gold and luxury. This gilded elixir is a celebration of sophistication, crafted with the finest essences and imbued with the allure of precious golden hues.
          </p> -->
          <div class="product-detail__price">
            <?= number_format($data['product']['PriceUnit']) ?> VND
          </div>
          <form action="cart/add/<?= $data['product']['ID'] ?>" method="get" class="product-detail__form">
            <div class="quantity__wrapper">
              <label for="quantity">Qty</label>
              <div class="quantity-adjust">
                <i class="fa-solid fa-minus"></i>
                <input min="1" value="1" type="number" name="quantity" id="quantity">
                <i class="fa-solid fa-plus"></i>
              </div>
            </div>
            <br>
            <button class="" type="submit">Add to Bag</button>
          </form>
        </div>
      </div>
      <div data-aos="fade-down" data-aos-duration="800" data-aos-delay="200" class="product-detail__content">
        <h2 class="product-detail__content-title">
          Product Description
        </h2>
        <div class="product-detail__content-body">
          <?= $data['product']['Description'] ?>
        </div>
        <!-- <div class="product-detail__section">
          <h3>Product Details</h3>
          <p>Step into a world of unparalleled opulence with Luxurious Elixir, an exquisite fragrance that weaves an enchanting symphony of gold and luxury. This gilded elixir is a celebration of sophistication, crafted with the finest essences and imbued with the allure of precious golden hues. From the first spritz to the lingering dry-down, Luxurious Elixir promises an intoxicating experience that embodies the essence of lavish indulgence.</p>
        </div>
        <div class="product-detail__section">
          <h3>The Golden Overture</h3>
          <p>Luxurious Elixir opens with a grand flourish of radiant citrus and sun-kissed fruits, reminiscent of golden rays caressing your senses. The opulent heart unfolds with a bouquet of velvety roses and rare blooms, their essence radiating with the allure of gilded petals. As the fragrance settles, a sumptuous blend of warm amber, creamy vanilla, and smooth sandalwood evokes a sense of ultimate luxury and refinement.</p>
        </div>
        <div class="product-detail__section">
          <h3>The Heart of Elegance</h3>
          <p>Luxurious Elixir is the embodiment of elegance, drawing you into a world where glamour and prestige unite. With every spritz, the fragrance weaves a tapestry of glistening gold around you, enhancing your allure and capturing the admiration of those around.</p>
        </div>
        <div class="product-detail__section">
          <h3>The Ultimate Expression of Luxury</h3>
          <p>Luxurious Elixir makes an extraordinary gift, an expression of your discerning taste and admiration for the extraordinary. Delight your loved ones with this lavish elixir, a symbol of admiration and adoration.</p>
        </div> -->
      </div>
    </div>
  </div>
</div>

<div class="product-discover">
  <div class="container">
    <div class="product-discover__wrapper">
      <h2 data-aos="fade-down" data-aos-duration="800" class="product-discover__title">
        Discover More
      </h2>
      <div data-aos="fade-down" data-aos-duration="800" data-aos-delay="300" class="product-discover__list swiper mySwiper3">
        <div class="swiper-wrapper">
          <?php
          for ($i = 0; $i < 5; $i++) {
            echo '
            <a href="#" class="product__item swiper-slide">
              <div class="product__item-image">
                <img src="public/images/fragment-1.png" alt="">
              </div>
              <h3 class="product__item-title">
                Luxurious Elixir Rough
              </h3>
              <div class="product__item-content">
                <span class="product__item-price">$ 220.00</span>
                <span class="product__item-volume">100ml</span>
              </div>
            </a>
            ';
          }
          ?>
          <!-- <a href="#" class="product__item swiper-slide">
            <div class="product__item-image">
              <img src="public/images/fragment-1.png" alt="">
            </div>
            <h3 class="product__item-title">
              Luxurious Elixir Rough
            </h3>
            <div class="product__item-content">
              <span class="product__item-price">$ 220.00</span>
              <span class="product__item-volume">100ml</span>
            </div>
          </a> -->
        </div>

      </div>
    </div>
  </div>
</div>