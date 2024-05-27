<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <div class="form-container">
    <h1>Ajout d'une séance</h1>
    <form action="ajouter_seance.php" method="post">
        <label for="date">Date de la séance</label>
        <input type="date" name="date"><br>

        <label for="effmax">Effectif maximum de la séance</label>
        <input type="text" name="effmax"><br>

        <label for="idtheme">Thème</label>
        <select name="idtheme" id="theme">

        <?php
        include("connexion.php");
        
        $liste_themes_actifs = mysqli_query($connect,"SELECT * FROM themes WHERE supprime=FALSE");

        if (!$liste_themes_actifs) // TOUJOURS tester le resultat de la requete
        {
            echo 'Requête '.$liste_themes_actifs.' invalide et voici le code erreur de mysql : '.mysqli_error($connect);
            mysqli_close($connect);
            exit;
        }

        while ($row = mysqli_fetch_array($liste_themes_actifs, MYSQLI_NUM))
        {

            echo"<option value='$row[0]'>$row[1]</option>";
            
        }
        echo "</select>"; 
        echo "<BR>";
        echo "<INPUT type='submit' value='Enregistrer séance'>";
        mysqli_close($connect);
        
        ?>
        </select>
    </form>
    </div>
</body>
</html>