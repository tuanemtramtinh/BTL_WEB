<?php
class UserModel extends DB {

  public function createUser($firstName, $lastName, $email, $password){
    $query = "INSERT INTO Customer(FirstName, LastName, Email, Password) VALUES (?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);

    $options = [
      'cost' => 12
    ];
    $hashedPwd = password_hash($password, PASSWORD_BCRYPT, $options);

    $stmt->bind_param("ssss", $firstName, $lastName, $email, $hashedPwd);
    $result = $stmt->execute();
    $stmt = null;
    return $result;
  }

  public function findUserByEmail($email) {
    $query = "SELECT ID, FirstName, LastName, Email FROM Customer WHERE Email = ?";
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
}