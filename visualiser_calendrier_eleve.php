<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>consulter eleve</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php

    // Récupérer l'ID de l'élève sélectionné
    $ideleve = $_POST['ideleve'];
    if (empty($ideleve)) {
        echo "Veuillez sélectionner un élève.";
        exit;
    }
    include("connexion.php");
    $query =   "SELECT 
                    eleves.nom AS nom, 
                    eleves.prenom AS prenom, 
                    themes.nom AS nom_theme, 
                    seances.DateSeance AS DateSeance, 
                    seances.EffMax AS EffMax 
                FROM eleves 
                inner join inscription ON eleves.ideleve = inscription.ideleve 
                inner join seances ON inscription.idseance = seances.idseance
                inner join themes ON seances.idtheme = themes.idtheme
                WHERE eleves.ideleve = $ideleve AND seances.DateSeance >= CURDATE()";
    $result = mysqli_query($connect, $query);
    if (!$result) // TOUJOURS tester le resultat de la requete
    {
        echo 'Requête ' . $result . ' invalide et voici le code erreur de mysql : ' . mysqli_error($connect);
        mysqli_close($connect);
        exit;
    }

    if ($result->num_rows > 0) {
        // Afficher le calendrier de l'eleve dans un tableau
        echo "<div class='form-container'>";
        echo "<h2>Calendrier de l'élève</h2>";
        echo "<p><strong>Nombre Seance :</strong> " . $result->num_rows . " séances</p>";
        echo "<ul>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<li>";
            echo "<p><strong>Theme :</strong> " . $row["nom_theme"] . "</p>";
            echo "<p><strong>Date :</strong> " . $row["DateSeance"] . "</p>";
            echo "<p><strong>Nombre de places :</strong> " . $row["EffMax"] . "</p>";
            echo "</li>";
        }
        echo "</ul>";
        echo "</div>";
    } else {
        echo "Aucune séance prévue pour cet élève.";
    }

    mysqli_close($connect);
    ?>
</body>

</html>