<?php

class AdminComment extends Controller
{


  public function index()
  {
    $this->checkAuthAdmin();
    $message = $this->getSessionMessage();
    
    // $itemsPerPage = 10;

    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $currentPage = $currentPage < 1 ? 1 : $currentPage;
    $Comment = $this->model("CommentModel");
    $status = isset($_GET['status']) ? $_GET['status'] : 'all';
    $totalComments = $Comment->countComment($status);
    $offset = ($currentPage - 1) * $totalComments;


    $filters = [
      'status' => $status
    ];

    $comments = $Comment->getAllComment($offset, $totalComments, $status);
    $totalPages = ceil($totalComments / $totalComments);

    $this->viewAdmin("layout", [
      "title" => "Comment Blog",
      "page" => "comment/index", 
      "comments" => $comments,
      "totalComments" => $totalComments,
      "totalPages" => $totalPages,
      "currentPage" => $currentPage,
      "filters" => $filters,
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 4
    ]);
  }

  public function deleteCMT()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->checkAuthAdmin();

      if (!isset($_POST['article_id']) || empty($_POST['article_id'])) {
        $_SESSION["error_message"] = "Invalid Comment ID";
        header("Location: index");
        exit;
      }

      // $message = $this->getSessionMessage();
  
      $id = $_POST['article_id'];
      printf('', $id);
  
      $Comment = $this->model("CommentModel");
      $deleteSuccess = $Comment->delete($id);
  
      if ($deleteSuccess) {
        $_SESSION["success_message"] = "Comment deleted successfully";
        header("Location: index");
        exit;
      } else {
        $_SESSION["error_message"] = "Failed to delete Comment";
        header("Location: index");
        exit;
      }
    }
  }

  public function updatestatus()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->checkAuthAdmin();
      
      if (!isset($_POST['id']) || empty($_POST['id'])) {
        $_SESSION["error_message"] = $_POST['id'];
        header("Location: index");
        exit;
      }

      $id = $_POST['id'];

      $status = $_POST['status'];

      if (empty($id) || empty($status)) {
        $_SESSION["error_message"] = "Vui lòng điền đầy đủ thông tin bắt buộc!";
              header("Location: index");
              exit;
      }

      $Comment = $this->model("CommentModel");
      $updateSuccess = $Comment->updateStatus($id, $status);

      if ($updateSuccess) {
        $_SESSION["success_message"] = "Updated successfully!";
      } else {
        $_SESSION["error_message"] = "Update failed!";
      }

      header("Location: index");
      exit;
    }
  }
}