<?php
class AdminContact extends Controller
{
    public function index()
    {
        $this->checkAuthAdmin();

        $status = $_GET['status'] ?? null;
        $startDate = $_GET['startDate'] ?? null;
        $endDate = $_GET['endDate'] ?? null;

        // Không cần nối thủ công "00:00:00" hoặc "23:59:59" ở đây nữa
        $contactModel = $this->model("ContactModel");
        $contacts = $contactModel->getContactsFiltered($startDate, $endDate, $status); 

        $message = $this->getSessionMessage();

        $this->viewAdmin("layout", [
            "title" => "Contact",
            "page" => "contact/index",
            "contacts" => $contacts,
            "error" => $message['error'],
            "success" => $message['success'],
            "task" => 1
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
            $_SESSION["success"] = "Xóa liên hệ thành công!";
            echo json_encode(["code" => "success"]);
        } else {
            echo json_encode(["code" => "error", "message" => "Không thể xóa liên hệ!"]);
        }
    }
}
