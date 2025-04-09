<section class="section">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header border-bottom">
          <h4 class="card-title mb-0">User's Info</h4>
        </div>
        <div class="card-body pt-4">
          <div class="card-text mb-3">
            <strong class="me-3">Email: </strong>
            <span> <?= $data['cart']['Email'] ?> </span>
          </div>
          <div class="card-text">
            <strong class="me-3">Full Name: </strong>
            <span><?= $data['cart']['FullName'] ?></span>
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
          <h4 class="card-title">Cart Detail</h4>
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
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if (isset($data['items'])) foreach ($data['items'] as $item) { ?>
                  <?php $productImage = json_decode($item['ProductImage'])[0] ?>
                  <tr>
                    <td><?= $item['ProductID'] ?></td>
                    <td style="width: 150px; height: 150px; object-fit: contain; aspect-ratio: 1/1;">
                      <img class="w-100" src="<?= $productImage ?>" alt="">
                    </td>
                    <td><?= $item['ProductName'] ?></td>
                    <td><?= number_format($item['ProductPrice']) ?> VND</td>
                    <td><input type="number" cart-id="<?= $data['cart']['ID'] ?>" product-id="<?= $item['ProductID'] ?>" min="0" class="product-update form-control" name="quantity" id="quantity" value="<?= $item['ProductQuantity'] ?>"></td>
                    <td><?= number_format($item['Total']) ?> VND</td>
                    <td>
                      <div class="modal-danger me-1 mb-1 d-inline-block">
                        <!-- Button trigger for danger theme modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#danger">
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
                                Are you sure you want to delete this product <span style="font-weight: 700; font-style: italic;"><?= $item['ProductName'] ?></span> ? This action cannot be undone.
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                  <i class="bx bx-x d-block d-sm-none"></i>
                                  <span class="d-none d-sm-block">Cancel</span>
                                </button>
                                <a href="admin/cart/delete?productId=<?= $item['ProductID'] ?>&cartId=<?= $data['cart']['ID'] ?>" type="button" class="btn btn-danger ms-1">
                                  <i class="bx bx-check d-block d-sm-none"></i>
                                  <span class="d-none d-sm-block">Delete</span>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
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