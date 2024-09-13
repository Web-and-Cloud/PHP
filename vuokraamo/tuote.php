<?php
  include_once 'inc/header.php';
?>

  <div class="container">

    <div class="row">
      <h3>Tuotetiedot</h3>
    </div>

    <div class="row">
    <p>
      <a href="lisaa_tuote.php" class="btn btn-success">Lisää</a>
    </p>
  </div>

    <div class="row">

      <table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Nimi</th>
            <th>Kpl</th>
            <th>Painoraja</th>
            <th>Kuva</th>
            <th>Toiminnot</th>
          </tr>
        </thead>
        <tbody>
          <?php
            //luodaan yhteys tietokantaan ja haetaan tuotetiedot
            require_once 'inc/database.php';
            $sql = "SELECT * FROM tuote";
            $result = $pdo->query($sql);

            while($row = $result->fetch()):
          ?>
            <tr>
              <td><?= $row['tuoteID']; ?></td>
              <td><?= $row['nimi']; ?></td>
              <td><?= $row['kpl']; ?></td>
              <td><?= $row['painoraja']; ?></td>
              <td><img width="50px" src="img/<?= $row['kuva']; ?>" alt="<?= $row['kuva']; ?>"></td>
              <td>
                <a href="katso_tuote.php?tuoteID=<?= $row['tuoteID']; ?>" class="btn">Katso</a>
                <a href="paivita_tuote.php?tuoteID=<?= $row['tuoteID']; ?>" class="btn btn-success">Päivitä</a>
                <a href="poista_tuote.php?tuoteID=<?= $row['tuoteID']; ?>" class="btn btn-danger">Poista</a>
              </td>
            </tr>

          <?php
            endwhile;
          ?>
        </tbody>
      </table>

    </div>
  </div>


<?php
  include_once 'inc/footer.php';
?>