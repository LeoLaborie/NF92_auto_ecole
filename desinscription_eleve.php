<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="form-container">
        <h1>désinscription élève</h1>
        <form action="desinscription_seance.php" method="post">

            <?php
            include("connexion.php");

            $liste_eleves = mysqli_query($connect, "SELECT * FROM eleves");

            if (!$liste_eleves) // TOUJOURS tester le resultat de la requete
            {
                echo 'Requête ' . $liste_eleves . ' invalide et voici le code erreur de mysql : ' . mysqli_error($connect);
                mysqli_close($connect);
                exit;
            }


            echo "<label for='ideleve'>Eleve</label>";
            echo "<select name='ideleve' id='eleve' requiered>";
            while ($row = mysqli_fetch_array($liste_eleves, MYSQLI_NUM)) {
                echo "<option value='$row[0]'>$row[1] $row[2]</option>";
            }
            echo "</select>";
            echo "<BR>";

            echo "<INPUT type='submit' value='Suivant'>";

            mysqli_close($connect);

            ?>
            </select>
        </form>
    </div>
</body>

</html>