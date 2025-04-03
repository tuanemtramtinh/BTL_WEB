<!-- Create Product -->
<div class="section">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Create Product</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <a href="admin/product/add" class="w-100 btn btn-success btn-sm py-2 fs-6">
              Add Product
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Product List -->
<section class="section">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Product List</h4>
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
                  <th>CreatedAt</th>
                  <th>UpdatedAt</th>
                  <th>UpdatedBy</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if (isset($data['products'])) foreach ($data['products'] as $product) {
                  $productImages = json_decode($product['Image']);
                  $productImage = $productImages[0];
                ?>
                  <tr>
                    <td><?= $product['ID'] ?></td>
                    <td><img style="aspect-ratio: 1/1; object-fit: contain; width: 150px;" src="<?= $productImage ?>" alt=""></td>
                    <td><?= $product['Name'] ?></td>
                    <td><?= $product['PriceUnit'] ?></td>
                    <td><?= $product['CreatedAt'] ?></td>
                    <td><?= $product['UpdatedAt'] ?></td>
                    <td><?= $product['Username'] ?></td>
                    <td>
                      <a class="btn btn-info btn-sm" href="admin/product/detail/<?= $product['ID'] ?>">Detail</a>
                      <a class="btn btn-warning btn-sm ml-1" href="admin/product/edit/<?= $product['ID'] ?>">Edit</a>
                      <a class="btn btn-danger btn-sm ml-1" href="admin/product/delete/<?= $product['ID'] ?>">Delete</a>
                    </td>
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