<?php

  // ladataan tarvittavat tiedostot
  include_once 'inc/header.php';
  require_once 'inc/database.php';
  require_once 'inc/functions.php';

  //alustetaan tarvittavat muuttujat
  $salasana = '';
  $salasanaError = '';
  $kayttajatunnus = '';
  $kayttajatunnusError = '';


  if(!empty($_POST)){
    $kayttajatunnus = $_POST['kayttajatunnus'];
    $salasana = $_POST['salasana'];

    // Kenttien syötteiden tarkistaminen
    // Lisää tähän

    $sql = "SELECT myyjaID, nimi, salasana 
            FROM myyja 
            WHERE kayttajatunnus = :kayttajatunnus";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':kayttajatunnus', $kayttajatunnus);
    $stmt->execute();

    if($stmt->rowCount() != 1){
      $salasanaError = 'Tarkista salasanasi';
      $kayttajatunnusError = 'Tarkista käyttäjätunnuksesi';
    } else {

      $myyja = $stmt->fetch(PDO::FETCH_OBJ);

      if(password_verify($salasana, $myyja->salasana)){
        $_SESSION['kirjautunut'] = true;
        $_SESSION['myyjaID'] = $myyja->myyjaID;
        $_SESSION['nimi'] = $myyja->nimi;

        header("Location: asiakas.php");
        exit;

      }else {
        $salasanaError = 'Tarkista salasanasi';
        $kayttajatunnusError = 'Tarkista käyttäjätunnuksesi';
      }

    }
  }
?>

  <div class="row">
    <div class="col-8 mx-auto">
      <div class="card card-body bg-light mt-3">
        <h3>Kirjaudu</h3>

        <form action="" method="post">

          <?= luoInputKentta('Käyttäjätunnus', 'kayttajatunnus', '', '', 'text', $kayttajatunnusError); ?>
          <?= luoInputKentta('Salasana', 'salasana', '', '', 'password', $salasanaError); ?>

          <button type="submit" class="btn btn-primary">Kirjaudu</button>
        </form>
      </div>
    </div>
  </div>



<?php

  include_once 'inc/footer.php';