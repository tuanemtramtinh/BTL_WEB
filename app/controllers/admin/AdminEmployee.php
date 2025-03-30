<?php

class AdminEmployee extends Controller
{
  public function index()
  {
    if ($_SESSION['employeeId'] !== ADMIN_ID) {
      header('Location: dashboard/index');
      exit;
    }
    $message = $this->getSessionMessage();
    $Employee = $this->model("EmployeeModel");
    $users = $Employee->getEmployeeList();
    $this->viewAdmin("layout", [
      "title" => "Employee List",
      "page" => "employee/index",
      "users" => $users,
      "error" => $message['error'],
      "success" => $message['success'],
    ]);
  }

  public function create()
  {
    if ($_SESSION['employeeId'] !== ADMIN_ID) {
      header('Location: ../dashboard/index');
      exit;
    }
    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Create Employee",
      "page" => "employee/create",
      "error" => $message['error'],
      "success" => $message['success']
    ]);
  }

  public function createPost()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $socialNumber = $_POST['socialnum'];
      $firstName = $_POST['firstname'];
      $lastName = $_POST['lastname'];
      $mobilePhone = $_POST['phone'];
      $address = $_POST['address'];
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      $Employee = $this->model("EmployeeModel");

      //ERROR HANDLERS
      $error = null;

      //Check empty
      if (empty($socialNumber) || empty($firstName) || empty($lastName) || empty($mobilePhone) || empty($address) || empty($username) || empty($email) || empty($password)) {
        $error = 'Fail to create: Fill in all fields!';
      }

      //Check is email valid
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Fail to create: Invalid email!';
      }

      //Check if user is exist
      $existEmployee = $Employee->findEmployeeByEmail($email);
      if (isset($existEmployee)) {
        $error = 'Fail to register: Email is already registered!';
      }
      $existEmployee = $Employee->findEmployeeByUsername($username);
      if (isset($existEmployee)) {
        $error = 'Fail to register: Username is already registered!';
      }

      if (isset($error)) {
        $_SESSION["error_message"] = $error;
        header("Location: create");
        exit;
      }

      $Employee->createEmployee($socialNumber, $firstName, $lastName, $address, $mobilePhone, $username, $email, $password);
      $Employee->closeConnection();

      $_SESSION['success_message'] = 'Register successfully';
      header('Location: index');
    }
  }
}
