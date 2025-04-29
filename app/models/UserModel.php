<?php
class UserModel extends DB
{

  public function createUser($firstName, $lastName, $email, $phone, $address, $password)
  {
    $query = "INSERT INTO Customer(FirstName, LastName, Email, Password, Phone, Address) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);

    $options = [
      'cost' => 12
    ];
    $hashedPwd = password_hash($password, PASSWORD_BCRYPT, $options);

    $stmt->bind_param("ssssss", $firstName, $lastName, $email, $hashedPwd, $phone, $address);
    $result = $stmt->execute();
    $userId = $stmt->insert_id;
    $stmt->close();
    return $userId;
  }

  public function findUserByEmail($email)
  {
    $query = "SELECT * FROM Customer WHERE Email = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $stmt = null;
    if ($result->num_rows > 0) {
      return $result->fetch_assoc();
    }
    return null;
  }

  public function findUserById($userId)
  {
    $query = "SELECT * FROM Customer WHERE ID = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("s", $userId);
    $stmt->execute();

    $result = $stmt->get_result();
    $stmt = null;
    if ($result->num_rows > 0) {
      return $result->fetch_assoc();
    }
    return null;
  }

  public function findUserOrderInfoById($userId)
  {
    $query = 'SELECT CONCAT(LastName, " ", FirstName) AS Fullname, Email, Phone, Address FROM Customer WHERE ID = ?';
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("s", $userId);
    $stmt->execute();

    $result = $stmt->get_result();
    $stmt = null;
    if ($result->num_rows > 0) {
      return $result->fetch_assoc();
    }
    return null;
  }
}
