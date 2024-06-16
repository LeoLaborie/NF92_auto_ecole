<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css">
    <title>Mon site d'auto école</title>
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
    } else {

        print("<ul>");
        for ($i = 0; $i < 3; $i++) {
            print("<li>" . $array1[$i] . " : " . $array2[$i] . " </li>");
        }
        print("</ul>");

        include("connexion.php");

        $query = 'INSERT INTO eleves values (null, "' . $_POST['nom'] . '", "' . $_POST['prenom'] . '", "' . $_POST['date_naissance'] . '", "' . date("Y-m-d") . '")'; // une chaine de caractere nommee $query
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