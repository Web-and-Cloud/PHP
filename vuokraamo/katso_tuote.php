<?php

  require_once 'inc/database.php';
  require_once 'inc/functions.php';

  $tuoteID = intval($_GET['tuoteID']) ?? null;

  if(is_null($tuoteID)){
    header("Location: tuote.php");
    exit;
  }

  $sql = "SELECT * 
          FROM tuote 
          WHERE tuoteID = :tuoteID";

  $stmt = $pdo->prepare($sql);
  $stmt->bindParam('tuoteID', $tuoteID);
  $stmt->execute();

  if($stmt->rowCount() != 1){
    header("Location: tuote.php");
    exit;
  }

  $tuote = $stmt->fetch(PDO::FETCH_OBJ);

  include_once 'inc/header.php';
?>

  <div class="container">
    <div class="row">
      <div class="col-8 mx-auto">
        <div class="card card-body bg-light mt-3">
          <h3>Tuotetietojen katsominen</h3>

          <form action="" class="mt-3">

            <?= luoInputKentta('TuoteID', 'tuoteID', $tuote->tuoteID, 'readonly'); ?>
            <?= luoInputKentta('Nimi', 'nimi', $tuote->nimi, 'readonly'); ?>
            <?= luoInputKentta('Kuvaus', 'kuvaus', $tuote->kuvaus, 'readonly'); ?>
            <?= luoInputKentta('Kpl', 'kpl', $tuote->kpl, 'readonly'); ?>
            <?= luoInputKentta('Painoraja', 'painoraja', $tuote->painoraja, 'readonly'); ?>
            <?= luoInputKentta('Kuva', 'kuva', $tuote->kuva, 'readonly'); ?>

            <div class="col-12">
              <a href="tuote.php" class="btn">Takaisin</a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

  <?php 
    include_once 'inc/footer.php';