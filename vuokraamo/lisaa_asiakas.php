<?php

  //alustetaan lomakkeella käytetyt muuttujat
  $etunimi = "";
  $sukunimi = "";
  $lahiosoite = "";
  $postinumero = "";
  $postitoimipaikka = "";
  $puhelin = "";
  $sahkoposti = "";
  $henkilotunnus = "";


  if(!empty($_POST)){
    //var_dump($_POST);
    //Luetaan lomakkeen tiedot muuttujiin
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

    //tietojen tarkistaminen
    //oletetaan, että käyttäjä on syöttänyt kaikki tiedot

    $valid = true;

    if(empty($etunimi)){
      $valid = false;
      $etunimiError = "Syötä etunimi";
    }

    if(empty($sukunimi)){
      $valid = false;
      $valid = false;
      $sukunimiError = "Syötä sukunimi";
    }

    if($valid){
      // jos tiedot ovat kunnossa tallennetaan ne tietokantaan
      // luodaan yhteys tietokantaan
      require_once 'inc/database.php';

      $sql = "INSERT INTO asiakas 
                (etunimi, sukunimi, lahiosoite, postinumero, postitoimipaikka, sahkoposti, puhelin, henkilotunnus) 
              VALUES 
                (:etunimi, :sukunimi, :lahiosoite, :postinumero, :postitoimipaikka, :sahkoposti, :puhelin, :henkilotunnus)";

      $stmt = $pdo->prepare($sql);

      $stmt->bindParam(':etunimi', $etunimi);
      $stmt->bindParam(':sukunimi', $sukunimi);
      $stmt->bindParam(':lahiosoite', $lahiosoite);
      $stmt->bindParam(':postinumero', $postinumero);
      $stmt->bindParam(':postitoimipaikka', $postitoimipaikka);
      $stmt->bindParam(':sahkoposti', $sahkoposti);
      $stmt->bindParam(':puhelin', $puhelin);
      $stmt->bindParam(':henkilotunnus', $henkilotunnus);

      $stmt->execute();
      
      //ohjataan käyttäjä asiakas-sivulle
      header("Location: asiakas.php");
      exit;

    }


  }

  include_once 'inc/header.php';
?>

<div class="container">
  <div class="row">
    <div class="col-8 mx-auto">
      <div class="card card-body bg-light mt-3">
        <h3>Asiakastietojen lisääminen</h3>

        <form action="" method="POST" class="mt-3 needs-validation" novalidate>

          <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="henkilotunnus">Henkilötunnus</label>
            <div class="col-sm-9">
              <input  type="text" 
                      class="form-control
                            <?php echo 
                              (!empty($henkilotunnusError)) 
                              ? 'is-invalid' 
                              : ''; 
                            ?>" 
                      name="henkilotunnus"
                      value="<?php echo $henkilotunnus; ?>"
                      required
              >
              <div class="invalid-feedback">
                <small><?php echo $henkilotunnusError ?? 'Syötä henkilötunnus'; ?></small>
              </div>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="etunimi">Etunimi</label>
            <div class="col-sm-9">
              <input required type="text" 
                class="form-control 
                      <?php echo (!empty($etunimiError)) ? 'is-invalid' : ''; ?>" 
                name="etunimi"
              value="<?php echo $etunimi; ?>">
              <div class="invalid-feedback">
                <small><?php echo $etunimiError ?? 'Syötä etunimi' ; ?></small>
              </div>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="sukunimi">Sukunimi</label>

            <div class="col-sm-9">
              <input required type="text" class="form-control
              <?php echo (!empty($sukunimiError)) ? 'is-invalid' : ''; ?>" 
                name="sukunimi"
              value="<?php echo $sukunimi; ?>">

              <div class="invalid-feedback">
                <small><?php echo $sukunimiError ?? 'Syötä sukunimi'; ?></small>
              </div>

            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="lahiosoite">Lähiosoite</label>
            <div class="col-sm-9">

              <input required type="text" class="form-control
              <?php echo (!empty($lahiosoiteError)) ? 'is-invalid' : ''; ?>" 
                name="lahiosoite"
              value="<?php echo $lahiosoite; ?>">

              <div class="invalid-feedback">
                <small><?php echo $lahiosoiteError ?? 'Syötä lähiosoite'; ?></small>
              </div>

            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="postinumero">Postinumero</label>
            <div class="col-sm-9">
              <input required type="text" class="form-control
              <?php echo (!empty($postinumeroError)) ? 'is-invalid' : ''; ?>" 
                name="postinumero"
              value="<?php echo $postinumero; ?>">

              <div class="invalid-feedback">
                <small><?php echo $postinumeroError ?? 'Syötä postinumero'; ?></small>
              </div>

            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="postitoimipaikka">Postitoimipaikka</label>
            <div class="col-sm-9">

              <input required type="text" class="form-control
              <?php echo (!empty($postitoimipaikkaError)) ? 'is-invalid' : ''; ?>" 
                name="postitoimipaikka"
              value="<?php echo $postitoimipaikka; ?>">

              <div class="invalid-feedback">
                <small><?php echo $postitoimipaikkaError ?? 'Syötä postitoimipaikka'; ?></small>
              </div>

            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="sahkoposti">Sähköposti</label>
            <div class="col-sm-9">
              <input required type="text" class="form-control
              <?php echo (!empty($sahkopostiError)) ? 'is-invalid' : ''; ?>" 
                name="sahkoposti"
              value="<?php echo $sahkoposti; ?>">
              <div class="invalid-feedback">
                <small><?php echo $sahkopostiError ?? 'Syötä sähköposti'; ?></small>
              </div>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="puhelin">Puhelin</label>
            <div class="col-sm-9">
              <input required type="text" class="form-control
              <?php echo (!empty($puhelinError)) ? 'is-invalid' : ''; ?>" 
                name="puhelin"
              value="<?php echo $puhelin; ?>">
              <div class="invalid-feedback">
                <small><?php echo $puhelinError ?? 'Syötä puhelin'; ?></small>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Tallenna</button>

        </form>
      </div>
    </div>
  </div>
</div>

<?php
  include_once 'inc/footer.php';
?>