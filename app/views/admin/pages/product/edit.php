<section>
  <div class="card">
    <div class="card-header">
      <h5 class="card-title">
        Edit Product
      </h5>
    </div>
    <div class="card-body">
      <form action="admin/product/editPost/<?= $data['product']['ID'] ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="name" class="form-label">Product Name</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" value="<?= $data['product']['Name'] ?>">
        </div>
        <div class="mb-3">
          <label for="category" class="form-label">Category</label>
          <select id="category" name="category" class="form-select">
            <option selected value="">Open this select menu</option>
            <?php if (isset($data['categories'])) foreach ($data['categories'] as $category) { ?>
              <option <?= $data['product']['ID_ProductCategory'] == $category['ID'] ? "selected" :  ""; ?> value="<?= $category['ID'] ?>"><?= $category['Name'] ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="brand" class="form-label">Brand</label>
          <select id="brand" name="brand" class="form-select">
            <option selected value="">Open this select menu</option>
            <?php if (isset($data['brands'])) foreach ($data['brands'] as $brand) { ?>
              <option <?= $data['product']['Brand'] == $brand['Name'] ? "selected" :  ""; ?> value="<?= $brand['Name'] ?>"><?= $brand['Name'] ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="content" class="form-label">Description</label>
          <textarea name="description" id="content">
            <?= $data['product']['Description'] ?>
          </textarea>
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Price</label>
          <input type="number" name="price" class="form-control" id="price" min="0" value="<?= $data['product']['PriceUnit'] ?>">
        </div>
        <div class="mb-3">
          <label for="quantity" class="form-label">Quantity</label>
          <input type="number" name="quantity" class="form-control" id="quantity" min="0" value="<?= $data['product']['Inventory'] ?>">
        </div>
        <div class="mb-3">
          <label for="images" class="form-label">Image</label>
          <input type="hidden" name="imageLink" class="image-link" value='<?= $data['product']['Image'] ?>'>
          <input type="file" class="image-preview-filepond-edit" name="images[]" id="images" multiple>
        </div>
        <button type="submit" class="btn btn-success w-100">Edit Product</button>
      </form>
    </div>
  </div>
</section>