<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $data["title"] ?></title>
  <base href="<?= BASE_URL ?>/">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="public/css/client/style.css">
  <?php if (isset($data['task'])) echo '<link rel="stylesheet" href="public/css/client/style_'.$data['task'].'.css">'; ?>
</head>

<body>
  <header class="header">
    <div class="container">
      <div class="header__wrapper">
        <div class="header__logo">
          <img src="public/images/logo.svg" alt="">
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
      </div>
    </div>
  </header>

  <?php require_once "./app/views/client/pages/" . $data["page"] . ".php" ?>

  <footer class="footer">
    <div class="container">
      <div class="footer__wrapper">
        <div class="footer__info">
          <div class="footer__contact">
            <div class="footer__logo">
              <img src="./public/images/logo.svg" alt="">
            </div>
            <h2>Subscribe to Our Newsletter:</h2>
            <p>Receive Updates on New Arrivals and Special Promotions!</p>
            <form action="#" class="footer__form">
              <input type="text" name="email" id="email" placeholder="Your email here">
              <button type="submit">Submit</button>
            </form>
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

  <script src="public/js/client/script.js"></script>
</body>

</html>