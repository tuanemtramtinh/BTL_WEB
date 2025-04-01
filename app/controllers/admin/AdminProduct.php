<?php

class AdminProduct extends Controller
{
  public function index()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Product",
      "page" => "product/index",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 3
    ]);
  }

  public function detail()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Product",
      "page" => "product/detail",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 3
    ]);
  }

  public function add()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Create Product",
      "page" => "product/add",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 3
    ]);
  }

  public function category()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Product Category",
      "page" => "product/category",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 3
    ]);
  }

  public function category_add()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Create Product Category",
      "page" => "product/category_add",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 3
    ]);
  }

  public function category_addPost()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      //Check if the employee is logged in
      $this->checkAuthAdmin();

      $name = $_POST['name'];
      $Category = $this->model("CategoryModel");

      //ERROR HANDLERS
      $error = null;

      if (empty($name)) {
        $error = 'Fail to create: Fill in all fields!';
      }

      //Check if the brand name is already taken
      $existCategory = $Category->findCategoryByName($name);
      if (isset($existCategory)) {
        $error = 'Fail to create: Category name already taken!';
      }

      if (isset($error)) {
        $_SESSION["error_message"] = $error;
        header("Location: brand");
        exit;
      }

      $Category->createCategory($name, $_SESSION['employeeId']);
      $Category->closeConnection();

      $_SESSION['success_message'] = 'Add Category successfully';
      header('Location: category');
    }
  }

  public function brand()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $Brand = $this->model("BrandModel");
    $brands = $Brand->getBrandList();
    $Brand->closeConnection();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Product Brand",
      "page" => "product/brand",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 3,
      "brands" => $brands
    ]);
  }

  public function brand_add()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Create Product Category",
      "page" => "product/brand_add",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 3
    ]);
  }

  public function brand_addPost()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      //Check if the employee is logged in
      $this->checkAuthAdmin();

      $name = $_POST['name'];

      $Brand = $this->model("BrandModel");

      //ERROR HANDLERS
      $error = null;

      if (empty($name)) {
        $error = 'Fail to create: Fill in all fields!';
      }

      //Check if the brand name is already taken
      $existBrand = $Brand->findBrandByName($name);
      if (isset($existBrand)) {
        $error = 'Fail to create: Brand name already taken!';
      }

      if (isset($error)) {
        $_SESSION["error_message"] = $error;
        header("Location: brand");
        exit;
      }

      $Brand->createBrand($name);
      $Brand->closeConnection();

      $_SESSION['success_message'] = 'Add Brand successfully';
      header('Location: brand');
    }
  }
}
