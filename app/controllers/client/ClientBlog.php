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

    $this->view("layout", [
      "title" => "Detail Blog",
      "page" => "blog/detail",
      "blog" => $blog,
      "categories" => $categories,
      "previousPost" => $previousPost,
      "nextPost" => $nextPost,
      "comments" => $comments,
      "task" => 4
    ]);
  }

  public function addComment() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (empty($_SESSION['userId'])) {
          header("Location: http://localhost/BTL_WEB/auth/login");
          exit();
      }

      $Content = $_POST['Content'];
      $ID_Customer = $_SESSION['userId'];  
      $ID_Blog = $_POST['ID_Blog'];
      $Status = $_POST['Status']; 

      $addSuccess = $this->model("CommentModel")->addComment($Content, $ID_Customer, $ID_Blog, $Status);

      if (!$addSuccess) {
        $_SESSION['error_message'] = 'Failed to add comment.';
      }
      else{
        $_SESSION['success_message'] = 'Comment successful pending approval!';
      }

      header("Location: http://localhost/BTL_WEB/blog/detail?id=$ID_Blog#comment");
      exit();
    }
  }




}