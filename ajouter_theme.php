<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css">
    <title>Mon site d'auto école</title>
</head>

<body>

    <?php
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $array1 = array("nom", "description");
    $array2 = array($nom, $description);
    if (empty($nom) || empty($description)) {
        for ($i = 0; $i < 2; $i++) {
            if (empty($array2[$i])) print("Le champ " . $array1[$i] . " est vide, veuillez le remplir. <br>");
        }
    } else {
        echo "<div class='form-container'>";
        print("<ul>");
        for ($i = 0; $i < 2; $i++) {
            print("<li>" . $array1[$i] . " : " . $array2[$i] . " </li>");
        }
        print("</ul>");

        include("connexion.php");
        // si deux themes ont le meme nom, on ne peut pas les ajouter
        $query = "SELECT * from themes WHERE nom='$nom' AND supprime=0";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) > 0) {
            //update "supprime" a 0 du theme
            $query = "UPDATE themes SET supprime=0 WHERE nom='$nom'";
            $result = mysqli_query($connect, $query);
            if (!$result) // TOUJOURS tester le resultat de la requete
            {
                echo 'Requête ' . $query . ' invalide et voici le code erreur de mysql : ' . mysqli_error($connect);
                mysqli_close($connect);
                exit;
            }
            echo "Le thème $nom a été réactivé";
            exit;
        }



        $query = 'INSERT INTO themes values (null, "' . $_POST['nom'] . '", "' . "0" . '", "' . $_POST['description'] . '")'; // une chaine de caractere nommee $query
        // print($query);
        print("<br>");

        $result = mysqli_query($connect, $query);

        if (!$result) // TOUJOURS tester le resultat de la requete
        {
            echo 'Requête ' . $query . ' invalide et voici le code erreur de mysql : ' . mysqli_error($connect);
            mysqli_close($connect);
            exit;
        } else {
            print("opération réussie");
            print("<br>");
        }
        echo "</div>";
        mysqli_close($connect);
    }
    ?>
    </ul>
</body>

</html>