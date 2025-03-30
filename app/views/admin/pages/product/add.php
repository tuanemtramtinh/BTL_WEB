<section>
  <div class="card">
    <div class="card-header">
      <h5 class="card-title">
        Create Product
      </h5>
    </div>
    <div class="card-body">
      <form action="">
        <div class="mb-3">
          <label for="name" class="form-label">Product Name</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
        </div>
        <div class="mb-3">
          <label for="category" class="form-label">Category</label>
          <select id="category" name="category" class="form-select" >
            <option selected>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
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
          <label for="image" class="form-label">Image</label>
          <input type="file" class="image-preview-filepond" name="image" id="image">
        </div>
      </form>
    </div>
  </div>
</section>