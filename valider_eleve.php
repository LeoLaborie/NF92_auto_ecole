<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <?php
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $array1 = array("nom", "prenom", "date de naissance");
    $array2 = array($nom, $prenom, $date_naissance);
    if (empty($nom) || empty($prenom) || empty($date_naissance)) {
        for ($i = 0; $i < 3; $i++) {
            if (empty($array2[$i])) print("Le champ " . $array1[$i] . " est vide, veuillez le remplir. <br>");
        }
    } else if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date_naissance)) {
        print("La date de naissance doit être au format YYYY-MM-DD");
    } else if (strtotime($date_naissance) > strtotime(date("Y-m-d"))) {
        print("La date de naissance ne peut pas être supérieure à la date actuelle");
    } else if (strtotime($date_naissance) < strtotime("1900-01-01")) {
        print("La date de naissance ne peut pas être inférieure à 1900-01-01");
    } else if (!preg_match("/^[a-zA-Z ]*$/", $nom) || !preg_match("/^[a-zA-Z ]*$/", $prenom)) {
        print("Le nom et le prénom ne peuvent contenir que des lettres et des espaces");
    } 
    else {

        print("<ul>");
        for ($i = 0; $i < 3; $i++) {
            print("<li>" . $array1[$i] . " : " . $array2[$i] . " </li>");
        }
        print("</ul>");

        include("connexion.php");

        $query = "SELECT * from eleves WHERE nom='$nom' AND prenom='$prenom'";

        $result = mysqli_query($connect, $query);
        if (!$result) // TOUJOURS tester le resultat de la requete
        {
            echo 'Requête ' . $query . ' invalide et voici le code erreur de mysql : ' . mysqli_error($connect);
            mysqli_close($connect);
            exit;
        }
        $nb_homonymes = mysqli_num_rows($result);
        if ($nb_homonymes == 0) {
            $query = 'INSERT INTO eleves values (null, "' . $_POST['nom'] . '", "' . $_POST['prenom'] . '", "' . $_POST['date_naissance'] . '", "' . date("Y-m-d") . '")'; // une chaine de caractere nommee $query
            $result = mysqli_query($connect, $query);

            if (!$result) // TOUJOURS tester le resultat de la requete
            {
                echo 'Requête ' . $query . ' invalide et voici le code erreur de mysql : ' . mysqli_error($connect);
                mysqli_close($connect);
                exit;
            }
        } else {
            echo "l'élève $nom $prenom existe déjà, etes vous sur de l'ajouter ?";
    ?>

            <form action="ajouter_eleve.php" method="post">
                <input type="hidden" name="nom" value="<?php $nom ?>">
                <input type="hidden" name="prenom" value="<?php $prenom ?>">
                <input type="hidden" name="date_naissance" value="<?php $date_naissance ?>">
                <input type="submit" value="OUI">
                <a href="ajout_eleve.html"> <button type="button">non</button></a>
            </form>
    <?php
        }
    }
    mysqli_close($connect);
    ?>
</body>

</html>