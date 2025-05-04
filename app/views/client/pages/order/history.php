<div class="order__">
  <div class="container">
    <div class="order__wrapper">
      <div class="order__wrapper-title">Order Detail</div>
      <div class="order__section">
        <div class="order__section-title">Personal Information</div>
        <div style="overflow-x: auto;">
          <table class="order__info-table">
            <tr>
              <td>Status:</td>
              <td><?= $data['order']['Status'] ?? '' ?></td>
            </tr>
            <tr>
              <td>Fullname:</td>
              <td><?= $data['order']['OrderFullname'] ?? '' ?></td>
            </tr>
            <tr>
              <td>Phone Number:</td>
              <td><?= $data['order']['OrderPhone'] ?? '' ?></td>
            </tr>
            <tr>
              <td>Email:</td>
              <td><?= $data['order']['OrderEmail'] ?? '' ?></td>
            </tr>
            <tr>
              <td>Address:</td>
              <td><?= $data['order']['OrderAddress'] ?? '' ?></td>
            </tr>
          </table>
        </div>
      </div>

      <div class="order__section">
        <div class="order__section-title">Products</div>
        <div style="overflow-x: auto;">
          <table class="order__product-table">
            <thead>
              <tr>
                <th>Product</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (isset($data['items'])) foreach ($data['items'] as $item) {
                $image = json_decode($item['ProductImage'])[0];
              ?>
                <tr>
                  <td><?= $item['ProductName'] ?></td>
                  <td><img width="100px" height="100px" src="<?=$image?>" alt=""></td>
                  <td><?= $item['Quantity'] ?></td>
                  <td><?= number_format($item['ProductPrice']) ?> VND</td>
                  <td><?= number_format($item['Total']) ?> VND</td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <div class="order__total">Total: <?= number_format($data['order']['Total']) ?> VND</div>
      </div>
    </div>
  </div>
</div>