<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Supprimer theme</title>
</head>
<body>
<?php
// Connexion à la base de données
include("connexion.php");

// Requête pour obtenir tous les thèmes
$idtheme = $_POST["idtheme"];
$query = "DELETE FROM themes WHERE idtheme = $idtheme";
$result = mysqli_query($connect,$query);
if (!$result) // TOUJOURS tester le resultat de la requete
{
    echo 'Requête '.$result.' invalide et voici le code erreur de mysql : '.mysqli_error($connect);
    mysqli_close($connect);
    exit;
}
echo "theme correctement supprimé !";
?>
</body>
</html>