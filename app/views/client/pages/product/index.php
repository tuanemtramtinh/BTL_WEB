<div class="product">
  <div class="container">
    <div class="product__wrapper">
      <h2 class="product__title">Products</h2>
      <div class="product__filter">
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
        for ($i=0; $i < 8; $i++) { 
          echo '
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
          ';
        }
        ?>

        <!-- <a href="#" class="product__item">
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
         -->
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