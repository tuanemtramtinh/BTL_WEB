<?php
$blogIntro = $data['blogIntro'];
$existingImages = json_decode($blogIntro['Images'] ?? '[]', true);
$existingImages = is_array($existingImages) ? $existingImages : [];

?>
<div class="card">
  <div class="card-body">
    <form action="admin/blog/addPostHead" method="POST" enctype="multipart/form-data" class="form form-vertical">
        <div class="mb-3">
            <label class="form-label">Current Image</label>
            <div class="current-images d-flex flex-wrap gap-2 mb-3 justify-content-center">
                <?php foreach ($existingImages as $image): ?>
                    <div class="position-relative" style="width: 400px;">
                        <img src="<?= htmlspecialchars($image) ?>" 
                            class="img-thumbnail" 
                            style="height: 400px; object-fit: cover;">
                    </div>
                <?php endforeach; ?>
            </div>
             
            <input type="hidden" name="existing_images" value="<?= htmlspecialchars(json_encode($existingImages)) ?>">

            <label for="images" class="form-label">Add new image</label>
            <input type="file" class="filepond" id="images" name="images[]" multiple accept="image/*">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Introductory content</label>
            <textarea class="form-control" id="content" name="content" cols="30" rows="10" placeholder="Enter blog content"><?= htmlspecialchars($blogIntro['Content']) ?></textarea>
        </div>
            <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</div>
