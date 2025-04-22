<div class="card border-0 shadow-sm">
    <div class="card-header border-bottom">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="admin/comment?status=all">Comments</a>
            </li>
        </ul>
    </div>

    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center"b style="margin-left: 8px;">
        <div class="d-flex gap-2">
        <form action="admin/comment" method="get" class="d-flex align-items-center gap-2">
            <select name="status" class="dataTable-selector form-select">
                <option value="all" <?= ($data['status'] ?? 'all') === 'all' ? 'selected' : '' ?>>All Statuses</option>
                <option value="approved" <?= ($data['status'] ?? '') === 'approved' ? 'selected' : '' ?>>Approved</option>
                <option value="pending" <?= ($data['status'] ?? '') === 'pending' ? 'selected' : '' ?>>Pending</option>
            </select>
            <button class="btn btn-outline-secondary">Filter</button>
        </form>


        </div>
    </div>

    <div class="table-responsive rounded-3">
        <table id="table1" class="table table-striped mb-0">
            <thead class="table-striped">
            <tr>
                <!-- <th style="width: 40px;"><input type="checkbox" class="form-check-input"></th> -->
                <th style="width: 40px;">ID</th>
                <th style="width: 70px;">Date</th>
                <th>Comment</th>
                <th style="width: 100px;">Status</th>
                <th style="width: 100px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['comments'] as $comment): ?>
            <tr class="align-middle">
                <!-- <td><input type="checkbox" class="form-check-input"></td> -->
                <td><?= htmlspecialchars($comment['ID']) ?></td>
                <td class="text-muted"><?= htmlspecialchars($comment['CreatedAt']) ?></td>
                <td>
                <div class="d-flex flex-column">
                    <strong class="mb-1"><?= htmlspecialchars($comment['name_Customer'] ?? 'Unknown') ?></strong>
                    <p class="text-muted mb-0"><?= htmlspecialchars($comment['Content']) ?></p>
                </div>
                </td>
                <td>
                    <button class="btn <?= $comment['Status'] == 'approved' ? 'btn-success' : 'btn-danger' ?>" style="cursor: default;">
                        <?= ucfirst($comment['Status']) ?>
                    </button>
                </td>

                <td>
                <div class="d-flex gap-2 align-items-center">
                    <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#commentDetailModal<?= htmlspecialchars($comment['ID']) ?>">
                    <i class="bi bi-eye"></i> | <i class="bi bi-pencil-square"></i>
                    </button>
                    <form action="admin/comment/deleteCMT" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xoá bài viết này không?');">
                        <input type="hidden" name="article_id" value="<?= htmlspecialchars($comment['ID']) ?>">
                        <input type="hidden" name="status" value="<?= htmlspecialchars($_GET['status'] ?? 'all') ?>">
                        <button type="submit" class="btn btn-outline-danger" data-comment-id="<?= htmlspecialchars($comment['ID']) ?>">
                        <i class="bi bi-trash-fill"></i>
                        </button>
                    </form>
                    <!-- <button class="btn btn-outline-danger" data-comment-id="<?= htmlspecialchars($comment['ID']) ?>">
                    <i class="bi bi-trash-fill"></i>
                    </button> -->
                </div>
                </td>
            </tr>

            <div class="modal fade" id="commentDetailModal<?= htmlspecialchars($comment['ID']) ?>" tabindex="-1" aria-labelledby="commentDetailModalLabel<?= htmlspecialchars($comment['ID']) ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                    
                        <form action="admin/comment/updatestatus" method="post">
                            <input type="hidden" name="article_id" value="<?= htmlspecialchars($comment['ID']) ?>">
                            <input type="hidden" name="statusid" value="<?= htmlspecialchars($_GET['status'] ?? 'all') ?>">
                            <div class="modal-header">
                                <h5 class="modal-title" id="commentDetailModalLabel<?= htmlspecialchars($comment['ID']) ?>">Detail Comment</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                            </div>

                            <div class="modal-body">
                                <ul class="list-group">
                                    <li class="list-group-item"><strong>ID:</strong> <?= htmlspecialchars($comment['ID']) ?></li>
                                    <li class="list-group-item"><strong>Content:</strong> <?= htmlspecialchars($comment['Content']) ?></li>
                                    <li class="list-group-item"><strong>ID Customer:</strong> <?= htmlspecialchars($comment['ID_Customer']) ?></li>
                                    <li class="list-group-item"><strong>ID Blog:</strong>
                                        <a href="admin/blog/detail?id=<?= htmlspecialchars($comment['ID_Blog']) ?>">
                                            <?= htmlspecialchars($comment['ID_Blog']) ?>
                                        </a>
                                    </li>
                                    <li class="list-group-item"><strong>Like:</strong> <?= htmlspecialchars($comment['Like']) ?></li>
                                    <li class="list-group-item"><strong>Dislike:</strong> <?= htmlspecialchars($comment['Dislike']) ?></li>
                                    <li class="list-group-item d-flex gap-2 align-items-center">
                                        <strong>Status:</strong>
                                        <select class="form-select form-select w-auto" name="status">
                                            <option value="approved" <?= $comment['Status'] == 'approved' ? 'selected' : '' ?>>Approved</option>
                                            <option value="pending" <?= $comment['Status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                        </select>
                                    </li>
                                    <li class="list-group-item"><strong>Created At:</strong> <?= htmlspecialchars($comment['CreatedAt']) ?></li>
                                </ul>
                            </div>

                            <div class="modal-footer">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($comment['ID']) ?>">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <?php endforeach; ?>
        </tbody>
      </table>
    </div>

  </div>
</div>

<script src="public/assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
<script src="public/assets/static/js/pages/simple-datatables.js"></script>