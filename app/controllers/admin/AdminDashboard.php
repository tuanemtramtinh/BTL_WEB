<?php
class AdminDashboard extends Controller
{
  public function index()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $Employee = $this->model("EmployeeModel");
    $employee = $Employee->findEmployeeById($_SESSION['employeeId']);
    $Employee->closeConnection();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Dashboard",
      "page" => "dashboard/index",
      "error" => $message['error'],
      "success" => $message['success'],
      "employee" => $employee,
    ]);
  }
}
