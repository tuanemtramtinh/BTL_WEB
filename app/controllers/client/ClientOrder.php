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


    $Order = $this->model("OrderModel");
    $OrderItem = $this->model("OrderItemModel");
    $CartItem = $this->model("CartItemModel");
    $Cart = $this->model("CartModel");

    $cart = $Cart->findCartByUserId($_SESSION['userId']);
    $items = $CartItem->getCartListByCartId($_SESSION['user_cart']);

    $order = $Order->createOrder($_SESSION['userId'], $cart['Total']);
    foreach ($items as $item) {
    }

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

  public function success() {}
}
