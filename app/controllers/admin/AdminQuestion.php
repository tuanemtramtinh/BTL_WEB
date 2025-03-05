<?php
class AdminQuestion extends Controller {
  public function index(){
    $this->viewAdmin("layout", [
      "title" => "Question",
      "page" => "question/index"
    ]);
  }
}