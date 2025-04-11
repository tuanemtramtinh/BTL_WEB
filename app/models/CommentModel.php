<?php 
class CommentModel extends DB {

    public function getAllComment($offset, $limit, $status = 'all') {
        $query = "SELECT 
                    co.*, 
                    CONCAT(cu.FirstName, ' ', cu.LastName) AS name_Customer,
                    (SELECT COUNT(*) FROM Customer_Comment cc WHERE cc.CommentID = co.ID AND cc.StatusCMT = 1) AS `Like`,
                    (SELECT COUNT(*) FROM Customer_Comment cc WHERE cc.CommentID = co.ID AND cc.StatusCMT = 0) AS Dislike
                  FROM Comment co
                  JOIN Customer cu ON co.ID_Customer = cu.ID";
        
        if ($status !== 'all') {
            $query .= " WHERE co.Status = ?";
        }
        
        $query .= " ORDER BY co.CreatedAt DESC LIMIT ?, ?";

        $stmt = $this->conn->prepare($query);
        if ($status !== 'all') {
            $stmt->bind_param("sii", $status, $offset, $limit);
        } else {
            $stmt->bind_param("ii", $offset, $limit);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $comments = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $comments ? $comments : [];
    }
    

    public function countComment($status = 'all'){
        if ($status !== 'all') {
            $query = "SELECT COUNT(*) AS count FROM Comment WHERE Status = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $status);
        } else {
            $query = "SELECT COUNT(*) AS count FROM Comment";
            $stmt = $this->conn->prepare($query);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        return (int)$row['count'];
    }

    public function addComment($Content, $ID_Customer, $ID_Blog, $Status){
        $query = "INSERT INTO Comment (Content, ID_Customer, ID_Blog, `Status`) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("siis", $Content, $ID_Customer, $ID_Blog, $Status);
        $stmt->execute();
        $stmt->close();

        return $this->conn->insert_id;
    }

    public function updateStatus($id, $status)
    {
        $sql = "UPDATE Comment SET Status = ? WHERE ID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $status, $id);

        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM Comment WHERE ID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }


    public function getCommentsByBlogId($ID_Blog) {
        $query = "SELECT Comment.*,
                    CONCAT(Customer.FirstName, ' ', Customer.LastName) as name_Customer,
                    (SELECT COUNT(*) FROM Customer_Comment cc WHERE cc.CommentID = Comment.ID AND cc.StatusCMT = 1) AS `Like`,
                    (SELECT COUNT(*) FROM Customer_Comment cc WHERE cc.CommentID = Comment.ID AND cc.StatusCMT = 0) AS Dislike
                FROM Comment 
                JOIN Customer ON Comment.ID_Customer = Customer.ID 
                WHERE ID_Blog = ? AND Status = 'approved'
                ORDER BY CreatedAt DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $ID_Blog);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $comments = [];
        while ($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }
    
        return $comments;
    }
    
       

    public function getCommentsByTag($tag) {
        $sql = "SELECT 
                  co.*, 
                  CONCAT(cu.FirstName, ' ', cu.LastName) as name_Customer,
                  (SELECT COUNT(*) FROM Customer_Comment cc WHERE cc.CommentID = co.ID AND cc.StatusCMT = 1) AS `Like`,
                  (SELECT COUNT(*) FROM Customer_Comment cc WHERE cc.CommentID = co.ID AND cc.StatusCMT = 0) AS Dislike
                FROM Comment co
                JOIN Customer cu ON co.ID_Customer = cu.ID 
                WHERE co.Status LIKE ?
                ORDER BY co.CreatedAt DESC";
    
        $stmt = $this->conn->prepare($sql);
        $searchTerm = "%" . $tag . "%";
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        $comments = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $comments ? $comments : [];
    }
    
    
}
?>