<?php

//TRANG ĐƠN HÀNG

class ClientOrder extends Controller
{
  public function index($cartId = '')
  {

    if ($cartId === '') {
      $_SESSION['error_message'] = 'Invalid Cart';
      header("Location: ../../cart/index");
      exit;
    }

    $CartItem = $this->model("CartItemModel");
    $Cart = $this->model("CartModel");

    $cart = $Cart->findCartByUserId($_SESSION['userId']);
    $items = $CartItem->getCartListByCartId($_SESSION['user_cart']);

    $CartItem->closeConnection();
    $Cart->closeConnection();

    $message = $this->getSessionMessage();
    $this->view("layout", [
      "title" => "Giỏ Hàng",
      "page" => "order/index",
      "task" => 3,
      "success" => $message['success'],
      "error" => $message['error'],
      "cart" => $cart,
      "items" => $items
    ]);
  }

  public function orderPost($cartId = '')
  {
    if ($cartId === '') {
      $_SESSION['error_message'] = 'Invalid Cart';
      header("Location: ../../cart/index");
      exit;
    }

    $Product = $this->model("ProductModel");

    $Order = $this->model("OrderModel");
    $OrderItem = $this->model("OrderItemModel");

    $CartItem = $this->model("CartItemModel");
    $Cart = $this->model("CartModel");

    $cart = $Cart->findCartByUserId($_SESSION['userId']);
    $items = $CartItem->getCartListByCartId($_SESSION['user_cart']);
    $order = $Order->createOrder($_SESSION['userId'], $cart['Total']);

    foreach ($items as $item) {
      $OrderItem->addItemToOrder($order, $item['ProductID'], $item['ProductQuantity'], $item['ProductName'], $item['ProductPrice'], $item['ProductImage']);

      $currentProduct = $Product->findProductById($item['ProductID']);
      $Product->updateProductQuantity($item['ProductID'], $currentProduct['Inventory'] - $item['ProductQuantity']);
    }

    $CartItem->resetCartItem($cart['ID']);
    $Cart->resetCart($_SESSION['userId']);

    $Cart->closeConnection();
    $CartItem->closeConnection();
    $Product->closeConnection();
    $Order->closeConnection();
    $OrderItem->closeConnection();

    
  }

  public function success() {}
}
