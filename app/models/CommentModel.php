<?php 
class CommentModel extends DB {
    public function addComment($blogId, $userId, $content) {
        $query = "INSERT INTO Comments (BlogID, UserID, Content) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iis", $blogId, $userId, $content);
        return $stmt->execute();
    }

    public function addReaction($commentId, $userId, $type) {
        // Check existing reaction
        $check = "SELECT * FROM CommentReactions 
                WHERE CommentID = ? AND UserID = ?";
        $stmt = $this->conn->prepare($check);
        $stmt->bind_param("ii", $commentId, $userId);
        $stmt->execute();
        
        if ($stmt->get_result()->num_rows > 0) {
            // Update existing reaction
            $query = "UPDATE CommentReactions 
                    SET Type = ?, UpdatedAt = NOW() 
                    WHERE CommentID = ? AND UserID = ?";
        } else {
            // Insert new reaction
            $query = "INSERT INTO CommentReactions (CommentID, UserID, Type) 
                    VALUES (?, ?, ?)";
        }
        
        $stmt = $this->conn->prepare($query);
        $type = in_array($type, ['like', 'dislike']) ? $type : 'like';
        $stmt->bind_param("sii", $type, $commentId, $userId);
        return $stmt->execute();
    }

    public function getReactionCounts($commentId) {
        $query = "SELECT 
                SUM(Type = 'like') AS likes,
                SUM(Type = 'dislike') AS dislikes
                FROM CommentReactions
                WHERE CommentID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $commentId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}

?>