<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>noter_eleves</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    include("connexion.php");
    // Récupérer les données du formulaire
    $idseance = $_POST['idseance'];
    $eleves = $_POST['eleves'];
    if (empty($idseance) || empty($eleves)) {
        echo "Veuillez sélectionner une séance et entrer les notes des élèves.";
        exit;
    }

    // Mettre à jour les notes pour chaque élève
    foreach ($eleves as $ideleve => $note) {
        $query = "UPDATE inscription SET note = $note WHERE idseance = $idseance AND ideleve = $ideleve";
        $result = mysqli_query($connect, $query);

        if (!$result) // TOUJOURS tester le resultat de la requete
        {
            echo 'Requête ' . $result . ' invalide et voici le code erreur de mysql : ' . mysqli_error($connect);
            mysqli_close($connect);
            exit;
        }
    }

    echo "Les notes ont été mises à jour avec succès.";

    mysqli_close($connect);
    ?>
</body>

</html>