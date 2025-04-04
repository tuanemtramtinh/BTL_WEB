<?php

// TRANG GIỎ HÀNG

class ClientCart extends Controller
{
  public function index()
  {
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

      if ($productId === '') {
        header('Location: ../detail');
        $_SESSION['error_message'] = 'Invalid Product';
        exit;
      }

      $productQuantity = $_GET['quantity'];
      $inCart = $_GET['inCart'];

      $Product = $this->model("ProductModel");
      $CartItem = $this->model("CartItemModel");
      $Cart = $this->model("CartModel");

      $currentProduct = $Product->findProductById($productId);
      $currentCart = $Cart->findCartByUserId($_SESSION['userId']);

      $newTotal = $currentCart['Total'] + ($productQuantity * $currentProduct['PriceUnit']);
      $newQuantity = $currentProduct['Inventory'] - $productQuantity;

      if ($newQuantity < 0) {
        $_SESSION['error_message'] = 'Not enough item to add to cart';
        header("Location: ../../product/detail/" . $currentProduct['Slug']);
        exit;
      }

      $CartItem->addItemToCart($_SESSION['user_cart'], $productId, $productQuantity);
      $Cart->updateCartTotal($currentCart['ID'], $newTotal);

      $Product->closeConnection();
      $CartItem->closeConnection();
      $Cart->closeConnection();

      if (isset($inCart)) {
        $_SESSION['success_message'] = 'Update cart successfully';
        header("Location: ../cart/index");
      } else {
        $_SESSION['success_message'] = 'Add to cart successfully';
        header("Location: ../../product/detail/" . $currentProduct['Slug']);
      }
    }
  }
}
