<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        
            <?php
                $nom = $_POST['nom'];
                $description = $_POST['description'];
                $array1= array("nom", "description");
                $array2= array($nom, $description);
                if (empty($nom) || empty($description)){
                    for ($i=0; $i<2; $i++){
                        if (empty($array2[$i])) print("Le champ ".$array1[$i]." est vide, veuillez le remplir. <br>");
                    }
                }
                else{
                    print("<ul>");
                    for ($i=0; $i<2; $i++){
                        print("<li>".$array1[$i]." : ".$array2[$i]." </li>");
                    }
                    print("</ul>");
                }
            ?>
        </ul>
    </body>
</html>