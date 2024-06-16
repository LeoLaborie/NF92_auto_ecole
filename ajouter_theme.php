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
        print("<ul>");
        for ($i = 0; $i < 2; $i++) {
            print("<li>" . $array1[$i] . " : " . $array2[$i] . " </li>");
        }
        print("</ul>");

        include("connexion.php");

        $query = 'INSERT INTO themes values (null, "' . $_POST['nom'] . '", "' . "0" . '", "' . $_POST['description'] . '")'; // une chaine de caractere nommee $query
        print($query);
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

        mysqli_close($connect);
    }
    ?>
    </ul>
</body>

</html>