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
  
  public function findUserById($id)
  {
    $queries = "SELECT * FROM Customer WHERE ID = ?";
    $stmt = $this->conn->prepare($queries);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if ($result->num_rows > 0) {
      return $result->fetch_assoc();
    }
    return null;
  }
  
  public function editUserInfo($id, $firstName, $lastName, $email, $phone, $address)
  {
    $queries = "UPDATE Customer SET FirstName = ?, LastName = ?, Email = ?, Phone = ? ,`Address` = ? WHERE ID = ?";
    $stmt = $this->conn->prepare($queries);
    $stmt->bind_param("sssssi", $firstName, $lastName, $email, $phone, $address, $id);
    $stmt->execute();
    return $stmt->affected_rows > 0;
  }
  
  public function uploadAvatar($id, $avatarImgJson)
  {
    $queries = "UPDATE Customer SET Avatar = ? WHERE ID = ?";
    $stmt = $this->conn->prepare($queries);
    $stmt->bind_param('si', $avatarImgJson, $id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
  }
  
  public function changePassword($id, $newPassword)
  {
    $queries = "UPDATE Customer SET Password = ? WHERE ID = ?";
    $stmt = $this->conn->prepare($queries);
    $stmt->bind_param("si", $newPassword, $id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
  }
  
  public function getOldPassword($id)
  {
    $queries = "SELECT `Password` FROM Customer WHERE ID = ?";
    $stmt = $this->conn->prepare($queries);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result->fetch_assoc();
  }
  
  public function getAllUser()
  {
    $queries = "SELECT * FROM Customer";
    $result = $this->conn->query($queries);
    return $result;
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
