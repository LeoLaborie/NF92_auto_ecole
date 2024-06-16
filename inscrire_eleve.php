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
    } 
    
    else {
        print("<div class='form-container'>");
        print("<ul>");
        for ($i = 0; $i < 2; $i++) {
            print("<li>" . $array1[$i] . " : " . $array2[$i] . " </li>");
        }
        print("</ul>");

        include("connexion.php");

        //verifier si eleve est pas deja dans la seance
        $query = "SELECT * from inscription WHERE idseance=$idseance AND ideleve=$ideleve";

        $result = mysqli_query($connect, $query);

        if (!$result) // TOUJOURS tester le resultat de la requete
        {
            echo 'Requête ' . $query . ' invalide et voici le code erreur de mysql : ' . mysqli_error($connect);
            mysqli_close($connect);
            exit;
        }
        $nb_homonymes = mysqli_num_rows($result);
        if ($nb_homonymes > 0) {
            echo "l'élève $ideleve est déjà inscrit à la séance $idseance <br> il n'a donc pas été ré-inscrit";
            exit;
        }
        // verifier si la seance est dans le futur
        $query = "SELECT * from seances WHERE idseance=$idseance";
        $result = mysqli_query($connect, $query);
        if (!$result) {
            echo 'Requête ' . $query . ' invalide et voici le code erreur de mysql : ' . mysqli_error($connect);
            mysqli_close($connect);
            exit;
        }
        if (mysqli_num_rows($result) == 0 || mysqli_fetch_assoc($result)['DateSeance'] < date("Y-m-d")) {
            echo "La séance $idseance n'existe pas ou est passée";
            exit;
        }

        $query = "INSERT into inscription values($idseance, $ideleve, '-1')";

        $result = mysqli_query($connect, $query);

        if (!$result) // TOUJOURS tester le resultat de la requete
        {
            echo 'Requête ' . $query . ' invalide et voici le code erreur de mysql : ' . mysqli_error($connect);
            mysqli_close($connect);
            exit;
        }
        print("l'élève $ideleve a bien été inscrit à la séance $idseance <br>");
        print("</div>");
        mysqli_close($connect);
    }
    ?>
    </ul>
</body>

</html>