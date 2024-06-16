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
    $ideleve = $_POST["ideleve"];
    $idseance = $_POST["idseance"];
    if (empty($idseance) || empty($ideleve)) {
        echo "Veuillez sélectionner un élève et une séance correct.";
        exit;
    }

    $query = "DELETE FROM inscription WHERE idseance = $idseance AND ideleve = $ideleve";
    $result = mysqli_query($connect, $query);
    if (!$result) // TOUJOURS tester le resultat de la requete
    {
        echo 'Requête ' . $result . ' invalide et voici le code erreur de mysql : ' . mysqli_error($connect);
        mysqli_close($connect);
        exit;
    }
    echo "élève correctement desinscrit de la séance !";
    ?>
</body>

</html>