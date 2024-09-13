<?php

//kontrollerin perusluokka
// lataa tarvittavan tietomallin ja näkymän

class Controller {

  // lataa oikea näkymä
  public function view($view, $data = []){
    if(file_exists('../app/views/'. $view . '.php')){
      require_once '../app/views/inc/header.php';
      require_once '../app/views/'. $view . '.php';
      require_once '../app/views/inc/footer.php';
    } else {
      //näkymää ei ole
      die("näkymää ei ole");
    }
  }

  // lataa tarvittava tietomalli
  // palauta siitä objekti
  public function model($model){

    require_once '../app/models/' . $model . '.php';
    return new $model();
  }
}