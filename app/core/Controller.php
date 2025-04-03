<?php

class Controller
{
  public function model($model)
  {
    require_once './app/models/' . $model . '.php';
    return new $model();
  }
  public function view($view, $data = [])
  {
    require_once './app/views/client/' . $view . '.php';
  }
  public function viewAdmin($view, $data = [])
  {
    require_once './app/views/admin/' . $view . '.php';
  }
  public function getSessionMessage()
  {
    $errorKey = 'error_message';
    $successKey = 'success_message';
    $error = isset($_SESSION[$errorKey]) ? $_SESSION[$errorKey] : null;
    $success = isset($_SESSION[$successKey]) ? $_SESSION[$successKey] : null;

    unset($_SESSION[$errorKey], $_SESSION[$successKey]);

    return [
      'error' => $error,
      'success' => $success
    ];
  }

  public function checkAuthClient()
  {
    if (!isset($_SESSION['userId'])) {
      header("Location: " . BASE_URL . "/auth/login");
      exit;
    }
  }

  public function checkAuthAdmin()
  {
    if (!isset($_SESSION['employeeId'])) {
      header("Location: " . BASE_URL . "/admin/auth/login");
      exit;
    }
  }

  public function uploadImages($files, $location, $uploadDir = "./storage/")
  {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif']; // Allowed file types
    $uploadedFiles = []; // Store uploaded file paths

    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0777, true);
    }

    $totalFiles = count($files['name']);

    for ($i = 0; $i < $totalFiles; $i++) {
      $fileName = $files['name'][$i];
      $fileTmp = $files['tmp_name'][$i];
      $fileSize = $files['size'][$i];
      $fileType = mime_content_type($fileTmp);
      $fileError = $files['error'][$i];

      if ($fileError === 0) {
        if (in_array($fileType, $allowedTypes)) {
          // Generate unique file name
          $fileNewName = uniqid("img_", true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
          $fileDestination = $uploadDir . $fileNewName;

          // Move file to upload directory
          if (move_uploaded_file($fileTmp, $fileDestination)) {
            $uploadedFiles[] = substr($fileDestination, 2);
          } else {
            $_SESSION['error_message'] = "Failed to upload {$fileName}.";
            header('Location: ' . $location);
            exit;
          }
        } else {
          $_SESSION['error_message'] = "Invalid file type for {$fileName}. Only JPEG, PNG, and GIF allowed.";
          header('Location: ' . $location);
          exit;
        }
      } else {
        $_SESSION['error_message'] = "Error uploading {$fileName}.";
        header('Location: ' . $location);
        exit;
      }
    }

    return $uploadedFiles;
  }
}
