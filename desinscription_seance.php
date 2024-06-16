<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>valider seance</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    include("connexion.php");
    $ideleve = $_POST['ideleve'];

    if (empty($ideleve)) {
        echo "Veuillez sélectionner un élève.";
        mysqli_close($connect);
        exit;
    }
    // Requête pour obtenir les séances dans le futur auqels est inscrit l'élève
    $query = "SELECT seances.idseance, themes.nom, DateSeance
                FROM inscription
                inner JOIN seances ON inscription.idseance = seances.idseance
                inner join themes on seances.idtheme = themes.idtheme
                WHERE inscription.ideleve = $ideleve AND seances.DateSeance >= CURDATE()";
    $result = mysqli_query($connect, $query);

    if (!$result) // TOUJOURS tester le resultat de la requete
    {
        echo 'Requête ' . $result . ' invalide et voici le code erreur de mysql : ' . mysqli_error($connect);
        mysqli_close($connect);
        exit;
    }

    if (mysqli_num_rows($result) > 0) {
        echo "<form class='form-container' action='desinscrire_seance.php' method='post'>";
        echo "<h2>Désinscrire de quelle séance ?</h2>";
        echo "<input type='hidden' name='ideleve' value='$ideleve'>";
        
        echo "<label for='idseance'>Sélectionner une séance :</label>";
        echo "<select name='idseance' id='seance' requiered>";
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
            echo "<option value='$row[0]'>$row[1] du $row[2]</option>";
        }
        echo "</select>";

        echo "<input type='submit' value='Enregistrer'>";
        echo "</form>";
    } else {
        echo "L'élève n'est inscrit à aucune séance dans le future";
    }

    mysqli_close($connect);
    ?>

</body>

</html>