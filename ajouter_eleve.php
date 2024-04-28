<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        
            <?php
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $date_naissance= $_POST['date_naissance'];
                $array1= array("nom", "prenom", "date de naissance");
                $array2= array($nom, $prenom, $date_naissance);
                if (empty($nom) || empty($prenom) || empty($date_naissance)){
                    for ($i=0; $i<3; $i++){
                        if (empty($array2[$i])) print("Le champ ".$array1[$i]." est vide, veuillez le remplir. <br>");
                    }
                }
                else{
                    print("<ul>");
                    for ($i=0; $i<3; $i++){
                        print("<li>".$array1[$i]." : ".$array2[$i]." </li>");
                    }
                    print("</ul>");
                }
                print("test");
            ?>
        </ul>
    </body>
</html>