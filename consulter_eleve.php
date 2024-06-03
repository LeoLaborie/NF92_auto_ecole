<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>consulter eleve</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
include("connexion.php");

// Récupérer l'ID de l'élève sélectionné
$ideleve = $_POST['ideleve'];

// Requête pour obtenir les caractéristiques de l'élève
$query = "SELECT * FROM eleves WHERE ideleve = $ideleve";
$result = mysqli_query($connect,$query);
if (!$result) // TOUJOURS tester le resultat de la requete
{
    echo 'Requête '.$result.' invalide et voici le code erreur de mysql : '.mysqli_error($connect);
    mysqli_close($connect);
    exit;
}

if ($result->num_rows > 0) {
    // Afficher les caractéristiques de l'élève
    $row = $result->fetch_assoc();
    echo "<div class='form-container'>";
    echo "<h2>Caractéristiques de l'élève</h2>";
    echo "<p><strong>Nom :</strong> " . $row["nom"] . "</p>";
    echo "<p><strong>Prénom :</strong> " . $row["prenom"] . "</p>";
    echo "<p><strong>Date de naissance :</strong> " . $row["date_naissance"] . "</p>";
    echo "<p><strong>Date d'inscription :</strong> " . $row["dateInscription"] . "</p>";
    echo "</div>";
} else {
    echo "Aucun élève trouvé avec cet ID.";
}

mysqli_close($connect);
?>
</body>
</html>