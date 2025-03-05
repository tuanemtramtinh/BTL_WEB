<?php

class AdminUser extends Controller {
  public function index(){
    $this->viewAdmin("layout", [
      "title" => "User",
      "page" => "user/index"
    ]);
  }
}