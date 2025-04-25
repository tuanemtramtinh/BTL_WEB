<section class="section">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Cart List</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="table1">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Email</th>
                  <th>Total</th>
                  <th>Last Updated</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if (isset($data['carts'])) foreach ($data['carts'] as $cart) { ?>
                  <tr>
                    <td><?= $cart['ID'] ?></td>
                    <td><?= $cart['Email'] ?></td>
                    <td><?= $cart['Total'] ?></td>
                    <td><?= $cart['UpdatedAt'] ?></td>
                    <td>
                      <a class="btn btn-info " href="admin/cart/detail/<?=$cart['ID']?>">Detail</a>
                      <a class="btn btn-warning  ml-1" href="admin/cart/edit/<?=$cart['ID']?>">Edit</a>
                      <div class="modal-danger me-1 mb-1 d-inline-block">
                        <!-- Button trigger for danger theme modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#danger">
                          Clear
                        </button>
                        <!--Danger theme Modal -->
                        <div class="modal fade text-left" id="danger" tabindex="-1" aria-labelledby="myModalLabel120" style="display: none;" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                              <div class="modal-header bg-danger">
                                <h5 class="modal-title white" id="myModalLabel120">
                                  Confirm Cart Clear
                                </h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                  </svg>
                                </button>
                              </div>
                              <div class="modal-body">
                                Are you sure you want to clear this cart of user <span style="font-weight: 700; font-style: italic;"><?= $cart["FullName"] ?></span> ? This action cannot be undone.
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                  <i class="bx bx-x d-block d-sm-none"></i>
                                  <span class="d-none d-sm-block">Cancel</span>
                                </button>
                                <a href="admin/product/delete/" type="button" class="btn btn-danger ms-1">
                                  <i class="bx bx-check d-block d-sm-none"></i>
                                  <span class="d-none d-sm-block">Clear</span>
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