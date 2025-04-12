<?php
class AdminAbout extends Controller
{
  public function index()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $Model = $this->model("MemModel");
    $member = $Model->getAllMem();
    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "About",
      "page" => "about/index",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2,
      "member" => $member
    ]);
  }
  public function addMem(): void
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Thêm thành viên",
      "page" => "about/addMem",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2
    ]);
  }
  public function addMember(): void
  {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      // Check if the employee is logged in
      $this->checkAuthAdmin();
      $memName = $_POST["name"];
      $memRole = $_POST["role"];
      $memDesc = $_POST["description"];
      $memImg = $this->uploadImages($_FILES['images'], 'add');
      $memImgJson = json_encode($memImg, JSON_PRETTY_PRINT);

      $Model = $this->model("MemModel");

      #error handling
      $error = null;
      if (empty($memName) || empty($memRole) || empty($memDesc) || empty($memImg)) {
        $error = "Vui lòng nhập đầy đủ thông tin!";
      }
      #check if member name already exists
      $existMember = $Model->getMemByName($memName);
      if (!$existMember) {
        $error = "Tên thành viên đã tồn tại!";
      }
      if (isset($error)) {
        $_SESSION["error_message"] = $error;
        header("Location: addMem");
        exit;
      }

      $result = $Model->addMem($memName, $memRole, $memDesc, $memImgJson);
      $Model->closeConnection();
      if ($result) {
        $_SESSION["success_message"] = "Thêm thành viên thành công!";
        header("Location: index");
      } else {
        $_SESSION["error_message"] = "Thêm thành viên không thành công";
        header("Location: addMem");
      }
    }
  }
  public function deleteMem(): void
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();
    $id = $_GET['id'];
    $Model = $this->model('MemModel');
    $result = $Model->deleteMem($id);
    if ($result) {
      $_SESSION["success_message"] = "Xóa thành viên thành công!";
    } else {
      $_SESSION["error_message"] = "Xóa thành viên không thành công!";
    }
    $Model->closeConnection();
    header("Location: index");
  }
  public function editMem(): void
  {
    $this->checkAuthAdmin();
    $Model = $this->model("MemModel");
    $id = $_GET['id'];
    $member = $Model->getMemById($id);
    if (!$member) {
      $_SESSION["error_message"] = "Không tìm thấy thành viên!";
      header("Location: index");
      exit;
    }
    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Chỉnh sửa thành viên",
      "page" => "about/editMem",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2,
      "member" => $member
    ]);
  }
  public function confirmEditMem(): void
  {
    function isImagesEmpty($images)
    {
      if (is_array($images['error'])) {
        foreach ($images['error'] as $error) {
          if ($error === UPLOAD_ERR_OK) {
            return false;
          }
        }
        return true;
      } else {
        return $images['error'] !== UPLOAD_ERR_OK;
      }
    }
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $this->checkAuthAdmin();
      $Model = $this->model("MemModel");
      $memName = $_POST["name"];
      $memRole = $_POST["role"];
      $memDesc = $_POST["description"];
      $memId = $_GET["id"];
      if (!isImagesEmpty($_FILES['images'])) {
        $memImg = $this->uploadImages($_FILES['images'], 'edit');
        $memImgJson = json_encode($memImg, JSON_PRETTY_PRINT);
      } else {
        $memImgJson = $Model->getOldAvatar($memId);
      }
      $result = $Model->updateMem($memId, $memName, $memRole, $memDesc, $memImgJson);
      $Model->closeConnection();
      if ($result) {
        $_SESSION["success_message"] = "Cập nhật thành viên thành công!";
        header("Location: index");
      } else {
        $_SESSION["error_message"] = "Cập nhật thành viên không thành công!";
        header("Location: editMem?id=" . $memId);
      }
    }
  }
}
