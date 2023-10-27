<?php
require('../sql/connect.php');
require('affichage.php');
$connect = connect();

if(isset($_POST['coche']))
{
    $connect = connect();
            foreach($_POST['coche'] as $valeur)
            {
                $del = "DELETE FROM `apprenants` WHERE `ID` =  '" . $valeur . "'"; 
                $res_del = mysqli_query($connect, $del);
            }
        affichage($connect);    
        
}
else {
    echo "Aucune case n'est cochée.";
}
?>