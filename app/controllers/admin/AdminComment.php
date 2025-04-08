<?php

class AdminComment extends Controller
{
  private $itemsPerPage = 10;

  public function index()
  {
    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();

    // $status = $_GET['status'] ?? 'all';
    // $currentPage = $_GET['page'] ?? 1;
    // $perPage = 10;
    // $offset = ($currentPage - 1) * $perPage;
    // $filters = [
    //   'status' => $status
    // ];

    // $Comment = $this->model('CommentModel');
    // $comments = $Comment->getComments($filters, $perPage, $offset);
    // $totalComments = $Comment->countComments($filters);
    // $totalPages = ceil($totalComments / $perPage);
    // $comments = array_slice($comments, $offset, $this->itemsPerPage);

    $this->viewAdmin("layout", [
      "title" => "Comment Blog",
      "page" => "comment/index",
      // "comments" => $comments,  
      // "totalComments" => $totalComments, 
      // "totalPages" => $totalPages,
      // "currentPage" => $currentPage,
      // "filters" => $filters,  
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 4
    ]);
    
  }
}
