<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Suppression theme</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    // Connexion à la base de données
    include("connexion.php");

    // Requête pour obtenir tous les thèmes
    $query = "SELECT * FROM themes where supprime = 0";
    $result = mysqli_query($connect, $query);
    if (!$result) // TOUJOURS tester le resultat de la requete
    {
        echo 'Requête ' . $result . ' invalide et voici le code erreur de mysql : ' . mysqli_error($connect);
        mysqli_close($connect);
        exit;
    }


    if (mysqli_num_rows($result) > 0) {
        echo "<div class='form-container'>";
        echo "<form action='supprimer_theme.php' method='post'>";
        echo "<label for='idtheme'><h2>Sélectionner un thème à supprimer :</h2></label>";
        echo "<select name='idtheme' id='idtheme' requiered>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["idtheme"] . "'><strong>" . $row["nom"] . "</strong> " . $row["description"] . "</option>";
        }
        echo "</select>";
        echo "<input type='submit' value='Supprimer'>";
        echo "</form>";
        echo "</div>";
    } else {
        echo "Aucun thème trouvé.";
    }

    mysqli_close($connect);
    ?>
</body>

</html>