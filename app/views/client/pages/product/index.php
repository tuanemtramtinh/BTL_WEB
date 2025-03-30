<div class="product">
  <div class="container">
    <div class="product__wrapper">
      <h2 data-aos="fade-down" data-aos-duration="500" class="product__title">Products</h2>
      <div data-aos="fade-left" data-aos-duration="500" class="product__filter">
        <label for="filter">Sort by</label>
        <div class="product__filter-wrapper">
          <select name="filter" id="filter">
            <option value="">A to Z</option>
            <option value="">Z to A</option>
            <option value="">Price Increase</option>
            <option value="">Price Decrease</option>
          </select>
          <i class="fa-solid fa-chevron-down"></i>
        </div>
      </div>
      <div class="product__list">
        <?php
        $delay = 50;
        for ($i=0; $i < 8; $i++) { 
          echo '
          
          <div data-aos="fade-down" data-aos-duration="500" class="product__item-wrapper">
            <a href="product/detail" class="product__item">
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
          </div>
          ';
        }
        ?>

        <!-- <div data-aos="fade-down" data-aos-duration="1000" class="product__item-wrapper">
          <a href="#" class="product__item">
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
        </div> -->
        
      </div>
      <div class="product__pagination">
        <a href="">
          <i class="product__pagination-prev fa-solid fa-chevron-left"></i>
        </a>
        <div class="product__pagination-current">
          Page <span>1</span> of <span>4</span>
        </div>
        <a href="">
          <i class="product__pagination-next fa-solid fa-chevron-right"></i>
        </a>
      </div>
    </div>
  </div>
</div>