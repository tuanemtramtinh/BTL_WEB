<?php

class AdminDashboard extends Controller{
  public function index(){
    $this->viewAdmin("layout", [
      "title" => "Dashboard",
      "page" => "dashboard/index"
    ]);
    // echo "Admin Dashboard Page";
  }
}