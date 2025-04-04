<section class="section">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header border-bottom">
          <h4 class="card-title mb-0">User's Info</h4>
        </div>
        <div class="card-body pt-4">
          <div class="card-text mb-3">
            <strong class="me-3">Status: </strong>
            <span style="text-transform: capitalize;" class="btn <?php if ($data['order']['Status'] === 'processing') echo "btn-warning";
                                                                  else if ($data['order']['Status'] === 'finish') echo "btn-success";
                                                                  else echo "btn-danger"; ?>"><?= $data['order']['Status'] ?></span>
          </div>
          <div class="card-text mb-3">
            <strong class="me-3">Email: </strong>
            <span> <?= $data['order']['Email'] ?> </span>
          </div>
          <div class="card-text">
            <strong class="me-3">Full Name: </strong>
            <span><?= $data['order']['FullName'] ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Order Detail</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="table1">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php if (isset($data['items'])) foreach ($data['items'] as $item) { ?>
                  <?php $productImage = json_decode($item['ProductImage'])[0] ?>
                  <tr>
                    <td><?= $item['ID'] ?></td>
                    <td style="width: 150px; height: 150px; object-fit: contain; aspect-ratio: 1/1;">
                      <img class="w-100" src="<?= $productImage ?>" alt="">
                    </td>
                    <td><?= $item['ProductName'] ?></td>
                    <td><?= $item['ProductPrice'] ?></td>
                    <td><?= $item['Quantity'] ?></td>
                    <td><?= $item['Total'] ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="public/assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
<script src="public/assets/static/js/pages/simple-datatables.js"></script>