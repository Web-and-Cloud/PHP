<?php
  session_start();
  include_once 'inc/functions.php';
  include_once 'inc/database.php';

  if(!onKirjautunut()){
    header("Location: index.php");
    exit;
  }

//http://vuokramo.test/asiakashaku.php?

$hakusana = $_GET['hakusana'];

$sql = "SELECT *
        From asiakas
        WHERE CONCAT(etunimi, '', sukunimi) LIKE :hakusana";

$stmt= $pdo->prepare($sql);
$stmt->bindParam(':hakusana', "%$hakusana%");
$stmt->execute();

while($row = $stmt->fetch()): ?>

<tr>
  <td><?= $row['asiakasID']; ?></td>
  <td><?= $row['etunimi']; ?></td>
  <td><?= $row['sukunimi']; ?></td>
  <td><?= $row['sahkoposti']; ?></td>
  <td>
    <a class="btn" href="katso_asiakas.php?asiakasID=<?= $row['asiakasID'];?>">Katso</a>
    <a class="btn" href="katso_asiakas.php?asiakasID=<?= $row['asiakasID'];?>">Katso</a>
    <a class="btn" href="katso_asiakas.php?asiakasID=<?= $row['asiakasID'];?>">Katso</a>

  </td>
</tr>

<?php endwhile; ?>

