<?php
  include_once 'inc/header.php';
  require_once 'inc/functions.php';
  require_once 'inc/database.php';

  $nimi = '';
  $kuvaus = '';
  $kpl = '';
  $painoraja = '';
  $kuva = '';

  if(!empty($_POST)){

    $nimi = $_POST['nimi'];
    $kuvaus = $_POST['kuvaus'];
    $kpl = $_POST['kpl'];
    $painoraja = $_POST['painoraja'];
    $kuva = $_FILES['kuva']['name'];

    //tarkistaa lomakkeen tiedot
    $valid = true;

    if($valid){

      $tmp_name = $_FILES['kuva']['tmp_name'];
      move_uploaded_file($tmp_name, "img/$kuva");

      $sql = "INSERT INTO tuote 
                (nimi, kuvaus, kpl, painoraja, kuva)
              VALUES  
                (:nimi, :kuvaus, :kpl, :painoraja, :kuva)";

      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':nimi', $nimi);
      $stmt->bindParam(':kuvaus', $kuvaus);
      $stmt->bindParam(':kpl', $kpl);
      $stmt->bindParam(':painoraja', $painoraja);
      $stmt->bindParam(':kuva', $kuva);
      $stmt->execute();

      header("Location: tuote.php");
      exit;
    }
  }
?>

<div class="container">
    <div class="row">
      <div class="col-8 mx-auto">
        <div class="card card-body bg-light mt-3">
          <h3>Tuotetietojen lisääminen</h3>

          <form action="" class="mt-3" method="POST" enctype="multipart/form-data">

            <?= luoInputKentta('Nimi', 'nimi', $nimi); ?>
            <?= luoInputKentta('Kuvaus', 'kuvaus', $kuvaus); ?>
            <?= luoInputKentta('Kpl', 'kpl', $kpl); ?>
            <?= luoInputKentta('Painoraja', 'painoraja', $painoraja); ?>
            <?= luoInputKentta('Kuva', 'kuva', $kuva, '', 'file'); ?>

            <button type="submit" class="btn btn-primary">Tallenna</button>

            <a href="tuote.php" class="btn float-end">Takaisin</a>

          </form>
        </div>
      </div>
    </div>
  </div>

<?php
  include_once 'inc/footer.php';