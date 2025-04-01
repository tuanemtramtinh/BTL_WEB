<section>
  <div class="card">
    <div class="card-header">
      <h5 class="card-title">
        Create Product
      </h5>
    </div>
    <div class="card-body">
      <form action="admin/product/addPost" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="name" class="form-label">Product Name</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
        </div>
        <div class="mb-3">
          <label for="category" class="form-label">Category</label>
          <select id="category" name="category" class="form-select">
            <option selected value="">Open this select menu</option>
            <?php if (isset($data['categories'])) foreach ($data['categories'] as $category) { ?>
              <option value="<?= $category['ID'] ?>"><?= $category['Name'] ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="brand" class="form-label">Brand</label>
          <select id="brand" name="brand" class="form-select">
            <option selected value="">Open this select menu</option>
            <?php if (isset($data['brands'])) foreach ($data['brands'] as $brand) { ?>
              <option value="<?= $brand['Name'] ?>"><?= $brand['Name'] ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="content" class="form-label">Description</label>
          <textarea name="description" id="content"></textarea>
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Price</label>
          <input type="number" name="price" class="form-control" id="price" min="0">
        </div>
        <div class="mb-3">
          <label for="quantity" class="form-label">Quantity</label>
          <input type="number" name="quantity" class="form-control" id="quantity" min="0">
        </div>
        <div class="mb-3">
          <label for="images" class="form-label">Image</label>
          <input type="file" class="image-preview-filepond" name="images[]" id="images" multiple>
        </div>
        <button type="submit" class="btn btn-success w-100">Add Product</button>
      </form>
    </div>
  </div>
</section>