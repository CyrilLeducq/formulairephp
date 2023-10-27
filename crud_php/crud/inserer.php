<?php
require('affichage.php');
require('../sql/connect.php');
$connect = connect();

if(isset($_POST['nom']) && isset($_POST['prenom'])) {
$nom    = $_POST['nom'];
$prenom = $_POST['prenom'];

    if(!empty($nom) && !empty($prenom) && ctype_alpha($nom) && ctype_alpha($prenom)) {
        //Count
        $count = "SELECT `NOM`, `PRENOM` FROM `apprenants` WHERE `NOM` = '" . $nom . "' AND PRENOM = '" . $prenom . "'"; 
        $res_count = mysqli_query($connect, $count);
        $row_count = mysqli_num_rows($res_count);
        if($row_count > 0) {
            affichage($connect);
            exit();
            }
            else {
                $req = "INSERT INTO `apprenants`(`NOM`,`PRENOM`) VALUES ('$nom','$prenom')";
                $res = $connect -> query($req); 
                echo "Insertion reussi";
                if($res) {
                    affichage($connect);
                    }
                    else {
                        echo "Erreur INSERT  : " . var_dump($req);
                    }
            }

        } 
        else {
            echo "Merci de remplir tout les champs correctement.";
        } 
    }  
    else {
        affichage($connect);
    }

?>