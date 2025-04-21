<?php
$member = $data["member"];
$member_img = json_decode($member['Image'], true);
$member_img = $member_img[0];
?>
<section class="section">
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <div class="avatar avatar-4xl">
                            <img src="<?= $member_img ?>" alt="<?= $member["Name"] ?>'s image" style="width: 150px; height: 150px;">
                        </div>

                        <h3 class="mt-3"><?= $member["Name"] ?></h3>
                        <p class="text-small"><?= $member["Role"] ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="admin/about/confirmEditMem?id=<?= $member["ID"] ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="<?= $member["Name"] ?>" value="<?= $member["Name"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="role" class="form-label">Role:</label>
                            <input type="text" name="role" id="role" class="form-control" placeholder="<?= $member["Role"] ?>" value="<?= $member["Role"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label">Description:</label>
                            <input type="text" name="description" id="description" class="form-control" placeholder="<?= $member["Description"] ?>" value="<?= $member["Description"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="images" class="form-label">Image:</label>
                            <input type="file" class="image-preview-filepond" name="images[]" id="images" multiple>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>