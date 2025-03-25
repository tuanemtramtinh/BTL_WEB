<?php

class AdminDashboard extends Controller
{
  public function index()
  {
    $message = $this->getSessionMessage();
    print_r($message);
    $this->viewAdmin("layout", [
      "title" => "Dashboard",
      "page" => "dashboard/index",
      "error" => $message['error'],
      "success" => $message['success']
    ]);
    // echo "Admin Dashboard Page";
  }
}
