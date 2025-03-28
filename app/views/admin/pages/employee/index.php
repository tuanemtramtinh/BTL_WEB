<!-- <div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>DataTable</h3>
        <p class="text-subtitle text-muted">A sortable, searchable, paginated table without
          dependencies thanks to simple-datatables.</p>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">DataTable</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div> -->

<section class="section">
  <div class="card">
    <div class="card-header">
      <h5 class="card-title">
        Simple Datatable
      </h5>
    </div>
    <div class="card-body">

      <a href="../admin/employee/create" class="btn btn-primary mb-3">Create New Employee Account</a>

      <table class="table table-striped" id="table1">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Username</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data['users'] as $user) { ?>
            <tr>
              <td><?php echo $user['FirstName'] . ' ' . $user['LastName'] ?></td>
              <td><?php echo $user['Email'] ?></td>
              <td><?php echo $user['PhoneNo'] ?></td>
              <td><?php echo $user['Username'] ?></td>
              <!-- <td>
                <span class="badge bg-success">Active</span>
              </td> -->
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<script src="assets/static/js/pages/simple-datatables.js"></script>';