<?php
require('common/head.html')
?>
<body>
    <h1>Premier cours PHP MySql</h1>
    <br />
    <table>
    <form class='w3-container' action="crud/inserer.php" method="post" >
        <input class='w3-input' type="text" name="nom" placeholder="Nom"  maxlength="33" minlength="2" /><br />
        <input class='w3-input' type="text" name="prenom" placeholder="Prénom"  maxlength="33" minlength="2" /><br />
        <input class='w3-btn w3-blue' type="submit" value="Insérer" /> 
    </form>
     </table>
</body>
</html>