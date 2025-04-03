<section>
  <div class="card">
    <div class="card-header">
      <h5 class="card-title">
        Product Detail
      </h5>
    </div>
    <div class="card-body">
      <form action="admin/product/addPost" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="name" class="form-label">Product Name</label>
          <input type="text" name="name" id="name" class="form-control" disabled value="<?= $data['product']['Name'] ?>">
        </div>
        <div class="mb-3">
          <label for="category" class="form-label">Category</label>
          <input type="text" id="category" name="category" class="form-control" disabled value="<?= $data['product']['CategoryName'] ?>">
        </div>
        <div class="mb-3">
          <label for="brand" class="form-label">Brand</label>
          <input type="text" id="category" name="category" class="form-control" disabled value="<?= $data['product']['Brand'] ?>">
        </div>
        <div class="mb-3">
          <div class="card border">
            <div class="card-header bg-primary text-white">
              <h5 class="mb-0 card-title">Description</h5>
            </div>
            <div class="card-body p-3">
              <p class="text-muted"><?= $data['product']['Description'] ?></p>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Price</label>
          <input type="number" name="price" class="form-control" id="price" min="0" disabled value="<?= $data['product']['PriceUnit'] ?>">
        </div>
        <div class="mb-3">
          <label for="quantity" class="form-label">Quantity</label>
          <input type="number" name="quantity" class="form-control" id="quantity" min="0" disabled value="<?= $data['product']['Inventory'] ?>">
        </div>
        <div class="mb-3">
          <label for="images" class="form-label">Image</label>
          <?php
          $productImagesJson = $data['product']['Image'];
          $productImages = json_decode($productImagesJson);
          ?>

          <?php if (!empty($productImages)) : ?>
            <div class="row g-2">
              <?php foreach ($productImages as $image) : ?>
                <div class="col-6 col-md-3">
                  <img src="<?= htmlspecialchars($image) ?>" alt="Product Image" class="img-fluid rounded shadow-sm">
                </div>
              <?php endforeach; ?>
            </div>
          <?php else : ?>
            <p class="text-muted">No images available.</p>
          <?php endif; ?>
        </div>
      </form>
    </div>
  </div>
</section>