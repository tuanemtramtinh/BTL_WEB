<?php

class CategoryModel extends DB
{
  public function createCategory($categoryName, $employeeId)
  {
    $slugName = strtolower(str_replace(' ', '-', $categoryName));

    $query = "INSERT INTO ProductCategory(Name, Slug, SocialNo) VALUES (?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("sss", $categoryName, $slugName, $employeeId);
    $result = $stmt->execute();

    $stmt->close();
    return $result;
  }

  public function getCategoryList()
  {
    $query = "SELECT ProductCategory.ID, ProductCategory.Name, ProductCategory.CreatedAt, ProductCategory.UpdatedAt, Employee.Username FROM ProductCategory INNER JOIN Employee WHERE ProductCategory.SocialNo = Employee.SocialNo ORDER BY ProductCategory.ID ASC";
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

  public function updateCategoryById($categoryId, $categoryName, $employeeId)
  {
    $existCategory = $this->findCategoryById($categoryId);

    if ($existCategory['Name'] == $categoryName) {
      return false;
    }

    $slug = strtolower(str_replace(' ', '-', $categoryName));

    $query = "UPDATE ProductCategory SET Name = ?, Slug = ?, SocialNo = ? WHERE ID = ?";

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("sssi", $categoryName, $slug, $employeeId, $categoryId);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
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

  public function findCategoryById($categoryId)
  {
    $query = "SELECT * FROM ProductCategory WHERE ID = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("s", $categoryId);
    $stmt->execute();

    $result = $stmt->get_result();
    $stmt = null;
    if ($result->num_rows > 0) {
      return $result->fetch_assoc();
    }
    return null;
  }
}
