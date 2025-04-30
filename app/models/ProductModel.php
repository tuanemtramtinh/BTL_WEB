<?php

class ProductModel extends DB
{
  public function createProduct($productName, $productPrice, $productQuantity, $productDesc, $productImage, $productBrand, $productCategory, $employeeId)
  {
    $slugName = str_replace(['’', '‘', '“', '”'], ["'", "'", '"', '"'], $productName);
    $slugName = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $slugName);
    $slugName = strtolower($slugName);
    $slugName = preg_replace('/[^a-z0-9]+/', '-', $slugName);
    $slugName = trim($slugName, '-');


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
      return false;
    }

    $query = "UPDATE Product SET Name = ?, ID_ProductCategory = ?, Brand = ?, Description = ?, PriceUnit = ?, Inventory = ?, Image = ?, SocialNo = ? WHERE ID = ?";

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ssssiisss", $productName, $productCategory, $productBrand, $productDesc, $productPrice, $productQuantity, $productImage, $employeeId, $productId);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
  }

  public function updateProductQuantity($productId, $productQuantity)
  {
    $query = "UPDATE Product SET Inventory = ? WHERE ID = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ii", $productQuantity, $productId);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
  }

  public function deleteProductById($productId)
  {
    $query = "DELETE FROM Product WHERE ID = ?";

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $productId);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
  }

  public function countProduct($category = '', $brand = '')
  {
    // $query = "SELECT COUNT(*) AS total FROM Product ";
    // $stmt = $this->conn->prepare($query);
    // $stmt->execute();
    // $result = $stmt->get_result();
    // $row = $result->fetch_assoc();
    // $total = $row['total'];
    // $stmt->close();

    // return $total;

    $query = "SELECT COUNT(*) AS total FROM Product WHERE 1";
    $params = [];
    $types = '';

    if (!empty($category)) {
      $query .= " AND ID_ProductCategory = ?";
      $params[] = $category;
      $types .= 's';
    }

    if (!empty($brand)) {
      $query .= " AND Brand = ?";
      $params[] = $brand;
      $types .= 's';
    }

    $stmt = $this->conn->prepare($query);

    if (!empty($params)) {
      $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $total = $row['total'];

    $stmt->close();

    return $total;
  }

  public function getProductList($skip = 0, $limit = 2147483647)
  {
    $query = "
    SELECT
      Product.ID,
      Image,
      Product.`Name`,
      PriceUnit,
      Product.CreatedAt,
      Product.UpdatedAt,
      Employee.Username,
      Product.Slug,
      Brand.`Name` AS Brand,
      ProductCategory.`Name` AS Category,
      Product.ID_ProductCategory AS CategoryID 
    FROM
      Product
      INNER JOIN Employee ON Product.SocialNo = Employee.SocialNo
      INNER JOIN ProductCategory ON Product.ID_ProductCategory = ProductCategory.ID
      INNER JOIN Brand ON Product.Brand = Brand.`Name` 
    ORDER BY
      ID ASC 
      LIMIT ?,
      ?
    ";

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ii", $skip, $limit);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = [];
    while ($row = $result->fetch_assoc()) {
      $products[] = $row;
    }
    $stmt->close();
    return !empty($products) ? $products : null;
  }

  public function getProductListClient($category = '', $brand = '', $skip = 0, $limit = 2147483647, $sort = 'a-to-z')
  {
    if ($sort === 'a-to-z' || $sort === '') {
      $orderBy = 'Product.Name ASC';
    } elseif ($sort === 'z-to-a') {
      $orderBy = 'Product.Name DESC';
    } elseif ($sort === 'price-inc') {
      $orderBy = 'Product.PriceUnit ASC';
    } elseif ($sort === 'price-desc') {
      $orderBy = 'Product.PriceUnit DESC';
    } else {
      $orderBy = 'Product.ID ASC';
    }

    $query = "
    SELECT
      Product.ID,
      Image,
      Product.`Name`,
      PriceUnit,
      Product.CreatedAt,
      Product.UpdatedAt,
      Employee.Username,
      Product.Slug,
      Brand.`Name` AS Brand,
      ProductCategory.`Name` AS Category,
      ProductCategory.Slug AS CategorySlug,
      Product.ID_ProductCategory AS CategoryID 
    FROM
      Product
      INNER JOIN Employee ON Product.SocialNo = Employee.SocialNo
      INNER JOIN ProductCategory ON Product.ID_ProductCategory = ProductCategory.ID
      INNER JOIN Brand ON Product.Brand = Brand.`Name`
    WHERE
      (? = '' OR ProductCategory.Slug = ?)
      AND (? = '' OR Product.Brand = ?)
    ORDER BY
      $orderBy
    LIMIT ?, ?
    ";

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ssssii", $category, $category, $brand, $brand, $skip, $limit);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = [];
    while ($row = $result->fetch_assoc()) {
      $products[] = $row;
    }
    $stmt->close();
    return !empty($products) ? $products : null;
  }

  public function findProductByKeyword($keyword)
  {
    $keyword = trim($keyword);
    $keyword = strtolower(str_replace(' ', '-', $keyword));
    $keyword = "%$keyword%";
    $query = "SELECT * FROM Product WHERE Name LIKE ? OR Slug LIKE ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ss", $keyword, $keyword);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt = null;
    if ($result->num_rows > 0) {
      $products = [];
      while ($row = $result->fetch_assoc()) {
        $products[] = $row;
      }
      return $products;
    }
    return null;
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
    $query = "SELECT P.ID, P.PriceUnit, P.Inventory, P.`Name`, P.Description, P.Slug, P.Image, P.CreatedAt, P.UpdatedAt, P.Brand, PC.`Name` as CategoryName, PC.Slug as CategorySlug, P.ID_ProductCategory FROM Product as P INNER JOIN ProductCategory as PC ON P.ID_ProductCategory = PC.ID WHERE P.ID = ?";
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
    $query = "SELECT P.ID, P.PriceUnit, P.Inventory, P.`Name`, P.Description, P.Slug, P.Image, P.CreatedAt, P.UpdatedAt, P.Brand, PC.`Name` as CategoryName, PC.Slug as CategorySlug, P.ID_ProductCategory FROM Product as P INNER JOIN ProductCategory as PC ON P.ID_ProductCategory = PC.ID WHERE P.Slug = ?";
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
