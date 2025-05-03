<div class="section">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Create Brand</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <a href="admin/product/brand_add" class="w-100 btn btn-success btn-sm py-2 fs-6">
              Create Brand
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="section">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">List</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <div class="table-responsive">
            <table class="w-100 table">
              <thead>
                <th>No.</th>
                <th>Name</th>
                <th>Action</th>
              </thead>
              <tbody>
                <?php
                for ($i = 0; $i < count($data['brands']); $i++) { ?>
                  <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><a href="admin/product/index?brand=<?php echo $data['brands'][$i]['Name'] ?>"><?php echo $data['brands'][$i]['Name'] ?></a></td>
                    <td>
                      <div class="modal-danger me-1 mb-1 d-inline-block">
                        <!-- Delete Button -->
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $i ?>">
                          Delete
                        </button>

                        <!-- Modal -->
                        <div class="modal fade text-left" id="deleteModal<?= $i ?>" tabindex="-1" aria-labelledby="modalLabel<?= $i ?>" style="display: none;" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                              <div class="modal-header bg-danger">
                                <h5 class="modal-title white" id="modalLabel<?= $i ?>">
                                  Confirm Brand Deletion
                                </h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                  </svg>
                                </button>
                              </div>
                              <div class="modal-body">
                                Are you sure you want to delete the brand <span style="font-weight: 700; font-style: italic;"><?= $data['brands'][$i]['Name'] ?></span>? This action cannot be undone.
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                  <span class="d-none d-sm-block">Cancel</span>
                                </button>
                                <a href="admin/product/brand_delete?brand=<?= $data['brands'][$i]['Name'] ?>" type="button" class="btn btn-danger ms-1">
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
</div>