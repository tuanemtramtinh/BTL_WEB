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
              </thead>
              <tbody>
                <?php
                for ($i = 0; $i < count($data['brands']); $i++) { ?>
                  <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><a href="admin/product/index?brand=<?php echo $data['brands'][$i]['Name'] ?>"><?php echo $data['brands'][$i]['Name'] ?></a></td>
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