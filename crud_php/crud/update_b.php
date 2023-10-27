<?php
require('affichage.php');
require('../sql/connect.php');
$connect = connect();

if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['code_rome']) && isset($_POST['id']) ) {
// UPDATE table SET colonne_1 = 'valeur 1', colonne_2 = 'valeur 2', colonne_3 = 'valeur 3' WHERE condition
$update     = "UPDATE `apprenants` SET `NOM` = '{$_POST['nom']}', `PRENOM` = '{$_POST['prenom']}', `ROME` = '{$_POST['code_rome']}'  WHERE `ID`= {$_POST['id']}";
$res_update = mysqli_query($connect, $update); 

if($res_update) {
    echo "Bravo element modifié.";
    affichage($connect);
}
     else {
        echo "Erreur requete ::: " . var_dump($update);
         exit();
         }
}
else {
    affichage($connect);
}


?>