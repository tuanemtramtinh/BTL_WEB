<nav class="navbar navbar-light" style="padding: 0;">
    <div class="d-flex align-items-center">
        <a href="../admin/blog/index" style="margin-right:5px;"><i class="bi bi-chevron-left"></i></a>
        <h5 class="card-title mb-0">Blog</h5>
    </div>
</nav>

<div class="card mt-5">
    <div class="card-header">
        <h4 class="card-title">Blog details</h4>
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="article_id" class="form-label">Article ID</label>
                <input type="text" class="form-control" id="article_id" name="article_id" value="348347387453846" readonly>
            </div>
            <div class="mb-3">
                <label for="post_date" class="form-label">Posted Date</label>
                <input type="date" class="form-control" id="post_date" name="post_date" value="2025-03-15" disabled>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter article title">
            </div>
            <div class="mb-3">
                <label for="cover_image" class="form-label">Cover Image</label>
                <input type="file" class="form-control" id="cover_image" name="cover_image" accept="image/*" onchange="previewImage(event)">
                <img id="cover_image_preview" src="#" alt="Cover Image Preview" style="max-width: 100%; display: none; margin-top: 10px;">
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category">
                    <option value="">Select category</option>
                    <option value="technology">Perfume</option>
                    <option value="lifestyle">Event</option>
                    <option value="education">New products</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" id="author" name="author" placeholder="Enter author name">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" id="default" cols="30" rows="10"></textarea>
                <script src="assets/extensions/tinymce/tinymce.min.js"></script>
                <script src="assets/static/js/pages/tinymce.js"></script>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<div class="card mt-5">
    <div class="card-header">
        <h4 class="card-title">Comments</h4>
        <p class="mb-0">Total Comments: <strong>3</strong></p>
    </div>
    <div class="card-body">
        <div class="list-group">
            <?php
                $count = 3;
                for( $i = 0; $i < $count; $i++){
                    echo '<div class="list-group-item mb-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1">
                            This is a comment content example. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        </p>
                        <small>by John Doe</small>
                        <br>
                        <small class="text-muted">Posted on: 2025-03-14</small>
                    </div>
                    <div class="d-flex">
                        <span class="badge bg-success me-2">Likes: 10</span>
                        <span class="badge bg-danger">Dislikes: 2</span>
                    </div>
                </div>
            </div>';
                }
            ?>
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
