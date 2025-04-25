<?php

class AdminProduct extends Controller
{
  public function index()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $category = $_GET['category'] ?? '';
    $brand = $_GET['brand'] ?? '';

    $Product = $this->model("ProductModel");
    $products = $Product->getProductList();

    if ($category !== '') {
      $products = array_filter($products, function ($product) use ($category) {
        return $product['CategoryID'] == $category;
      });
    }

    if ($brand !== '') {
      $products = array_filter($products, function ($product) use ($brand) {
        return $product['Brand'] === $brand;
      });
    }

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Product",
      "page" => "product/index",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 3,
      "products" => $products
    ]);
  }

  public function detail($productId)
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $Product = $this->model("ProductModel");
    $product = $Product->findProductById($productId);

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Product",
      "page" => "product/detail",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 3,
      "product" => $product
    ]);
  }

  public function add()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $Category = $this->model("CategoryModel");
    $Brand = $this->model("BrandModel");

    $categories = $Category->getCategoryList();
    $brands = $Brand->getBrandList();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Create Product",
      "page" => "product/add",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 3,
      "categories" => $categories,
      "brands" => $brands
    ]);
  }

  public function addPost()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      //Check if the employee is logged in
      $this->checkAuthAdmin();

      $productImages = $this->uploadImages($_FILES['images'], 'add');
      $productImagesJson = json_encode($productImages, JSON_PRETTY_PRINT);

      $productName = $_POST['name'];
      $productCategory = $_POST['category'];
      $productBrand = $_POST['brand'];
      $productDesc = $_POST['description'];
      $productPrice = $_POST['price'];
      $productQuantity = $_POST['quantity'];

      $Product = $this->model("ProductModel");

      //ERROR HANDLERS
      $error = null;

      if (empty($productName) || empty($productCategory) || empty($productBrand) || empty($productDesc) || empty($productDesc) || empty($productPrice) || empty($productQuantity)) {
        $error = 'Fail to create: Fill in all fields!';
      }

      //Check if the brand name is already taken
      $existProduct = $Product->findProductByName($productName);
      if (isset($existProduct)) {
        $error = 'Fail to create: Product name already taken!';
      }

      if (isset($error)) {
        $_SESSION["error_message"] = $error;
        header("Location: add");
        exit;
      }

      $Product->createProduct($productName, $productPrice, $productQuantity, $productDesc, $productImagesJson, $productBrand, $productCategory, $_SESSION['employeeId']);
      $Product->closeConnection();
      $_SESSION['success_message'] = 'Add Product successfully';
      header('Location: index');
    }
  }

  public function edit($productId = '')
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();


    $Category = $this->model("CategoryModel");
    $Product = $this->model("ProductModel");
    $Brand = $this->model("BrandModel");

    $categories = $Category->getCategoryList();
    $product = $Product->findProductById($productId);
    $brands = $Brand->getBrandList();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Product Edit",
      "page" => "product/edit",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 3,
      "product" => $product,
      "categories" => $categories,
      "brands" => $brands
    ]);
  }
  public function editPost($productId = '')
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      //Check if the employee is logged in
      $this->checkAuthAdmin();

      if ($productId === '') {
        header("Location: ../index");
        $_SESSION["error_message"] = "Invalid Product ID";
        exit;
      }

      $productImageLinkJson = $_POST['imageLink'];
      $productImageLink = json_decode($productImageLinkJson);
      if (count($productImageLink) != count($_FILES['images']['name'])) {
        $productImages = $this->uploadImages($_FILES['images'], 'edit');
        $productImagesJson = json_encode($productImages, JSON_PRETTY_PRINT);
      } else {
        $isDifferent = false;
        foreach ($_FILES['images']['name'] as $index => $fileName) {
          $imageLinkFileName = basename($productImageLink[$index]);
          echo $imageLinkFileName, $fileName;
          if ($fileName !== $imageLinkFileName) {
            $isDifferent = true;
            break;
          }
        }
        if ($isDifferent) {
          $productImages = $this->uploadImages($_FILES['images'], 'edit');
          $productImagesJson = json_encode($productImages, JSON_PRETTY_PRINT);
        } else {
          $productImagesJson = $productImageLinkJson;
          // header('Location: ../edit/' . $productId);
          // $_SESSION["error_message"] = "No new fields to update";
          // exit;
        }
      }


      $productName = $_POST['name'];
      $productCategory = $_POST['category'];
      $productBrand = $_POST['brand'];
      $productDesc = $_POST['description'];
      $productPrice = $_POST['price'];
      $productQuantity = $_POST['quantity'];

      $Product = $this->model("ProductModel");

      //ERROR HANDLERS
      $error = null;

      if (empty($productName) || empty($productCategory) || empty($productBrand) || empty($productDesc) || empty($productDesc) || empty($productPrice) || empty($productQuantity)) {
        $error = 'Fail to create: Fill in all fields!';
      }

      if (isset($error)) {
        $_SESSION["error_message"] = $error;
        header("Location: add");
        exit;
      }

      $Product->updateProductById($productId, $productName, $productCategory, $productBrand, $productDesc, $productPrice, $productQuantity, $productImagesJson, $_SESSION['employeeId']);
      $Product->closeConnection();
      $_SESSION['success_message'] = 'Edit Product successfully';
      header('Location: ../index');
    }
  }

  public function delete($productId = '')
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $Product = $this->model("ProductModel");

    // $product = $Product->findProductById($productId);

    // $urlPattern = '/storage\/img_[a-zA-Z0-9]+(\.[a-zA-Z0-9]+)+/';
    // preg_match_all($urlPattern, $product['Description'], $matches);
    // $foundUrl = $matches[0];

    // $imageUrl = json_decode($product['Image']);

    // $urls = array_merge($imageUrl, $foundUrl);

    // foreach ($urls as $file) {
    //   unlink('./' . $file);
    // }

    $status = $Product->deleteProductById($productId);

    $Product->closeConnection();

    if ($status) {
      $_SESSION['success_message'] = 'Delete Product Successfully';
      header('Location: ../index');
      exit;
    }

    $_SESSION['error_message'] = 'Error on deleting Product';
    header('Location: ../index');
  }

  public function category()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $Category = $this->model("CategoryModel");
    $categories = $Category->getCategoryList();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Product Category",
      "page" => "product/category",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 3,
      "categories" => $categories
    ]);
  }

  public function category_detail($categoryId = '')
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    if ($categoryId === '') {
      header('Location: category');
      $_SESSION['error_message'] = 'Invalid category Id';
      exit;
    }

    $Category = $this->model("CategoryModel");
    $category = $Category->findCategoryById($categoryId);

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Product Category",
      "page" => "product/category_detail",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 3,
      "category" => $category
    ]);
  }

  public function category_edit($categoryId = '')
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    if ($categoryId === '') {
      header('Location: category');
      $_SESSION['error_message'] = 'Invalid category Id';
      exit;
    }

    $Category = $this->model("CategoryModel");
    $category = $Category->findCategoryById($categoryId);

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Product Category",
      "page" => "product/category_edit",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 3,
      "category" => $category
    ]);
  }

  public function category_editPost($categoryId = '')
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      //Check if the employee is logged in
      $this->checkAuthAdmin();

      if ($categoryId === '') {
        header('Location: category');
        $_SESSION['error_message'] = 'Invalid category Id';
        exit;
      }

      $categoryName = $_POST['name'];

      $Category = $this->model("CategoryModel");

      //ERROR HANDLERS
      $error = null;

      if (empty($categoryName)) {
        $error = 'Fail to create: Fill in all fields!';
      }

      if (isset($error)) {
        $_SESSION["error_message"] = $error;
        header("Location: add");
        exit;
      }

      $Category->updateCategoryById($categoryId, $categoryName, $_SESSION['employeeId']);
      $Category->closeConnection();
      $_SESSION['success_message'] = 'Edit Category successfully';
      header('Location: ../category');
    }
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
