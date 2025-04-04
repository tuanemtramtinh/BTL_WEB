<nav class="navbar navbar-light" style="padding: 0;">
  <div class="d-flex align-items-center">
    <a href="admin/blog/index" style="margin-right:5px;">
      <i class="bi bi-chevron-left"></i>
    </a>
    <h5 class="card-title mb-0">Blog Detail</h5>
  </div>
</nav>

<div class="card mt-5">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h4 class="card-title">Blog Details</h4>
    <form action="admin/blog/deletePost" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xoá bài viết này không?');">
        <input type="hidden" name="article_id" value="<?= htmlspecialchars($data['blog']['BlogID']) ?>">
        <button type="submit" class="btn btn-danger">Delete post</button>
    </form>
  </div>
  <div class="card-body">
    <form action="admin/blog/updatePost" method="POST" enctype="multipart/form-data">
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
          <label for="desc" class="form-label">Description</label>
          <textarea class="form-control" id="desc" name="desc" rows="3" placeholder="Enter article description" required><?= htmlspecialchars($data['blog']['Desc']) ?></textarea>
      </div>
      <div class="mb-3">
          <label class="form-label">Current Image</label>
          <div class="current-images d-flex flex-wrap gap-2 mb-3 justify-content-center">
              <?php 
              $existingImages = !empty($data['blog']['Image']) ? json_decode($data['blog']['Image'], true) : [];
              foreach ($existingImages as $image): 
              ?>
                  <div class="position-relative" style="width: 400px;">
                      <img src="<?= htmlspecialchars($image) ?>" 
                          class="img-thumbnail" 
                          style="height: 400px; object-fit: cover;">
                  </div>
              <?php endforeach; ?>
          </div>
          
          <input type="hidden" name="existing_images" value="<?= htmlspecialchars($data['blog']['Image']) ?>">
          
          <label for="images" class="form-label">Add new image</label>
          <input type="file" class="filepond" id="images" name="images[]" multiple accept="image/*">
      </div>
      <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select class="form-select" id="category" name="category" required>
          <option value="">Select category</option>
          <?php if (!empty($data['categories'])): ?>
            <?php foreach ($data['categories'] as $cat): ?>
              <option value="<?= htmlspecialchars($cat['ID']) ?>" <?= ($cat['ID'] == $data['blog']['CategoryID']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat['Name']) ?>
              </option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="author" class="form-label">Author</label>
        <input type="text" class="form-control" id="author" name="author" 
               value="<?= htmlspecialchars($data['blog']['Author']) ?>" placeholder="Enter author name" required>
      </div>
      <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" id="content" name="content" cols="30" rows="10" placeholder="Enter blog content" required><?= htmlspecialchars($data['blog']['Content']) ?></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</div>



<?php
$existingImages = !empty($data['blog']['Image']) ? json_decode($data['blog']['Image'], true) : [];
$initialFiles = array_map(function($img) {
  return [
      'source' => $img,
      'options' => ['type' => 'local']
  ];
}, $existingImages);
?>
<script>
const existingImage = <?= json_encode($firstImage) ?>;
const pond = FilePond.create(document.getElementById('images'), {
    files: <?= json_encode($initialFiles) ?>,
    allowMultiple: true,
    maxFiles: 5,
    server: {
        url: '/upload',
        process: {
            url: '/admin/blog/uploadImage',
            method: 'POST'
        },
        revert: {
            url: '/admin/blog/deleteImage',
            method: 'DELETE'
        }
    },
    acceptedFileTypes: ['image/*'],
    labelIdle: 'Kéo thả ảnh hoặc <span class="filepond--label-action">Chọn từ máy</span>',
    stylePanelAspectRatio: 0.75,
    imagePreviewHeight: 200
});

document.querySelector('form').addEventListener('submit', (e) => {
    const existingFiles = pond.getFiles().filter(file => file.origin === 1);
    const newFiles = pond.getFiles().filter(file => file.origin !== 1);
    
    newFiles.forEach((file) => {
        if (file.status === 5) { 
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'uploaded_images[]';
            input.value = file.serverId;
            e.target.appendChild(input);
        }
    });
});

</script>
