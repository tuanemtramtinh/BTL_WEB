<?php

// TRANG ĐĂNG NHẬP/ĐĂNG KÝ

class ClientAuth extends Controller
{
  public function index()
  {
    $this->login();
  }

  public function login()
  {
    if (isset($_SESSION['userId'])) {
      header('Location: ../home/index');
      exit;
    }

    $message = $this->getSessionMessage();
    $this->view("layout", [
      "title" => "Đăng Nhập",
      "page" => "auth/login",
      "error" => $message['error'],
      "success" => $message['success']
    ]);
  }

  public function register()
  {
    if (isset($_SESSION['userId'])) {
      header('Location: ../home/index');
      exit;
    }

    $message = $this->getSessionMessage();

    $this->view("layout", [
      "title" => "Đăng Ký",
      "page" => "auth/register",
      "error" => $message['error'],
      "success" => $message['success']
    ]);
  }

  public function logout()
  {
    session_start();
    unset($_SESSION['userId']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_cart']);
    setcookie('remember', "", time() - 3600, "/");
    // session_unset();
    // session_destroy();
    $_SESSION['success_message'] = 'Logout successfully';
    header('Location: ../home/index');
  }

  public function loginPost()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = $_POST['email'];
      $password = $_POST['password'];
      $remember = isset($_POST['remember']) ? true : false;

      $User = $this->model("UserModel");
      $Cart = $this->model("CartModel");

      //ERROR HANDLERS

      $error = null;

      //Check empty
      if (empty($email) || empty($password)) {
        $error = 'Fail to login: Please fill in all fields!';
      }

      //Check if user is exist
      $existUser = $User->findUserByEmail($email);
      if (!isset($existUser)) {
        $error = 'Fail to login: User is not exist!';
      }

      if (!password_verify($password, $existUser['Password'])) {
        $error = 'Fail to login: Wrong password!';
      }

      if (isset($error)) {
        $_SESSION["errors_message"] = $error;
        $User->closeConnection();
        header("Location: login");
        exit;
      }

      $existCart = $Cart->findCartByUserId($existUser['ID']);

      // $newSessionId = session_create_id();
      // $sessionId = $newSessionId . '_' . $existUser['ID'];
      // session_id($sessionId);
      // $_SESSION['last_regeneration'] = time();

      $_SESSION['userId'] = $existUser['ID'];
      $_SESSION['user_email'] = htmlspecialchars($existUser['Email']);
      $_SESSION['user_cart'] = $existCart['ID'];

      // Set "remember me" cookie if checked
      if ($remember) {
        setcookie('remember', $existUser['ID'], time() + (86400 * 30), "/"); // 30 days
      }

      $User->closeConnection();
      $Cart->closeConnection();

      $_SESSION['success_message'] = 'Login Successfully';
      header('Location: ../home/index');
    } else {
    }
  }

  public function registerPost()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $firstName = $_POST['firstname'];
      $lastName = $_POST['lastname'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $address = $_POST['address'];
      $password = $_POST['password'];

      $User = $this->model("UserModel");
      $Cart = $this->model("CartModel");

      //ERROR HANDLERS
      $error = null;

      //Check empty
      if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($phone) || empty($address)) {
        $error = 'Fail to register: Fill in all fields!';
      }

      //Check is email valid
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Fail to register: Invalid email!';
      }

      //Check if user is exist
      $existUser = $User->findUserByEmail($email);
      if (isset($existUser)) {
        $error = 'Fail to register: Email is already registered!';
      }

      //Check if phone has length = 10
      if (!preg_match('/^\d{10}$/', $phone)) {
        $error = 'Fail to register: Phone Number is not valid!';
      }

      if (isset($error)) {
        $_SESSION["error_message"] = $error;
        header("Location: register");
        exit;
      }

      $userId = $User->createUser($firstName, $lastName, $email, $phone, $address, $password);
      $Cart->createCart($userId);

      $User->closeConnection();
      $Cart->closeConnection();

      $_SESSION['success_message'] = 'Register successfully';
      header('Location: login');
    } else {
    }
  }
}
