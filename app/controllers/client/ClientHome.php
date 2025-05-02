<?php

// TRANG CHỦ

class ClientHome extends Controller
{
    public function index()
    {
        $message = $this->getSessionMessage();
        $model = $this->model("HomeModel");
    
        $intro1 = $model->getIntro(1); // Giới thiệu 1
        $intro2 = $model->getIntro(2); // Giới thiệu 2
        $intro3 = $model->getIntro(3); // Giảm giá
    
        $this->view("layout", [
            "title" => "Trang Chủ",
            "page" => "home/index",
            "task" => 1,
            "error" => $message['error'],
            "success" => $message['success'],
            "data" => [
                "intro2_title" => $intro1['title'] ?? '',
                "intro2_content" => $intro1['content'] ?? '',
    
                "intro3_title" => $intro2['title'] ?? '',
                "intro3_content" => $intro2['content'] ?? '',
    
                "sale_title" => $intro3['title'] ?? '',
                "sale_content" => $intro3['content'] ?? '',
                "saleoff" => $intro3['saleoff'] ?? ''
            ]
        ]);
    }    
}
