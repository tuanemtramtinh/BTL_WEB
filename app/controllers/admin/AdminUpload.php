<?php

class AdminUpload extends Controller
{
  public function image()
  {
    header('Content-Type: application/json');
    // echo json_encode(["file" => BASE_URL]);
    $target_dir = "./storage/";

    // Check if the directory exists, if not, create it
    if (!is_dir($target_dir)) {
      if (!mkdir($target_dir, 0777, true) && !is_dir($target_dir)) {
        echo json_encode(["error" => "Failed to create upload directory."]);
        exit;
      }
    }

    $original_name = pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME); // Get filename without extension
    // $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $imageFileType = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if ($check === false) {
      echo json_encode(["error" => "File is not an image."]);
      exit;
    }

    // Allow certain file formats
    $allowed_types = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowed_types)) {
      echo json_encode(["error" => "Only JPG, JPEG, PNG & GIF files are allowed."]);
      exit;
    }

    // Generate a unique filename with the original name
    $unique_name =  uniqid("img_", true) . '.' . $imageFileType;
    $target_file = $target_dir . $unique_name;

    // Check if $uploadOk is set to 0 by an error{
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
      // $file_url = substr($target_file, 2); // Adjust with your actual domain
      $file_url = BASE_URL . substr($target_file, 1);
      echo json_encode(["location" => $file_url]);
      exit;
    } else {
      echo json_encode(["error" => "Error uploading file."]);
      exit;
    }
  }
}
