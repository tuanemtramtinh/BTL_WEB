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

    $User = $this->model("UserModel");
    $existUser = $User->findUserOrderInfoById($_SESSION['userId']);

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
      "userInfo" => $existUser,
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

    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];

    $Product = $this->model("ProductModel");

    $Order = $this->model("OrderModel");
    $OrderItem = $this->model("OrderItemModel");

    $CartItem = $this->model("CartItemModel");
    $Cart = $this->model("CartModel");

    $cart = $Cart->findCartByUserId($_SESSION['userId']);
    $items = $CartItem->getCartListByCartId($_SESSION['user_cart']);
    $order = $Order->createOrder($_SESSION['userId'], $cart['Total'], $fullname, $phone, $address, $email);

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

    header("Location: ../../order/success/" . $order);
  }

  public function success($orderId = '')
  {
    if ($orderId === '') {
      $_SESSION['error_message'] = 'Invalid Order';
      header('Location: ../../cart/index');
      exit;
    }

    $Order = $this->model("OrderModel");
    $OrderItem = $this->model("OrderItemModel");

    $items = $OrderItem->getOrderListByOrderId($orderId);
    $order = $Order->findOrderById($orderId);

    $message = $this->getSessionMessage();
    $this->view("layout", [
      "title" => "Giỏ Hàng",
      "page" => "order/success",
      "task" => 3,
      "success" => $message['success'],
      "error" => $message['error'],
      "items" => $items,
      "order" => $order
    ]);
  }

  public function history($orderId = '')
  {
    $this->checkAuthClient();

    if ($orderId === '') {
      // echo "hello";
      $_SESSION['error_message'] = 'Invalid Order';
      header('Location: ../../user/index');
      exit;
    }

    $Order = $this->model("OrderModel");
    $OrderItem = $this->model("OrderItemModel");

    $order = $Order->findOrderById($orderId);
    $items = $OrderItem->getOrderListByOrderId($orderId);

    // print_r($order);

    $message = $this->getSessionMessage();
    $this->view("layout", [
      "title" => "Chi tiết đơn hàng",
      "page" => "order/history",
      "task" => 3,
      "success" => $message['success'],
      "error" => $message['error'],
      "order" => $order,
      "items" => $items
    ]);
  }
}
