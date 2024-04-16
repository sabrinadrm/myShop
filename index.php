<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body>
  <div class = "container">
    <h1>Liste client :</h1>
    <a href =" /myShop/createClient.php" class = "btn">Ajouter un Client</a>
    <table class= "table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>email</th>
                <th>Phone</th>
                <th>adress</th>
                <th>crée le : </th>
                <th>action </th>
            </tr>
        </thead>

        <tbody>

     <! --début du code php connection bdd-- >
       <?php
            $serverName = 'localhost';
            $userName ='root';
            $passeword ='root';
            $dbname = 'myShop';
    
     // création de connexion 
            $connexion = new mysqli($serverName, $userName, $passeword, $dbname);
    // vérification de la connexion 
        if ($connexion->connect_error) { 
            die("Connection echoué: " . $connexion->connect_error); 
         }
    // lire toutes les données de la table client 
        $sql = "SELECT * FROM  `clients`";
        $resultat = $connexion -> query($sql);
    // vérifier si la requete est bien exécuté
    if (!$resultat) {
        die ("requête invalide : ".$connexion->error); 
    }
    // lire les datas de chaque ligne 
    while ($row = $resultat->fetch_assoc()) {
        echo"
            <tr> 
                <td>$row[ID]</td>  
                <td>$row[name]</td>
                <td>$row[email]</td>
                <td>$row[phone]</td>
                <td>$row[adress]</td>
                <td>$row[created_at]</td>    
                <td>
                <a class='btn btn-primary btn-m5' href='/myShop/updateClient.php?ID=$row[ID]'>Modifier</a>
                <a class='btn btn-danger btn-m5' href='/myShop/deleteClient.php?ID=$row[ID]'>Supprimer</a>
                </td>
            </tr> 
             
        ";
    };
     
       
?>

        <
        </tbody>
</div>

</body>
</html>
