<?php

class GeneralModel extends DB
{
  public function getAll()
  {
    $query = "SELECT * FROM General";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $general = $result->fetch_assoc();
    return !empty($general) ? $general : null;
  }

  public function updateLogo($imageLink)
  {
    $query = "UPDATE General SET Logo = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("s", $imageLink);
    $result = $stmt->execute();
    $stmt = null;
    return $result;
  }
}
