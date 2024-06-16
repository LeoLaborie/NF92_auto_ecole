<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css">
    <title>Mon site d'auto école</title>
</head>

<body>

    <?php

    $date = $_POST['date'];
    $effmax = $_POST['effmax'];
    $idtheme = $_POST['idtheme'];
    $array1 = array("date", "effmax", "idtheme");
    $array2 = array($date, $effmax, $idtheme);
    if (empty($date) || empty($effmax) || empty($idtheme)) {
        for ($i = 0; $i < 3; $i++) {
            if (empty($array2[$i])) print("Le champ " . $array1[$i] . " est vide, veuillez le remplir. <br>");
        }
    }
    else if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date)) {
        print("La date doit être au format YYYY-MM-DD");
    } 
    else if (strtotime($date) < strtotime(date("Y-m-d"))) {
        print("La date ne peut pas être inférieure à la date actuelle");
    }
    
    //verifier si effmax est un entier > 0
    else if (!preg_match("/^[0-9]*$/", $effmax) || $effmax <= 0) {
        print("L'effectif maximum doit être un entier supérieur à 0");
    }
    
    //verifier si idtheme est un entier
    else if (!preg_match("/^[0-9]*$/", $idtheme)) {
        print("L'id du thème doit être un entier");
    }

    
    
    else {
        echo "<div class='form-container'>";
        print("<ul>");
        for ($i = 0; $i < 3; $i++) {
            print("<li>" . $array1[$i] . " : " . $array2[$i] . " </li>");
        }
        print("</ul>");

        include("connexion.php");
        $query = "SELECT * FROM seances WHERE DateSeance='$date' AND idtheme=$idtheme";

        $result = mysqli_query($connect, $query);

        if (!$result) // TOUJOURS tester le resultat de la requete
        {
            echo 'Requête ' . $query . ' invalide et voici le code erreur de mysql : ' . mysqli_error($connect);
            mysqli_close($connect);
            exit;
        }
        $n_seances_existantes = mysqli_num_rows($result);
        if ($n_seances_existantes > 0) {
            echo "<p> Il existe deja une seance sur ce theme à cette date</p>";
            mysqli_close($connect);
            exit;
        }

        $query = 'INSERT INTO seances values (null, "' . $_POST['date'] . '", "' . $_POST['effmax'] . '", "' . $_POST['idtheme'] . '")'; // une chaine de caractere nommee $query
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