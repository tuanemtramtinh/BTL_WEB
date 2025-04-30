<?php

// TRANG DANH SÁCH BÀI VIẾT

class ClientBlog extends Controller {
  public function index(){
    $Blog = $this->model("BlogModel");
    
    $search = $_GET['search'] ?? '';
    $category = $_GET['category'] ?? null;
    $currentPage = max((int)($_GET['page'] ?? 1), 1);
    
    $limit = empty($search) ? 6 : PHP_INT_MAX;
    $offset = empty($search) ? ($currentPage - 1) * $limit : 0;

    $totalBlogs = $Blog->getTotalFilteredBlogs($search, $category);
    $blogs = $Blog->getFilteredBlogs($search, $category, $limit, $offset);
    $blogIntro = $Blog->getBlogIntro(1);
    $message = $this->getSessionMessage();
    
    $totalPages = empty($search) 
        ? ceil($totalBlogs / 6) 
        : 1;

    $this->view("layout", [
        "title" => "Danh Sách Bài Viết",
        "page" => "blog/index",
        "blogs" => $blogs,
        "blogIntro" => $blogIntro,
        "categories" => $Blog->getCategories(),
        "currentPage" => $currentPage,
        "totalPages" => $totalPages,
        "limit" => $limit,
        "search" => $search,
        "category" => $category,
        "task" => 4
    ]);
}


  public function detail() {
    $Blog = $this->model("BlogModel");
    $Comment = $this->model("CommentModel");
    $message = $this->getSessionMessage();


    if (!isset($_GET['id']) || empty($_GET['id'])) {
      $_SESSION["error_message"] = "Blog ID is missing.";
      header("Location: ../admin/blog/index");
      exit;
    }
    $id = (int)$_GET['id'];

    $blog = $Blog->getBlogDetail($id);
    $categories = $Blog->getCategories();

    $adjacentPosts = $Blog->getAdjacentPosts($id);
    $previousPost = $adjacentPosts['previous'] ?? null;
    $nextPost = $adjacentPosts['next'] ?? null;

    if (!$blog) {
      $_SESSION["error_message"] = "Blog not found.";
      header("Location: ../admin/blog/index");
      exit;
    }

    $comments = $Comment->getCommentsByBlogId($id);

    $user = $_SESSION['userId'] ?? null;
    $userCommentStatus = [];
    if ($user) {
        $userCommentStatus = $Comment->getStatusCMTinBlog($user);
    }

    // echo "<pre>";
    // print_r($Comment->getStatusCMTinBlog($_SESSION['userId']));
    // echo "</pre>";



    $this->view("layout", [
      "title" => "Detail Blog",
      "page" => "blog/detail",
      "blog" => $blog,
      "categories" => $categories,
      "previousPost" => $previousPost,
      "nextPost" => $nextPost,
      "comments" => $comments,
      "userCommentStatus" => $userCommentStatus,
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 4
    ]);
  }

  public function addComment() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (empty($_SESSION['userId'])) {
        http_response_code(401);
        echo json_encode([
          'success' => false,
          'message'=> 'Please login first.'
        ]);
          exit();
      }

      $Content = $_POST['Content'];
      $ID_Customer = $_SESSION['userId'];  
      $ID_Blog = $_POST['ID_Blog'];
      $Status = $_POST['Status']; 

      if (empty($Content)) {
        echo json_encode([
          'success'=> false,
          'message'=> 'Please enter comment content.'
        ]);
        exit();
      }

      $addSuccess = $this->model("CommentModel")->addComment($Content, $ID_Customer, $ID_Blog, $Status);

      if (!$addSuccess) {
        echo json_encode([
          "success"=> false,
          "message"=> "Failed to add comment."
        ]);
      }
      else{
        echo json_encode([
          'success'=> true,
          'message'=> 'Comment successfully pending approval!'
        ]);
      }
      exit();
    }
  }


  public function toggleLike() {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode([
            'success' => false,
            'message' => 'Method not allowed.'
        ]);
        exit();
    }
    
    if (empty($_SESSION['userId'])) {
        http_response_code(401);
        echo json_encode([
            'success' => false,
            'message' => 'Please login first.'
        ]);
        exit();
    }
    
    $userId = $_SESSION['userId'];
    $commentId = $_POST['commentId'] ?? null;
    $likeStatus = $_POST['likeStatus'] ?? null; 
    
    if (!$commentId || !$likeStatus) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Missing required parameters.'
        ]);
        exit();
    }
    
    $Comment = $this->model("CommentModel");
    $currentStatus = $Comment->getUserReactStatus($userId, $commentId);
    $message = null;
    $newStatus = null;

    if ($likeStatus === 'like' || $likeStatus === 'dislike') {
        $likeValue = $likeStatus === 'like' ? 1 : 0;

        if ($currentStatus === $likeValue) {
            $Comment->deleteReact($userId, $commentId);
            $newStatus = -1;
            $message = 'Reaction removed successfully.';
        } else {
            $Comment->upsertReact($userId, $commentId, $likeValue);
            $newStatus = $likeValue;
            $message = 'Reaction added successfully.';
        }
    } else {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Invalid likeStatus value.'
        ]);
        exit();
    }

    
    $likes = $Comment->countReact($commentId, 1);
    $dislikes = $Comment->countReact($commentId, 0);
    
    echo json_encode([
        'success' => true,
        'message' => $message,
        'status'  => $newStatus, 
        'likes'   => $likes,
        'dislikes'=> $dislikes
    ]);
    exit();
}

}
