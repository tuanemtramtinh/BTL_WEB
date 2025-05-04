<?php
class AdminHome extends Controller
{
  public function index()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $model = $this->model("HomeModel");
    $intro1 = $model->getIntro(1);
    $intro2 = $model->getIntro(2);
    $intro3 = $model->getIntro(3);

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Home",
      "page" => "home/index",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 1,
      "data" => [
        "intro1_title" => $intro1['title'] ?? '',
        "intro1_content" => $intro1['content'] ?? '',
        "intro2_title" => $intro2['title'] ?? '',
        "intro2_content" => $intro2['content'] ?? '',
        "sale_title" => $intro3['title'] ?? '',
        "sale_content" => $intro3['content'] ?? '',
        "saleoff" => $intro3['saleoff'] ?? ''
      ]
    ]);
  }

  public function logoUpdate()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // $imageLink = $_FILES['imageLogo'] ?? '';
      print_r($_FILES['imageLogo']);
      echo count($_FILES['imageLogo']['name']);
      $logoImage = $this->uploadImages($_FILES['imageLogo'], '../index');
  
      $model = $this->model("GeneralModel");
      $model->updateLogo($logoImage[0]);
      $_SESSION['success_message'] = "Cập nhật logo thành công.";
      header("Location: index");
      exit;
    }
  }

  public function section2()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $title = $_POST['intro1_title'] ?? '';
      $content = $_POST['intro1_content'] ?? '';
      $model = $this->model("HomeModel");
      $model->updateIntro(1, $title, $content);
      $_SESSION['success_message'] = "Cập nhật giới thiệu 1 thành công.";
      header("Location: " . BASE_URL . "/admin/home");
      exit;
    }
  }

  public function section3()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $title = $_POST['intro2_title'] ?? '';
      $content = $_POST['intro2_content'] ?? '';
      $model = $this->model("HomeModel");
      $model->updateIntro(2, $title, $content);
      $_SESSION['success_message'] = "Cập nhật giới thiệu 2 thành công.";
      header("Location: " . BASE_URL . "/admin/home");
      exit;
    }
  }

  public function section4()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $title = $_POST['sale_title'] ?? '';
      $content = $_POST['sale_content'] ?? '';
      $saleoff = $_POST['saleoff'] ?? '';

      $model = $this->model("HomeModel");
      $model->updateIntroWithSaleoff(3, $title, $content, $saleoff); // section 3: dùng cho sale
      $_SESSION['success_message'] = "Cập nhật thông tin giảm giá thành công.";
      header("Location: " . BASE_URL . "/admin/home");
      exit;
    }
  }
}
