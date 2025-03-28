<?php
class AdminBlog extends Controller
{
  public function index()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();
    $Blog = $this->model("BlogModel");

    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $currentPage = $currentPage < 1 ? 1 : $currentPage;
    $totalBlogs = $Blog->getTotalBlogs(); 
    $totalPages = ceil($totalBlogs / $limit);
    $offset = ($currentPage - 1) * $limit;
    $blogs = $Blog->getBlogList($offset, $limit);

    $search = isset($_GET['search']) ? trim($_GET['search']) : '';

    if (!empty($search)) {
        $totalBlogs = $Blog->getTotalBlogsBySearch($search);
        $blogs = $Blog->searchBlogs($search, $offset, $limit);
    } else {
        $totalBlogs = $Blog->getTotalBlogs();
        $blogs = $Blog->getBlogList($offset, $limit);
    }

    $this->viewAdmin("layout", [
      "title" => "Blog",
      "page" => "blog/index",
      "blogs" => $blogs,
      "totalBlogs" => $totalBlogs,
      "currentPage" => $currentPage,
      "totalPages" => $totalPages,
      "limit" => $limit,
      "error" => $message['error'],
      "success" => $message['success']
    ]);
  }

  public function content() {

    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Blog's Content",
      "page" => "blog/content",
      "error" => $message['error'],
      "success" => $message['success']
    ]);
  }

  public function detail()
  {
    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();
    $Blog = $this->model("BlogModel");

    if (!isset($_GET['id']) || empty($_GET['id'])) {
        $_SESSION["error_message"] = "Blog ID is missing.";
        header("Location: ../admin/blog/index");
        exit;
    }
    $id = (int)$_GET['id'];

    $blog = $Blog->getBlogDetail($id);

    if (!$blog) {
        $_SESSION["error_message"] = "Blog not found.";
        header("Location: ../admin/blog/index");
        exit;
    }


    $this->viewAdmin("layout", [
      "title" => "Detail Blog",
      "page" => "blog/detail",
      "blog"        => $blog,
      "error"       => $message['error'],
      "success"     => $message['success']
    ]);
  }

  public function add()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();
    $Blog = $this->model("BlogModel");

    $categories = $Blog->getCategories();

    $this->viewAdmin("layout", [
        "title" => "Add Blog",
        "page" => "blog/add",
        "categories" => $categories,
        "error" => $message['error'],
        "success" => $message['success']
    ]);
  }

  public function addPost()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $author   = trim($_POST['author']);
      $title    = trim($_POST['title']);
      $content  = trim($_POST['content']);
      $category = (int)$_POST['category'];
      $dateCreated = date("Y-m-d H:i:s");

      $cover_image = "";
      if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
          $uploadDir = "/BTL_WEB/public/images";
          if (!is_dir($uploadDir)) {
              mkdir($uploadDir, 0777, true);
          }

          $filename   = time() . "_" . basename($_FILES['cover_image']['name']);
          $targetPath = $uploadDir . $filename;
          if (move_uploaded_file($_FILES['cover_image']['tmp_name'], $targetPath)) {
              $cover_image = $targetPath;
          } else {
              $_SESSION["error_message"] = "Error uploading cover image.";
              header("Location: add");
              exit;
          }
      } else {
          $_SESSION["error_message"] = "Cover image is required.";
          header("Location: add");
          exit;
      }

      if (empty($author) || empty($title) || empty($content) || empty($category)) {
          $_SESSION["error_message"] = "Fail to create: Fill in all fields!";
          header("Location: add");
          exit;
      }

      $Blog = $this->model("BlogModel");
      $insertResult = $Blog->createBlog($author, $title, $content, $category, $cover_image, $dateCreated);

      if ($insertResult) {
          $_SESSION['success_message'] = "Blog added successfully!";
          header("Location: index");
          exit;
      } else {
          $_SESSION["error_message"] = "Failed to add blog. Please try again.";
          header("Location: add");
          exit;
      }
    }
  }
}
