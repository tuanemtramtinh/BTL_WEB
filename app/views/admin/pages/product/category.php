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

<!-- Product List -->
<section class="section">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Product List</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <div class="table-responsive">
              <table class="w-100 table">
                <thead>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Updated By</th>
                </thead>
                <tbody>
                  <?php if (isset($data['categories'])) foreach ($data['categories'] as $category) { ?>
                    <tr>
                      <td><?= $category['ID'] ?></td>
                      <td><?= $category['Name'] ?></td>
                      <td><?= $category['CreatedAt'] ?></td>
                      <td><?= $category['UpdatedAt'] ?></td>
                      <td><?= $category['Username'] ?></td>
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