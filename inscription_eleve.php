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
    <h1>Inscription élève</h1>
    <form action="inscrire_eleve.php" method="post">
        
        <?php
        include("connexion.php");
        
        $liste_eleves = mysqli_query($connect,"SELECT * FROM eleves");

        if (!$liste_eleves) // TOUJOURS tester le resultat de la requete
        {
            echo 'Requête '.$liste_eleves.' invalide et voici le code erreur de mysql : '.mysqli_error($connect);
            mysqli_close($connect);
            exit;
        }
        

        $liste_seances = mysqli_query($connect,"SELECT seances.idseance, DateSeance, EffMax, COUNT(ideleve) AS nbEleve, nom FROM seances inner join themes on seances.Idtheme = themes.idtheme LEFT OUTER JOIN inscription on seances.idseance = inscription.idseance where DateSeance >= CURRENT_DATE() GROUP BY seances.idseance HAVING nbEleve < EffMax");


        if (!$liste_seances) // TOUJOURS tester le resultat de la requete
        {
            echo 'Requête '.$liste_seances.' invalide et voici le code erreur de mysql : '.mysqli_error($connect);
            mysqli_close($connect);
            exit;
        }
        
        echo "<label for='ideleve'>Eleve</label>";
        echo "<select name='ideleve' id='eleve'>";
        while ($row = mysqli_fetch_array($liste_eleves, MYSQLI_NUM))
        {
            echo"<option value='$row[0]'>$row[1] $row[2]</option>";
        }
        echo "</select>"; 
        echo "<BR>";

        echo "<label for='idseance'>seances</label>";
        echo "<select name='idseance' id='seance'>";
        while ($row = mysqli_fetch_array($liste_seances, MYSQLI_NUM))
        {
            echo"<option value='$row[0]'>$row[4] du $row[1], $row[3]/$row[2]</option>";
        }
        echo "</select>"; 
        echo "<BR>";
        
        echo "<INPUT type='submit' value='Enregistrer'>";

        mysqli_close($connect);
        
        ?>
        </select>
    </form>
    </div>
</body>
</html>