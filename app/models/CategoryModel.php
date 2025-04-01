<?php

class CategoryModel extends DB
{
  public function createCategory($categoryName, $employeeId)
  {
    $slugName = strtolower(str_replace(' ', '-', $categoryName));

    $query = "INSERT INTO ProductCategory(Name, Slug) VALUES (?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ss", $categoryName, $slugName);
    $result = $stmt->execute();

    $categoryId = $stmt->insert_id;
    $stmt->close();

    $query_1 = "INSERT INTO ProductCategory_History(ProductCategory_ID, SocialNo) VALUES (?, ?)";
    $stmt_1 = $this->conn->prepare($query_1);
    $stmt_1->bind_param("is", $categoryId, $employeeId);
    $result_1 = $stmt_1->execute();
    $stmt_1->close();
    return $result && $result_1;
  }

  public function getCategoryList()
  {
    $query = "SELECT * FROM ProductCategory";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    $result = $stmt->get_result();
    $categories = [];
    while ($row = $result->fetch_assoc()) {
      $categories[] = $row;
    }
    $stmt->close();
    return !empty($categories) ? $categories : null;
  }

  public function findCategoryByName($categoryName)
  {
    $query = "SELECT * FROM ProductCategory WHERE Name = ?";
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
