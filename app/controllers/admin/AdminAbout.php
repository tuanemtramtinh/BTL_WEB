<?php
class AdminAbout extends Controller
{
  public function index()
  {
    $this->viewAdmin("layout", [
      "title" => "About",
      "page" => "about/index"
    ]);
  }
}