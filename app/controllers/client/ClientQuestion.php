<?php

// TRANG HỎI/ĐÁP

class ClientQuestion extends Controller
{
  public function index()
  {
    $Model = $this->model("QuestionModel");
    $AllQuestion = $Model->getQuestionFront();
    $message = $this->getSessionMessage();
    $this->view("layout", [
      "title" => "Hỏi/Đáp",
      "page" => "question/index",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2,
      "Questions" => $AllQuestion
    ]);
  }
  public function question()
  {
    $message = $this->getSessionMessage();
    $Model = $this->model("QuestionTypeModel");
    $AllTypes = $Model->takeAllType();
    $this->view("layout", [
      "title" => "Hỏi",
      "page" => "question/question",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2,
      "allType" => $AllTypes
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
          "
          <div style='font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px; color: #333;'>
            <div style='max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.05);'>
              <h2 style='color: #FF6600;'>Xin chào {$name},</h2>
              <p>Cảm ơn bạn đã gửi câu hỏi đến hệ thống của chúng tôi.</p>
              <p style='margin-top: 15px;'>Chúng tôi đã nhận được câu hỏi của bạn:</p>
              <blockquote style='margin: 20px 0; padding: 15px; background: #f3f3f3; border-left: 4px solid #FF6600;'>
                <em>\"{$question}\"</em>
              </blockquote>
              <p>Chúng tôi sẽ cố gắng phản hồi bạn trong thời gian sớm nhất qua địa chỉ email <strong>{$email}</strong>.</p>
              <p>Nếu bạn có thêm câu hỏi khác, vui lòng liên hệ với chúng tôi bất cứ lúc nào.</p>
              <hr style='margin: 30px 0;'>
              <p style='font-size: 14px; color: #888;'>Trân trọng,<br><strong>Đội ngũ hỗ trợ</strong></p>
            </div>
          </div>
          "
        );
        header("Location: index");
      } else {
        $_SESSION["error_message"] = "Gửi câu hỏi không thành công";
        header("Location: question");
      }
    }
  }
}
