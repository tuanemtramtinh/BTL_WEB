
<nav class="navbar navbar-light" style="padding: 0;">
  <div class="d-flex align-items-center">
    <a href="admin/blog/index" style="margin-right:5px;">
      <i class="bi bi-chevron-left"></i>
    </a>
    <h5 class="card-title mb-0">Blog</h5>
  </div>
</nav>

<div class="card mt-5">
  <div class="card-header">
    <h4 class="card-title">Add Blog</h4>
  </div>
  <div class="card-body">
    <form action="admin/blog/addPost" method="POST" enctype="multipart/form-data" class="form form-vertical">
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Enter article title" required>
      </div>
      <div class="mb-3">
          <label for="desc" class="form-label">Description</label>
          <textarea 
              class="form-control" 
              id="desc" 
              name="desc" 
              rows="3" 
              placeholder="Enter article description" 
              required
          ><?= isset($data['blog']['Desc']) ? htmlspecialchars($data['blog']['Desc']) : '' ?></textarea>
      </div>
      <div class="mb-3">
        <label for="images" class="form-label">Cover Image</label>
        <input type="file" class="image-preview-filepond" id="images" name="images[]" required>
      </div>
      <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select class="form-select" id="category" name="category" required>
          <option value="">Select category</option>
          <?php if (!empty($data['categories'])): ?>
            <?php foreach ($data['categories'] as $cat): ?>
              <option value="<?= htmlspecialchars($cat['ID']) ?>">
                <?= htmlspecialchars($cat['Name']) ?>
              </option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="author" class="form-label">Author</label>
        <input type="text" class="form-control" id="author" name="author" placeholder="Enter author name" required>
      </div>
      <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" id="content" name="content" cols="30" rows="10" placeholder="Enter blog content"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Post</button>
    </form>
  </div>
</div>
<script>
  const existingImage = undefined;
</script>


