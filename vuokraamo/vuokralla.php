<?php
include_once 'inc/header.php';
require_once 'inc/database.php';

if(!empty($_POST)){
    $vuokrausriviID = $_POST['vuokrausriviID'];
    foreach($vuokrausriviID as $ID){
        $sql = "UPDATE vuokrausrivi
        SET palautettu = 1
        WHERE vuokrausriviID = :vuokrausriviID ";

        $stmt->$pdo->prepare($sql);
        $stmt->bindParam('vuokrausID', $ID);
        $stmt->execute();
    }
}

$sql = "SELECT CONCAT(a.etunimi,'',a.sukunimi) nimi, vr.alkamisaika, vr. pattymisaika, t.nimi tuote
        FROM asiakas a, vuokraus v, vuokrausrivi vr, tuote t
        WHERE a.asiakasID = v.asiakasID
        And v.vuokrausID = vr.vuokrausID
        AND t.tuoteID = vr.tuoteID
        AND vr.palautettu = 0";


$vuokralla = $pdo->query($sql);

?>
<div class="container">
    <h3>Vuokrelle olevat tuotteet</h3>

    <div class="row">
        <form action="" method="post">
            <table class="table table-stripped-table-bordered">
                <thead>
                    <tr>
                        <th>Asiakas</th>
                        <th>Tuote</th>
                        <th>Alkamisaika</th>
                        <th>Päättymisaika</th>
                        <th>Palautus</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $vuokralla->fetch()):?>
                        <tr>
                            <td><?=$row['nimi'];?></td>
                            <td><?=$row['tuote'];?></td>
                            <td><?=$row['alkamisaika'];?></td>
                            <td><?=$row['paattymisaika'];?></td>
                            <td>
                                <input type="checkbox" 
                                    name="vuokrausriviID[]"
                                    value="<?=$row['vrID']; ?>"></td>
                        </tr>

                        <?php endwhile;?>
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary">Palauta</button>
        </form>
    </div>

    </div>
<?php
include_once 'inc/footer.php'
?>