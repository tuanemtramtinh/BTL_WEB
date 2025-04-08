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
    
    $totalPages = empty($search) 
        ? ceil($totalBlogs / 6) 
        : 1;

    $this->view("layout", [
        "title" => "Danh Sách Bài Viết",
        "page" => "blog/index",
        "blogs" => $blogs,
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

    $this->view("layout", [
      "title" => "Chi Tiết Bài Viết",
      "page" => "blog/detail",
      "blog" => $blog,
      "blog"        => $blog,
      "categories" => $categories,
      "previousPost" => $previousPost,
      "nextPost" => $nextPost,
      "task" => 4
    ]);
  }

}