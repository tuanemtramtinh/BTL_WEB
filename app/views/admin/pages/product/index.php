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
                  <th>Category</th>
                  <th>Brand</th>
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
                    <td><img style="aspect-ratio: 1/1; object-fit: contain; width: 100px;" src="<?= $productImage ?>" alt=""></td>
                    <td><?= $product['Name'] ?></td>
                    <td><?= number_format($product['PriceUnit']) ?> VND</td>
                    <td><?= $product['Brand'] ?></td>
                    <td><?= $product['Category'] ?></td>
                    <td><?= $product['CreatedAt'] ?></td>
                    <td><?= $product['UpdatedAt'] ?></td>
                    <td><?= $product['Username'] ?></td>
                    <td>
                      <a class="btn btn-sm btn-info " href="admin/product/detail/<?= $product['ID'] ?>">Detail</a>
                      <a class="btn btn-sm btn-warning  ml-1" href="admin/product/edit/<?= $product['ID'] ?>">Edit</a>
                      <div class="modal-danger me-1 mb-1 d-inline-block">
                        <!-- Button trigger for danger theme modal -->
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#danger">
                          Delete
                        </button>
                        <!--Danger theme Modal -->
                        <div class="modal fade text-left" id="danger" tabindex="-1" aria-labelledby="myModalLabel120" style="display: none;" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                              <div class="modal-header bg-danger">
                                <h5 class="modal-title white" id="myModalLabel120">
                                  Confirm Product Deletion
                                </h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                  </svg>
                                </button>
                              </div>
                              <div class="modal-body">
                                Are you sure you want to delete this product <span style="font-weight: 700; font-style: italic;"><?= $product['Name'] ?></span> ? This action cannot be undone.
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                  <i class="bx bx-x d-block d-sm-none"></i>
                                  <span class="d-none d-sm-block">Cancel</span>
                                </button>
                                <a href="admin/product/delete/<?= $product['ID'] ?>" type="button" class="btn btn-danger ms-1">
                                  <i class="bx bx-check d-block d-sm-none"></i>
                                  <span class="d-none d-sm-block">Delete</span>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- <a class="btn btn-danger btn-sm ml-1" href="admin/product/delete/<?= $product['ID'] ?>">Delete</a> -->
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