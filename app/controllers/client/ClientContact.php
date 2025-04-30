<?php

// TRANG LIÊN HỆ
class ClientContact extends Controller {
  public function index() {
    $message = $this->getSessionMessage();
    $this->view("layout", [
      "title" => "Liên Hệ",
      "page" => "contact/index",
      "task" => 1
    ]);
  }

  public function addContact()
{
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (!$data) {
        echo json_encode([
            "code" => "error",
            "message" => "Dữ liệu không hợp lệ."
        ]);
        return;
    }

    $name = trim($data['name'] ?? '');
    $email = trim($data['email'] ?? '');
    $message = trim($data['message'] ?? '');

    if (empty($name) || empty($email) || empty($message)) {
        echo json_encode([
            "code" => "error",
            "message" => "Vui lòng điền đầy đủ thông tin."
        ]);
        return;
    }

    $db = new DB();
    $conn = $db->getConnection();

    if ($conn->connect_error) {
        echo json_encode([
            "code" => "error",
            "message" => "Không thể kết nối database."
        ]);
        return;
    }

    // Chuẩn bị câu SQL
    $stmt = $conn->prepare("INSERT INTO Contact (Name, Email, Status, Message, created_at) VALUES (?, ?, ?, ?, NOW())");

    if (!$stmt) {
        echo json_encode([
            "code" => "error",
            "message" => "Lỗi khi chuẩn bị truy vấn."
        ]);
        return;
    }

    $status = "pending"; // trạng thái mặc định
    $stmt->bind_param("ssss", $name, $email, $status, $message);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Gửi liên hệ thành công!";
        echo json_encode([
            "code" => "success",
            "message" => "Cảm ơn bạn đã liên hệ với chúng tôi."
        ]);
    } else {
        echo json_encode([
            "code" => "error",
            "message" => "Gửi liên hệ thất bại. Vui lòng thử lại."
        ]);
    }

    $stmt->close();
    $db->closeConnection();
}
}