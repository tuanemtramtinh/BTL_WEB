<?php 
class BlogModel extends DB
{
    public function getBlogList($offset, $limit)
    {
        $query = "SELECT b.ID AS BlogID, b.Author, b.DateCreated, b.Title, b.Content, b.Desc,
                    bc.ID AS CategoryID, bc.Name AS CategoryName, b.Image
                    FROM Blog b
                    JOIN BlogCategory bc ON b.ID_BlogCategory = bc.ID
                    ORDER BY b.ID ASC
                    LIMIT ?, ?
                    ";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $offset, $limit);
        $stmt->execute();

        $result = $stmt->get_result();
        $blogs = [];
        while ($row = $result->fetch_assoc()) {
            $blogs[] = $row;
        }
        $stmt->close();

        return !empty($blogs) ? $blogs : null;
    }

    public function getTotalBlogs(){
        $query = "SELECT COUNT(*) as total FROM Blog";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();
        return (int)$data['total'];
    }

    public function searchBlogs($searchTerm, $offset, $limit)
    {
        $query = "SELECT b.ID AS BlogID, b.Author, b.DateCreated, b.Title, b.Content, b.Desc,
                    bc.ID AS CategoryID, bc.Name AS CategoryName, b.Image
                  FROM Blog b 
                  JOIN BlogCategory bc ON b.ID_BlogCategory = bc.ID
                  WHERE (b.Title LIKE ?) OR (b.Author LIKE ?)
                  ORDER BY b.ID ASC
                  LIMIT ?, ?";
        $stmt = $this->conn->prepare($query);
        $pattern = "%" . $searchTerm . "%"; 
        $stmt->bind_param("ssii", $pattern, $pattern, $offset, $limit);
        $stmt->execute();
    
        $result = $stmt->get_result();
        $blogs = [];
        while ($row = $result->fetch_assoc()) {
            $blogs[] = $row;
        }
        $stmt->close();
    
        return !empty($blogs) ? $blogs : null;
    }

    public function getTotalBlogsBySearch($searchTerm)
    {
        $query = "SELECT COUNT(*) as total FROM Blog WHERE Title LIKE ?";
        $stmt = $this->conn->prepare($query);
        $pattern = "%" . $searchTerm . "%";
        $stmt->bind_param("s", $pattern);
        $stmt->execute();
  
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();
        return (int)$data['total'];
    }

    public function createBlog($author, $title, $content, $category, $cover_image, $desc)
    {
        $query = "INSERT INTO Blog(Author, Title, Content, ID_BlogCategory, Image, `Desc`)
                  VALUES (?, ?, ?, ?, ?, ?)";

        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssiss", $author, $title, $content, $category, $cover_image, $desc);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function updateBlog($blogID, $author, $title, $content, $category, $cover_image, $desc)
    {
        $query = "UPDATE Blog SET 
                    Author = ?, 
                    Title = ?, 
                    Content = ?, 
                    ID_BlogCategory = ?, 
                    Image = ?, 
                    `Desc` = ?
                  WHERE ID = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param(
            "sssissi",
            $author, 
            $title, 
            $content, 
            $category, 
            $cover_image, 
            $desc, 
            $blogID
        );
        
        $result = $stmt->execute();
        $stmt->close();
        
        return $result;
    }

    public function deleteBlog($blogID)
    {
        $stmt = $this->conn->prepare("DELETE FROM Blog WHERE ID = ?");
        return $stmt->execute([$blogID]);
    }


    public function getCategories()
    {
        $query = "SELECT * FROM BlogCategory ORDER BY Name ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = $stmt->get_result();
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
        $stmt->close();

        return !empty($categories) ? $categories : null;
    }

    public function getBlogDetail($id)
    {
        $query = "SELECT b.ID AS BlogID, b.Author, b.DateCreated, b.Title, b.Content, b.Desc,
                        bc.ID AS CategoryID, bc.Name AS CategoryName, b.Image
                FROM Blog b
                JOIN BlogCategory bc ON b.ID_BlogCategory = bc.ID
                WHERE b.ID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $blog = $result->fetch_assoc();
        $stmt->close();
        return $blog;
    }

    public function getFilteredBlogs($search = null, $category = null, $limit = 9, $offset = 0)
    {
        $query = "SELECT b.ID AS BlogID, b.Author, b.DateCreated, b.Title, b.Content, b.Desc,
                        bc.ID AS CategoryID, bc.Name AS CategoryName, b.Image
                  FROM Blog b
                  JOIN BlogCategory bc ON b.ID_BlogCategory = bc.ID 
                  WHERE 1=1";
        
        $params = [];
        $types = "";
    
        if (!empty($search)) {
            $query .= " AND (b.Title LIKE ? OR b.Author LIKE ?)";
            $searchTerm = "%" . $search . "%";
            $params[] = $searchTerm;
            $params[] = $searchTerm;
            $types .= "ss";
        }
    
        if (!empty($category)) {
            $query .= " AND bc.ID = ?";
            $params[] = $category;
            $types .= "i";
        }
    
        if (empty($search)) {
            $query .= " ORDER BY b.ID ASC LIMIT ? OFFSET ?";
            $params[] = $limit;
            $params[] = $offset;
            $types .= "ii";
        } else {
            $query .= " ORDER BY b.ID ASC";
        }
    
        $stmt = $this->conn->prepare($query);
        
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        $blogs = [];
        while ($row = $result->fetch_assoc()) {
            $blogs[] = $row;
        }
        
        $stmt->close();
        return !empty($blogs) ? $blogs : null;
    }
    
    public function getTotalFilteredBlogs($search = null, $category = null)
    {
        $query = "SELECT COUNT(*) as total 
                  FROM Blog b
                  JOIN BlogCategory bc ON b.ID_BlogCategory = bc.ID 
                  WHERE 1=1";
        
        $params = [];
        $types = "";
    
        if (!empty($search)) {
            $query .= " AND (b.Title LIKE ? OR b.Author LIKE ?)";
            $searchTerm = "%" . $search . "%";
            $params[] = $searchTerm;
            $params[] = $searchTerm;
            $types .= "ss";
        }
    
        if (!empty($category)) {
            $query .= " AND bc.ID = ?";
            $params[] = $category;
            $types .= "i";
        }
    
        $stmt = $this->conn->prepare($query);
        
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        
        $stmt->close();
        return (int)$data['total'];
    }

    public function getBlogById($id) {
        $query = "SELECT b.*, bc.Name AS CategoryName 
                FROM Blog b
                JOIN BlogCategory bc ON b.ID_BlogCategory = bc.ID
                WHERE b.ID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getAdjacentPosts($currentId) {
        $query = "(
            SELECT * FROM Blog 
            WHERE ID < ? 
            ORDER BY ID DESC 
            LIMIT 1
        ) UNION ALL (
            SELECT * FROM Blog 
            WHERE ID > ? 
            ORDER BY ID ASC 
            LIMIT 1
        )";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $currentId, $currentId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $posts = [
            'previous' => null,
            'next' => null
        ];
        
        while ($row = $result->fetch_assoc()) {
            if ($row['ID'] < $currentId) {
                $posts['previous'] = $row;
            } else {
                $posts['next'] = $row;
            }
        }
        
        return $posts;
    }

    public function updateBlogIntro($img, $content){
        $sql = "UPDATE Section SET Images = ?, Content = ? WHERE ID = 1";
        print($sql);
        $stmt = $this->conn->prepare($sql);
        $imagesJson = json_encode($img, JSON_PRETTY_PRINT);
        $stmt->bind_param("ss", $imagesJson, $content);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }
    public function getBlogIntro($blogId) {
        $sql = "SELECT ID, Images, Content FROM Section WHERE ID = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $blogId);
        $stmt->execute();
        $result = $stmt->get_result();
        $blog = $result->fetch_assoc();
        return $blog;
    }  
}
?>