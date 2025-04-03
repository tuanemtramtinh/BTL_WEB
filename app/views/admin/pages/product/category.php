<!-- Create Category -->
<div class="section">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Create Category</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <a href="admin/product/category_add" class="w-100 btn btn-success btn-sm py-2 fs-6">
              Add Category
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Category List -->
<section class="section">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Category List</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="table1">
                <thead>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Updated By</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <?php if (isset($data['categories'])) foreach ($data['categories'] as $category) { ?>
                    <tr>
                      <td><?= $category['ID'] ?></td>
                      <td><?= $category['Name'] ?></td>
                      <td><?= $category['CreatedAt'] ?></td>
                      <td><?= $category['UpdatedAt'] ?></td>
                      <td><?= $category['Username'] ?></td>
                      <td>
                        <a href="admin/product/category_detail/<?=$category['ID']?>" class="btn btn-info">Detail</a>
                        <a href="admin/product/category_edit/<?=$category['ID']?>" class="btn btn-warning">Edit</a>
                        <a href="admin/product/category_delete/<?=$category['ID']?>" class="btn btn-danger">Delete</a>
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
</section>

<script src="public/assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
<script src="public/assets/static/js/pages/simple-datatables.js"></script>