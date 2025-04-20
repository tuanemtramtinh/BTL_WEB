<?php
class QuestionTypeModel extends DB
{
    public function takeAllType()
    {
        $queries = "SELECT * FROM QuestionType ORDER BY ID ASC";
        $result = $this->conn->query($queries);
        return $result;
    }
    public function findById($id)
    {
        $queries = "SELECT * FROM QuestionType WHERE ID = ?";
        $stmt = $this->conn->prepare($queries);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
    public function findByName($name)
    {
        $queries = "SELECT * FROM QuestionType WHERE Name = ?";
        $stmt = $this->conn->prepare($queries);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
    public function addType($name)
    {
        $queries = "INSERT INTO QuestionType (Name) VALUES (?)";
        $stmt = $this->conn->prepare($queries);
        $stmt->bind_param("s", $name);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    public function editType($id, $name)
    {
        $queries = "UPDATE QuestionType SET Name = ? WHERE ID = ?";
        $stmt = $this->conn->prepare($queries);
        $stmt->bind_param("si", $name, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    public function deleteType($id)
    {
        $queries = "DELETE FROM QuestionType WHERE ID = ?";
        $stmt = $this->conn->prepare($queries);
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}
