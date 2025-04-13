<?php
class AdminAbout extends Controller
{
  public function index()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $Model = $this->model("MemModel");
    $member = $Model->getAllMem();
    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "About",
      "page" => "about/index",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2,
      "member" => $member
    ]);
  }
  public function addMem(): void
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Thêm thành viên",
      "page" => "about/addMem",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2
    ]);
  }
  public function addMember(): void
  {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      // Check if the employee is logged in
      $this->checkAuthAdmin();
      $memName = $_POST["name"];
      $memRole = $_POST["role"];
      $memDesc = $_POST["description"];
      $memImg = $this->uploadImages($_FILES['images'], 'add');
      $memImgJson = json_encode($memImg, JSON_PRETTY_PRINT);

      $Model = $this->model("MemModel");

      #error handling
      $error = null;
      if (empty($memName) || empty($memRole) || empty($memDesc) || empty($memImg)) {
        $error = "Vui lòng nhập đầy đủ thông tin!";
      }
      #check if member name already exists
      $existMember = $Model->getMemByName($memName);
      if (!$existMember) {
        $error = "Tên thành viên đã tồn tại!";
      }
      if (isset($error)) {
        $_SESSION["error_message"] = $error;
        header("Location: addMem");
        exit;
      }

      $result = $Model->addMem($memName, $memRole, $memDesc, $memImgJson);
      $Model->closeConnection();
      if ($result) {
        $_SESSION["success_message"] = "Thêm thành viên thành công!";
        header("Location: index");
      } else {
        $_SESSION["error_message"] = "Thêm thành viên không thành công";
        header("Location: addMem");
      }
    }
  }
  public function deleteMem(): void
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();
    $id = $_GET['id'];
    $Model = $this->model('MemModel');
    $result = $Model->deleteMem($id);
    if ($result) {
      $_SESSION["success_message"] = "Xóa thành viên thành công!";
    } else {
      $_SESSION["error_message"] = "Xóa thành viên không thành công!";
    }
    $Model->closeConnection();
    header("Location: index");
  }
  public function editMem(): void
  {
    $this->checkAuthAdmin();
    $Model = $this->model("MemModel");
    $id = $_GET['id'];
    $member = $Model->getMemById($id);
    if (!$member) {
      $_SESSION["error_message"] = "Không tìm thấy thành viên!";
      header("Location: index");
      exit;
    }
    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Chỉnh sửa thành viên",
      "page" => "about/editMem",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2,
      "member" => $member
    ]);
  }
  public function confirmEditMem(): void
  {
    function isImagesEmpty($images)
    {
      if (is_array($images['error'])) {
        foreach ($images['error'] as $error) {
          if ($error === UPLOAD_ERR_OK) {
            return false;
          }
        }
        return true;
      } else {
        return $images['error'] !== UPLOAD_ERR_OK;
      }
    }
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $this->checkAuthAdmin();
      $Model = $this->model("MemModel");
      $memName = $_POST["name"];
      $memRole = $_POST["role"];
      $memDesc = $_POST["description"];
      $memId = $_GET["id"];
      if (!isImagesEmpty($_FILES['images'])) {
        $memImg = $this->uploadImages($_FILES['images'], 'edit');
        $memImgJson = json_encode($memImg, JSON_PRETTY_PRINT);
      } else {
        $memImgJson = $Model->getOldAvatar($memId);
      }
      $result = $Model->updateMem($memId, $memName, $memRole, $memDesc, $memImgJson);
      $Model->closeConnection();
      if ($result) {
        $_SESSION["success_message"] = "Cập nhật thành viên thành công!";
        header("Location: index");
      } else {
        $_SESSION["error_message"] = "Cập nhật thành viên không thành công!";
        header("Location: editMem?id=" . $memId);
      }
    }
  }
  private function changeClassTag($html, $className)
  {
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

    $paragraphs = $dom->getElementsByTagName('p');

    foreach ($paragraphs as $p) {
      $existingClass = $p->getAttribute('class');
      $p->setAttribute('class', trim($existingClass . ' ' . $className));
    }

    $body = $dom->getElementsByTagName('body')->item(0);
    $innerHTML = '';
    foreach ($body->childNodes as $child) {
      $innerHTML .= $dom->saveHTML($child);
    }

    return $innerHTML;
  }
  public function changeTitle(): void
  {

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
      $this->checkAuthAdmin();
      $Model = $this->model("AboutModel");
      $title = $_POST['title'];
      $title = "<h2 class=\"about__section1-title\">" . $title . "</h2>";
      $content = $_POST['content'];
      $content = $this->changeClassTag($content, "about__section1-desc");
      $image = $_FILES['images'];
      $imageJson = $this->uploadImages($image, 'edit');
      $imageJson = json_encode($imageJson, JSON_PRETTY_PRINT);
      $result = $Model->changeTitleSection($title, $content, $imageJson);

      $error = null;
      if (empty($title) || empty($content) || empty($imageJson)) {
        $error = "Vui lòng nhập đầy đủ thông tin!";
      }
      if (isset($error)) {
        $_SESSION["error_message"] = $error;
        header("Location: index");
        exit;
      }
      if ($result) {
        $_SESSION["success_message"] = "Cập nhật tiêu đề thành công!";
        header("Location: index");
      } else {
        $_SESSION["error_message"] = "Cập nhật tiêu đề không thành công!";
        header("Location: index");
      }
    }
  }
  public function changeStory(): void
  {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $this->checkAuthAdmin();
      $Model = $this->model("AboutModel");
      $title = $_POST['title'];
      $title = "<h3 class=\"about__section2-story\">" . $title . "</h3>";
      $content = $_POST['content'];
      $content = $this->changeClassTag($content, "about__section2-story-desc");
      $result = $Model->changeStorySection($title, $content);
      $error = null;
      if (empty($title) || empty($content)) {
        $error = "Vui lòng nhập đầy đủ thông tin!";
      }
      if (isset($error)) {
        $_SESSION["error_message"] = $error;
        header("Location: index");
        exit;
      }
      if ($result) {
        $_SESSION["success_message"] = "Cập nhật story thành công!";
        header("Location: index");
      } else {
        $_SESSION["error_message"] = "Cập nhật story không thành công!";
        header("Location: index");
      }
    }
  }
  public function changeShowCase(): void
  {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $this->checkAuthAdmin();
      $Model = $this->model("AboutModel");
      $image = $_FILES['images'];
      $imageJson = $this->uploadImages($image, 'edit');
      $imageJson = json_encode($imageJson, JSON_PRETTY_PRINT);
      $result = $Model->changeShowCaseSection($imageJson);
      $error = null;
      if (empty($imageJson)) {
        $error = "Vui lòng nhập đầy đủ thông tin!";
      }
      if (isset($error)) {
        $_SESSION["error_message"] = $error;
        header("Location: index");
        exit;
      }
      if ($result) {
        $_SESSION["success_message"] = "Cập nhật showcase thành công!";
        header("Location: index");
      } else {
        $_SESSION["error_message"] = "Cập nhật showcase không thành công!";
        header("Location: index");
      }
    }
  }
  public function changeUnique(): void
  {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $this->checkAuthAdmin();
      $Model = $this->model("AboutModel");
      $title = $_POST['title'];
      $title = "<h3 class=\"about__section4-unique-title\">" . $title . "</h3>";
      $lTitle = $_POST['left-section-title'];
      $lTitle = "<span class=\"about__section4-unique-strong\">" . $lTitle . "</span>";
      $lContent = $_POST['left-section-content'];
      $lContent = $this->changeClassTag($lContent, "about__section4-unique-normal");
      $mTitle = $_POST['mid-section-title'];
      $mTitle = "<span class=\"about__section4-unique-strong\">" . $mTitle . "</span>";
      $mContent = $_POST['mid-section-content'];
      $mContent = $this->changeClassTag($mContent, "about__section4-unique-normal");
      $rTitle = $_POST['right-section-title'];
      $rTitle = "<span class=\"about__section4-unique-strong\">" . $rTitle . "</span>";
      $rContent = $_POST['right-section-content'];
      $rContent = $this->changeClassTag($rContent, "about__section4-unique-normal");
      $result = $Model->changeUniqueSection($title, $lTitle, $lContent, $mTitle, $mContent, $rTitle, $rContent);
      $error = null;
      if (empty($title) || empty($lTitle) || empty($lContent) || empty($mTitle) || empty($mContent) || empty($rTitle) || empty($rContent)) {
        $error = "Vui lòng nhập đầy đủ thông tin!";
      }
      if (isset($error)) {
        $_SESSION["error_message"] = $error;
        header("Location: index");
        exit;
      }
      if ($result) {
        $_SESSION["success_message"] = "Cập nhật unique thành công!";
        header("Location: index");
      } else {
        $_SESSION["error_message"] = "Cập nhật unique không thành công!";
        header("Location: index");
      }
    }
  }
  public function changeInvite(): void
  {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $this->checkAuthAdmin();
      $Model = $this->model("AboutModel");
      $invite = $_POST['invite'];
      $invite = $this->changeClassTag($invite, "about__section4-invite-paraph");
      $result = $Model->changeInviteSection($invite);
      $error = null;
      if (empty($invite)) {
        $error = "Vui lòng nhập đầy đủ thông tin!";
      }
      if (isset($error)) {
        $_SESSION["error_message"] = $error;
        header("Location: index");
        exit;
      }
      if ($result) {
        $_SESSION["success_message"] = "Cập nhật invite thành công!";
        header("Location: index");
      } else {
        $_SESSION["error_message"] = "Cập nhật invite không thành công!";
        header("Location: index");
      }
    }
  }
}
