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
            $_SESSION["success"] = "Xóa liên hệ thành công!";
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
            echo json_encode([
                "code" => "error",
                "message" => "Vui lòng chọn hành động và bản ghi!"
            ]);
            return;
        }

        $contactModel = $this->model("ContactModel");

        switch ($option) {
            case "notSeen":
            case "seen":
            case "responded":
                $contactModel->updateStatusMulti($ids, $option);
                echo json_encode(["code" => "success"]);
                break;
            case "delete":
                $contactModel->deleteMulti($ids);
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
            "title" => "Thùng rác",
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
                break;
            case "delete":
                $model->deletePermanentlyByIds($ids);
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
}
