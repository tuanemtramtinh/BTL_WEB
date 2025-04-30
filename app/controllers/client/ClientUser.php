<?php

// TRANG CÁ NHÂN

class ClientUser extends Controller
{
  public function index()
  {
    $this->checkAuthClient();
    $CustomerModel = $this->model("UserModel");
    $OrderModel = $this->model("OrderModel");
    $Orders = $OrderModel->getOrderByUserId($_SESSION['userId']);
    $CustomerInfo = $CustomerModel->findUserById($_SESSION['userId']);
    $message = $this->getSessionMessage();
    $this->view("layout", [
      "title" => "Trang Tổng Quan",
      "page" => "user/index",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2,
      "customer" => $CustomerInfo,
      "orders" => $Orders
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
    $CustomerModel = $this->model("UserModel");
    $OrderModel = $this->model("OrderModel");
    $Orders = $OrderModel->getOrderByUserId($_SESSION['userId']);
    $CustomerInfo = $CustomerModel->findUserById($_SESSION['userId']);
    $this->view("layout", [
      "title" => "Trang Lịch Sử",
      "page" => "user/history",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2,
      "customer" => $CustomerInfo,
      "orders" => $Orders
    ]);
  }

  public function password()
  {
    $this->checkAuthClient();
    $message = $this->getSessionMessage();
    $CustomerModel = $this->model("UserModel");
    $CustomerInfo = $CustomerModel->findUserById($_SESSION['userId']);
    $this->view("layout", [
      "title" => "Trang Đổi Mật Khẩu",
      "page" => "user/password",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2,
      "customer" => $CustomerInfo,
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

  public function verify()
  {
    $this->checkAuthClient();
    $CustomerModel = $this->model("UserModel");
    $CustomerInfo = $CustomerModel->findUserById($_SESSION['userId']);
    $message = $this->getSessionMessage();
    $this->view("layout", [
      "title" => "Trang Xác nhận đổi mật khẩu",
      "page" => "user/verify",
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
        empty($_FILES['images']['name']) ||
        $_FILES['images']['error'][0] === UPLOAD_ERR_NO_FILE
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
  public function changePassword()
  {
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
      $this->checkAuthClient();
      $model = $this->model("UserModel");
      $id = $_GET['id'];
      $currPass = htmlspecialchars($_POST['currPass']);
      $newPass = htmlspecialchars($_POST['new_password']);
      $confNewPass = htmlspecialchars($_POST['confirm_new_password']);

      $error = null;
      $oldPassword = $model->getOldPassword($id);
      if (empty($currPass) || empty($newPass) || empty($confNewPass)) {
        $error = 'Bạn chưa nhập đầy đủ thông tin các trường. Vui lòng nhập hết tất cả các trường.';
      }
      if (!password_verify($currPass, $oldPassword['Password'])) {
        $error = 'Bạn nhập chưa đúng password hiện tại của bản thân. Vui lòng nhập lại.';
      }

      if ($newPass != $confNewPass) {
        $error = 'Bạn nhập xác nhận password mới đã sai. Vui lòng nhập lại.';
      }

      if (isset($error)) {
        $_SESSION["error_message"] = $error;
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
      }
      $code = rand(100000, 999999);
      $user = $model->findUserById($id);
      $userName = $user['FirstName'] . " " . $user["Lastname"];
      $userEmail = $user['Email'];
      $_SESSION['verify_code'] = $code;
      $_SESSION['verify_code_time'] = time();
      $_SESSION['new_password'] = $newPass;
      $this->sendMail(
        $userEmail,
        $userName,
        "Xác nhận thay đổi mật khẩu",
        "
        <div style='font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; color: #333;'>
          <div style='max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);'>
            <h2 style='color: #FF6F00;'>Xin chào {$userName},</h2>
            <p>Bạn đã yêu cầu thay đổi mật khẩu cho tài khoản tại hệ thống của chúng tôi.</p>
            <p>Để xác nhận hành động này, vui lòng nhập mã xác nhận dưới đây trong vòng <strong>10 phút</strong>:</p>
      
            <div style='margin: 20px 0; padding: 15px; font-size: 24px; background: #FFF3E0; color: #FF6F00; font-weight: bold; letter-spacing: 4px; border-radius: 6px;'>
              {$code}
            </div>
      
            <p>Nếu bạn không thực hiện yêu cầu này, vui lòng bỏ qua email này. Mật khẩu của bạn sẽ không thay đổi nếu mã xác nhận không được nhập.</p>
      
            <hr style='margin: 30px 0;'>
            <p style='font-size: 14px; color: #888;'>Trân trọng,<br><strong>Đội ngũ hỗ trợ kỹ thuật</strong></p>
          </div>
        </div>
        "
      );

      header("Location: verify");
    }
  }
  public function verifyCode()
  {
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
      $this->checkAuthClient();
      $model = $this->model("UserModel");
      if (!isset($_SESSION['userId'], $_SESSION['verify_code'], $_SESSION['verify_code_time'], $_SESSION['new_password'])) {
        $_SESSION['error_message'] = "Phiên làm việc đã hết hạn. Vui lòng thử lại.";
        header("Location: index");
        exit;
      }
      $id = $_SESSION['userId'];
      $codeInput = htmlspecialchars($_POST["code"]);
      $codeCheck = $_SESSION['verify_code'];
      $codeTime = $_SESSION['verify_code_time'];
      $newPass = $_SESSION['new_password'];
      $currTime = time();
      if ($currTime - $codeTime > 600) {
        $_SESSION['error_message'] = "Mã xác nhận đã hết hạn. Vui lòng yêu cầu mã mới.";
        unset($_SESSION['verify_code']);
        unset($_SESSION['verify_code_time']);
        unset($_SESSION['new_password']);
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
      }
      if ($codeInput != $codeCheck) {
        $_SESSION['error_message'] = "Mã xác nhận sai. Vui lòng nhập lại";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
      }
      $options = [
        'cost' => 12
      ];
      $result = $model->changePassword($id, password_hash($newPass, PASSWORD_BCRYPT, $options));
      if ($result) {
        $_SESSION["success_message"] = "Thay đổi mật khẩu thành công";
        unset($_SESSION['new_password']);
        unset($_SESSION['verify_code']);
        unset($_SESSION['verify_code_time']);
        unset($_SESSION['userId']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_cart']);
        setcookie('remember', "", time() - 3600, "/");
        header('Location: ../home/index');
      } else {
        $_SESSION["error_message"] = "Thay đổi mật khẩu không thành công";
        header("Location: " . $_SERVER['HTTP_REFERER']);
      }
    }
  }
}
