<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css">
    <title>Mon site d'auto école</title>
</head>

<body>

    <?php

    $ideleve = $_POST['ideleve'];
    $idseance = $_POST['idseance'];

    $array1 = array("ideleve", "idseance");
    $array2 = array($ideleve, $idseance);
    /*
                verifier
                champs non vide
                ideleve existe
                idseance existe
                seance dans ke future
                seance pas > effmax
                */
    if (empty($ideleve) || empty($idseance)) {
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
        $query = "INSERT into inscription values($idseance, $ideleve, '-1')";

        $result = mysqli_query($connect, $query);

        if (!$result) // TOUJOURS tester le resultat de la requete
        {
            echo 'Requête ' . $query . ' invalide et voici le code erreur de mysql : ' . mysqli_error($connect);
            mysqli_close($connect);
            exit;
        }

        mysqli_close($connect);
    }
    ?>
    </ul>
</body>

</html>