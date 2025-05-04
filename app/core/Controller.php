<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';
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

  public function rememberClient() {
    if (!isset($_SESSION['userId']) && isset($_COOKIE['remember'])) {
      $token = $_COOKIE['remember'];

      $User = $this->model("UserModel");
      $existUser = $User->findUserById($token);

      if ($existUser) {
        $_SESSION['userId'] = $existUser['ID'];
        $_SESSION['user_email'] = htmlspecialchars($existUser['Email']);
        
        $Cart = $this->model("CartModel");
        $existCart = $Cart->findCartByUserId($existUser['ID']);
        $_SESSION['user_cart'] = $existCart['ID'];

        $Cart->closeConnection();
      }

      $User->closeConnection();
    }
  }

  public function rememberAdmin(){
    if (!isset($_SESSION['employeeId']) && isset($_COOKIE['remember-admin'])) {
      $token = $_COOKIE['remember-admin'];

      $Employee = $this->model("EmployeeModel");
      $existEmployee = $Employee->findEmployeeById($token);

      if ($existEmployee) {
        $_SESSION['employeeId'] = $existEmployee['SocialNo'];
        $_SESSION['employee_username'] = htmlspecialchars($existEmployee['Username']);
      }

      $Employee->closeConnection();
    }
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
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp']; // Allowed file types
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

  public function getGeneral() {
    $General = $this->model("GeneralModel");
    $general = $General->getAll();
    $GLOBALS['general'] = $general ? $general : null;
    // print_r($general);
    $General->closeConnection();
  }

  public function sendMail($toEmail, $toName, $subject, $body)
  {
    $mail = new PHPMailer(true);

    try {
      $mail->CharSet = 'UTF-8';
      $mail->Encoding = 'base64';
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'perfumes.assistance@gmail.com';
      $mail->Password = 'bxdc enpe kozf fuob';
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
      $mail->Port = 465;

      $mail->setFrom('perfumes.assistance@gmail.com', 'Support');
      $mail->addAddress($toEmail, $toName);

      $mail->isHTML(true);
      $mail->Subject = $subject;
      $mail->Body    = $body;

      $mail->send();
      return true;
    } catch (Exception $e) {
      error_log("Mail error: {$mail->ErrorInfo}");
      return false;
    }
  }
}
