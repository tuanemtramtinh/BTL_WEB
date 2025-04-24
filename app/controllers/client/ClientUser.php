<?php

// TRANG CÁ NHÂN

class ClientUser extends Controller
{
  public function index()
  {
    $this->checkAuthClient();
    $CustomerModel = $this->model("UserModel");
    $CustomerInfo = $CustomerModel->findUserById($_SESSION['userId']);
    $message = $this->getSessionMessage();
    $this->view("layout", [
      "title" => "Trang Tổng Quan",
      "page" => "user/index",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2,
      "customer" => $CustomerInfo,
    ]);
  }

  public function profile()
  {
    $this->checkAuthClient();
    $CustomerModel = $this->model("UserModel");
    $CustomerInfo = $CustomerModel->findUserById($_SESSION['userId']);
    $message = $this->getSessionMessage();
    $this->view("layout", [
      "title" => "Trang Cá Nhân",
      "page" => "user/profile",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2,
      "customer" => $CustomerInfo,
    ]);
  }

  public function history()
  {
    $this->checkAuthClient();
    $message = $this->getSessionMessage();
    $this->view("layout", [
      "title" => "Trang Lịch Sử",
      "page" => "user/history",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2
    ]);
  }

  public function password()
  {
    $this->checkAuthClient();
    $message = $this->getSessionMessage();
    $this->view("layout", [
      "title" => "Trang Đổi Mật Khẩu",
      "page" => "user/password",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2
    ]);
  }
  public function avatar()
  {
    $this->checkAuthClient();
    $CustomerModel = $this->model("UserModel");
    $CustomerInfo = $CustomerModel->findUserById($_SESSION['userId']);
    $message = $this->getSessionMessage();
    $this->view("layout", [
      "title" => "Trang Đổi Avatar",
      "page" => "user/avatar",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2,
      "customer" => $CustomerInfo
    ]);
  }
  public function editUser()
  {
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
      ini_set('display_errors', 1);
      ini_set('display_startup_errors', 1);
      error_reporting(E_ALL);
      $this->checkAuthClient();
      $model = $this->model('UserModel');
      $id = $_GET['id'];
      $fname = htmlspecialchars($_POST['fname']);
      $lname = htmlspecialchars($_POST['lname']);
      $email = htmlspecialchars($_POST['email']);
      $phone = htmlspecialchars($_POST['phone']);
      $address = htmlspecialchars($_POST['address']);

      $error = null;
      if (!is_numeric($phone) || !ctype_digit($phone)) {
        $error = "Số điện thoại không hợp lệ";
      }
      if ($address === "Chưa có địa chỉ") {
        $error = "Vui lòng nhập địa chỉ vào";
      }
      if (isset($error)) {
        $_SESSION['error_message'] = $error;
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
      }
      $result = $model->editUserInfo($id, $fname, $lname, $email, $phone, $address);
      if ($result) {
        $_SESSION["success_message"] = "Thay đổi thông tin thành công";
        header("Location: " . $_SERVER['HTTP_REFERER']);
      } else {
        $_SESSION['error_message'] = "Bạn chưa thay đổi thông tin nào có, vui lòng nhập lại !!!";
        header("Location: " . $_SERVER['HTTP_REFERER']);
      }
    }
  }
  public function uploadAvatar()
  {
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
      ini_set('display_errors', 1);
      ini_set('display_startup_errors', 1);
      error_reporting(E_ALL);
      $this->checkAuthClient();
      $model = $this->model('UserModel');
      $id = $_GET['id'];
      if (
        !isset($_FILES['images']) ||
        empty($_FILES['images']['name']) || // tên trống
        $_FILES['images']['error'][0] === UPLOAD_ERR_NO_FILE // lỗi không có file upload
      ) {
        $_SESSION['error_message'] = "Bạn chưa upload ảnh nào.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
      }
      $avatarImg = $this->uploadImages($_FILES['images'], 'add');
      $avatarImgJson = json_encode($avatarImg, JSON_PRETTY_PRINT);

      $result = $model->uploadAvatar($id, $avatarImgJson);
      if ($result) {
        $_SESSION["success_message"] = "Thay đổi ảnh thành công";
        header("Location: index");
      } else {
        $_SESSION["error_message"] = "Đã xảy ra lỗi khi upload ảnh vui lòng upload lại sau";
        header("Location: " . $_SERVER['HTTP_REFERER']);
      }
    }
  }
}
