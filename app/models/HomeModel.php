<?php

class HomeModel extends DB
{
    public function getIntro($section)
    {
        $sql = "SELECT * FROM Intro WHERE section = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die('Prepare failed: ' . $this->conn->error);
        }

        $stmt->bind_param('i', $section); // 'i' = integer
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc(); // trả về 1 dòng dữ liệu (hoặc null nếu không có)
    }

    public function updateIntro($section, $title, $content)
    {
        $sql = "UPDATE Intro SET title = ?, content = ?, updated_at = NOW() WHERE section = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die('Prepare failed: ' . $this->conn->error);
        }

        $stmt->bind_param('ssi', $title, $content, $section); // 's' = string, 'i' = integer
        return $stmt->execute();
    }

    public function updateIntroWithSaleoff($section, $title, $content, $saleoff)
    {
        $sql = "UPDATE Intro SET title = ?, content = ?, saleoff = ?, updated_at = NOW() WHERE section = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die('Prepare failed: ' . $this->conn->error);
        }

        $stmt->bind_param('sssi', $title, $content, $saleoff, $section); // 3 string, 1 int
        return $stmt->execute();
    }
}