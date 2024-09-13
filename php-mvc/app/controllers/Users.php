<?php

class Users extends Controller {

  private $userModel;

  public function __construct()
  {
    $this->userModel = $this->model('User');
  }

  public function index(){
    echo "Users/index";
  }

  public function register(){

    if(!empty($_POST)){

      //luetaan lomakkeen tiedot data-muuttujaan
      $data = [
        'name' => trim($_POST['name']),
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'confirm_password' => trim($_POST['confirm_password']),
        'name_err' => '',
        'email_err' => '',
        'password_err' => '',
        'confirm_password_err' => ''
      ];

      //tarkistetaan lomake
      $valid = true;

      if(empty($data['name'])){
        $valid = false;
        $data['name_err'] = "Syötä nimesi";
      }

      if( empty( $data['email'] ) ){
        $valid = false;
        $data['email_err'] = "Syötä sähköposti";
      } else {
        //tarkistetaan onko kyseisen sähköposti jo käytössä
        if( $this->userModel->findUserByEmail( $data['email'] ) ){
          $valid = false;
          $data['email_err'] = "Et voi käyttää kyseistä sähköpostiosoitetta";
        }
      }

      if(empty($data['password'])){
        $valid = false;
        $data['password_err'] = "Syötä salasana";
      } elseif(strlen($data['password']) < 6){
        $valid = false;
        $data['password_err'] = "Salasana vähintään 6 merkkiä";
      }

      if($data['confirm_password'] != $data['password']){
        $valid = false;
        $data['confirm_password_err'] = 'Salasanat eivät täsmänneet';
      }

      if($valid){
        //tallennetaan käyttäjän tiedot kantaan
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        
        if($this->userModel->register($data)){
          redirect("users/login");
        } else {
          die('Rekisteröinti ei tällä hetkellä onnistu');
        }
      } else {
        $this->view('users/register', $data);
      }
      
    } else {
      // ladataan rekisteröintilomake
      $this->view('users/register');
    }
  }

  public function login(){

    if(!empty($_POST))
    {
      //luetaan lomakkeen tiedot
      $data = [
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'email_err' => '',
        'password_err' => ''
      ];

      // tarkistetaan käyttäjän syötteet
      $valid = true;

      if(!$valid){
        $this->view('users/login', $data);
        exit;
      } else 
      {
        $loggedInUser = $this->userModel->login($data['email'], $data['password']);

        if($loggedInUser === false)
        {
          $data['email_err'] = "Tarkista sähköpostiosoite";
          $data['password_err'] = "Tarkista salasana";
          $this->view('users/login', $data);
          exit;
        } else 
        {
          $this->createUserSession($loggedInUser);
        }
      }

    } else 
    {
      $this->view('users/login');
    }
  }

  private function createUserSession($user)
  {
    $_SESSION['userID'] = $user->userID;
    $_SESSION['userName'] = $user->name;
    redirect('posts');
  }

  public function logout()
  {
    $_SESSION = array();
    session_destroy();

    redirect('users/login');
  }
  
}