<?php

// TRANG GIỚI THIỆU

class ClientAbout extends Controller
{
  public function index()
  {
    $MemModel = $this->model("MemModel");
    $AboutSection = $this->model("AboutModel");
    $member = $MemModel->getAllMem();
    $title = $AboutSection->getTitleSection();
    $story = $AboutSection->getStorySection();
    $showcase = $AboutSection->getShowcaseSection();
    $unique = $AboutSection->getUniqueSection();
    $invite = $AboutSection->getInviteSection();
    $this->view("layout", [
      "title" => "Giới Thiệu",
      "page" => "about/index",
      "task" => 2,
      "member" => $member,
      "titleSection" => $title,
      "storySection" => $story,
      "showcaseSection" => $showcase,
      "uniqueSection" => $unique,
      "inviteSection" => $invite
    ]);
  }
}
