<?php

// TRANG SẢN PHẨM

class ClientProduct extends Controller
{
  public function index()
  {

    $brand = $_GET['brand'] ?? '';
    $category = $_GET['category'] ?? '';

    $Product = $this->model("ProductModel");

    $limit = $_GET['limit'] ?? 12;
    $page = $_GET['page'] ?? 1;
    $skip = ($page - 1) * $limit;
    $totalPages = ceil($Product->countProduct() / $limit);

    $products = $Product->getProductListClient($category, $brand, $skip, $limit);
    $Product->closeConnection();

    $this->view("layout", [
      "title" => "Sản Phẩm",
      "page" => "product/index",
      "task" => 3,
      "products" => $products,
      "pages" => $totalPages,
      "currentPage" => $page
    ]);
  }

  public function search()
  {

    header("Content-Type: application/json");
    $keyword = $_GET['keyword'] ?? '';
    $Product = $this->model("ProductModel");
    $products = $Product->findProductByKeyword($keyword);
    $Product->closeConnection();
    if ($products) {
      echo json_encode($products);
    } else {
      echo json_encode([]);
    }
  }

  public function detail($productSlug = '')
  {
    if ($productSlug === '') {
      header("Location: index");
      exit;
    }

    $Product = $this->model("ProductModel");

    $product = $Product->findProductBySlug($productSlug);

    $Product->closeConnection();

    $message = $this->getSessionMessage();
    $this->view("layout", [
      "title" => "Chi Tiết Sản Phẩm",
      "page" => "product/detail",
      "task" => 3,
      "success" => $message['success'],
      "error" => $message['error'],
      "product" => $product
    ]);
  }
}
