<!-- Section 5 - Hành động nhóm / Tìm kiếm / Tạo mới -->
<div class="card mb-4">
  <div class="card-body d-flex flex-wrap align-items-center gap-3">

    <!-- Hành động nhóm -->
    <div class="d-flex align-items-center border rounded-3 overflow-hidden" 
        change-multi
        data-api="admin/contact/changeMultiTrash">
      <div class="p-3 border-end">
        <select class="form-select form-select-sm" id="bulk-action">
          <option value="">-- Hành động --</option>
          <option value="restore">Khôi phục</option>
          <option value="delete">Xóa vĩnh viễn</option>
        </select>
      </div>
      <div class="p-3">
        <button class="btn btn-link text-danger fw-semibold p-0">Áp dụng</button>
      </div>
    </div>

    <!-- Nút xem danh sách xóa -->
    <div>
      <a href="admin/contact" class="btn btn-primary fw-bold px-4 rounded-3 d-flex align-items-center" style="min-height: 62px;">
        Quay lại trang danh sách
      </a>
    </div>
  </div>
</div>

<!-- Section 6 -->
<div class="section-6 mb-4">
  <div class="table-2">
    <div class="table-responsive">
      <table class="table table-bordered rounded-3 overflow-hidden" style="min-width: 1141px;">
        <thead class="table-light">
          <tr>
            <th class="text-center">
              <input type="checkbox" class="form-check-input" check-all/>
            </th>
            <th>Tên người liên hệ</th>
            <th class="text-center">Ngày gửi</th>
            <th class="text-center">Trạng thái</th>
            <th class="text-center">Phản hồi bởi</th>
            <th class="text-center">Hành động</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($data["contacts"] as $contact): ?>
          <tr>
            <td class="text-center">
              <input type="checkbox" class="form-check-input" check-item="<?= $contact['ID'] ?>"/>
            </td>
            <td><?= htmlspecialchars($contact["Name"]) ?></td>
            <td class="text-center"><?= date("d-m-Y", strtotime($contact["created_at"])) ?></td>
            <td class="text-center">
              <?php
                $statusMap = [
                  "notSeen" => "Chưa xem",
                  "seen" => "Đã xem",
                  "responded" => "Đã phản hồi",
                  "deleted" => "Đã xoá"
                ];
                $badgeClass = [
                  "pending" => "secondary",
                  "seen" => "warning",
                  "responded" => "success",
                  "deleted" => "danger"
                ];
                $status = $contact["Status"];
              ?>
              <span class="badge bg-<?= $badgeClass[$status] ?? 'secondary' ?>">
                <?= $statusMap[$status] ?? "Không rõ" ?>
              </span>
            </td>
            <td class="text-center">
              <div><?= $contact["reply_by"] ?? "Chưa phản hồi" ?></div>
              <div class="text-muted small">
                <?= $contact["reply_at"] ? date("d/m/Y", strtotime($contact["reply_at"])) : "" ?>
              </div>
            </td>
            <td class="text-center">
              <!-- Nút xem modal -->
              <a href="#" class="btn icon btn-info" data-bs-toggle="modal" data-bs-target="#viewModal-<?= $contact["ID"] ?>">
                <i class="bi bi-eye"></i>
              </a>

              <!-- Modal riêng cho từng liên hệ -->
              <div class="modal fade" id="viewModal-<?= $contact["ID"] ?>" tabindex="-1" aria-labelledby="viewModalLabel-<?= $contact["ID"] ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="viewModalLabel-<?= $contact["ID"] ?>">Chi tiết phản hồi</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <div class="modal-body">
                      <p><strong>Tên người gửi:</strong> <?= htmlspecialchars($contact["Name"]) ?></p>
                      <p><strong>Email:</strong> <?= htmlspecialchars($contact["Email"]) ?></p>
                      <p><strong>Nội dung:</strong> <?= htmlspecialchars($contact["Message"]) ?></p>
                    </div>
                  </div>
                </div>
              </div>

              <a href="admin/contact/restore/<?= $contact['ID'] ?>" class="btn icon btn-warning" title="Khôi phục">
                <i class="bi bi-arrow-counterclockwise"></i>
              </a>

              <a 
              href="javascript:;" 
              class="btn icon btn-danger" 
              button-delete 
              data-api="admin/contact/deleteDestroy/<?= $contact['ID'] ?>">
                <i class="bi bi-trash"></i>
              </a>

            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- End Section 6 -->

<!-- Section 7 -->
<div class="section-7 d-flex align-items-center gap-3 mb-4">
  <span class="fw-semibold">
    Hiển thị trang <?= $data["currentPage"] ?> trên <?= $data["totalPages"] ?>
  </span>
  <?php
    // Lấy toàn bộ query string trừ page
    $queryParams = $_GET;
    unset($queryParams['page']);
    $baseQuery = http_build_query($queryParams);
  ?>
  <select class="form-select form-select-sm" style="width: 90px;" onchange="location.href='?<?= $baseQuery ?>&page=' + this.value">
    <?php for ($i = 1; $i <= $data["totalPages"]; $i++): ?>
      <option value="<?= $i ?>" <?= $i == $data["currentPage"] ? "selected" : "" ?>>Trang <?= $i ?></option>
    <?php endfor; ?>
  </select>
</div>
<!-- End Section 7 -->