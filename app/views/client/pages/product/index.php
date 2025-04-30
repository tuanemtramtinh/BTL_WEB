<div class="product">
  <div class="container">
    <div class="product__wrapper">
      <h2 data-aos="fade-down" data-aos-duration="500" class="product__title">Products</h2>
      <div data-aos="fade-left" data-aos-duration="500" class="product__filter">

        <div class="left">
          <div>
            <label for="filter">Brand</label>
            <div class="product__filter-wrapper">
              <select name="filter" class="filter-brand" id="filter">
                <option value="" <?php if ($data['brand'] === '') echo "selected" ?>>All</option>
                <?php
                if (isset($data['brands'])) foreach ($data['brands'] as $brand) { ?>
                  <option value="<?= $brand['Name'] ?>" <?php if ($data['brand'] === $brand['Name']) echo "selected" ?>><?= $brand['Name'] ?></option>
                <?php } ?>
              </select>
              <i class="fa-solid fa-chevron-down"></i>
            </div>
          </div>

          <div>
            <label for="filter">Category</label>
            <div class="product__filter-wrapper">
              <select name="filter" class="filter-category" id="filter">
                <option value="" <?php if ($data['category'] === '') echo "selected" ?>>All</option>
                <?php
                if (isset($data['categories'])) foreach ($data['categories'] as $category) { ?>
                  <option value="<?= $category['Slug'] ?>" <?php if ($category['Slug'] === $data['category']) echo 'selected' ?>><?= $category['Name'] ?></option>
                <?php } ?>
              </select>
              <i class="fa-solid fa-chevron-down"></i>
            </div>
          </div>
        </div>

        <div>
          <label for="filter">Sort by</label>
          <div class="product__filter-wrapper">
            <select name="filter" class="filter-sort" id="filter">
              <option <?php if ($data['sort'] === '' || $data['sort'] === 'a-to-z') echo "selected"; ?> value="a-to-z">A to Z</option>
              <option <?php if ($data['sort'] === 'z-to-a') echo "selected"; ?> value="z-to-a">Z to A</option>
              <option <?php if ($data['sort'] === 'price-inc') echo "selected"; ?> value="price-inc">Price Increase</option>
              <option <?php if ($data['sort'] === 'price-desc') echo "selected"; ?> value="price-desc">Price Decrease</option>
            </select>
            <i class="fa-solid fa-chevron-down"></i>
          </div>
        </div>
      </div>
      <div class="product__list">
        <?php if (isset($data['products'])) foreach ($data['products'] as $product) { ?>
          <?php
          $productImagesJson = $product['Image'];
          $productImages = json_decode($productImagesJson);
          ?>
          <div data-aos="fade-down" data-aos-duration="500" class="product__item-wrapper">
            <a href="product/detail/<?= $product['Slug'] ?>" class="product__item">
              <div class="product__item-image">
                <img src="<?= $productImages[0] ?>" alt="">
              </div>
              <h3 class="product__item-title">
                <?= $product['Name'] ?>
              </h3>
              <div class="product__item-content">
                <span class="product__item-price"><?= number_format($product['PriceUnit']) ?> VND</span>
                <!-- <span class="product__item-volume">100ml</span> -->
              </div>
            </a>
          </div>
        <?php } ?>
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
        <?php
        if ($data['currentPage'] > 1) {
        ?>
          <a href="product/index?page=<?= $data['currentPage'] - 1 ?>">
            <i class="product__pagination-prev fa-solid fa-chevron-left"></i>
          </a>
        <?php } else { ?>
          <span>
          </span>
        <?php } ?>
        <div class="product__pagination-current">
          Page <span> <?= $data['currentPage'] ?></span> of <span><?= $data['pages'] ?></span>
        </div>
        <?php
        if ($data['pages'] > $data['currentPage']) {
        ?>
          <a href="product/index?page=<?= $data['currentPage'] + 1 ?>">
            <i class="product__pagination-next fa-solid fa-chevron-right"></i>
          </a>
        <?php } else { ?>
          <span>
          </span>
        <?php } ?>

      </div>
    </div>
  </div>
</div>