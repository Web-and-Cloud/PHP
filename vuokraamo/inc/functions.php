<?php 

  function luoInputKentta($otsikko, $muuttujanNimi, $muuttujanArvo, $vainLuku = '', $kentanTyyppi = 'text', $virheviesti = ''){

    $html = "";
    $is_invalid = '';

    if(!empty($virheviesti)){
      $is_invalid = 'is-invalid';
    }

    $html .= "<div class='row mb-3'>";
    $html .= "<label for='$muuttujanNimi' class='col-sm-3 form-label'>$otsikko</label>";
    $html .= "<div class='col-sm-9'>";
    $html .= "<input type='$kentanTyyppi' class='form-control $is_invalid' $vainLuku value='$muuttujanArvo' name='$muuttujanNimi'>";
    $html .= "<div class='invalid-feedback'>";
    $html .= "<small>$virheviesti</small>";
    $html .= "</div>";
    $html .= "</div>";
    $html .= "</div>";

    return $html;
  }

  function onKirjautunut(){
    if(isset($_SESSION['kirjautunut']) && $_SESSION['kirjautunut'] === true){
      return true;
    } else {
      return false;
    }
  }