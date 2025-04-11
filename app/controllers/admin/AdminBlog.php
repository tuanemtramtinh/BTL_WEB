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
      "task" => 4,
      "blogs" => $blogs,
      "totalBlogs" => $totalBlogs,
      "currentPage" => $currentPage,
      "totalPages" => $totalPages,
      "limit" => $limit,
      "error" => $message['error'],
      "success" => $message['success']
    ]);
  }

  public function content()
  {

    $this->checkAuthAdmin();
    $Blog = $this->model("BlogModel");

    $blogIntro = $Blog->getBlogIntro(1);

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Blog introduction",
      "page" => "blog/content",
      "blogIntro"=> $blogIntro,
      "task" => 4,
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
    $categories = $Blog->getCategories();

    if (!$blog) {
      $_SESSION["error_message"] = "Blog not found.";
      header("Location: ../admin/blog/index");
      exit;
    }


    $this->viewAdmin("layout", [
      "title" => "Detail Blog",
      "page" => "blog/detail",
      "task" => 4,
      "blog"        => $blog,
      "categories" => $categories,
      "error"       => $message['error'],
      "success"     => $message['success']
    ]);
  }

  public function add()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $Blog = $this->model("BlogModel");
    $categories = $Blog->getCategories();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Add Blog",
      "page" => "blog/add",
      "task" => 4,
      "categories" => $categories,
      "error" => $message['error'],
      "success" => $message['success']
    ]);
  }

  public function addPost()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      $this->checkAuthAdmin();

      print_r($_FILES);
  
      // if (!isset($_FILES['cover_image']) || $_FILES['cover_image']['error'] !== UPLOAD_ERR_OK) {
      //   $_SESSION["error_message"] = "Cover image is missing or upload failed.";
      //   header("Location: add");
      //   exit;
      // }
  
      $blogImages = $this->uploadImages($_FILES['images'], 'add');
      $blogImagesJson = json_encode($blogImages, JSON_PRETTY_PRINT);
  
      $author      = $_POST['author'];
      $title       = $_POST['title'];
      $content     = $_POST['content'];
      $category    = (int)$_POST['category'];
      // $dateCreated = date("Y-m-d H:i:s");
      $desc        = $_POST['desc'];
  
      $Blog = $this->model("BlogModel");
  
      $error = null;

      if (empty($author) || empty($title) || empty($content) || empty($category) || empty($blogImagesJson) || empty($desc)){
        $error = 'Fail to create: Fill in all fields!';
      }

      if (isset($error)){
        $_SESSION["error_message"] = $error;
        header("Location: add");
        exit;
      }

      $Blog->createBlog($author, $title, $content, $category, $blogImagesJson, $desc);

      $_SESSION['success_message'] = 'Add Blog successfully';
      header('Location: index');
    }
  }

  public function updatePost()
  {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $this->checkAuthAdmin();

          if (!isset($_POST['article_id']) || empty($_POST['article_id'])) {
              $_SESSION["error_message"] = "Invalid Blog ID";
              header("Location: index");
              exit;
          }

          $blogID = (int)$_POST['article_id'];

          $author   = trim($_POST['author']);
          $title    = trim($_POST['title']);
          $content  = trim($_POST['content']);
          $category = (int)$_POST['category'];
          $desc     = trim($_POST['desc']);

          $existingImages = json_decode($_POST['existing_images'], true) ?? [];

          $uploadedImages = [];
          if (!empty($_FILES['images']['name'][0])) { 
              $uploadedImages = $this->uploadImages($_FILES['images'], 'edit');

              $finalImages = $uploadedImages;
          } else {
              $finalImages = $existingImages;
          }

          $blogImageJson = !empty($finalImages) ? json_encode($finalImages) : '[]';

          if (empty($author) || empty($title) || empty($content) || $category <= 0 || empty($desc)) {
              $_SESSION["error_message"] = "Vui lòng điền đầy đủ thông tin bắt buộc!";
              header("Location: detail?id=" . $blogID);
              exit;
          }

          $Blog = $this->model("BlogModel");
          $updateSuccess = $Blog->updateBlog(
              $blogID, 
              $author, 
              $title, 
              $content, 
              $category, 
              $blogImageJson, 
              $desc
          );

          if ($updateSuccess) {
              $_SESSION['success_message'] = "Post updated successfully!";
          } else {
              $_SESSION['error_message'] = "Post update failed!";
          }

          header("Location: detail?id=" . $blogID);
          exit;
      }
  }
  public function deletePost()
  {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $this->checkAuthAdmin();

          if (!isset($_POST['article_id']) || empty($_POST['article_id'])) {
              $_SESSION["error_message"] = "Invalid Blog ID";
              header("Location: index");
              exit;
          }

          $blogID = (int)$_POST['article_id'];
          $Blog = $this->model("BlogModel");

          $deleteSuccess = $Blog->deleteBlog($blogID);

          if ($deleteSuccess) {
              $_SESSION['success_message'] = "The post has been deleted!";
          } else {
              $_SESSION['error_message'] = "Delete post failed!";
          }

          header("Location: index");
          exit;
      }
  }

  public function addPostHead(){
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
      $this->checkAuthAdmin();

      $uploadedImages = $this->uploadImages($_FILES['images'], 'blog'); 
      $imagesArray = !empty($uploadedImages) ? $uploadedImages : json_decode($_POST['existing_images'] ?? '[]', true);

      $content = isset($_POST['content']) ? trim($_POST['content']) : '';

      if (empty($content) || empty($imagesArray)) {
        $_SESSION["error_message"] = "Please enter text and ensure at least 1 image is available!";
        header("Location: content");
        exit;
    }    

      $BlogModel = $this->model("BlogModel");

      $updateSuccess = $BlogModel->updateBlogIntro($imagesArray, $content);

      if ($updateSuccess) {
        $_SESSION["success_message"] = "Blog intro has been updated successfully!";
      } else {
        $_SESSION["error_message"] = "Update failed!";
      }

      header("Location: content");
      exit;
    }
  }

}
