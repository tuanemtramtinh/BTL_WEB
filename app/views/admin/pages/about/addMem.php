<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                Add Member
            </h4>
        </div>
        <div class="card-body">
            <form action="admin/about/addMember" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <input type="text" class="form-control" id="role" name="role" placeholder="Enter role">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="images" class="form-label">Image</label>
                    <input type="file" class="image-preview-filepond" name="images[]" id="images" multiple>
                </div>
                <button type="submit" class="btn btn-success w-100">Add</button>
            </form>
        </div>
    </div>
</section>