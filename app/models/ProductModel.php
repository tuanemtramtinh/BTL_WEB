<?php

class ProductModel extends DB
{
  public function createProduct($productName, $productPrice, $productQuantity, $productDesc, $productImage, $productBrand, $productCategory, $employeeId)
  {
    $slugName = strtolower(str_replace(' ', '-', $productName));

    $query = 'INSERT INTO Product(Name, PriceUnit, Inventory, Description, Slug, Image, Brand, ID_ProductCategory, SocialNo) VALUES (?,?,?,?,?,?,?,?,?)';
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("sisssssss", $productName, $productPrice, $productQuantity, $productDesc, $slugName, $productImage, $productBrand, $productCategory, $employeeId);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
  }

  public function getProductList()
  {
    $query = "SELECT ID, Image, Name, PriceUnit, CreatedAt, UpdatedAt, Employee.Username FROM Product INNER JOIN Employee ON Product.SocialNo = Employee.SocialNo";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = [];
    while ($row = $result->fetch_assoc()) {
      $products[] = $row;
    }
    $stmt->close();
    return !empty($products) ? $products : null;
  }

  public function findProductByName($productName)
  {
    $query = "SELECT * FROM Product WHERE Name = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("s", $categoryName);
    $stmt->execute();

    $result = $stmt->get_result();
    $stmt = null;
    if ($result->num_rows > 0) {
      return $result->fetch_assoc();
    }
    return null;
  }
}
