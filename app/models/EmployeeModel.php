<?php
class EmployeeModel extends DB
{
  public function findEmployeeByEmail($email)
  {
    $query = "SELECT * FROM Employee WHERE Email = ?";
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

  public function findEmployeeByUsername($username)
  {
    $query = "SELECT * FROM Employee WHERE Username = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $stmt = null;
    if ($result->num_rows > 0) {
      return $result->fetch_assoc();
    }
    return null;
  }

  public function createEmployee($socialNumber, $firstName, $lastName, $address, $phoneNo, $username, $email, $password)
  {
    $query = "INSERT INTO Employee(SocialNo, PhoneNo, Address, Email, FirstName, LastName, Password, Username) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);

    $options = [
      'cost' => 12
    ];
    $hashedPwd = password_hash($password, PASSWORD_BCRYPT, $options);

    $stmt->bind_param("ssssssss", $socialNumber, $phoneNo, $address, $email, $firstName, $lastName, $hashedPwd, $username);
    $result = $stmt->execute();
    $stmt = null;
    return $result;
  }

  public function getEmployeeList()
  {
    $query = "SELECT PhoneNo, Email, FirstName, LastName, Username FROM Employee WHERE Username != 'admin'";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $users = [];
    while ($row = $result->fetch_assoc()) {
      $users[] = $row;
    }
    $stmt->close();
    return !empty($users) ? $users : null;;
  }
}
