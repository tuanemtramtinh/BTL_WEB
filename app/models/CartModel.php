<?php

class CartModel extends DB
{
  public function createCart($userId)
  {
    $query = "INSERT INTO Cart (ID_Customer) VALUES (?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
  }

  public function resetCart($userId)
  {
    $query = "UPDATE Cart SET Total = 0 WHERE ID_Customer = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
  }

  public function findCartByUserId($userId)
  {
    $query = "SELECT * FROM Cart WHERE ID_Customer = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
      return $result->fetch_assoc();
    }
    return null;
  }

  // public function findCartById

  public function updateCartTotal($cartId, $total)
  {
    $query = "UPDATE Cart SET Total = ? WHERE ID = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ii", $total, $cartId);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
  }
}
