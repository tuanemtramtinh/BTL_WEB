<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Title Section</h4>
        </div>
        <div class="card-body">
            <form action="admin/about/changeTitle" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Description:</label>
                    <textarea class="form-control" id="content" name="content"></textarea>
                </div>
                <div class="mb-3">
                    <label for="images" class="form-label">Image</label>
                    <input type="file" class="image-preview-filepond" name="images[]" id="images" multiple>
                </div>
                <button type="submit" class="btn btn-success w-100">Change Section</button>
            </form>
        </div>
    </div>
</section>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                Member Section
            </h4>
        </div>
        <div class="card-body">
            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                <a href="admin/about/addMem" class="w-100 btn btn-success btn-sm py-2 fs-6">
                    Add Member
                </a>
                <div class="dataTable-container">
                    <table class="table table-striped dataTable-table" id="member-table">
                        <thead>
                            <tr>
                                <th data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">ID</a></th>
                                <th data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">Image</a></th>
                                <th data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">Name</a></th>
                                <th data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">Role</a></th>
                                <th data-sortable="" style="width: 50%"><a href="#" class="dataTable-sorter">Description</a></th>
                                <th data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">Action</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['member'] as $member) {
                                $image = json_decode($member['Image']) ?>
                                <tr>
                                    <td data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter"><?= $member['ID'] ?></a></td>
                                    <td data-sortable="" style="width: 10%">
                                        <img src="<?= $image[0] ?>" alt="" class="card__avatar" style="width: 150px; height: 150px;">
                                    </td>
                                    <td data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter"><?= $member['Name'] ?></a></td>
                                    <td data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter"><?= $member['Role'] ?></a></td>
                                    <td data-sortable="" style="width: 50%"><a href="#" class="dataTable-sorter"><?= $member['Description'] ?></a></td>
                                    <td data-sortable="" style="width: 10%">
                                        <a href="admin/about/editMem?id=<?= $member['ID'] ?>" class="btn btn-primary">Edit</a>
                                        <a href="admin/about/deleteMem?id=<?= $member['ID'] ?>" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa thành viên này ?')">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Story Section</h4>
        </div>
        <div class="card-body">
            <form action="admin/about/changeStory" method="POST">
                <div class="mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Content:</label>
                    <textarea class="form-control" id="content" name="content"></textarea>
                </div>
                <button type="submit" class="btn btn-success w-100">Change Section</button>
            </form>
        </div>
    </div>
</section>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Show case section</h4>
        </div>
        <div class="card-body">
            <form action="admin/about/changeShowCase" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="images" class="form-label">Background:</label>
                    <input type="file" class="image-preview-filepond" name="images[]" id="images" multiple>
                </div>
                <button type="submit" class="btn btn-success w-100">Change Section</button>
            </form>
        </div>
    </div>
</section>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Unique section</h4>
        </div>
        <div class="card-body">
            <form action="admin/about/changeUnique" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
                </div>
                <div class="md-6">
                    <label for="left-section-title" class="form-label">Left section title:</label>
                    <input type="text" class="form-control" id="title" name="left-section-title" placeholder="Enter title" required>
                </div>
                <div class="md-6">
                    <label for="left-section-content" class="form-label">Left section content: </label>
                    <textarea class="form-control" id="content" name="left-section-content"></textarea>
                </div>
                <div class="md-6">
                    <label for="mid-section-title" class="form-label">Mid section title:</label>
                    <input type="text" class="form-control" id="title" name="mid-section-title" placeholder="Enter title" required>
                </div>
                <div class="md-6">
                    <label for="mid-section-content" class="form-label">Mid section content: </label>
                    <textarea class="form-control" id="content" name="mid-section-content"></textarea>
                </div>
                <div class="md-6">
                    <label for="right-section-title" class="form-label">Right section title:</label>
                    <input type="text" class="form-control" id="title" name="right-section-title" placeholder="Enter title" required>
                </div>
                <div class="md-6">
                    <label for="right-section-content" class="form-label">Right section content: </label>
                    <textarea class="form-control" id="content" name="right-section-content"></textarea>
                </div>
                <button type="submit" class="btn btn-success w-100">Change Section</button>
            </form>
        </div>
    </div>
</section>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Invite section</h4>
        </div>
        <div class="card-body">
            <form action="admin/about/changeInvite" method="POST" enctype="multipart/form-data">
                <div class="md-6">
                    <label for="invite" class="form-label">Invite: </label>
                    <textarea class="form-control" id="content" name="invite"></textarea>
                </div>
                <button type="submit" class="btn btn-success w-100">Change Section</button>
            </form>
        </div>
    </div>
</section>