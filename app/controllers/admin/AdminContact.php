<?php
class AdminContact extends Controller
{
    public function index()
    {   
        $this->checkAuthAdmin();

        $status = $_GET['status'] ?? null;
        $startDate = $_GET['startDate'] ?? null;
        $endDate = $_GET['endDate'] ?? null;

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 5;
        $offset = ($currentPage - 1) * $perPage;

        $contactModel = $this->model("ContactModel");
        $result = $contactModel->getContactsFiltered($startDate, $endDate, $status, $perPage, $offset);

        $totalContacts = $result['total'];
        $totalPages = ceil($totalContacts / $perPage);
        $contacts = $result['contacts'];

        $message = $this->getSessionMessage();

        $this->viewAdmin("layout", [
            "title" => "Contact",
            "page" => "contact/index",
            "contacts" => $contacts,
            "error" => $message['error'],
            "success" => $message['success'],
            "task" => 1,
            "currentPage" => $currentPage,
            "totalPages" => $totalPages
        ]);
    }

    public function delete($id)
    {
        header('Content-Type: application/json');

        $this->checkAuthAdmin();

        if (!is_numeric($id)) {
            echo json_encode([
                "code" => "error",
                "message" => "ID không hợp lệ!"
            ]);
            return;
        }

        $contactModel = $this->model("ContactModel");
        $success = $contactModel->softDelete($id, $_SESSION['admin']['id'] ?? null);

        if ($success) {
            $_SESSION['success_message'] = "Lưu trữ liên hệ thành công!";
            echo json_encode(["code" => "success"]);
        } else {
            echo json_encode(["code" => "error", "message" => "Không thể xóa liên hệ!"]);
        }
    }

    public function changeMulti()
    {
        $this->checkAuthAdmin();

        // Đọc JSON từ body
        $input = json_decode(file_get_contents("php://input"), true);
        $option = $input["option"] ?? null;
        $ids = $input["ids"] ?? [];

        header('Content-Type: application/json');

        if (!$option || empty($ids)) {
            $_SESSION['error_message'] = "Vui lòng chọn hành động và bản ghi!";
            echo json_encode([
                "code" => "error",
                "message" => "Vui lòng chọn hành động và bản ghi!"
            ]);
            return;
        }

        $contactModel = $this->model("ContactModel");

        switch ($option) {
            case "notSeen":
                $contactModel->updateStatusMulti($ids, $option);
                $_SESSION['success_message'] = "Đã chuyển trạng thái thành 'Chưa xem'!";
                echo json_encode(["code" => "success"]);
                break;
            case "seen":
                $contactModel->updateStatusMulti($ids, $option);
                $_SESSION['success_message'] = "Đã chuyển trạng thái thành 'Đã xem'!";
                echo json_encode(["code" => "success"]);
                break;
            case "responded":
                $contactModel->updateStatusMulti($ids, $option);
                $_SESSION['success_message'] = "Đã chuyển trạng thái thành 'Đã phản hồi'!";
                echo json_encode(["code" => "success"]);
                break;
            case "delete":
                $contactModel->deleteMulti($ids);
                $_SESSION['success_message'] = "Đã lưu trữ các liên hệ được chọn!";
                echo json_encode(["code" => "success"]);
                break;
            default:
                echo json_encode([
                    "code" => "error",
                    "message" => "Hành động không hợp lệ!"
                ]);
        }
    }

    public function trash()
    {
        $this->checkAuthAdmin();

        $startDate = $_GET['startDate'] ?? null;
        $endDate = $_GET['endDate'] ?? null;

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 5;
        $offset = ($currentPage - 1) * $perPage;

        $contactModel = $this->model("ContactModel");
        $result = $contactModel->getDeletedContacts($startDate, $endDate, $perPage, $offset);

        $totalContacts = $result['total'];
        $totalPages = ceil($totalContacts / $perPage);
        $contacts = $result['contacts'];

        $message = $this->getSessionMessage();

        $this->viewAdmin("layout", [
            "title" => "Removed Contact",
            "page" => "contact/trash", // tạo view contact/trash.php nếu cần
            "contacts" => $contacts,
            "error" => $message['error'],
            "success" => $message['success'],
            "task" => 1,
            "currentPage" => $currentPage,
            "totalPages" => $totalPages
        ]);
    }

    public function restore($id)
    {
        $model = $this->model("ContactModel");
        $model->restoreContact($id);
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }

    public function deleteDestroy($id)
    {
        $this->checkAuthAdmin();

        $model = $this->model("ContactModel");
        $result = $model->deletePermanently($id);

        if ($result) {
            $_SESSION['success_message'] = "Xóa vĩnh viễn thành công!";
            echo json_encode(["code" => "success"]);
        } else {
            echo json_encode(["code" => "error", "message" => "Xóa vĩnh viễn thất bại."]);
        }

        exit();
    }

    public function changeMultiTrash()
    {
        $this->checkAuthAdmin();

        $json = file_get_contents("php://input");
        $data = json_decode($json, true);

        $option = $data["option"] ?? null;
        $ids = $data["ids"] ?? [];

        header('Content-Type: application/json');

        if (!$option || empty($ids)) {
            echo json_encode([
                "code" => "error",
                "message" => "Dữ liệu không hợp lệ."
            ]);
            exit();
        }

        $model = $this->model("ContactModel");

        switch ($option) {
            case "restore":
                $model->restoreByIds($ids);
                $_SESSION['success_message'] = "Khôi phục liên hệ thành công!";
                break;
            case "delete":
                $model->deletePermanentlyByIds($ids);
                $_SESSION['success_message'] = "Xóa vĩnh viễn liên hệ thành công!";
                break;
            default:
                echo json_encode([
                    "code" => "error",
                    "message" => "Tuỳ chọn không hợp lệ."
                ]);
                exit();
        }

        echo json_encode(["code" => "success"]);
        exit();
    }

    public function sendReply()
    {
        $this->checkAuthAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $_SESSION['error_message'] = "Phương thức không hợp lệ!";
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit();
        }

        $email = $_POST['email'] ?? '';
        $message = $_POST['message'] ?? '';
        $name = $_POST['name'] ?? 'Người dùng';
        $id = $_POST['contact_id'] ?? null;
        // $employeeId = $_SESSION['employeeId'] ?? null;

        if (!$email || !$message) {
            $_SESSION['error_message'] = "Thiếu email hoặc nội dung phản hồi.";
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit();
        }

        // Làm sạch và chuẩn bị nội dung HTML cho email
        $message = nl2br(htmlspecialchars($message));
        $htmlBody = "
            <div style='font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px; color: #333;'>
                <div style='max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.05);'>
                    <h2 style='color: #FF6600;'>Xin chào {$name},</h2>
                    <p>Chúng tôi đã nhận được liên hệ từ bạn và phản hồi như sau:</p>
                    <blockquote style='margin: 20px 0; padding: 15px; background: #f3f3f3; border-left: 4px solid #FF6600;'>
                        {$message}
                    </blockquote>
                    <p>Nếu bạn có thêm thắc mắc hoặc câu hỏi khác, vui lòng liên hệ lại với chúng tôi bất cứ lúc nào.</p>
                    <hr style='margin: 30px 0;'>
                    <p style='font-size: 14px; color: #888;'>Trân trọng,<br><strong>Đội ngũ hỗ trợ</strong></p>
                </div>
            </div>
        ";

        $success = $this->sendMail($email, $name, "Phản hồi liên hệ", $htmlBody);

        if ($success) {
            if ($id) {
                require_once './app/models/ContactModel.php';
                $contactModel = new ContactModel();
                $contactModel->updateStatusById((int)$id, 'responded');
                // $contactModel->updateAfterReply($contactId, $employeeId);
            }
            $_SESSION['success_message'] = "Gửi phản hồi thành công!";
        } else {
            $_SESSION['error_message'] = "Gửi phản hồi thất bại! Vui lòng kiểm tra lại cấu hình gửi mail.";
        }

        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
}
