<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $data["title"] ?></title>
  <base href="<?= BASE_URL ?>/">
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="public/css/client/style.css">
  <?php if (isset($data['task'])) echo '<link rel="stylesheet" href="public/css/client/style_' . $data['task'] . '.css">'; ?>
</head>

<body>
  <div class="wrapper">
    <header class="header sticky">
      <div class="container">
        <div class="header__wrapper">
          <label for="header__nav-mobile-input" class="header__menu-bar fa-solid fa-bars"></label>
          <input hidden type="checkbox" name="nav" id="header__nav-mobile-input" class="header__nav-input">
          <div class="header__logo">
            <a href="home">
              <img src="public/images/logo.svg" alt="">
            </a>
          </div>
          <ul class="header__nav">
            <li><a href="home">Home</a></li>
            <li><a href="product">Shop</a></li>
            <li><a href="about">About us</a></li>
            <li><a href="blog">Blog</a></li>
            <li><a href="contact">Contact</a></li>
            <li><a href="question">FAQ</a></li>
          </ul>
          <div class="header__utility">
            <i class="fa-solid fa-magnifying-glass"></i>
            <i class="fa-solid fa-user"></i>
            <i class="fa-solid fa-cart-shopping"></i>
          </div>

          <label for="header__nav-mobile-input" class="header__overlay">

          </label>

          <div class="header__nav-mobile">
            <label for="header__nav-mobile-input" class="header__nav-mobile-close fa-solid fa-x"></label>
            <ul class="header__nav-mobile-list">
              <li><a href="home">Home</a></li>
              <li><a href="product">Shop</a></li>
              <li><a href="about">About us</a></li>
              <li><a href="blog">Blog</a></li>
              <li><a href="contact">Contact</a></li>
              <li><a href="question">FAQ</a></li>
            </ul>
          </div>

          
        </div>
      </div>
    </header>
    <div class="search">
      <div class="container">
        <div class="search__wrapper">
          <div class="search__logo">
            <img src="public/images/logo.svg" alt="">
          </div>

          <form class="search__text">
            <input type="text" name="product" id="product" placeholder="Search...">
            <button type="submit">
              <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <i class="fa-solid fa-xmark close"></i>
          </form>

          <div class="search__popular">
            <h3>Popular tag: </h3>
            <ul>
              <li>Dior</li>
              <li>Louis Vuitton</li>
              <li>Goyard</li>
              <li>Gucci</li>
            </ul>
          </div>

          <div class="search__new-product">
            <h3>New Product</h3>
            <div class="search__product-list">
              <a href="product/detail" class="search__product-item">
                <div class="search__product-wrapper">
                  <img src="public/images/product.png" alt="">
                </div>
                <div class="search__product-content">
                  <h4>Luxurious Perfume</h4>
                  <p>$599</p>
                </div>
              </a>
              <?php
              for ($i = 0; $i < 3; $i++) {
                echo '
                  <a href="product/detail" class="search__product-item">
                    <div class="search__product-wrapper">
                      <img src="public/images/product.png" alt="">
                    </div>
                    <div class="search__product-content">
                      <h4>Luxurious Perfume</h4>
                      <p>$599</p>
                    </div>
                  </a>
                  ';
              }
              ?>
            </div>
          </div>

          <div class="search__category">
            <h3>Category</h3>
            <div class="search__product-list">
              <a href="product/detail" class="search__product-item">
                <div class="search__product-wrapper">
                  <img src="public/images/product.png" alt="">
                </div>
                <div class="search__product-content">
                  <h4>Luxurious Perfume</h4>
                  <p>$599</p>
                </div>
              </a>

              <?php
              for ($i = 0; $i < 3; $i++) {
                echo '
                <a href="product/detail" class="search__product-item">
                  <div class="search__product-wrapper">
                    <img src="public/images/product.png" alt="">
                  </div>
                  <div class="search__product-content">
                    <h4>Luxurious Perfume</h4>
                    <p>$599</p>
                  </div>
                </a>
                ';
              }
              ?>
            </div>
          </div>

          <div class="search__result">
            <h3>Search Result</h3>
            <div class="search__product-list">
              <a href="product/detail" class="search__product-item">
                <div class="search__product-wrapper">
                  <img src="public/images/product.png" alt="">
                </div>
                <div class="search__product-content">
                  <h4>Luxurious Perfume</h4>
                  <p>$599</p>
                </div>
              </a>

              <?php
              for ($i = 0; $i < 3; $i++) {
                echo '
                <a href="product/detail" class="search__product-item">
                  <div class="search__product-wrapper">
                    <img src="public/images/product.png" alt="">
                  </div>
                  <div class="search__product-content">
                    <h4>Luxurious Perfume</h4>
                    <p>$599</p>
                  </div>
                </a>
                ';
              }
              ?>
            </div>
          </div>

          <div class="search__footer">
            2025 Perfumé Inc. All rights reserved
          </div>
        </div>
      </div>
    </div>

    <?php require_once "./app/views/client/pages/" . $data["page"] . ".php" ?>

    <footer class="footer">
      <div class="container">
        <div class="footer__wrapper">
          <div class="footer__info">
            <div class="footer__contact">
              <div class="footer__logo">
                <a href="home">
                  <img src="./public/images/logo.svg" alt="">
                </a>
              </div>
              <div class="footer__subscribe">
                <h2>Subscribe to Our Newsletter:</h2>
                <p>Receive Updates on New Arrivals and Special Promotions!</p>
                <form action="#" class="footer__form">
                  <input type="text" name="email-contact" id="email-contact" placeholder="Your email here">
                  <button type="submit">Submit</button>
                </form>
              </div>
              <div class="footer__mobile">
                <ul>
                  <li><a href="">Contact Us</a></li>
                  <li><a href="">Blog</a></li>
                  <li><a href="">FAQ</a></li>
                </ul>
              </div>
              <div class="footer__social">
                <i class="facebook fa-brands fa-facebook-f"></i>
                <i class="instagram fa-brands fa-instagram"></i>
              </div>
            </div>
            <div class="footer__nav">
              <div class="footer__col footer__shopping">
                <h3>Shopping</h3>
                <ul>
                  <li>Payments</li>
                  <li>Delivery options</li>
                  <li>Buyer protection</li>
                </ul>
              </div>
              <div class="footer__col footer__customer">
                <h3>Customer care</h3>
                <ul>
                  <li>FAQ</li>
                  <li>Contact Us</li>
                </ul>
              </div>
              <div class=" footer__col footer__pages">
                <h3>Pages</h3>
                <ul>
                  <li>Home</li>
                  <li>About Us</li>
                  <li>Shop</li>
                  <li>Blog</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer__copyright">
            2025 Perfumé Inc. All rights reserved
          </div>
        </div>
      </div>
    </footer>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="public/js/client/script.js"></script>
  <?php if (isset($data['task'])) echo '<script src="public/js/client/script_' . $data['task'] . '.js"></script>'; ?>
</body>

</html>