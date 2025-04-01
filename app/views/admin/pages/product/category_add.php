<section>
  <div class="card">
    <div class="card-header">
      <h5 class="card-title">
        Create Product
      </h5>
    </div>
    <div class="card-body">
      <form action="admin/product/category_addPost" method="POST">
        <div class="mb-3">
          <label for="name" class="form-label">Category Name</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
        </div>

        <button class="w-100 btn btn-success" type="submit">Add Category</button>
      </form>
    </div>
  </div>
</section>