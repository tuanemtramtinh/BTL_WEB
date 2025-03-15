<?php
class AdminBlog extends Controller
{
  public function index()
  {
    $this->viewAdmin("layout", [
      "title" => "Blog",
      "page" => "blog/index"
    ]);
  }

  public function detail()
  {
    $this->viewAdmin("layout", [
      "title" => "Chi Tiết Blog",
      "page" => "blog/detail"
    ]);
  }
}
