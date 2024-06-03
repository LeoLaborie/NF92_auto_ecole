<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Consultation eleve</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
// Connexion à la base de données
include("connexion.php");

// Requête pour obtenir tous les élèves
$query = "SELECT * FROM eleves";
$liste_eleves = mysqli_query($connect,$query);
if (!$liste_eleves) // TOUJOURS tester le resultat de la requete
{
    echo 'Requête '.$liste_eleves.' invalide et voici le code erreur de mysql : '.mysqli_error($connect);
    mysqli_close($connect);
    exit;
}

if (mysqli_num_rows($liste_eleves) > 0) {
    echo "<form action='consulter_eleve.php' method='post'>";
    echo "<label for='ideleve'>Sélectionner un élève :</label>";
    echo "<select name='ideleve' id='ideleve'>";
    while($row = $liste_eleves->fetch_assoc()) {
        echo "<option value='" . $row["ideleve"] . "'>" . $row["nom"] . " " . $row["prenom"] . "</option>";
    }
    echo "</select>";
    echo "<input type='submit' value='Consulter'>";
    echo "</form>";
} else {
    echo "Aucun élève trouvé.";
}

mysqli_close($connect);
?>
</body>
</html>