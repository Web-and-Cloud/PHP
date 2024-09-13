<?php
include_once 'inc/header.php';
require_once 'inc/database.php';

if (!empty($_POST)) {

  $asiakasID = intval($_POST['asiakasID']);

  $sql = "DELETE FROM asiakas
            WHERE asiakasID = :asiakasID";

  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':asiakasID', $asiakasID);
  $stmt->execute();

  header("Location: asiakas.php");
  exit;
} else {

  $asiakasID = (!empty($_GET['asiakasID']))
    ? intval($_GET['asiakasID'])
    : null;

  if (!is_int($asiakasID)) {
    header("Location: asiakas.php");
    exit;
  }

  $sql = "SELECT CONCAT(etunimi, ' ', sukunimi) AS nimi
          FROM asiakas 
          WHERE asiakasID = :asiakasID";

  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':asiakasID', $asiakasID);
  $stmt->execute();

  if ($stmt->rowCount() != 1) {
    header("Location: asiakas.php");
    exit;
  }

  $asiakas = $stmt->fetch();
}
?>

<div class="container">

  <div class="row">
    <div class="col-8 mx-auto">
      <div class="card card-body bg-ligt mt-3">

        <h3>Asiakastietojen poistaminen</h3>
        <p>Haluatko varmasti poistaa asiakkaan, <?php echo $asiakas['nimi']; ?>, tiedot?</p>

        <form action="" method="POST">
          <input type="hidden" name="asiakasID" value="<?php echo $asiakasID; ?>">
          <button type="submit" class="btn btn-danger">Poista</button>
          <a href="asiakas.php" class="btn float-end">Takaisin</a>
        </form>

      </div>
    </div>
  </div>
</div>

<?php
include_once 'inc/footer.php';
?>