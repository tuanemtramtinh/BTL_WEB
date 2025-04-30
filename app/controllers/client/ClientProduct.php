<?php

// TRANG SẢN PHẨM

class ClientProduct extends Controller
{
  public function index()
  {
    $brand = $_GET['brand'] ?? '';
    $category = $_GET['category'] ?? '';
    $sort = $_GET['sort'] ?? '';

    $Product = $this->model("ProductModel");
    $Brand = $this->model("BrandModel");
    $Category = $this->model("CategoryModel");

    $categoryID = '';
    if ($category !== '') {
      $existCategory = $Category->findCategoryBySlug($category);
      $categoryID = $existCategory['ID'];
    }

    $brands = $Brand->getBrandList();
    $categories = $Category->getCategoryList();

    $limit = $_GET['limit'] ?? 12;
    $page = $_GET['page'] ?? 1;
    $skip = ($page - 1) * $limit;
    $totalPages = ceil($Product->countProduct($categoryID, $brand) / $limit);
    if ($totalPages < 1) {
      $page = 0;
    }

    $products = $Product->getProductListClient($category, $brand, $skip, $limit, $sort);

    $Product->closeConnection();
    $Brand->closeConnection();
    $Category->closeConnection();

    $this->view("layout", [
      "title" => "Sản Phẩm",
      "page" => "product/index",
      "task" => 3,
      "products" => $products,
      "brands" => $brands,
      "brand" => $brand,
      "category" => $category,
      "categories" => $categories,
      "sort" => $sort,
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
    $products = $Product->getProductListClient('', '', 0, 8, '');
    $products = array_filter($products, function ($item) use ($productSlug) {
      return $item['Slug'] !== $productSlug;
    });

    $Product->closeConnection();

    $message = $this->getSessionMessage();
    $this->view("layout", [
      "title" => "Chi Tiết Sản Phẩm",
      "page" => "product/detail",
      "task" => 3,
      "success" => $message['success'],
      "error" => $message['error'],
      "product" => $product,
      "products" => $products,
    ]);
  }
}
