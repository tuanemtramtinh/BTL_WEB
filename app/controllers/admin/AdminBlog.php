<?php
class AdminBlog extends Controller {
  public function index(){
    $this->viewAdmin("layout", [
      "title" => "Blog",
      "page" => "blog/index"
    ]);
  }
}