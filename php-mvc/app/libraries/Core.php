<?php

class Core {

  protected $currentController = 'Pages';
  protected $currentMethod = 'index';
  protected $params = [];

  public function __construct()
  {
    //http://localhost/php-mvc/kontrolleri/metodi/parametrit
    // index.php?url=kontrolleri/metodi/parametrit

    $url = $this->getUrl();
    //var_dump($url);

    if(isset($url) && 
      file_exists('../app/controllers/' . ucwords($url[0]). '.php' ))
    {
      $this->currentController = ucwords($url[0]);
      unset($url[0]);
    }

    // ladataan haluttu controller-luokka
    require_once '../app/controllers/' . $this->currentController . '.php';

    //luodaan luokasta objekti
    $this->currentController = new $this->currentController;

    //selvitetään mitä objektin metodia kutsutaan
    if(isset($url[1])){
      if(method_exists($this->currentController, $url[1]))
      {
        $this->currentMethod = $url[1];
        unset($url[1]);
      }
    }

    //katsotaan sisältääkö url parametrejä
    $this->params = $url ? array_values($url) : [];

    //lopuksi kutsutaan kyseisen objektin metodia parametrien kanssa
    call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
  }

  private function getUrl()
  {
    // user/add
    // index.php?url=user/add
    // index.php?url=user/show/23455

    if(isset($_GET['url']))
    {
      $url = rtrim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);
      return $url;
    }
  }
}