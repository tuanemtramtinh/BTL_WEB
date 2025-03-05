<?php
class AdminHome extends Controller {
  public function index(){
    $this->viewAdmin("layout", [
      "title" => "Home",
      "page" => "home/index"
    ]);
  }
}