<?php
class AdminContact extends Controller {
  public function index(){
    $this->viewAdmin("layout", [
      "title" => "Contact",
      "page" => "contact/index"
    ]);
  }
}