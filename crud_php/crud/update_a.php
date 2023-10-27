<?php
require('../sql/connect.php');
require('../common/head.html');
$connect = connect();

$code_rome = "";

$req_app = "SELECT `apprenants`.`ID` AS `ID_APPRENANTS`, `NOM`,`PRENOM`, `metiers`.`CODE_ROME`, `LIBELLE_ROME`, `ROME` FROM `apprenants` INNER JOIN `metiers` ON `apprenants`.`ROME` = `metiers`.`CODE_ROME` WHERE `apprenants`.`ID` = {$_POST['modif']}";
$res_app = mysqli_query($connect, $req_app);

$req_metier = "SELECT DISTINCT `LIBELLE_ROME`,`CODE_ROME` FROM `metiers` GROUP BY `LIBELLE_ROME` ORDER BY `LIBELLE_ROME`";
$res_metier = mysqli_query($connect, $req_metier);


echo "<form class='w3-container' action='update_b.php' method='post'>";
echo '<table class="w3-table">';
echo '<legend>Modifier et valider pour mettre à jour</legend>';

if(!$res_app) {
    echo "Erreur : " . var_dump($req_app);
    exit();
}
if(!$res_metier) {
    echo "Erreur : " . var_dump($req_metier);
    exit();
}

while($data_app = mysqli_fetch_array($res_app)) {
    $code_rome = $data_app['ROME'];
    echo "<tr>
            <td>
                <input type='text' name='id' value='{$data_app['ID_APPRENANTS']}' hidden />
            </td>
            <td>
                <input class='w3-input' type='text' name='nom' value='{$data_app['NOM']}' />
            </td>
            <td>
                <input class='w3-input' type='text' name='prenom' value='{$data_app['PRENOM']}' />
            </td>
            <td>";
       echo "<select class='w3-select' name='code_rome'>";
        while($data_metiers = mysqli_fetch_array($res_metier)) {
            if($data_metiers['CODE_ROME'] == $code_rome) {$selected = 'selected="selected"';} else {$selected = '';}
            echo "test :: ". $data_app['ROME'] . " " . $data_metiers['CODE_ROME'];
            echo "<option value={$data_metiers['CODE_ROME']} $selected>{$data_metiers['LIBELLE_ROME']}</option>";
            }
    echo "</select>";  
    echo "</td>
        </tr>";
            }
          
echo "</table>";
echo "<input  class='w3-btn w3-blue' type='submit' value='Mettre à jour' />";
echo "</form><br />";
       
?>