<?php

class AdminAuth extends Controller
{
  public function index()
  {
    $this->login();
  }

  public function login()
  {
    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "page" => "auth/login",
      "title" => "Login",
      "error" => $message['error'],
      "success" => $message['success']
    ]);
  }

  public function logout()
  {
    session_start();
    unset($_SESSION['employeeId']);
    unset($_SESSION['employee_username']);
    setcookie('remember-admin', "", time() - 3600, "/");
    // session_unset();
    // session_destroy();
    $_SESSION['success_message'] = 'Logout successfully';
    header('Location: login');
  }

  public function loginPost()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $remember = isset($_POST['remember']) ? true : false;

      $Employee = $this->model("EmployeeModel");

      //ERROR HANDLERS

      $error = null;

      //Check empty
      if (empty($username) || empty($password)) {
        $error = 'Fail to login: Please fill in all fields!';
      }

      //Check if user is exist
      $existEmployee = $Employee->findEmployeeByUsername($username);
      if (!isset($existEmployee)) {
        $error = 'Fail to login: User is not exist!';
      }

      if (!password_verify($password, $existEmployee['Password'])) {
        $error = 'Fail to login: Wrong password!';
      }

      if (isset($error)) {
        $_SESSION["error_message"] = $error;
        $Employee->closeConnection();
        header("Location: login");
        exit;
      }

      $_SESSION['employeeId'] = $existEmployee['SocialNo'];
      $_SESSION['employee_username'] = htmlspecialchars($existEmployee['Username']);

      // Set "remember me" cookie if checked
      if ($remember) {
        setcookie('remember-admin', $existEmployee['SocialNo'], time() + (86400 * 30), "/"); // 30 days
      }

      $Employee->closeConnection();
      $_SESSION['success_message'] = 'Login Successfully';

      header('Location: ../dashboard/index');
    }
  }
}
