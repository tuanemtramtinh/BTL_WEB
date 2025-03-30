<?php
class AdminDashboard extends Controller
{
  public function index()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Dashboard",
      "page" => "dashboard/index",
      "error" => $message['error'],
      "success" => $message['success']
    ]);
  }
}
