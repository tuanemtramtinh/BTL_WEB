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

  public function updateProductById($productId, $productName, $productCategory, $productBrand, $productDesc, $productPrice, $productQuantity, $productImage, $employeeId)
  {
    $existProduct = $this->findProductById($productId);

    if (
      $existProduct['Name'] == $productName &&
      $existProduct['ID_ProductCategory'] == $productCategory &&
      $existProduct['Brand'] == $productBrand &&
      $existProduct['Description'] == $productDesc &&
      $existProduct['PriceUnit'] == $productPrice &&
      $existProduct['Inventory'] == $productQuantity &&
      $existProduct['Image'] == $productImage
    ) {
      return;
    }

    $query = "UPDATE Product SET Name = ?, ID_ProductCategory = ?, Brand = ?, Description = ?, PriceUnit = ?, Inventory = ?, Image = ?, SocialNo = ? WHERE ID = ?";

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ssssiisss", $productName, $productCategory, $productBrand, $productDesc, $productPrice, $productQuantity, $productImage, $employeeId, $productId);
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
    $stmt->bind_param("s", $productName);
    $stmt->execute();

    $result = $stmt->get_result();
    $stmt = null;
    if ($result->num_rows > 0) {
      return $result->fetch_assoc();
    }
    return null;
  }

  public function findProductById($productId)
  {
    $query = "SELECT P.ID, P.PriceUnit, P.Inventory, P.`Name`, P.Description, P.Slug, P.Image, P.CreatedAt, P.UpdatedAt, P.Brand, PC.`Name` as CategoryName, P.ID_ProductCategory FROM Product as P INNER JOIN ProductCategory as PC ON P.ID_ProductCategory = PC.ID WHERE P.ID = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $productId);
    $stmt->execute();

    $result = $stmt->get_result();
    $stmt = null;
    if ($result->num_rows > 0) {
      return $result->fetch_assoc();
    }
    return null;
  }

  public function findProductBySlug($productSlug)
  {
    $query = "SELECT * FROM Product WHERE Slug = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("s", $productSlug);
    $stmt->execute();

    $result = $stmt->get_result();
    $stmt = null;
    if ($result->num_rows > 0) {
      return $result->fetch_assoc();
    }
    return null;
  }
}
