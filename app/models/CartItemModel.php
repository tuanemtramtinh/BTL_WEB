<?php

class CartItemModel extends DB
{
  public function getCartListByCartId($cartId)
  {
    $query = "SELECT P.ID as ProductID, P.`Name` as ProductName, P.Image as ProductImage, P.PriceUnit as ProductPrice, P.Slug as ProductSlug, CI.Quantity as ProductQuantity, (CI.Quantity * P.PriceUnit) AS Total FROM CartItem AS CI INNER JOIN Product P ON CI.ID_Product = P.ID WHERE CI.Cart = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('i', $cartId);
    $stmt->execute();

    $result = $stmt->get_result();
    $items = [];
    while ($row = $result->fetch_assoc()) {
      $items[] = $row;
    }
    $stmt->close();
    return !empty($items) ? $items : null;
  }

  public function addItemToCart($cartId, $productId, $quantity)
  {
    $existCartItem = $this->findCartItemByProductIdAndCartId($productId, $cartId);
    if (isset($existCartItem)) {
      $newQuantity = $existCartItem['Quantity'] + $quantity;
      $query = "UPDATE CartItem SET Quantity = ? WHERE ID_Product = ? AND Cart = ?";
      $stmt = $this->conn->prepare($query);
      $stmt->bind_param("iii", $newQuantity, $productId, $cartId);
      $result = $stmt->execute();
      $stmt->close();

      return $result;
    }

    $query = "INSERT INTO CartItem (Cart, ID_Product, Quantity) VALUES (?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("iii", $cartId, $productId, $quantity);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
  }

  public function deleteCartItem($productId, $cartId)
  {
    $query = "DELETE FROM CartItem WHERE ID_Product = ? AND Cart = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ii", $productId, $cartId);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
  }

  public function resetCartItem($cartId)
  {
    $query = "DELETE FROM CartItem WHERE Cart = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $cartId);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
  }

  public function findCartItemByProductIdAndCartId($productId, $cartId)
  {
    $query = "SELECT * FROM CartItem WHERE ID_Product = ? AND Cart = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ii", $productId, $cartId);
    $stmt->execute();

    $result = $stmt->get_result();
    $stmt->close();
    if ($result->num_rows > 0) {
      return $result->fetch_assoc();
    }
    return null;
  }
}
