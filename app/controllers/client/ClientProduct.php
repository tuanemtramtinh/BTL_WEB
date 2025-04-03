<?php

// TRANG SẢN PHẨM

class ClientProduct extends Controller
{
  public function index()
  {

    $Product = $this->model("ProductModel");

    $products = $Product->getProductList();

    $Product->closeConnection();

    $this->view("layout", [
      "title" => "Sản Phẩm",
      "page" => "product/index",
      "task" => 3,
      "products" => $products
    ]);
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
