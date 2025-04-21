<?php

// TRANG HỎI/ĐÁP

class ClientQuestion extends Controller
{
  public function index()
  {
    $QuestionModel = $this->model('QuestionModel');
    $questionAnswered = $QuestionModel->getQuestionAnswer();
    $message = $this->getSessionMessage();
    $this->view("layout", [
      "title" => "Hỏi/Đáp",
      "page" => "question/index",
      "error" => $message['error'],
      "success" => $message['success'],
      "answeredQuestion" => $questionAnswered,
      "task" => 2
    ]);
  }
  public function question()
  {
    $Model = $this->model("QuestionTypeModel");
    $allType = $Model->takeAllType();
    $message = $this->getSessionMessage();
    $this->view("layout", [
      "title" => "Hỏi",
      "page" => "question/question",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2,
      "allType" => $allType
    ]);
  }
  public function sendQuestion()
  {
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
      $name = htmlspecialchars($_POST["name"]);
      $email = htmlspecialchars($_POST["email"]);
      $question = htmlspecialchars($_POST["question"]);
      $questionType = $_POST['type'];
      $date = date('Y-m-d');
      $Model = $this->model('QuestionModel');

      $error = null;
      if (empty($name) || empty($email) || empty($question)) {
        $error = 'Thiếu trường xin vui lòng nhập đủ trường';
      }
      if (isset($error)) {
        $_SESSION["error_message"] = $error;
        header("Location: question");
        exit;
      }
      $result = $Model->createQuestion($name, $email, $question, $questionType, $date);
      if ($result) {
        $_SESSION["success_message"] = "Gửi câu hỏi thành công";
        $this->sendMail(
          $email,
          $name,
          "Cảm ơn bạn đã gửi câu hỏi!",
          "<p>Chúng tôi sẽ phản hồi bạn sớm nhất có thể.</p>"
        );
        header("Location: index");
      } else {
        $_SESSION["error_message"] = "Gửi câu hỏi không thành công";
        header("Location: question");
      }
    }
  }
}
