<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Supprimer theme</title>
    <link rel="stylesheet" href="style.css" />
</head>


<body>
    <?php
    // Connexion à la base de données
    include("connexion.php");

    // Requête pour obtenir tous les thèmes
    $idtheme = $_POST["idtheme"];
    if (empty($idtheme)) {
        echo "Veuillez sélectionner un thème à supprimer.";
        exit;
    }
    //update "supprimer" en le mettant à 1
    $query = "UPDATE themes SET supprime = 1 WHERE idtheme = $idtheme";
    $result = mysqli_query($connect, $query);
    if (!$result) // TOUJOURS tester le resultat de la requete
    {
        echo 'Requête ' . $result . ' invalide et voici le code erreur de mysql : ' . mysqli_error($connect);
        mysqli_close($connect);
        exit;
    }
    echo "theme correctement supprimé !";
    ?>
</body>

</html>