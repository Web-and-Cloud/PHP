<?php
  include_once 'inc/header.php';
  require_once 'inc/database.php';

  if(!empty($_POST)){
    //var_dump($_POST);
    //luetaan vuokrauslomakkeen tiedot
    $asiakasID = $_POST['asiakasID'];
    $vuokrauspvm = $_POST['vuokrauspvm'];

    //taulukoita
    $tuote = $_POST['tuote'];
    $alkamisaika = $_POST['alkamisaika'];
    $paattymisaika = $_POST['paattymisaika'];
    $hinta = $_POST['hinta'];

    //lomakkeen tietojen tarkistaminen
    $valid = true;

    if($valid){

      try{
        $pdo->beginTransaction();

        $sql = "INSERT INTO vuokraus
                  (asiakasID, myyjaID, vuokrauspvm)
                VALUES
                  (:asiakasID, :myyjaID, :vuokrauspvm)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':asiakasID', $asiakasID);
        $stmt->bindParam(':myyjaID', $_SESSION['myyjaID']);
        $stmt->bindParam(':vuokrauspvm', $vuokrauspvm);
        $stmt->execute();

        // haetaan tallennetun vuokrauksen vuokrausID
        $vuokrausID = $pdo->lastInsertId();

        //viedään vuokrausrivit omaan tauluunsa
        foreach($tuote as $key => $value){

          $sql = "INSERT INTO vuokrausrivi
                  (vuokrausID, tuoteID, alkamisaika, paattymisaika, hinta, palautettu)
                  VALUES
                  (:vuokrausID, :tuoteID, :alkamisaika, :paattymisaika, :hinta, :palautettu)";
          
          $stmt = $pdo->prepare($sql);
          $stmt->bindParam(':vuokrausID', $vuokrausID);
          $stmt->bindParam(':tuoteID', $tuote[$key]);
          $stmt->bindParam(':alkamisaika', $alkamisaika[$key]);
          $stmt->bindParam(':paattymisaika', $paattymisaika[$key]);
          $stmt->bindParam(':hinta', $hinta[$key]);
          $stmt->bindValue(':palautettu', 0);
          $stmt->execute();

        }

        //hyväksytään tiedot tietokantaan
        $pdo->commit();
        header("Location: vuokraus_onnistui.php");
        exit;

      }catch(Exception $e){
        echo $e->getMessage();
        $stmt->debugDumpParams();
        //palautetaan tietokanta aloitustilaan
        $pdo->rollBack();
      }
    }

  }

  //asiakastietojen hakeminen pudotuslistaan
  $sql = "SELECT asiakasID, CONCAT(etunimi, ' ', sukunimi) nimi 
          FROM asiakas
          ORDER BY sukunimi, etunimi DESC";

  $asiakkaat = $pdo->query($sql);

  //tuotetietojen hakeminen
  $sql = "SELECT tuoteID, nimi 
          FROM tuote
          ORDER by nimi";

  $tuotteet = $pdo->query($sql);
?>

  <div class="container">
    <form action="" method="post">
      <div class="row">
        <h3>Vuokraustiedot</h3>

        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Asiakas</th>
              <th>Vuokrauspvm</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <select name="asiakasID" id="" class="form-select">
                  <?php while($row = $asiakkaat->fetch()): ;?>
                    <option value="<?= $row['asiakasID']; ?>"><?= $row['nimi']; ?></option>
                  <?php endwhile; ?>
                </select>
              </td>
              <td>
                <input type="date" value="<?= date('Y-m-d'); ?>" name="vuokrauspvm" class="form-control">
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <h3>Vuokrattavat tuotteet</h3>
      <div class="row mt-3">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>&nbsp;</th>
              <th>Tuote</th>
              <th>Alkamisaika</th>
              <th>Päättymisaika</th>
              <th>Hinta</th>
              <th>Toiminto</th>
            </tr>
          </thead>
          <tbody>
            <tr id="rivi-1">
              <td>&nbsp;</td>
              <td>
                <select name="tuote[]" id="" class="form-select">
                  <?php while($row = $tuotteet->fetch()): ?>
                      <option value="<?= $row['tuoteID']; ?>"><?= $row['nimi']; ?></option>
                  <?php endwhile; ?>
                </select>
              </td>
              <td>
                <input name="alkamisaika[]" type="datetime-local" class="form-control">
              </td>
              <td>
                <input name="paattymisaika[]" type="datetime-local" class="form-control">
              </td>
              <td>
                <input type="number" class="form-control" name="hinta[]" step="0.1">
              </td>
              <td>
                <button type="button" class="btn btn-danger piiloon">Poista rivi</button>
              </td>
            </tr>
            <tr>
              <td colspan="6">
                  <div class="d-grid">
                    <button type="button" id="lisaaRivi" class="btn btn-success">Lisää rivi</button>
                  </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div>
        <button type="submit" class="btn btn-success">Tallenna</button>
      </div>
    </form>
  </div>


<?php
  include_once 'inc/footer.php';