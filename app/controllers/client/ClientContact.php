<?php

// TRANG LIÊN HỆ
// TRANG LIÊN HỆ
class ClientContact extends Controller {
    public function index() {
      // Lấy thông báo từ session
      $message = $this->getSessionMessage();
      
      // Truyền dữ liệu thông báo vào view
      $this->view("layout", [
        "title" => "Liên Hệ",
        "page" => "contact/index",
        "error" => $message['error'],
        "success" => $message['success'],
        "task" => 1
      ]);
    }
  
    public function addContact() {
      // Lấy dữ liệu từ JSON
      $json = file_get_contents('php://input');
      $data = json_decode($json, true);
  
      if (!$data) {
          $_SESSION["error_message"] = "Dữ liệu không hợp lệ!";
          echo json_encode([
              "code" => "error",
              "message" => "Dữ liệu không hợp lệ."
          ]);
          return;
      }
  
      $name = trim($data['name'] ?? '');
      $email = trim($data['email'] ?? '');
      $message = trim($data['message'] ?? '');
      $status = trim($data['status']);
  
      if (empty($name) || empty($email) || empty($message)) {
          $_SESSION["error_message"] = "Vui lòng điền đầy đủ thông tin!";
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
  
      $stmt->bind_param("ssss", $name, $email, $status, $message); // Bind status vào câu truy vấn
  
      if ($stmt->execute()) {
          $_SESSION['success_message'] = "Gửi liên hệ thành công!";
          echo json_encode([
              "code" => "success",
              "message" => "Cảm ơn bạn đã liên hệ với chúng tôi."
          ]);
      } else {
            $_SESSION["error_message"] = "Gửi liên hệ thất bại. Vui lòng thử lại.";
          echo json_encode([
              "code" => "error",
              "message" => "Gửi liên hệ thất bại. Vui lòng thử lại."
          ]);
      }
  
      $stmt->close();
      $db->closeConnection();
    }
  }  