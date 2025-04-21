<?php
class AboutModel extends DB
{
    public function changeTitleSection($title, $content, $imageJson)
    {
        $arrayData = [
            "title" => $title,
            "content" => $content
        ];
        $jsonData = json_encode($arrayData);
        $queries = "UPDATE Section SET Content = ?, Background = ? WHERE Page_name = 'About' AND `Order` = 0";
        $stmt = $this->conn->prepare($queries);
        $stmt->bind_param("ss", $jsonData, $imageJson);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    public function getTitleSection()
    {
        $queries = "SELECT * FROM Section WHERE Page_name = 'About' AND `Order` = 0";
        $stmt = $this->conn->query($queries);
        $result = $stmt->fetch_assoc();
        return $result;
    }
    public function changeStorySection($title, $content)
    {
        $arrayData = [
            "title" => $title,
            "content" => $content
        ];
        $jsonData = json_encode($arrayData);
        $queries = "UPDATE Section SET Content = ? WHERE Page_name = 'About' AND `Order` = 1";
        $stmt = $this->conn->prepare($queries);
        $stmt->bind_param("s", $jsonData);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    public function getStorySection()
    {
        $queries = "SELECT * FROM Section WHERE Page_name = 'About' AND `Order` = 1";
        $stmt = $this->conn->query($queries);
        $result = $stmt->fetch_assoc();
        return $result;
    }
    public function changeShowCaseSection($imageJson)
    {
        $queries = "UPDATE Section SET Background = ? WHERE Page_name = 'About' AND `Order` = 2";
        $stmt = $this->conn->prepare($queries);
        $stmt->bind_param("s", $imageJson);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    public function getShowCaseSection()
    {
        $queries = "SELECT * FROM Section WHERE Page_name = 'About' AND `Order` = 2";
        $stmt = $this->conn->query($queries);
        $result = $stmt->fetch_assoc();
        return $result;
    }
    public function changeUniqueSection($title, $lTitle, $lContent, $mTitle, $mContent, $rTitle, $rContent)
    {
        $dataArray = [
            "title" => $title,
            "leftTitle" => $lTitle,
            "leftContent" => $lContent,
            "middleTitle" => $mTitle,
            "middleContent" => $mContent,
            "rightTitle" => $rTitle,
            "rightContent" => $rContent
        ];
        $jsonData = json_encode($dataArray);
        $queries = "UPDATE Section SET Content = ? WHERE Page_name = 'About' AND `Order` = 3";
        $stmt = $this->conn->prepare($queries);
        $stmt->bind_param("s", $jsonData);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    public function getUniqueSection()
    {
        $queries = "SELECT * FROM Section WHERE Page_name = 'About' AND `Order` = 3";
        $stmt = $this->conn->query($queries);
        $result = $stmt->fetch_assoc();
        return $result;
    }
    public function changeInviteSection($content)
    {
        $queries = "UPDATE Section SET Content = ? WHERE Page_name = 'About' AND `Order` = 4";
        $stmt = $this->conn->prepare($queries);
        $stmt->bind_param("s", $content);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    public function getInviteSection()
    {
        $queries = "SELECT * FROM Section WHERE Page_name = 'About' AND `Order` = 4";
        $stmt = $this->conn->query($queries);
        $result = $stmt->fetch_assoc();
        return $result;
    }
}
