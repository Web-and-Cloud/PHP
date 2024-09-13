<?php


class Post {

  private $db;

  public function __construct()
  {
    $this->db = (new Database())->getConnect();
  }

  public function addPost($data)
  {
    $sql = "INSERT INTO posts (userID, title, body)
            VALUES (:userID, :title, :body)";
    
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':userID', $data['userID']);
    $stmt->bindParam(':title', $data['title']);
    $stmt->bindParam(':body', $data['body']);

    return $stmt->execute();
  }

  public function deletePost($postID)
  {
    $sql = "DELETE FROM posts 
            WHERE postID = :postID";

    $stmt = $this->db->prepare($sql);
    $stmt->bindParam('postID', $postID);

    return $stmt->execute();
  }

  public function updatePost($data)
  {
      // tee viestin päivittäminen
  }
  
  public function getPosts()
  {
    $sql = "SELECT p.postID, p.title, p.body, u.userID, u.name, p.created_at 
            FROM posts p
            INNER JOIN users u 
            ON p.userID = u.userID
            ORDER BY p.created_at DESC";
          
    $stmt = $this->db->query($sql);

    return $stmt->fetchAll();
  }

  public function getPostByID($postID)
  {
    $sql = "SELECT * 
            FROM posts 
            WHERE postID = :postID";

    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':postID', $postID);
    $stmt->execute();

    return $stmt->fetch();

  }
}