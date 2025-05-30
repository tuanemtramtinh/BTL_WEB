<div class="card mb-4">
    <div class="card-header bg-primary text-white">Thay đổi Logo Website</div>
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <div style="width: 100px; height: 100px;" class="avatar avatar-4xl">
                            <img style="object-fit: contain; width: 100%; height: 100%;" src="<?= isset($GLOBALS['general']['Logo']) ? $GLOBALS['general']['Logo'] : 'public/images/logo.svg' ?>" alt="logo" style="width: 150px; height: 150px;">
                        </div>
                        <h3 class="mt-3">Logo Hiện tại</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="admin/home/logoUpdate" method="POST" enctype="multipart/form-data" multiple>
                        <div class="form-group">
                            <label for="imageLogo" class="form-label">Image:</label>
                            <input type="file" class="image-preview-filepond" name="imageLogo[]" id="imageLogo">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form 2: Đổi thông tin giới thiệu 1 -->
<div class="card mb-4">
    <div class="card-header bg-secondary text-white">Thông tin giới thiệu 1</div>
    <div class="card-body">
        <form action="<?= BASE_URL ?>/admin/home/section2" method="POST">
            <div class="mb-3" style="margin-top: 20px;">
                <label for="intro1_title" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" name="intro1_title" id="intro1_title" value="<?= $data['intro1_title'] ?? '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="intro1_content" class="form-label">Nội dung</label>
                <textarea class="form-control" name="intro1_content" id="intro1_content" rows="4" required><?= $data['intro1_content'] ?? '' ?></textarea>
            </div>
            <button type="submit" class="btn btn-secondary">Lưu giới thiệu 1</button>
        </form>
    </div>
</div>

<!-- Form 3: Đổi thông tin giới thiệu 2 -->
<div class="card mb-4">
    <div class="card-header bg-primary text-white">Thông tin giới thiệu 2</div>
    <div class="card-body">
        <form action="<?= BASE_URL ?>/admin/home/section3" method="POST">
            <div class="mb-3" style="margin-top: 20px;">
                <label for="intro2_title" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" name="intro2_title" id="intro2_title" value="<?= $data['intro2_title'] ?? '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="intro2_content" class="form-label">Nội dung</label>
                <textarea class="form-control" name="intro2_content" id="intro2_content" rows="4" required><?= $data['intro2_content'] ?? '' ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary text-white">Lưu giới thiệu 2</button>
        </form>
    </div>
</div>

<!-- Form 4: Đổi thông tin giảm giá -->
<div class="card mb-4">
    <div class="card-header bg-secondary text-white">Thông tin giảm giá</div>
    <div class="card-body">
        <form action="<?= BASE_URL ?>/admin/home/section4" method="POST">
            <div class="mb-3" style="margin-top: 20px;">
                <label for="sale_title" class="form-label">Tên Sự kiện</label>
                <input type="text" class="form-control" name="sale_title" id="sale_title" value="<?= $data['sale_title'] ?? '' ?>" required>
            </div>
            <div class="mb-3" style="margin-top: 20px;">
                <label for="saleoff" class="form-label">Mức giảm giá</label>
                <input type="text" class="form-control" name="saleoff" id="saleoff" value="<?= $data['saleoff'] ?? '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="sale_content" class="form-label">Nội dung</label>
                <textarea class="form-control" name="sale_content" id="sale_content" rows="4" required><?= $data['sale_content'] ?? '' ?></textarea>
            </div>
            <button type="submit" class="btn btn-secondary">Lưu thông tin giảm giá</button>
        </form>
    </div>
</div>