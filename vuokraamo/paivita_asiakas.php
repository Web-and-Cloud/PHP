<?php
require_once 'inc/database.php';
require_once 'inc/functions.php';

if (!empty($_POST)) {
  //Luetaan lomakkeen tiedot muuttujiin
  $asiakasID = intval($_POST['asiakasID']);
  $etunimi = $_POST['etunimi'];
  $sukunimi = $_POST['sukunimi'];
  $lahiosoite = $_POST['lahiosoite'];
  $postinumero = $_POST['postinumero'];
  $postitoimipaikka = $_POST['postitoimipaikka'];
  $puhelin = $_POST['puhelin'];
  $sahkoposti = $_POST['sahkoposti'];
  $henkilotunnus = $_POST['henkilotunnus'];

  //Puuttuvien kenttien ohjetekstit
  $etunimiError = "";
  $sukunimiError = "";
  $lahiosoiteError = "";
  $postinumeroError = "";
  $postitoimipaikkaError = "";
  $puhelinError = "";
  $sahkopostiError = "";
  $henkilotunnusError = "";

  //serveripuolen tarkistuksia

  $valid = true;

  if(empty($etunimi)){
    $valid = false;
    $etunimiError = "Syötä etunimi";
  }

  if($valid && is_int($asiakasID) ){

    $sql = "UPDATE asiakas
            SET henkilotunnus = :henkilotunnus, etunimi = :etunimi, 
                sukunimi = :sukunimi, lahiosoite = :lahiosoite, 
                postinumero = :postinumero, postitoimipaikka = :postitoimipaikka, sahkoposti = :sahkoposti, puhelin = :puhelin
            WHERE asiakasID = :asiakasID";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':etunimi', $etunimi);
    $stmt->bindParam(':sukunimi', $sukunimi);
    $stmt->bindParam(':henkilotunnus', $henkilotunnus);
    $stmt->bindParam(':lahiosoite', $lahiosoite);
    $stmt->bindParam(':postinumero', $postinumero);
    $stmt->bindParam(':postitoimipaikka', $postitoimipaikka);
    $stmt->bindParam(':sahkoposti', $sahkoposti);
    $stmt->bindParam(':puhelin', $puhelin);
    $stmt->bindParam(':asiakasID', $asiakasID);

    $stmt->execute();

    header("Location: asiakas.php");
    exit;
  }

} else {

  $asiakasID = intval($_GET['asiakasID']) ?? null;

  if (is_null($asiakasID)) {
    header("Location: asiakas.php");
    exit;
  }

  $sql = "SELECT *
          FROM asiakas
          WHERE asiakasID = :asiakasID";

  $stmt = $pdo->prepare($sql);
  $stmt->bindParam('asiakasID', $asiakasID);
  $stmt->execute();

  if ($stmt->rowCount() != 1) {
    header("Location: asiakas.php");
    exit;
  }

  $asiakas = $stmt->fetch(PDO::FETCH_OBJ);
}

include_once 'inc/header.php';
?>

<!-- HTML template -->

<div class="container">
  <div class="row">
    <div class="col-8 mx-auto">
      <div class="card card-body bg-light mt-3">
        <h3>Asiakastietojen päivittäminen</h3>

        <form action="" method="POST" class="mt-3">
          <input type="hidden" name="asiakasID" value="<?= $asiakasID; ?>">
          <?= luoInputKentta('Henkilötunnus', 'henkilotunnus', $asiakas->henkilotunnus); ?>
          <?= luoInputKentta('Etunimi', 'etunimi', $asiakas->etunimi); ?>
          <?= luoInputKentta('Sukunimi', 'sukunimi', $asiakas->sukunimi); ?>
          <?= luoInputKentta('Lähiosoite', 'lahiosoite', $asiakas->lahiosoite); ?>
          <?= luoInputKentta('Postinumero', 'postinumero', $asiakas->postinumero); ?>
          <?= luoInputKentta('Postitoimipaikka', 'postitoimipaikka', $asiakas->postitoimipaikka); ?>
          <?= luoInputKentta('Sähköposti', 'sahkoposti', $asiakas->sahkoposti); ?>
          <?= luoInputKentta('Puhelin', 'puhelin', $asiakas->puhelin); ?>

          <button type="submit" class="btn btn-primary">Tallenna</button>
          <a href="asiakas.php" class="btn">Takaisin</a>


        </form>
      </div>
    </div>
  </div>
</div>

<?php
include_once 'inc/footer.php';
