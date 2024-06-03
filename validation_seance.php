<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Validation Seance</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <?php
    include("connexion.php");
    $liste_seances_passees = mysqli_query($connect,"SELECT idseance, nom, DateSeance FROM seances inner join themes on seances.Idtheme = themes.idtheme WHERE DateSeance < CURRENT_DATE;");

    if (!$liste_seances_passees) // TOUJOURS tester le resultat de la requete
        {
            echo 'Requête '.$liste_seances_passees.' invalide et voici le code erreur de mysql : '.mysqli_error($connect);
            mysqli_close($connect);
            exit;
        }
    
    if (mysqli_num_rows($liste_seances_passees) > 0) {
        echo "<form action='valider_seance.php' method='post'>";
        echo "<select name='idseance'>";
        while($row = $liste_seances_passees->fetch_assoc()) {
            echo "<option value='" . $row["idseance"] . "'>".$row["nom"] ." du ". $row["DateSeance"] . "</option>";
        }
        echo "</select>";
        echo "<input type='submit' value='Valider'>";
        echo "</form>";
    } else {
        echo "Aucune séance passée trouvée.";
    }
    mysqli_close($connect);
    ?>
</body>
</html>