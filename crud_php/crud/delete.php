<?php
/** NOT USE */
require('../sql/affichage.php');

echo "Mon indice ::: '" . $_GET['indice'] . "'";
$indice = $_GET['indice'];

//connection bdd

$server = 'localhost';
$bdd    = 'm2i';
$user   = 'root';
$pwd    = ''; //par defaut WAMP - MAMP ::: root

$connect = mysqli_connect($server, $user, $pwd, $bdd);
            //mysqli_connect(SERVER, LOGIN, PASS, MABDD);
if(!$connect) {
    die('Erreur de connection : ' . mysqli_connect_error());
        }
        else {
            $del     = "DELETE FROM `apprenants` WHERE `ID` = '" . $indice   . "'";
            $res_del = mysqli_query($connect, $del); 

            if($res_del) {
                echo "Bravo element supprimé.";
                affichage($connect);
            }
            else {
                echo "Erreur requete ::: " . var_dump($del);
                exit();
            }
        }

?>