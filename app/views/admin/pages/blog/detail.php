
  <nav class="navbar navbar-light" style="padding: 0;">
    <div class="d-flex align-items-center">
      <a href="../admin/blog/index" style="margin-right:5px;">
        <i class="bi bi-chevron-left"></i>
      </a>
      <h5 class="card-title mb-0">Blog Detail</h5>
    </div>
  </nav>

  <div class="card mt-5">
    <div class="card-header">
      <h4 class="card-title">Blog Details</h4>
    </div>
    <div class="card-body">
      <form action="../admin/blog/updatePost" method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="article_id" class="form-label">Article ID</label>
          <input type="text" class="form-control" id="article_id" name="article_id" 
                 value="<?= htmlspecialchars($data['blog']['BlogID']) ?>" readonly>
        </div>
        <div class="mb-3">
          <label for="post_date" class="form-label">Posted Date</label>
          <input type="date" class="form-control" id="post_date" name="post_date" 
                 value="<?= date('Y-m-d', strtotime($data['blog']['DateCreated'])) ?>" disabled>
        </div>
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" name="title" 
                 value="<?= htmlspecialchars($data['blog']['Title']) ?>" 
                 placeholder="Enter article title" required>
        </div>
        <div class="mb-3">
          <label for="cover_image" class="form-label">Cover Image</label>
          <input type="file" class="form-control" id="cover_image" name="cover_image" accept="image/*" onchange="previewImage(event)">
          <?php if (!empty($data['blog']['Image'])): ?>
            <img id="cover_image_preview" src="<?= htmlspecialchars($data['blog']['Image']) ?>" alt="Cover Image Preview" style="max-width: 100%; margin-top: 10px;">
          <?php else: ?>
            <img id="cover_image_preview" src="#" alt="Cover Image Preview" style="max-width: 100%; display: none; margin-top: 10px;">
          <?php endif; ?>
        </div>
        <div class="mb-3">
          <label for="category" class="form-label">Category</label>
          <select class="form-select" id="category" name="category" required>
            <option value="">Select category</option>
            <?php if (!empty($data['categories'])): ?>
              <?php foreach ($data['categories'] as $cat): ?>
                <option value="<?= htmlspecialchars($cat['ID']) ?>" 
                  <?= ($cat['ID'] == $data['blog']['CategoryID']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($cat['Name']) ?>
                </option>
              <?php endforeach; ?>
            <?php endif; ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="author" class="form-label">Author</label>
          <input type="text" class="form-control" id="author" name="author" 
                 value="<?= htmlspecialchars($data['blog']['Author']) ?>" 
                 placeholder="Enter author name" required>
        </div>
        <div class="mb-3">
          <label for="content" class="form-label">Content</label>
          <textarea class="form-control" id="content" name="content" cols="30" rows="10" 
                    placeholder="Enter blog content" required><?= htmlspecialchars($data['blog']['Content']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
    </div>
  </div>

  <div class="card mt-5">
    <div class="card-header">
      <h4 class="card-title">Comments</h4>
      <p class="mb-0">Total Comments: <strong><?= isset($data['comments_count']) ? $data['comments_count'] : 0 ?></strong></p>
    </div>
    <div class="card-body">
      <div class="list-group">
        <?php if (!empty($data['comments'])): ?>
          <?php foreach ($data['comments'] as $comment): ?>
            <div class="list-group-item mb-2">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <p class="mb-1"><?= htmlspecialchars($comment['content']) ?></p>
                  <small>by <?= htmlspecialchars($comment['author']) ?></small>
                  <br>
                  <small class="text-muted">Posted on: <?= date('Y-m-d', strtotime($comment['post_date'])) ?></small>
                </div>
                <div class="d-flex">
                  <span class="badge bg-success me-2">Likes: <?= htmlspecialchars($comment['likes']) ?></span>
                  <span class="badge bg-danger">Dislikes: <?= htmlspecialchars($comment['dislikes']) ?></span>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>No comments available.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <script>
    function previewImage(event) {
      var output = document.getElementById('cover_image_preview');
      output.src = URL.createObjectURL(event.target.files[0]);
      output.style.display = 'block';
    }
  </script>

  <script src="assets/extensions/tinymce/tinymce.min.js"></script>
  <script>
    tinymce.init({
      selector: '#content',
      height: 300,
      plugins: 'advlist autolink lists link image charmap print preview anchor',
      toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat'
    });
  </script>