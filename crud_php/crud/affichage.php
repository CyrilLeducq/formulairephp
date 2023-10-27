<?php
require('../common/head.html');
function affichage($connect) {
        $req = "SELECT `ID`, `NOM`,`PRENOM` FROM `apprenants`";
        $res = $connect -> query($req);

        $reponse_recherche = "";

        if(isset($_POST['recherche'])) {
            $req_recherche = "SELECT `NOM`,`PRENOM`, `metiers`.`CODE_ROME`, `LIBELLE_ROME` FROM `apprenants` INNER JOIN `metiers` ON `apprenants`.`ROME` = `metiers`.`CODE_ROME` WHERE `NOM` LIKE '" .  $_POST['recherche'] . "%' OR `PRENOM` LIKE '". $_POST['recherche'] . "%'";
            $res_recherche = mysqli_query($connect, $req_recherche);
            if(!$res_recherche) {
                $reponse_recherche = "La recheche n'a pu aboutir.";
            }
            else {
   
                while($data_recherche = mysqli_fetch_array($res_recherche)) {
                    //print_r($data_recherche);
             
                    if($data_recherche['CODE_ROME'] == 'AAAAA') {
                        $reponse_recherche = "{$data_recherche['PRENOM']} {$data_recherche['NOM']} n'a pas d'emploi actuellement.";
                    }
                    else {
                        $reponse_recherche = "{$data_recherche['PRENOM']} {$data_recherche['NOM']} à comme métier {$data_recherche['LIBELLE_ROME']} ({$data_recherche['CODE_ROME']})";
                    }
                }
            }
        }
    
        echo "<form method='post'>
                <input class='w3-input' type='text' name='recherche' maxlength='50' minlength='3' placeholder='Tapez votre recherche içi' />
                <input class='w3-input' type='submit' value='Rechercher' />
            </form>";
        echo $reponse_recherche;
        echo "<form class='w3-container'  method='post'>";
        echo '<table class="w3-table">';
        echo "<tr class='head'><td>&nbsp;</td><td>Nom</td><td>Prénom</td><td>Supression</td><td>Modification</td></tr>";
        while($data = mysqli_fetch_array($res)) {
            echo "<tr><td><input class='w3-input' type='hidden' name='indice' value='{$data['ID']}' /></td><td>{$data['NOM']}</td><td>{$data['PRENOM']}</td>";
            echo "<td><input class='w3-check' type='checkbox' name='coche[]' value='{$data['ID']}' />
            <td><input class='w3-radio' type='radio' name='modif' value='{$data['ID']}' /></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<input class='w3-btn w3-red' type='submit' formaction='supprimer.php' value='Supprimer' />";

        //echo "<input type='number' name='indice' /><input type='submit' formaction='delete.php' value='Delete' />";
        echo "<input class='w3-btn w3-blue' type='submit' formaction='update_a.php' value='Mise à jour' /></form>";
        echo "<a href='/crud_php' class='add'>Ajouter</a>";

    }
/*
function init() {
    require('connect.php');
    $connect = connnect();

    $init = "TRUNCATE TABLE `apprenants`";
   // mysqli_query($connect, $init); 

    echo "Base initalisée.";
}    
*/
?>