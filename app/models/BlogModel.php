<?php 
class BlogModel extends DB
{
    public function getBlogList($offset, $limit)
    {
        $query = "SELECT b.ID AS BlogID, b.Author, b.DateCreated, b.Title, b.Content, 
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
        $query = "SELECT b.ID AS BlogID, b.Author, b.DateCreated, b.Title, b.Content, 
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

    public function createBlog($author, $dateCreated, $title, $content, $category, $cover_image)
    {
        $query = "INSERT INTO Blog (Author, DateCreated, Title, Content, ID_BlogCategory, Image)
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssis", $author, $title, $content, $category, $cover_image, $dateCreated);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
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
        $query = "SELECT b.ID AS BlogID, b.Author, b.DateCreated, b.Title, b.Content, 
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

}
?>