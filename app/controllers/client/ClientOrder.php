<?php

//TRANG ĐƠN HÀNG

class ClientOrder extends Controller
{
  public function index()
  {
    $this->checkAuthClient();

    $User = $this->model("UserModel");
    $existUser = $User->findUserOrderInfoById($_SESSION['userId']);

    $CartItem = $this->model("CartItemModel");
    $Cart = $this->model("CartModel");

    $cart = $Cart->findCartByUserId($_SESSION['userId']);
    $items = $CartItem->getCartListByCartId($_SESSION['user_cart']);

    if (empty($items)) {
      $_SESSION['error_message'] = 'Empty Cart!';
      header("Location: ../cart/index");
      $CartItem->closeConnection();
      $Cart->closeConnection();
      exit;
    }

    $total = 0;

    foreach ($items as $item) {
      $total += $item['ProductPrice'] * $item['ProductQuantity'];
    }

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
      "items" => $items,
      "total" => $total
    ]);
  }

  public function orderPost()
  {
    // if ($cartId === '') {
    //   $_SESSION['error_message'] = 'Invalid Cart';
    //   header("Location: ../../cart/index");
    //   exit;
    // }

    $fullname = $_POST['fullname'];
    $fullname = trim($fullname);
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $address = trim($address);
    $email = $_POST['email'];
    $email = trim($email);
    $total = $_POST['total'];

    if (empty($fullname) || empty($phone) || empty($address) || empty($email)) {
      $_SESSION['error_message'] = 'Please fill in all fields!';
      header("Location: ../order/index");
      exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $_SESSION['error_message'] = 'Email is invalid!';
      header("Location: ../order/index");
      exit;
    }

    if (!preg_match('/^[0-9]{10,11}$/', $phone)) {
      $_SESSION['error_message'] = 'Phone Number is Invalid!';
      header("Location: ../order/index");
      exit;
    }

    $Product = $this->model("ProductModel");

    $Order = $this->model("OrderModel");
    $OrderItem = $this->model("OrderItemModel");

    $CartItem = $this->model("CartItemModel");
    $Cart = $this->model("CartModel");

    $cart = $Cart->findCartByUserId($_SESSION['userId']);
    $items = $CartItem->getCartListByCartId($_SESSION['user_cart']);
    $order = $Order->createOrder($_SESSION['userId'], $total, $fullname, $phone, $address, $email);

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
    $this->checkAuthClient();

    if ($orderId === '') {
      $_SESSION['error_message'] = 'Invalid Order';
      header('Location: cart/index');
      exit;
    }

    $Order = $this->model("OrderModel");
    $OrderItem = $this->model("OrderItemModel");

    $items = $OrderItem->getOrderListByOrderId($orderId);
    $order = $Order->findOrderById($orderId);

    if (!isset($order)) {
      $_SESSION['error_message'] = 'Invalid Order';
      header('Location: ../../cart/index');
      $OrderItem->closeConnection();
      $Order->closeConnection();
      exit;
    }

    $OrderItem->closeConnection();
    $Order->closeConnection();

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
      header('Location: user/index');
      exit;
    }

    $Order = $this->model("OrderModel");
    $OrderItem = $this->model("OrderItemModel");

    $order = $Order->findOrderById($orderId);

    if (!isset($order)) {
      $_SESSION['error_message'] = 'Invalid Order';
      header('Location: ../../user');
      $OrderItem->closeConnection();
      $Order->closeConnection();
      exit;
    }

    $items = $OrderItem->getOrderListByOrderId($orderId);

    $OrderItem->closeConnection();
    $Order->closeConnection();

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
