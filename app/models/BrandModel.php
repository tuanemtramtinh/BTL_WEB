<?php

class BrandModel extends DB
{
  public function createBrand($brandName)
  {
    $query = "INSERT INTO Brand(Name) VALUES (?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("s", $brandName);
    $result = $stmt->execute();
    $stmt = null;
    return $result;
  }

  public function getBrandList()
  {
    $query = "SELECT * FROM Brand";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    $result = $stmt->get_result();
    $brands = [];
    while ($row = $result->fetch_assoc()) {
      $brands[] = $row;
    }
    $stmt->close();
    return !empty($brands) ? $brands : null;
  }
  
  public function findBrandByName($brandName)
  {
    $query = "SELECT * FROM Brand WHERE Name = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("s", $brandName);
    $stmt->execute();

    $result = $stmt->get_result();
    $stmt = null;
    if ($result->num_rows > 0) {
      return $result->fetch_assoc();
    }
    return null;
  }
}
