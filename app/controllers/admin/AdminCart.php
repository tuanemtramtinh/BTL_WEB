<?php

class AdminCart extends Controller
{
  public function index()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $Cart = $this->model("CartModel");

    $carts = $Cart->getCartList();

    $Cart->closeConnection();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Cart",
      "page" => "cart/index",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 3,
      "carts" => $carts
    ]);
  }

  public function detail($cartId = "")
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    if ($cartId === '') {
      $_SESSION['error_message'] = "Invalid Cart";
      header("Location: ../index");
      exit;
    }

    $Cart = $this->model("CartModel");
    $CartItem = $this->model("CartItemModel");

    $cart = $Cart->findCartById($cartId);
    $items = $CartItem->getCartListByCartId($cartId);

    $Cart->closeConnection();
    $CartItem->closeConnection();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Cart",
      "page" => "cart/detail",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 3,
      "cart" => $cart,
      "items" => $items
    ]);
  }

  public function edit($cartId = "")
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    if ($cartId === '') {
      $_SESSION['error_message'] = "Invalid Cart";
      header("Location: ../index");
      exit;
    }

    $Cart = $this->model("CartModel");
    $CartItem = $this->model("CartItemModel");

    $cart = $Cart->findCartById($cartId);
    $items = $CartItem->getCartListByCartId($cartId);

    $Cart->closeConnection();
    $CartItem->closeConnection();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Cart",
      "page" => "cart/edit",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 3,
      "cart" => $cart,
      "items" => $items
    ]);
  }

  public function delete()
  {
    $productId = $_GET['productId'];
    $cartId = $_GET['cartId'];

    $CartItem = $this->model("CartItemModel");

    $CartItem->deleteCartItem($productId, $cartId);
    $CartItem->closeConnection();
    $_SESSION['success_message'] = 'Delete Product Successfully';
    header("Location: edit/" . $cartId);
  }

  public function updateQuantity($productId = "")
  {
    header('Content-Type: application/json');

    if ($productId === '') {
      $_SESSION['error_message'] = 'Invalid Product';
      echo json_encode([
        "status" => "error",
        "message" => "Invalid Product"
      ]);
      exit;
    }

    $productQuantity = $_GET['quantity'];
    $cartId = $_GET['cartId'];

    $Product = $this->model("ProductModel");
    $CartItem = $this->model("CartItemModel");
    $Cart = $this->model("CartModel");

    $currentProduct = $Product->findProductById($productId);
    $currentCart = $Cart->findCartById($cartId);

    $newTotal = $currentCart['Total'] + ($productQuantity * $currentProduct['PriceUnit']);
    $newQuantity = $currentProduct['Inventory'] - $productQuantity;

    if ($newQuantity < 0) {
      $_SESSION['error_message'] = 'Not enough item to add to cart';
      echo json_encode([
        "status" => "error",
        "message" => "Not enough item to add to cart"
      ]);
      exit;
    }

    $CartItem->addItemToCart($cartId, $productId, $productQuantity);
    $Cart->updateCartTotal($currentCart['ID'], $newTotal);

    $Product->closeConnection();
    $CartItem->closeConnection();
    $Cart->closeConnection();

    $_SESSION['success_message'] = "Update quantity successfully";
    echo json_encode([
      "status" => "success",
      "message" => "Update quantity successfully"
    ]);
  }
}
