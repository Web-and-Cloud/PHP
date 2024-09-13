<?php

class User {

  private $db;

  public function __construct()
  {
    $this->db = (new Database())->getConnect();
    
  }

  public function register($data)
  {
    $sql = "INSERT INTO users (name, email, password)
            VALUES (:name, :email, :password)";

    $stmt = $this->db->prepare($sql);

    $stmt->bindParam(':name', $data['name']);
    $stmt->bindParam(':email', $data['email']);
    $stmt->bindParam(':password', $data['password']);

    return $stmt->execute();
  }

  public function login($email, $password)
  {
    $sql = "SELECT * 
            FROM users
            WHERE email = :email";

    $stmt = $this->db->prepare($sql);

    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if($stmt->rowCount() === 1)
    {
      $user = $stmt->fetch(PDO::FETCH_OBJ);
      
      if(password_verify($password, $user->password))
      {
        return $user;
      }
      else
      {
        return false;
      }
    } else 
    {
      return false;
    }
  }

  public function findUserByEmail($email)
  {
    $sql = "SELECT *
            FROM users
            WHERE email = :email";

    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    if($stmt->rowCount() > 0){
      return true;
    } else {
      return false;
    }
  }

  public function getUserByID($userID)
  {
    $sql = "SELECT * 
            FROM users 
            WHERE userID = :userID";

    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();

    return $stmt->fetch();
  }
}