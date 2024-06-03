<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>valider seance</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <?php
        include("connexion.php");
        // Récupérer l'ID de la séance sélectionnée
        $idseance = $_POST['idseance'];


        // Requête pour obtenir les élèves inscrits à cette séance
        $query = "SELECT *
                FROM inscription
                JOIN eleves ON inscription.ideleve = eleves.ideleve
                WHERE inscription.idseance = $idseance";
        $result = mysqli_query($connect,$query);

        if (!$result) // TOUJOURS tester le resultat de la requete
            {
                echo 'Requête '.$result.' invalide et voici le code erreur de mysql : '.mysqli_error($connect);
                mysqli_close($connect);
                exit;
            }

        if (mysqli_num_rows($result) > 0) {
            echo "<form action='noter_eleves.php' method='post'>";
            echo "<input type='hidden' name='idseance' value='$idseance'>";
            while($row = $result->fetch_assoc()) {
                echo "<label for='eleve_" . $row["ideleve"] . "'>" . $row["nom"] . " " . $row["prenom"] . ":</label>";
                echo "<input type='number' id='eleve_" . $row["ideleve"] . "' name='eleves[" . $row["ideleve"] . "]' value='" . $row["note"] . "' min = '0' max='40' required><br>";
            }
            echo "<input type='submit' value='Enregistrer'>";
            echo "</form>";
        } else {
            echo "Aucun élève inscrit à cette séance.";
        }

        mysqli_close($connect);
        ?>

</body>
</html>