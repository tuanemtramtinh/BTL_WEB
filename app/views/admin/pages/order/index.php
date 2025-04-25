<section class="section">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Order List</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="table1">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>CreatedAt</th>
                  <th>Total</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if (isset($data['orders'])) foreach ($data['orders'] as $order) { ?>
                  <tr>
                    <td><?= $order['ID'] ?></td>
                    <td><?= $order['Email'] ?></td>
                    <td>
                      <select class="form-select order-select" name="status" id="status" order-id="<?= $order['ID'] ?>">
                        <option value="processing" <?= $order['Status'] === 'processing' ? "selected" : "" ?>>Processing</option>
                        <option value="finish" <?= $order['Status'] === 'finish' ? "selected" : "" ?>>Finish</option>
                        <option value="fail" <?= $order['Status'] === 'fail' ? "selected" : "" ?>>Fail</option>
                      </select>
                    </td>
                    <td><?= $order['CreatedAt'] ?></td>
                    <td><?= number_format($order['Total']) ?> VND</td>
                    <td>
                      <a class="btn btn-info " href="admin/order/detail/<?= $order['ID'] ?>">Detail</a>
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