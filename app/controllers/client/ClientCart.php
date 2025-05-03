<?php

// TRANG GIỎ HÀNG

class ClientCart extends Controller
{
  public function index()
  {
    $this->checkAuthClient();
    $CartItem = $this->model("CartItemModel");
    $Cart = $this->model("CartModel");

    $cart = $Cart->findCartByUserId($_SESSION['userId']);
    $items = $CartItem->getCartListByCartId($_SESSION['user_cart']);

    $message = $this->getSessionMessage();
    $this->view("layout", [
      "title" => "Giỏ Hàng",
      "page" => "cart/index",
      "task" => 3,
      "success" => $message['success'],
      "error" => $message['error'],
      "cart" => $cart,
      "items" => $items
    ]);
  }

  public function add($productId = '')
  {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

      header('Content-Type: application/json');
      http_response_code(200);

      if (!isset($_SESSION['userId'])) {
        http_response_code(400);
        echo json_encode([
          "status" => "fail",
          "msg" => "Please login to add item to cart"
        ]);
        exit;
      }

      if ($productId === '') {
        http_response_code(400);
        echo json_encode([
          "status" => "fail",
          "msg" => "Invalid Product Id"
        ]);
        exit;
      }

      $productQuantity = $_GET['quantity'];

      $Product = $this->model("ProductModel");
      $CartItem = $this->model("CartItemModel");
      $Cart = $this->model("CartModel");

      $currentProduct = $Product->findProductById($productId);
      $currentCart = $Cart->findCartByUserId($_SESSION['userId']);

      $newTotal = $currentCart['Total'] + ($productQuantity * $currentProduct['PriceUnit']);
      $newQuantity = $currentProduct['Inventory'] - $productQuantity;

      if ($newQuantity < 0) {
        http_response_code(500);
        echo json_encode([
          "status" => "fail",
          "msg" => "Not enough item to add to cart"
        ]);
        exit;
      }

      $CartItem->addItemToCart($_SESSION['user_cart'], $productId, $productQuantity);
      $Cart->updateCartTotal($currentCart['ID'], $newTotal);

      $Product->closeConnection();
      $CartItem->closeConnection();
      $Cart->closeConnection();


      echo json_encode([
        "status" => "success",
        "msg" => "Add to cart successfully"
      ]);
      exit;
      // $_SESSION['success_message'] = 'Add to cart successfully';
      // header("Location: ../../product/detail/" . $currentProduct['Slug']);
    }
  }

  public function addCart($productId = '')
  {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

      $this->checkAuthClient();

      $productQuantity = $_GET['quantity'];

      $Product = $this->model("ProductModel");
      $CartItem = $this->model("CartItemModel");
      $Cart = $this->model("CartModel");

      $currentProduct = $Product->findProductById($productId);
      $currentCart = $Cart->findCartByUserId($_SESSION['userId']);

      $newTotal = $currentCart['Total'] + $productQuantity * $currentProduct['PriceUnit'];
      $newQuantity = $currentProduct['Inventory'] - $productQuantity;

      $CartItem->addItemToCart($_SESSION['user_cart'], $productId, $productQuantity);

      $currentCartItem = $CartItem->findCartItemByProductIdAndCartId($productId, $_SESSION['user_cart']);
      if ($currentCartItem['Quantity'] < 1) {
        $CartItem->deleteCartItem($productId, $_SESSION['user_cart']);
      }

      $Cart->updateCartTotal($currentCart['ID'], $newTotal);

      $Product->closeConnection();
      $CartItem->closeConnection();
      $Cart->closeConnection();

      $_SESSION['success_message'] = 'Update cart successfully';
      header("Location: ../cart/index");

      // if (isset($inCart)) {

      // } else {
      //   $_SESSION['success_message'] = 'Add to cart successfully';
      //   header("Location: ../../product/detail/" . $currentProduct['Slug']);
      // }
    }
  }
}
