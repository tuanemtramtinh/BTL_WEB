<!-- Section 4 - Bộ lọc -->
<div class="card mb-4">
  <div class="card-body d-flex flex-wrap align-items-center">
    <div class="d-flex align-items-center me-3 mb-2">
      <i class="fa-solid fa-filter me-2 fs-4"></i> <strong>Bộ lọc</strong>
    </div>

    <div class="me-3 mb-2">
      <select class="form-select form-select-sm" style="min-width: 150px;" filter-status="filter-status">
        <option value="">Trạng thái</option>
        <option value="notSeen">Chưa xem</option>
        <option value="seen">Đã xem</option>
        <option value="responded">Đã phản hồi</option>
      </select>
    </div>

    <!-- <div class="me-3 mb-2">
      <select class="form-select form-select-sm" style="min-width: 150px;" filter-created-by="filter-created-by">
        <option value="">Người tạo</option>
        <option value="">Nguyen Van AA</option>
      </select>
    </div> -->

    <div class="d-flex align-items-center me-3 mb-2">
      <input type="date" filter-start-date class="form-control form-control-sm me-1" style="width: 120px;" filter-start-date="filter-start-date">
      <span class="mx-1">-</span>
      <input type="date" filter-end-date class="form-control form-control-sm" style="width: 120px;" filter-end-date="filter-end-date">
    </div>

    <div class="text-danger fw-semibold mb-2" style="cursor: pointer;" filter-reset>
      <i class="bi bi-arrow-counterclockwise me-1"></i> Xóa bộ lọc
    </div>
  </div>
</div>

<!-- Section 5 - Hành động nhóm / Tìm kiếm / Tạo mới -->
<div class="card mb-4">
  <div class="card-body d-flex flex-wrap align-items-center gap-3">

    <!-- Hành động nhóm -->
    <div class="d-flex align-items-center border rounded-3 overflow-hidden" 
        change-multi 
        data-api="admin/contact/changeMulti">
      <div class="p-3 border-end">
        <select class="form-select form-select-sm" id="bulk-action">
          <option value="">-- Hành động --</option>
          <option value="notSeen">Chưa xem</option>
          <option value="seen">Đã xem</option>
          <option value="responded">Đã phản hồi</option>
          <option value="delete">Xoá</option>
        </select>
      </div>
      <div class="p-3">
        <button class="btn btn-link text-danger fw-semibold p-0">Áp dụng</button>
      </div>
    </div>

    <!-- Tìm kiếm -->
    <div class="d-flex justify-content-center align-items-center bg-blue border rounded-3 px-3 py-2" style="min-height: 62px; width: 366px; max-width: 100%;">
      <i class="bi bi-search me-2 fs-5 text-muted" style="padding-bottom: 30px;"></i>
      <input type="text" class="form-control border-0 p-0 fw-bold" placeholder="Tìm kiếm" search style="box-shadow: none; margin-left: 10px;">
    </div>

    <!-- Nút xem danh sách xóa -->
    <div>
      <a href="admin/contact/trash" class="btn btn-primary fw-bold px-4 rounded-3 d-flex align-items-center" style="min-height: 62px;">
        Các liên hệ đã xóa
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

              <!-- Nút mở modal trả lời -->
              <a href="#" class="btn icon btn-warning" data-bs-toggle="modal" data-bs-target="#replyModal-<?= $contact["ID"] ?>">
                <i class="bi bi-envelope-open"></i>
              </a>

              <!-- Modal trả lời -->
              <div class="modal fade" id="replyModal-<?= $contact["ID"] ?>" tabindex="-1" aria-labelledby="replyModalLabel-<?= $contact["ID"] ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
                  <div class="modal-content">
                    <form method="POST" action="<?= BASE_URL ?>/admin/contact/sendReply">
                      <div class="modal-header">
                        <h5 class="modal-title" id="replyModalLabel-<?= $contact["ID"] ?>">Phản hồi đến: <?= htmlspecialchars($contact["Email"]) ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                      </div>
                      <div class="modal-body">
                        <p><strong>Email người nhận:</strong> <?= htmlspecialchars($contact["Email"]) ?></p>
                        <div class="mb-3">
                          <label for="replyTextarea-<?= $contact["ID"] ?>" class="form-label">Nội dung phản hồi</label>
                          <textarea class="form-control" name="message" id="replyTextarea-<?= $contact["ID"] ?>" rows="5" placeholder="Nhập nội dung phản hồi..." required></textarea>
                        </div>

                        <!-- Hidden fields (không cần thêm input text cho người dùng thấy) -->
                        <input type="hidden" name="email" value="<?= htmlspecialchars($contact["Email"]) ?>">
                        <input type="hidden" name="contact_id" value="<?= $contact["ID"] ?>">
                        <input type="hidden" name="name" value="<?= htmlspecialchars($contact["Name"] ?? 'Người dùng') ?>">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Gửi phản hồi</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <a 
              href="javascript:;" 
              class="btn icon btn-danger" 
              button-delete 
              data-api="admin/contact/delete/<?= $contact['ID'] ?>">
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