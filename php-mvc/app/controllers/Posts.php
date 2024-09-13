<?php

class Posts extends Controller 
{

  private $postModel;
  private $userModel;

  public function __construct()
  {
    if(!isLoggedIn()){
      redirect('users/login');
      exit;
    }

    $this->postModel = $this->model('Post');
    $this->userModel = $this->model('User');

  }

  public function index()
  {
    $posts = $this->postModel->getPosts();

    $data = [
      'posts' => $posts
    ];

    $this->view('posts/index', $data);
  }

  public function add()
  {

    if(!empty($_POST)){
      //lue lomakkeen data
      $data = [
        'userID' => $_SESSION['userID'],
        'title' => trim($_POST['title']),
        'body' => trim($_POST['body']),
        'title_err' => '',
        'body_err' => ''
      ];

      //tarkistetaan datan oikeellisuus
      $valid = true;

      //tallennetaan viesti kantaan
      if($valid){
        if($this->postModel->addPost($data)){
          flash('post_message', "Viesti lisätty onnistuneesti");
          redirect('posts');
          exit;
        } else {
          die("Viestiä ei saatu tallennettua");
        }
      }else {
        $this->view('posts/add', $data);
      }

    }else {
      $this->view('posts/add');
    }
  }

  public function show($postID)
  {
    $post = $this->postModel->getPostByID($postID);
    $user = $this->userModel->getUserByID($post['userID']);

    $data = [
      'post' => $post,
      'user' => $user
    ];

    $this->view('posts/show', $data);

  }

  public function delete($postID)
  {
    if($_SERVER['REQUEST_METHOD'] === "POST"){
      $post = $this->postModel->getPostByID($postID);

      if($post['userID'] != $_SESSION['userID']){
        redirect('posts');
      }

      if($this->postModel->deletePost($postID)){
        flash('post_message', 'Viesti poistettu onnistuneesti');
        redirect('posts');
        exit;
      } else {
        die("Viestin poistaminen ei onnistunut");
      }
    } else {
      redirect('posts');
    }
  }

  public function edit($postID)
  {
    if($_SERVER['REQUEST_METHOD'] === "POST"){

    } else {
      //tarkista, että käytäjän oma viesti
      // haetaan viestin data kannasta
      // näytetään lomake
      $data = [

      ];

      $this->view('posts/edit', $data);
    }
  }

}