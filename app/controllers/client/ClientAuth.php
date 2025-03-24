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
    $this->view("layout", [
      "title" => "Đăng Nhập",
      "page" => "auth/login"
    ]);
  }

  public function register()
  {
    // $errors = null;
    // if (isset($_SESSION['errors_signup'])) {
    //   $errors = $_SESSION['errors_signup'];

    //   unset($_SESSION['errors_signup']);
    // }
    // print_r($errors);
    $this->view("layout", [
      "title" => "Đăng Ký",
      "page" => "auth/register"
    ]);
  }

  public function loginPost()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // $username 
    }
  }

  public function registerPost()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $firstName = $_POST['firstname'];
      $lastName = $_POST['lastname'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      $User = $this->model("UserModel");

      //ERROR HANDLERS
      $errors = [];

      //Check empty
      if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
        $errors['empty_input'] = 'Fill in all fields!';
      }

      //Check is email valid
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['invalid_email'] = 'Invalid email used!';
      }

      //Check if user is exist
      $existUser = $User->findUserByEmail($email);
      if (isset($existUser)) {
        $errors['email_used'] = 'Email already registered!';
      } 

      if ($errors) {
        $_SESSION["errors_signup"] = $errors;
        header("Location: register");
        exit;
      }

      $User->createUser($firstName, $lastName, $email, $password);
      $User->closeConnection();

      echo 'SUCCESS';
    }
  }
}
