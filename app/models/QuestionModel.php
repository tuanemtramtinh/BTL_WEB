<?php
class QuestionModel extends DB
{
    public function getAllQuestion()
    {
        $queries = "SELECT * FROM Question";
        $result = $this->conn->query($queries);
        return $result;
    }
    public function getById($id)
    {
        $queries = "SELECT * FROM Question WHERE ID = ?";
        $stmt = $this->conn->prepare($queries);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
    public function createQuestion($name, $email, $question, $questionType, $date)
    {
        $queries = "INSERT INTO Question (Name, Email, Question, QuestionType, DateCreated) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($queries);
        $stmt->bind_param("sssss", $name, $email, $question, $questionType, $date);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    public function getByQuestionType($questionType)
    {
        $queries = "SELECT * FROM Question WHERE QuestionType = ?";
        $stmt = $this->conn->prepare($queries);
        $stmt->bind_param("s", $questionType);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    public function updateAnswer($id, $answer)
    {
        $queries = "UPDATE Question SET Answer = ? WHERE ID = ?";
        $stmt = $this->conn->prepare($queries);
        $stmt->bind_param("si", $answer, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    public function getQuestionNotAnswer()
    {
        $queries = "SELECT * FROM Question WHERE Answer IS NULL";
        $result = $this->conn->query($queries);
        return $result;
    }
    public function getByTypeQuestionNotAnswer($questionType)
    {
        $queries = "SELECT * FROM Question WHERE Answer IS NULL AND QuestionType = ?";
        $stmt = $this->conn->prepare($queries);
        $stmt->bind_param("s", $questionType);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    public function getQuestionAnswer()
    {
        $queries = "SELECT * FROM Question WHERE Answer IS NOT NULL";
        $result = $this->conn->query($queries);
        return $result;
    }
    public function deleteQuestion($id)
    {
        $queries = "DELETE FROM Question WHERE ID = ?";
        $stmt = $this->conn->prepare($queries);
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    public function getQuestionFront()
    {
        $queries = "SELECT * FROM Question_Front";
        $result = $this->conn->query($queries);
        return $result;
    }
    public function getQuestionFrontByID($id)
    {
        $queries = "SELECT * FROM Question_Front WHERE ID = ?";
        $stmt = $this->conn->prepare($queries);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
    public function addQuestionFront($question, $answer, $questionType)
    {
        $queries = "INSERT INTO Question_Front(Question, Answer, `Type`) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($queries);
        $stmt->bind_param("sss", $question, $answer, $questionType);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    public function deleteQuestionFront($id)
    {
        $queries = "DELETE FROM Question_Front WHERE ID = ?";
        $stmt = $this->conn->prepare($queries);
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    public function editQuestionFront($id, $question, $answer, $questionType)
    {
        $queries = "UPDATE Question_Front SET Question = ?, Answer = ?, `Type` = ? WHERE ID = ?";
        $stmt = $this->conn->prepare($queries);
        $stmt->bind_param("sssi", $question, $answer, $questionType, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}
