<?php
class MemModel extends DB
{
    public function getAllMem()
    {
        $queries = "SELECT * FROM Employee_Front";
        $result = $this->conn->query($queries);
        return $result;
    }
    public function getMemByName($nameMem)
    {
        $queries = "SELECT * FROM Employee_Front WHERE Name LIKE ?";
        $stmt = $this->conn->prepare($queries);
        $pattern = "%" . $nameMem . "%";
        $stmt->bind_param("s", $pattern);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    public function getMemById($idMem)
    {
        $queries = "SELECT * FROM Employee_Front WHERE ID = ?";
        $stmt = $this->conn->prepare($queries);
        $stmt->bind_param("i", $idMem);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
    public function addMem($nameMem, $roleMem, $descMem, $imgMem)
    {
        $queries = "INSERT INTO Employee_Front (Name, Role, Description, Image, Page_name) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($queries);
        $pageName = "about";
        $stmt->bind_param("sssss", $nameMem, $roleMem, $descMem, $imgMem, $pageName);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    public function deleteMem($idMem)
    {
        $queries = "DELETE FROM Employee_Front WHERE ID = ?";
        $stmt = $this->conn->prepare($queries);
        $stmt->bind_param("i", $idMem);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    public function getOldAvatar($idMem)
    {
        $queries = "SELECT Image FROM Employee_Front WHERE ID = ?";
        $stmt = $this->conn->prepare($queries);
        $stmt->bind_param("i", $idMem);
        $stmt->execute();
        $result = $stmt->get_result();
        $imageRow = $result->fetch_assoc();
        $stmt->close();
        return $imageRow['Image'];
    }
    public function updateMem($idMem, $nameMem, $roleMem, $descMem, $imgMem)
    {
        $queries = "UPDATE Employee_Front SET Name = ?, Role = ?, Description = ?, Image = ? WHERE ID = ?";
        $stmt = $this->conn->prepare($queries);
        $stmt->bind_param("ssssi", $nameMem, $roleMem, $descMem, $imgMem, $idMem);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}
