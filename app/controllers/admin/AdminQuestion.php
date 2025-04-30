<?php
class AdminQuestion extends Controller
{
  public function index()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();
    $QType = $this->model("QuestionTypeModel");
    $Question = $this->model("QuestionModel");
    $AllQuestion = $Question->getQuestionFront();
    $allQType = $QType->takeAllType();
    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Question",
      "page" => "question/index",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2,
      "QuestionType" => $allQType,
      "Questions" => $AllQuestion
    ]);
  }
  public function addType()
  {
    $this->checkAuthAdmin();
    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Add Question Type",
      "page" => "question/addType",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2
    ]);
  }
  public function createQuestionType()
  {
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
      $this->checkAuthAdmin();
      $Name = htmlspecialchars($_POST['name']);
      $error = null;
      if (empty($Name)) {
        $error = "Thiếu trường vui lòng nhập lại";
      }
      $Model = $this->model('QuestionTypeModel');
      $checkExist = $Model->findByName($Name);
      if (isset($checkExist)) {
        $error = "Tên bị trùng vui lòng nhập lại";
      } else {
        $result = $Model->addType($Name);
      }
      if (isset($error)) {
        $_SESSION["error_message"] = $error;
        header("Location: addType");
        exit;
      }
      if ($result) {
        $_SESSION["success_message"] = "Tạo kiểu câu hỏi thành công";
        header("Location: index");
      } else {
        $_SESSION["error_message"] = "Tạo kiểu câu hỏi không thành công!";
        header("Location: index");
      }
    }
  }
  public function deleteQuestionType()
  {
    $this->checkAuthAdmin();
    $id = $_GET['id'];
    $Model = $this->model('QuestionTypeModel');
    $result = $Model->deleteType($id);
    if ($result) {
      $_SESSION["success_message"] = "Xóa kiểu câu hỏi thành công";
      header("Location: index");
    } else {
      $_SESSION["error_message"] = "Xóa kiểu câu hỏi không thành công!";
      header("Location: index");
    }
  }
  public function editType()
  {
    $this->checkAuthAdmin();
    $id = $_GET["id"];
    $Model = $this->model("QuestionTypeModel");
    $QuestionTypeData = $Model->findById($id);
    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Edit Question Type",
      "page" => "question/editType",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2,
      "TypeData" => $QuestionTypeData
    ]);
  }
  public function editQuestionType()
  {
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
      $this->checkAuthAdmin();
      $id = $_GET["id"];
      $name = htmlspecialchars($_POST["name"]);
      $Model = $this->model("QuestionTypeModel");
      $result = $Model->editType($id, $name);
      if ($result) {
        $_SESSION["success_message"] = "Thay đổi tên chủ đề câu hỏi thành công";
        header("Location: index");
      } else {
        $_SESSION["error_message"] = "Thay đổi tên chủ đề câu hỏi không thành công!";
        header("Location: editType?id=$id");
      }
    }
  }
  public function answerQuestion()
  {
    $this->checkAuthAdmin();
    $id = $_GET['id'];
    $QuestionModel = $this->model('QuestionModel');
    $Question = $QuestionModel->getById($id);
    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => $Question['Answer'] ? "Edit Answer" : "Answer Question",
      "page" => "question/answerQuestion",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2,
      "question" => $Question
    ]);
  }
  public function deleteQuestion()
  {
    $this->checkAuthAdmin();
    $id = $_GET['id'];
    $QuestionModel = $this->model('QuestionModel');
    $Question = $QuestionModel->getById($id);
    $result = $QuestionModel->deleteQuestion($id);
    if ($result) {
      $_SESSION["success_message"] = "Xoá câu hỏi thành công";
      $this->sendMail(
        $Question['Email'],
        $Question['Name'],
        "Câu hỏi của bạn đã không được duyệt",
        "
        <div style='font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px; color: #333;'>
          <div style='max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.05);'>
            <h2 style='color: #FF5722;'>Xin chào {$Question['Name']},</h2>
            <p>Cảm ơn bạn đã gửi câu hỏi tới chúng tôi.</p>
            <p>Tuy nhiên, sau khi xem xét, chúng tôi rất tiếc phải thông báo rằng câu hỏi của bạn đã không được duyệt vì lý do sau:</p>
            <ul style='margin: 15px 0; padding-left: 20px;'>
              <li>Câu hỏi bị trùng lặp hoặc</li>
              <li>Không liên quan đến nội dung mà hệ thống đang hỗ trợ</li>
            </ul>
            <p style='margin-top: 20px;'>Chi tiết câu hỏi của bạn:</p>
            <blockquote style='margin: 20px 0; padding: 15px; background: #f3f3f3; border-left: 4px solid #FF5722;'>
              <strong>Chủ đề:</strong> {$Question['QuestionType']}<br>
              <strong>Nội dung:</strong> <em>\"{$Question['Question']}\"</em>
            </blockquote>
            <p>Chúng tôi rất mong bạn thông cảm và hy vọng bạn sẽ tiếp tục đồng hành cùng chúng tôi trong tương lai.</p>
            <hr style='margin: 30px 0;'>
            <p style='font-size: 14px; color: #888;'>Trân trọng,<br><strong>Đội ngũ quản trị</strong></p>
          </div>
        </div>
        "
      );

      header("Location: index");
    } else {
      $_SESSION["error_message"] = "Xoá câu hỏi không thành công!";
      header("Location: index");
    }
  }
  public function datatable()
  {
    $model = $this->model("QuestionModel");
    $draw = isset($_POST['draw']) ? intval($_POST['draw']) : 1;
    $start = isset($_POST['start']) ? intval($_POST['start']) : 0;
    $length = isset($_POST['length']) ? intval($_POST['length']) : 10;
    $searchValue = isset($_POST['search']['value']) ? htmlspecialchars($_POST['search']['value']) : '';
    $type = $_POST['type'] ?? '';
    $notAnswered = isset($_POST['notAnswered']) && $_POST['notAnswered'] == 1;

    if ($notAnswered) {
      $totalCount = $model->countQuestionByTypeNotAnswer($type, $searchValue);
      $questions = $model->getByTypeQuestionNotAnswer($type, $length, $start, $searchValue);
    } else {
      $totalCount = $model->countQuestionByType($type, $searchValue);
      $questions = $model->getByQuestionType($type, $length, $start, $searchValue);
    }

    $data = [];
    foreach ($questions as $q) {
      $data[] = [
        $q['ID'],
        htmlspecialchars($q['Name']),
        htmlspecialchars($q['Email']),
        htmlspecialchars($q['Question']),
        htmlspecialchars($q['QuestionType']),
        htmlspecialchars($q['Answer'] ?? 'Chưa có'),
        "<a href='admin/question/answerQuestion?id={$q['ID']}' class='btn btn-success'>" . ($q['Answer'] ? 'Edit' : 'Answer') . " question</a>
             <a href='admin/question/deleteQuestion?id={$q['ID']}' class='btn btn-danger' onclick='return confirm(\"Bạn có muốn xóa câu hỏi này ?\")'>Delete</a>"
      ];
    }
    header('Content-Type: application/json');
    echo json_encode([
      'draw' => $draw,
      'recordsTotal' => $totalCount,
      'recordsFiltered' => $totalCount,
      'data' => $data
    ]);
  }
  public function sendQuestion()
  {
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
      $id = $_GET['id'];
      $answer = htmlspecialchars($_POST['answer']);
      $QuestionModel = $this->model('QuestionModel');
      $error = null;
      if (empty($answer)) {
        $error = "Thiếu câu trả lời vui lòng nhập lại";
      }
      if (isset($error)) {
        $_SESSION["error_message"] = $error;
        header("Location: answerQuestion?id={$id}");
        return;
      }
      $result = $QuestionModel->updateAnswer($id, $answer);
      if ($result) {
        $_SESSION["success_message"] = "Trả lời câu hỏi thành công";
        $Question = $QuestionModel->getById($id);
        $this->sendMail(
          $Question['Email'],
          $Question['Name'],
          "Câu hỏi của bạn đã được trả lời",
          "
          <div style='font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; color: #333;'>
            <div style='max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);'>
              <h2 style='color: #FF6F00;'>Xin chào {$Question['Name']},</h2>
              <p>Cảm ơn bạn đã gửi câu hỏi đến hệ thống.</p>
              <p>Chúng tôi đã xem xét và phản hồi câu hỏi của bạn như sau:</p>
        
              <h3 style='margin-top: 20px; color: #222;'>📌 Câu hỏi của bạn:</h3>
              <blockquote style='margin: 10px 0 20px 0; padding: 15px; background: #f9f9f9; border-left: 4px solid #FF6F00;'>
                <em>\"{$Question['Question']}\"</em>
              </blockquote>
        
              <h3 style='margin-top: 10px; color: #222;'>✅ Trả lời từ shop:</h3>
              <div style='margin: 10px 0 30px 0; padding: 15px; background: #e8f5e9; border-left: 4px solid #4CAF50;'>
                <strong>{$Question['Answer']}</strong>
              </div>
        
              <p>Hy vọng câu trả lời trên sẽ giúp ích cho bạn. Nếu còn thắc mắc khác, đừng ngần ngại gửi thêm câu hỏi cho chúng tôi.</p>
              <hr style='margin: 30px 0;'>
              <p style='font-size: 14px; color: #888;'>Trân trọng,<br><strong>Đội ngũ tư vấn</strong></p>
            </div>
          </div>
          "
        );

        header("Location: index");
      } else {
        $_SESSION["error_message"] = "Trả lời câu hỏi không thành công!";
        header("Location: answerQuestion?id={$id}");
      }
    }
  }
  public function addQuestionFront()
  {
    $this->checkAuthAdmin();
    $QuestionType = $this->model("QuestionTypeModel");
    $allType = $QuestionType->takeAllType();
    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Add Question Client",
      "page" => "question/addQuestionFront",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2,
      "Types" => $allType
    ]);
  }
  public function addQuestiontoFront()
  {
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
      $this->checkAuthAdmin();
      $Model = $this->model("QuestionModel");
      $question = htmlspecialchars($_POST['question']);
      $answer = htmlspecialchars($_POST['answer']);
      $type = $_POST['type'];
      $error = null;
      if (empty($question) | empty($answer)) {
        $error = 'Thiếu trường vui lòng nhập lại !!!';
      }
      if (isset($error)) {
        $_SESSION["error_message"] = $error;
        header("Location: addQuestionFront");
        exit;
      }
      $result = $Model->addQuestionFront($question, $answer, $type);
      if ($result) {
        $_SESSION["success_message"] = "Thêm question vào client thành công ";
        header("Location: index");
      } else {
        $_SESSION["error_message"] = "Thêm question vào client không thành công";
        header("Location: addQuestionFront");
      }
    }
  }
  public function editAnswer()
  {
    $this->checkAuthAdmin();
    $id = $_GET['id'];
    $modelType = $this->model("QuestionTypeModel");
    $modelQuestion = $this->model("QuestionModel");
    $AllType = $modelType->takeAllType();
    $Question = $modelQuestion->getQuestionFrontByID($id);
    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Edit Answer Client",
      "page" => "question/editAnswerFront",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2,
      "id" => $id,
      "Types" => $AllType,
      "Question" => $Question
    ]);
  }
  public function editAnswerFront()
  {
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
      $this->checkAuthAdmin();
      $Model = $this->model("QuestionModel");
      $id = $_GET['id'];
      $question = htmlspecialchars($_POST['question']);
      $answer = htmlspecialchars($_POST['answer']);
      $type = $_POST['type'];
      $error = null;
      if (empty($question) | empty($answer)) {
        $error = 'Thiếu trường xin nhập lại';
      }
      if (isset($error)) {
        $_SESSION["error_message"] = $error;
        header("Location: editAnswerFront?id={$id}");
        exit;
      }
      $result = $Model->editQuestionFront($id, $question, $answer, $type);
      if ($result) {
        $_SESSION["success_message"] = "Thay đổi question vào client thành công ";
        header("Location: index");
      } else {
        $_SESSION["error_message"] = "Thay đổi question vào client không thành công";
        header("Location: editAnswerFront?id={$id}");
      }
    }
  }
  public function deleteAnswerFront()
  {
    $this->checkAuthAdmin();
    $Model = $this->model("QuestionModel");
    $id = $_GET["id"];
    $result = $Model->deleteQuestionFront($id);
    if ($result) {
      $_SESSION["success_message"] = "Xóa question vào client thành công ";
      header("Location: index");
    } else {
      $_SESSION["error_message"] = "Xóa question vào client không thành công";
      header("Location: index");
    }
  }
}
