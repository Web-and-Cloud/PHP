<?php
  require_once 'inc/database.php';
  require_once 'inc/functions.php';

  $asiakasID = intval($_GET['asiakasID']) ?? null;

  if(is_null($asiakasID)){
    header("Location: asiakas.php");
    exit;
  }

  $sql = "SELECT *
          FROM asiakas
          WHERE asiakasID = :asiakasID";

  $stmt = $pdo->prepare($sql);
  $stmt->bindParam('asiakasID', $asiakasID);
  $stmt->execute();

  if( $stmt->rowCount() != 1 ){
    header("Location: asiakas.php");
    exit;
  }

  $asiakas = $stmt->fetch(PDO::FETCH_OBJ);

  include_once 'inc/header.php';
?>

  <!-- HTML template -->

  <div class="container">
    <div class="row">
      <div class="col-8 mx-auto">
        <div class="card card-body bg-light mt-3">
          <h3>Asiakastietojen katsominen</h3>

          <form class="mt-3">

            <!-- <div class="row mb-3">
              <label  for="henkilotunnus" 
                      class="col-sm-3 col-form-label">Henkilötunnus</label>
              <div class="col-sm-9">
                <input  type="text" 
                        class="form-control" readonly 
                        value="<?php echo $asiakas->henkilotunnus; ?>">
              </div>
            </div> -->

            <?= luoInputKentta('Henkilötunnus', 'henkilotunnus', $asiakas->henkilotunnus, 'readonly'); ?>
            <?= luoInputKentta('Etunimi', 'etunimi', $asiakas->etunimi, 'readonly'); ?>
            <?= luoInputKentta('Sukunimi', 'sukunimi', $asiakas->sukunimi, 'readonly'); ?>
            <?= luoInputKentta('Lähiosoite', 'lahiosoite', $asiakas->lahiosoite, 'readonly'); ?>
            <?= luoInputKentta('Postinumero', 'postinumero', $asiakas->postinumero, 'readonly'); ?>
            <?= luoInputKentta('Postitoimipaikka', 'postitoimipaikka', $asiakas->postitoimipaikka, 'readonly'); ?>
            <?= luoInputKentta('Sähköposti', 'sahkoposti', $asiakas->sahkoposti, 'readonly'); ?>
            <?= luoInputKentta('Puhelin', 'puhelin', $asiakas->puhelin, 'readonly'); ?>

            <div class="col-12">
              <a href="asiakas.php" class="btn">Takaisin</a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

<?php
  include_once 'inc/footer.php';